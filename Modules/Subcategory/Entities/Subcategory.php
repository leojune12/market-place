<?php

namespace Modules\Subcategory\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Business\Entities\Business;
use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'category_id',
    ];

    // protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Subcategory\Database\factories\SubcategoryFactory::new();
    // }

    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'business_categories');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
