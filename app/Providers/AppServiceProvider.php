<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('mobile', function ($attribute, $value, $parameters, $validator){

            return preg_match("/^(\+98|0)?(9{1}[0-9]{9})$/", $value);
        }, 'شماره موبایل وارد شده معتبر نمی باشد!');

        Validator::extend('national_code', function ($attribute, $value, $parameters, $validator){

            if(!preg_match('/^[0-9]{10}$/',$value))
                return false;
            for($i=0;$i<10;$i++)
                if(preg_match('/^'.$i.'{10}$/',$value))
                    return false;
            for($i=0,$sum=0;$i<9;$i++)
                $sum+=((10-$i)*intval(substr($value, $i,1)));
            $ret=$sum%11;
            $parity=intval(substr($value, 9,1));
            if(($ret<2 && $ret==$parity) || ($ret>=2 && $ret==11-$parity))
                return true;
            return false;
        }, 'کدملی وارد شده معتبر نمی باشد!');
    }
}
