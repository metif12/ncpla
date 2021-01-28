<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public static array $types = [

        [
            'name' => 'متنی',
            'value' => 'text',
        ],
        [
            'name' => 'عددی',
            'value' => 'number',
        ],
    ];

    public static array $merge_types = [

        [
            'name' => 'جلوگیری از ادغام',
            'value' => 'skip',
        ],
        [
            'name' => 'مجموع',
            'value' => 'sum',
        ],
        [
            'name' => 'جایگزینی',
            'value' => 'replace',
        ],
    ];

    protected $guarded = ['id'];

    public function product_attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id');
    }

    public function lines()
    {
        return $this->hasManyThrough(Line::class, LineOutputs::class, 'line_id', 'id');
    }
}
