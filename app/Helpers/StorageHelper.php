<?php

namespace App\Helpers;

use Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class StorageHelper
{

    public static function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function getFileName($file)
    {
        $fileOriginalName = $file->getClientOriginalName();
        $file_name = pathinfo($fileOriginalName, PATHINFO_FILENAME);
        $file_extension = pathinfo($fileOriginalName, PATHINFO_EXTENSION);
        return self::clean($file_name) . '_' . time() . '_' . uniqid() .'.' . $file_extension;
    }

    /**
     * Upload File
     */
    public static function uploadFile($file, $path, $width = null, $thumb_width = null, $height = null,  $thumb_height = null)
    {
        // $agent = new Agent(); // Unhide to solve iPhone image rotate issue

        $filename       = self::getFileName($file);
        $file_contents  = file_get_contents($file);
        $file_path      = $path . '/' . $filename;

        if($width) {
            $normal_image = Image::make($file_contents)->resize($width, $height);
        } else {
            $normal_image = Image::make($file_contents);
        }

        // Unhide to solve iPhone image rotate issue
        // if($agent->device() == 'iPhone') {
        //     $normal_image = $normal_image->rotate(-90);
        // }

        Storage::put($file_path, $normal_image->stream());

        if($thumb_width) {
            $thumbs_path = $path . "/thumbs/$filename";
            $thumb_image = Image::make($file_contents)->resize($thumb_width, $thumb_height);

            // Unhide to solve iPhone image rotate issue
            // if($agent->device() == 'iPhone') {
            //     $thumb_image = $thumb_image->rotate(-90);
            // }

            Storage::put($thumbs_path, $thumb_image->stream());
        }

        return $filename;
    }

    public static function uploadFileAs($file, $filePath)
    {
        $filename = self::getFileName($file);

        Storage::putFileAs($filePath, $file, $filename);
        Storage::setVisibility($filePath."/".$filename, 'public');

        return str_replace('/index.php','', url("storage/".$filePath."/".$filename));

    }
}
