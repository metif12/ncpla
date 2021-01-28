<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineInputs extends Model
{
    use HasFactory;
    
    protected $table = 'line_inputs';
    
    protected $guarded = ['id'];

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
