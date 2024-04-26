<?php

namespace App\Helpers;
use Carbon\Carbon;

class CustomHelper
{

    public static function dateDisplay($date, $format = "Y-m-d")
    {
        return ($date) ? Carbon::parse($date)->format($format) : "";
    }

    public static function getWeekDays($week_days=null)
    {
        /* Have to set the static values in settings */
        return $week_days ?: ["1","2","3","4","5"];
    }

    public static function clean($string) {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

 }
