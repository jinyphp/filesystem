<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// 관리자 URL
Route::middleware(['web','auth:sanctum', 'verified'])
->name('admin.files.')
->prefix('/admin/files')->group(function () {
    Route::resource('dropzone', \Jiny\Filesystem\Http\Controllers\Admin\DropzoneController::class);
});


use Jiny\Filesystem\Http\Controllers\Admin\UploadController;
Route::middleware(['web'])
->group(function(){
    Route::post('/api/upload/drop',[UploadController::class,"dropzone"]);
});


