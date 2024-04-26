<?php

namespace App\Helpers;

use Carbon\Carbon;
use Storage;

class StorageHelper
{
    /**
     * Upload File
     *
     * $type => hw: Homework, sm: Submission, av: Activity, im: Import data
     */

    public static function uploadFile($file, $type)
    {
        $currentdatetime = Carbon::now()->format("Ymd");

        $fileOriginalName = $file->getClientOriginalName();
        $file_name = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
        $cleanedName = CustomHelper::clean($file_name);
        $filename = $cleanedName . '_' . time() . '.' . $file_extension;

        $directory = "/" . $currentdatetime . "/" . $type;

        $filePath = Storage::putFileAs($directory, $file, $filename);

        return $filePath;
    }

    /**
     * Upload File from baseb4
     *
     */
    public static function uploadUri($file, $type)
    {
        list($mime, $data)   = explode(';', $file);
        list(, $data)       = explode(',', $data);
        $mime = explode(':',$mime)[1];
        $file_extension = explode('/',$mime)[1];
        $cleanedName = str_random(5);

        $data = base64_decode($data);

        $branchcode = \Auth::user()->branch->branchcode;
        $currentdatetime = Carbon::now()->format("Ymd");

        $filename = $cleanedName . "_" . time() . '.' . $file_extension;
        $directory_path = "/" . $branchcode . "/" . $currentdatetime . "/" . $type . "/" . $filename;
        Storage::put($directory_path, $data);

        return ltrim($directory_path,'/');
    }

    public static function deleteFile($filepath)
    {
        return Storage::delete($filepath);
    }

    public static function getFileUrl($filepath)
    {
        return Storage::url($filepath);
    }

    public static function getFileMimeType($filepath)
    {
        return Storage::mimeType($filepath);
    }
}
