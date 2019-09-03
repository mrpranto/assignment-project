<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'sale_date', 'customer_id', 'total_sub_total', 'tax', 'total_payable', 'paid_amount'
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

    public function sale_details(){

        return $this->hasMany(SaleDetails::class);
    }

    public function customer(){

        return $this->belongsTo(Customer::class);
    }


    public function storeRules($request){

        $request->validate([
            'customer' => 'required',
            'customer_id' => 'required',
            'itemName.*' => 'required',
            'itemId.*' => 'required',
            'unit_prices.*' => 'required',
            'quantities.*' => 'required',
            'item_sub_total.*' => 'required',
            'sub_total' => 'required',
            'total_payable' => 'required',
            'amountDue' => 'required',
            'amount_paid' => 'required',
        ]);

    }


    public function updateRules($request){

        $request->validate([
            'customer' => 'required',
            'customer_id' => 'required',
            'itemName.*' => 'required',
            'itemId.*' => 'required',
            'unit_prices.*' => 'required',
            'quantities.*' => 'required',
            'item_sub_total.*' => 'required',
            'sub_total' => 'required',
            'total_payable' => 'required',
            'amountDue' => 'required',
            'amount_paid' => 'required',
        ]);

    }




}
