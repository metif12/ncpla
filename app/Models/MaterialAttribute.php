<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialAttribute extends Model
{
    use HasFactory;

    protected $table = 'material_attributes';
    protected $guarded = ['id'];
}
