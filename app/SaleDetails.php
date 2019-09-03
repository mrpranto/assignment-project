<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SaleDetails extends Model
{
    protected $fillable = [
        'user_id', 'sale_id', 'item_id', 'price', 'quantity', 'sub_total'
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

    public function sale(){

        return $this->belongsTo(Sale::class);
    }

    public function item(){

        return $this->hasOne(Item::class,'id','item_id');
    }

}
