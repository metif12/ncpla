<?php

use Illuminate\Support\Str;

if(!function_exists('generateCode')){

    function generateCode() : string {

        return strtoupper(dechex(time()).Str::random(5));
    }
}
