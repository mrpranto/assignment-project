<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Customer extends Model
{
    protected $fillable = [
       'user_id', 'customer_name', 'phone', 'email', 'address',
    ];

    public static function boot()
    {
        parent::boot();
        if(!App::runningInConsole())
        {
            static::creating(function ($model)
            {
                $model->fill([
                    'user_id' => Auth::user()->id,
                ]);
            });
            static::updating(function ($model)
            {
                $model->fill([
//                    'user_id' => Auth::user()->id,
                ]);
            });

        }
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function storeRules($request){

        $request->validate([

            'customer_name' => 'required',
            'phone' => 'unique:customers,phone|numeric|nullable||regex: /(01)[0-9]{9}/',
            'email' => 'email|unique:customers,email|nullable',

        ]);

    }

    public function updateRules($request, $id){

        $request->validate([

            'customer_name' => 'required',
            'phone' => 'unique:customers,phone,'.$id.'|numeric|nullable||regex: /(01)[0-9]{9}/',
            'email' => 'email|unique:customers,email,'.$id.'|nullable',

        ]);

    }

}
