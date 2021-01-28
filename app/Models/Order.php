<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function line()
    {
        return $this->belongsTo(Line::class);
    }

    public function order_attributes()
    {
        return $this->hasMany(OrderAttribute::class);
    }
}