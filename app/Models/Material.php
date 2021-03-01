<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

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

    public function material_attributes()
    {
        return $this->hasMany(MaterialAttribute::class, 'material_id');
    }
}
