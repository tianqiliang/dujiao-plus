<?php

namespace App\Admin\Forms;

use App\Models\Carmi;
use App\Models\Good;
use Dcat\Admin\Widgets\Form;
use Illuminate\Support\Facades\Storage;

class ImportCarmis extends Form
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
        $carmisData = [];
        for ($i = 1; $i <= $input['count']; $i++) {
            $carmisData[] = [
                'goods_id' => $input['goods_id'],
                'carmi' => $this->generateRandomString(),
                'status' => Carmi::STATUS_UNSOLD,
                'is_used' => Carmi::NOT_USED,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];
        }
        Carmi::query()->insert($carmisData);
        // 删除文件
        return $this
				->response()
				->success("生成成功")
				->location('/carmis');
    }

    private function generateRandomString($length = 32): string
    {
        // 定义字母和数字的字符集
        $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        // 生成随机字符串
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->select('goods_id', "商品选择")->options(
            Good::query()->where('type', Good::AUTOMATIC_DELIVERY)->pluck('gd_name', 'id')
        )->required();
        $this->number("count", "数量")->default(1)->required();

    }

}
