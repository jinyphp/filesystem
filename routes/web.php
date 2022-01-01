<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/**
 * 관리자 Url
 */
Route::middleware(['web','auth:sanctum', 'verified'])
->name('admin.file.')
->prefix('/admin/file')->group(function () {
    Route::resource('dropzone', \Jiny\Filesystem\Http\Controllers\Admin\DropzoneController::class);

    // 파일관리자
    Route::resource('/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}/{slug8?}/{slug9?}',
    \Jiny\Filesystem\Http\Controllers\Admin\FileController::class);
});


/**
 * dropzone 파일 업로드 api
 * CSRF 토큰적용을 위해서 미들웨어 web 통과.
 */
use Jiny\Filesystem\Http\Controllers\Admin\UploadController;
Route::middleware(['web'])
->group(function(){
    Route::post('/api/upload/drop',[UploadController::class,"dropzone"]);
});


/**
 * URL 다운로드
 */
use Jiny\Filesystem\Http\Controllers\Admin\DownloadController;
Route::get('/download/{slug1?}/{slug2?}/{slug3?}/{slug4?}/{slug5?}/{slug6?}/{slug7?}/{slug8?}/{slug9?}',
    [DownloadController::class,"index"]
);
