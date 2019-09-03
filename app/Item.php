<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    protected $fillable = [
        'user_id', 'item_name', 'stock_type', 'item_type', 'wholeSale_price', 'retail_price', 'receiving_quantity', 'description'
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

    public function sale_details(){
        return $this->hasMany(SaleDetails::class);
    }


    public function storeRules($request){

        $request->validate([

            'item_name' => 'required|unique:items,item_name',
            'whole_sale_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'receive_quantity' => 'required|numeric',

        ]);

    }

    public function updateRuls($request, $id){

        $request->validate([

            'item_name' => 'required|unique:items,item_name,'.$id,
            'whole_sale_price' => 'required|numeric',
            'retail_price' => 'required|numeric',
            'receive_quantity' => 'required|numeric',

        ]);

    }

}
