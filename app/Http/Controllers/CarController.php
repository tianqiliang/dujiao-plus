<?php

namespace App\Http\Controllers;

use App\Models\GptAccount;
use Illuminate\Http\Request;

class CarController extends BaseController
{
    public function carList(Request $request)
    {
        $car_name = $request->input("car_name");

        $accounts = GptAccount::where("state", 1)
            ->when($car_name, function ($query, $car_name) {
                // 当 $car_name 不为空时，添加模糊搜索条件
                return $query->where("car_name", "like", "%" . $car_name . "%");
            })
            ->get();

        return $this->success("获取成功", $accounts);
    }

}
