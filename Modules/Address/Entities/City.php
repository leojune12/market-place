<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $guarded = [];

    // protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Address\Database\factories\CityFactory::new();
    // }

    protected $table = 'address_city_municipalities';

    public function barangays()
    {
        return $this->hasMany(Barangay::class, 'citymunCode', 'citymunCode');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'city_id', 'regCode');
    }
}
