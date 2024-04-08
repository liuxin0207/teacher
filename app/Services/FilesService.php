<?php


namespace App\Services;

use Illuminate\Support\Facades\File;


class FilesService
{
    public function uploadImg($file)
    {
        if (!is_dir('upload/')) {
            mkdir('upload');
        }

        // 拿到副檔名
        $extension = $file->extension();
        
        $fileName = $file->hashName();

        $spliteName = explode('.', $fileName)[0];

        // 組成檔案路徑
        $path = '/upload/' . $spliteName . '.' . $extension;


        move_uploaded_file($file, public_path() . $path);

        return $path;
    }
    // 刪除檔案
    public function deleteFile($path)
    {
        // 如果原本檔案確實存在，則刪除原本的檔案
        if (file_exists(public_path() . $path)) {
            File::delete(public_path() . $path);
        }

        return true;
    }
}
