<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendApiController
{

    /**
     * 网关转发BackendApi
     * @return void
     */
    public function handleBackendApi(Request $request)
    {
        return ["status" => $request->user()];

    }

    /**
     * 会话隔离需要单独处理
     * @return void
     */
    public function conversations()
    {

    }

}
