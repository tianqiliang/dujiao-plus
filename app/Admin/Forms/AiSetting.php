<?php

namespace App\Admin\Forms;

use App\Models\BaseModel;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Cache;

class AiSetting extends Form
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
        Cache::put('ai-setting', $input);
        return $this
            ->response()
            ->success('AI配置保存成功');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->tab("AI设置", function () {
            $this->switch('is_open_sso', "是否开启单点登录")
                ->default(BaseModel::STATUS_CLOSE);
        });
        $this->tab("网关及API授权", function () {
            $this->text('gw_host', "网关地址");
            $this->text('gw_key', "网关密钥");
            $this->text('auth', "APIAUTH");
        });
        $this->tab("敏感词配置", function () {
            $this->textarea('sensitive_words', "敏感词");
        });
        $this->confirm("AI设置保存成功");
    }

    /**
     * The data of the form.
     *
     * @return array
     */
    public function default()
    {
        return Cache::get('ai-setting');
    }
}
