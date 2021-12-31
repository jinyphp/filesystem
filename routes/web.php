<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 관리자 파일 관리
Route::middleware(['web','auth:sanctum', 'verified'])
->name('admin.file.')
->prefix('/admin/file')->group(function () {
    Route::resource('dropzone', \Jiny\Filesystem\Http\Controllers\Admin\DropzoneController::class);
    Route::resource('/', \Jiny\Filesystem\Http\Controllers\Admin\FileController::class);
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


