<?php

namespace App\Helpers\Tools;

use Illuminate\Support\Facades\Cache;

class Tool
{
    public static function replace_mail_tpl($mailtpl = [], $data = [])
    {
        if (!$mailtpl) {
            return false;
        }
        if ($data) {
            foreach ($data as $key => $val) {
                $title = str_replace('{' . $key . '}', $val, isset($title) ? $title : $mailtpl['tpl_name']);
                $content = str_replace('{' . $key . '}', $val, isset($content) ? $content : $mailtpl['tpl_content']);
            }
            return ['tpl_name' => $title, 'tpl_content' => $content];
        }
        return $mailtpl;
    }

    public static function dujiaoka_config_get(string $key, $default = null)
    {
        $sysConfig = Cache::get('system-setting');
        return $sysConfig[$key] ?? $default;
    }
}
