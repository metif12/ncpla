<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function canMerge(Order $order)
    {
        if($this->product_id != $order->product->id) return false;

        $theirAttrs = [];

        foreach ($order->order_attributes as $attr){

            $theirAttrs[$attr['product_id'].''.$attr['name']] = $attr;
        }

        foreach ($this->order_attributes as $attr){

            $productAttr = $attr->product->product_attributes()->where('name', $attr['name'])->get();

            if(
                $productAttr->merge_type == 'skip'
                &&
                $attr['value'] != $theirAttrs[$attr['product_id'].''.$attr['name']]['value']
            ) return false;
        }

        return true;
    }

    public function merge(Order $order)
    {
        $theirAttrs = [];

        $result = new Order($this->attributes);

        foreach ($order->order_attributes as $attr){

            $theirAttrs[$attr['product_id'].''.$attr['name']] = $attr;
        }

        foreach ($this->order_attributes as $attr){

            $productAttr = $attr->product->product_attributes()->where('name', $attr['name'])->get();

            if($productAttr->merge_type == 'skip') continue;

            $theirAttr = $theirAttrs[$attr['product_id'] . '' . $attr['name']];

            if($productAttr->merge_type == 'replace') {

                $result->value = $theirAttr['value'];
            }

            if($productAttr->merge_type == 'replace') {

                if($productAttr->type == 'number'){

                    $result->value = $attr['value'] + $theirAttr['value'];
                }

                if($productAttr->type == 'text'){

                    $result->value = $attr['value'] . $theirAttr['value'];
                }
            }
        }

        return $result;
    }

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
