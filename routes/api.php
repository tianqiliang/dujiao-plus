<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::options('/{any}', function() {
    return response()->json([], 200);
})->where('any', '.*');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// 登录注册接口
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('sendEmailCode', [AuthController::class, 'sendEmailCode']);
Route::post('carList', [AuthController::class, 'carList']);

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('/backend-api/conversations', [App\Http\Controllers\BackendApiController::class, 'conversations']);

// 在 routes/web.php 或 routes/api.php 中定义路由
    Route::any('/backend-api/{any}', [App\Http\Controllers\BackendApiController::class, 'handleBackendApi'])
        ->where('any', '.*'); // 捕捉所有 backend-api 开头的请求
});


