<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    public function success($msg = "请求成功", $data = [], $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ]);
    }

    public function fail($msg = "请求失败", $data = null, $code = -1): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ]);
    }
}
