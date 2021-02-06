<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
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

    public function uname()
    {
        return "{$this->code} {$this->name}";
    }

    public function line_attributes()
    {
        return $this->hasMany(LineAttributes::class);
    }

    public function output()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function inputs()
    {
        return $this->belongsToMany(Product::class, 'line_inputs');
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'line_materials');
    }
}
