<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Pay extends BaseModel
{

    use SoftDeletes;

    protected $table = 'pays';

    /**
     * 跳转
     */
    const METHOD_JUMP = 1;

    /**
     * 扫码
     */
    const METHOD_SCAN = 2;

    /**
     * 电脑
     */
    const PAY_CLIENT_PC = 1;

    /**
     * 手机
     */
    const PAY_CLIENT_MOBILE = 2;

    /**
     * 通用
     */
    const PAY_CLIENT_ALL = 3;

    public static function getMethodMap()
    {
        return [
            self::METHOD_JUMP => "跳转",
            self::METHOD_SCAN => "扫码",
        ];
    }

    public static function getClientMap()
    {
        return [
            self::PAY_CLIENT_PC => "PC",
            self::PAY_CLIENT_MOBILE => "手机",
            self::PAY_CLIENT_ALL => "全部",
        ];
    }

}
