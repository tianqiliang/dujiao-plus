<?php

namespace App\Admin\Forms;

use App\Models\BaseModel;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Cache;

class SystemSetting extends Form
{
    /**
     * Handle the form request.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function handle(array $input)
    {
        Cache::put('system-setting', $input);
        return $this
				->response()
				->success('系统配置保存成功');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->tab("基础设置", function () {
            $this->text('title', "网站标题")->required();
            $this->image('img_logo', "网站logo");
            $this->text('text_logo', "文字logo");
            $this->text('keywords', "网站关键字");
            $this->textarea('description', "网站描述");
            $this->text('manage_email', "管理员邮箱");
            $this->number('order_expire_time', "订单过期时间(分钟)")
                ->default(5)
                ->required();
            $this->editor('notice', "站点公告");
//            $this->textarea('footer', admin_trans('system-setting.fields.footer'));
        });
        $this->tab("订单推送配置", function () {
            $this->switch('is_open_server_jiang', "是否开启Server酱")
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('server_jiang_token', "Server酱通讯Token");
            $this->switch('is_open_telegram_push', "是否开启Telegram推送")
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('telegram_bot_token', "Telegram通讯Token");
            $this->text('telegram_userid', "Telegram用户Id");
            $this->switch('is_open_qywxbot_push', "是否开启企业微信推送")
                ->default(BaseModel::STATUS_CLOSE);
            $this->text('qywxbot_key', "企业微信通讯Key");
        });
        $this->tab("邮件服务", function () {
            $this->text('driver', "邮件驱动")->default('smtp')->required();
            $this->text('host', "Smtp服务器地址");
            $this->text('port', "端口")->default(587);
            $this->text('username', "账号");
            $this->text('password', "密码");
            $this->text('encryption', "协议");
            $this->text('from_address', "发件地址");
            $this->text('from_name', "发件名称");
        });
        $this->confirm("系统配置保存成功","修改部分配置需要重启[supervisor]或php进程管理工具才会生效，例如邮件服务，server酱等。"
        );
    }

    public function default()
    {
        return Cache::get('system-setting');
    }

}
