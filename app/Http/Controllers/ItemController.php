<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderByDesc('id')->get();
        return view('items.index',compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();
        $item->storeRules($request);
        try{
            $item->create([
                'item_name' => $request->item_name,
                'stock_type' => $request->stock_type,
                'item_type' => $request->item_type,
                'wholeSale_price' => $request->whole_sale_price,
                'retail_price' => $request->retail_price,
                'receiving_quantity' => $request->receive_quantity,
                'description' => $request->description,
            ]);

        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('message','Item Added Successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item = new Item();
        $item->updateRuls($request, $id);
        try{
            $item->where('id',$id)->update([
                'item_name' => $request->item_name,
                'stock_type' => $request->stock_type,
                'item_type' => $request->item_type,
                'wholeSale_price' => $request->whole_sale_price,
                'retail_price' => $request->retail_price,
                'receiving_quantity' => $request->receive_quantity,
                'description' => $request->description,
            ]);

        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('message','Item Update Successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        try{

            $item->delete();

        }catch (\Exception $e){

            return redirect()->back()->with('error', $e->getMessage());

        }


        return redirect()->back()->with('message', 'Item Deleted Successful');

    }
}
