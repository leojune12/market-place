<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Business\Entities\Business;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price',
        'is_available',
    ];

    // protected $guarded = [];

    protected static function newFactory()
    {
        return \Modules\Service\Database\factories\ServiceFactory::new();
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
