<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineMaterials extends Model
{
    use HasFactory;

    protected $table = 'line_materials';

    protected $guarded = ['id'];

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
