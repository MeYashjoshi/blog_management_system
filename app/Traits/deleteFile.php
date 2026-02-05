<?php

namespace App\Traits;

trait deleteFile
{
    public function deleteFile($filePath)
    {
     $fullPath = storage_path('app/public/' . $filePath);
    // dd(file_exists($fullPath));
        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

}
