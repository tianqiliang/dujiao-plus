<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Carmi extends Model
{
	use HasDateTimeFormatter;
    use SoftDeletes;

    protected $table = 'carmis';

    /**
     * 未售出
     */
    const STATUS_UNSOLD = 1;

    /**
     * 已售出
     */
    const STATUS_SOLD = 2;

    /**
     * 未售出
     */
    const NOT_USED = 0;

    /**
     * 已售出
     */
    const USED = 1;

    /**
     * 获取组建映射
     *
     * @return array
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public static function getStatusMap()
    {
        return [
            self::STATUS_UNSOLD => "未售出",
            self::STATUS_SOLD => "已售出"
        ];
    }

    public static function getUsedMap()
    {
        return [
            self::NOT_USED => "未使用",
            self::USED => "已使用"
        ];
    }

    /**
     * 关联商品
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     * @author    assimon<ashang@utf8.hk>
     * @copyright assimon<ashang@utf8.hk>
     * @link      http://utf8.hk/
     */
    public function goods()
    {
        return $this->belongsTo(Good::class, 'goods_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
