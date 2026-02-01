<?php

namespace App\Traits;

trait imageUpload
{
    public function uploadImage($file)
    {
     if ($file && $file->isValid()) {
         $extension = $file->getClientOriginalExtension();
         $filename = time() .'-'. date('d-m-Y') . '.' . $extension;
        return $filename;
        }
        return null;
    }
}
