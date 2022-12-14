<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Province extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $guarded = [];

    // protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Address\Database\factories\ProvinceFactory::new();
    // }

    protected $table = 'address_provinces';

    public function cities()
    {
        return $this->hasMany(City::class, 'provCode', 'provCode');
    }

    public function businesses()
    {
        return $this->hasMany(Business::class, 'province_id', 'regCode');
    }
}
