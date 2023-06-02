<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $collection = 'products';

    protected $dates = ['imported_t','created_t','last_modified_t'];

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'status',
        'imported_t',
        'url',
        'product_name',
        'quantity',
        'brands',
        'categories',
        'labels',
        'cities',
        'stores',
        'purchase_places',
        'ingredients_text',
        'traces',
        'serving_size',
        'serving_quantity',
        'nutriscore_score',
        'nutriscore_grade',
        'main_category',
        'image_url',
    ];

   /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'imported_t' => 'timestamp',
        'created_t' => 'timestamp',
        'last_modified_t' => 'timestamp',
    ];
}
