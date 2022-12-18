<?php

namespace Modules\Address\Services;

use Modules\Address\Entities\City;
use Modules\Address\Entities\Barangay;

class AddressService
{
    public function __construct()
    {
    }

    // Cities and Municipalities
    public static function getBarangaysPerCity($city_code)
    {
        $barangays = Barangay::where('citymunCode', $city_code)
            ->select('brgyCode', 'brgyDesc')
            ->orderBy('brgyDesc')
            ->get();

        return $barangays;
    }

    public static function getCityPerProvince($province_code)
    {
        $cities = City::where('provCode', $province_code)
            ->select('citymunCode', 'citymunDesc')
            ->orderBy('citymunDesc')
            ->get();

        return $cities;
    }
}
