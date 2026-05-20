<?php

use App\Http\Controllers\ToolController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// 2. 替代原本 api.php 的 Ajax 接口路由
Route::post('/ajax/parse-cron', [ToolController::class, 'parseCron']);
Route::post('/ajax/shorten-url', [ToolController::class, 'generateShortUrl']);
Route::post('/ajax/generate-qrcode', [ToolController::class, 'generateQrCode']);
// 3. 短网址重定向跳转路由
Route::get('/s/{code}', [ToolController::class, 'redirectShortUrl']);