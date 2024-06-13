<?php

namespace App\Http\Controllers;

use App\Helpers\Tools\Tool;
use App\Models\User;
use App\Jobs\MailSend;
use App\Services\EmailtplService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class AuthController extends BaseController
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $code = $request->verCode;
        $sysCode = Cache::get($request->email . '_code_cache');
        if ($code !== $sysCode) {
            return $this->fail('验证码错误');
        }

        $super_code = trim($request->inviteCode);
        $super_user = null;
        if (!empty($super_code)) {
            // 根据邀请码获取邀请用户
            $super_user = User::where('invitation_code', $super_code)->first();
            if (!$super_user) {
                return $this->fail('邀请码无效');
            }
        }

        $user = User::create([
            'name' => $request->username,
            'email_verified_at' => now(),
            'join_time' => now(),
            'expire_at' => now(),
            'super_user_id' => $super_user->id ?? null,
            'email' => $request->email,
            'status' => 1,
            'invitation_code' => generateRandomString(),
            'password' => Hash::make($request->password)
        ]);

        return $this->success('注册成功', $user);
    }



    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (! $token = auth()->guard('api')->attempt($credentials)) {
                return response()->json(['error' => '未授权'], 401);
            }

            return $this->respondWithToken($token);
        } catch (\Exception $exception) {
            Log::error("打印错误", ['$exception' => $exception]);
            return response()->json(['error' => "系统错误"], 401);

        }

    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60 * 24
        ]);
    }

    public function sendEmailCode(Request $request)
    {
        $input = $request->all();
        $to = trim($input['email']);
        $code = mt_rand(100000, 999999);
        Cache::put($to . '_code_cache', $code, 10* 60);
        $mailData = [
            'code' => $code,
        ];
        $emailtplService = new EmailtplService();
        $tpl = $emailtplService->detailByToken('send_reg_mail');

        $mailBody = Tool::replace_mail_tpl($tpl, $mailData);
        Log::info("记录邮箱", ["email" => $mailBody]);

        try {
            // 邮件发送
            MailSend::dispatch($to, $mailBody['tpl_name'], $mailBody['tpl_content']);

        } catch(\Exception $e) {
            return $this->fail($e->getMessage());
        }
        return $this->success("发送成功");
    }
}
