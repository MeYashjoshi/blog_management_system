<?php

namespace App\Traits;

trait deleteFile
{
    public function deleteFile($filePath)
    {
     $fullPath = storage_path('app/' . $filePath);

        if (file_exists($fullPath)) {
            unlink($fullPath);
        }
    }

}
