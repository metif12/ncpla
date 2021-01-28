<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LineOutputs extends Model
{
    use HasFactory;

    protected $table = 'line_outputs';

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
