<?php

namespace App\Services;

class DateService
{
    public function __construct()
    {
    }

    public static function viewDate($date)
    {
        return $date ? date("F j, Y", strtotime($date)) : 'N/A';
    }
}
