<?php

use Illuminate\Support\Facades\Storage;


/**
 * 把字符串储存到Storage驱动
 */
function string_storege($storege, $path, $stringFile = null, $options = [])
{
    // 创建一个临时文件
    $temp = tempnam(sys_get_temp_dir(), 'upload');
    file_put_contents($temp, $stringFile);

    // 创建 UploadedFile 实例
    $file = new \Illuminate\Http\UploadedFile($temp, 'filename.txt');

    // 保存文件
    if($storege instanceof \Illuminate\Filesystem\FilesystemAdapter){
        $filename = $storege->putFile($path, $file, $options);

    }else{
        $filename = Storage::disk($storege)->putFile($path, $file, $options);
    }

    unlink($temp);
    return $filename;
}


function string_storege_as($storege, $path, $stringFile = null, $name = null, $options = [])
{
    // 创建一个临时文件
    $temp = tempnam(sys_get_temp_dir(), 'upload');
    file_put_contents($temp, $stringFile);

    // 创建 UploadedFile 实例
    $file = new \Illuminate\Http\UploadedFile($temp, 'filename.txt');

    // 保存文件
    if($storege instanceof \Illuminate\Filesystem\FilesystemAdapter){
        $filename = $storege->putFileAs($path, $file, $name, $options);

    }else{
        $filename = Storage::disk($storege)->putFileAs($path, $file, $name, $options);
    }

    unlink($temp);
    return $filename;
}