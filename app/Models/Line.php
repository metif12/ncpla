<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function outputs()
    {
        return $this->hasMany(LineOutputs::class);
    }

    public function inputs()
    {
        return $this->hasMany(LineInputs::class);
    }

    public function materials()
    {
        return $this->hasMany(LineMaterials::class);
    }
}
