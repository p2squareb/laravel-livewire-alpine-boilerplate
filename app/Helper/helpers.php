<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\File;

if(! function_exists('humanReadableDate')) {
    function humanReadableDate($date, $type)
    {
        if (!$date instanceof Carbon) {
            $date = Carbon::parse($date);
        }

        if ($type == 1) {
            if ($date->diffInHours() < 24){
                return $date->format('H:i');
            }else{
                return $date->format('y.m.d');
            }
        } elseif ($type == 2) {
            return $date->diffForHumans();
        } elseif ($type == 3) {
            return $date->format('y.m.d H:i');
        }
    }
}

if (!function_exists('formatNumberWithK')) {
    function formatNumberWithK($number)
    {
        if ($number >= 1000) {
            $number = number_format($number / 1000, ($number % 1000 === 0 ? 0 : 1)) . 'k';
        }
        return $number;
    }
}

if(! function_exists('getFolderNames')) {
    function getFolderNames($path): array
    {
        $directories = File::directories($path);
        $folderNames = [];

        foreach ($directories as $directory) {
            $folderNames[] = basename($directory);
        }

        return $folderNames;
    }
}

if(! function_exists('containsImage')) {
    function containsImage($text): false|int
    {
        return preg_match('/<img\s[^>]*>/i', $text);
    }
}

if(! function_exists('containsVideo')) {
    function containsVideo($text): false|int
    {
        return preg_match('/<iframe\s[^>]*>/i', $text);
    }
}

if(! function_exists('extractFirstImageUrl')) {
    function extractFirstImageUrl($text): ?string
    {
        preg_match('/<img\s[^>]*src="([^"]*)"[^>]*>/i', $text, $matches);
        return $matches[1] ?? null;
    }
}

if(! function_exists('getImagePaths')) {
    function getImagePaths($content): array
    {
        $pattern = '/src="([^"]*storage\/ckeditor\/[^"]*)"/i';
        preg_match_all($pattern, $content, $matches);
        return array_map(function ($src) {
            return str_replace('/storage/', '', $src);
        }, $matches[1]);
    }
}

if(! function_exists('calDateByPeriod')) {
    function calDateByPeriod($period): string
    {
        $now = Carbon::now();
        $return_date = '';

        switch ($period) {
            case '3d':
                $return_date = $now->addDays(3)->format('Y-m-d H:i:s');
                break;
            case '7d':
                $return_date = $now->addDays(7)->format('Y-m-d H:i:s');
                break;
            case '1m':
                $return_date = $now->addMonth(1)->format('Y-m-d H:i:s');
                break;
            case '3m':
                $return_date = $now->addMonths(3)->format('Y-m-d H:i:s');
                break;
            case '6m':
                $return_date = $now->addMonths(6)->format('Y-m-d H:i:s');
                break;
            case '1y':
                $return_date = $now->addYear(1)->format('Y-m-d H:i:s');
                break;
            case 'eternity':
                $return_date = '9999-12-31 23:59:59';
                break;
        }

        return $return_date;
    }
}
