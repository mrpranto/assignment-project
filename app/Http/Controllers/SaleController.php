<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Item;
use App\Sale;
use App\SaleDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::orderByDesc('id')->get();
        return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function get_customer(Request $request)
    {
        $search = $request->term;
        $customers = Customer::where('customer_name', 'LIKE', '%' . $search . '%')
            ->orWhere('id', '=', $search)
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('phone', 'LIKE', '%' . $search . '%')
            ->get();

        $data = [];
        foreach ($customers as $key => $value) {
            $data [] = [
                'value' => $value->customer_name,
                'customer_id' => $value->id,
            ];
        }

        return response($data);

    }


    public function searchProduct()
    {

        $product = Item::select('item_name', 'id', 'wholeSale_price', 'retail_price')
            ->get();
        return response()->json($product);

    }


    public function store(Request $request)
    {
        $sale = new Sale();
        $sale->storeRules($request);
        try {

            $sale_id = $sale->create([

                'sale_date' => Carbon::today(),
                'customer_id' => $request->customer_id,
                'total_sub_total' => $request->sub_total,
                'tax' => $request->tax,
                'total_payable' => $request->total_payable,
                'paid_amount' => $request->amount_paid,

            ])->id;

            $itemId = $request->itemId;
            $this->saleDetailsStore($request, $sale_id, $itemId);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->back()->with('message', 'Sale Added Successful');

    }


    public function saleDetailsStore($request, $sale_id, $itemId)
    {

        if ($itemId) {
            foreach ($itemId as $key => $value) {

                SaleDetails::create([

                    'sale_id' => $sale_id,
                    'item_id' => $request->itemId[$key],
                    'price' => $request->unit_prices[$key],
                    'quantity' => $request->quantities[$key],
                    'sub_total' => $request->item_sub_total[$key],

                ]);

            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::with('sale_details.item')->findOrFail($id);
        return view('sales.report', compact('sale'));
    }

    public function sale_info($id){
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->conver_html_to_pdf($id));
        return $pdf->stream();
    }



    public function conver_html_to_pdf($id)
    {

        $sale = Sale::findOrFail($id);

        $output = '
       
        <div class="row">
            <div class="col-md-12">
                <div class="tile">


        <div class="row mb-3">

            <div class="col-sm-6 text-left">
                <h5 class="mb-3">To,</h5>
                <div>
                    <strong>Customer Info</strong>
                </div>
                <div>Mr/Mrs/Miss.' . $sale->customer->customer_name . '</div>
                <div>' . $sale->customer->address . '</div>
                <div>Phone: ' . $sale->customer->phone . '</div>
            </div>

            <div class="col-sm-6 text-right">
                <div>
                    <strong> # Invoice No:' . $sale->id . '</strong>
                </div>
                <div>Date: ' . $sale->sale_date . '</div>
                <div>Grand Total:' . $sale->total_payable . '</div>
                <div>Amount Paid:' . $sale->paid_amount . '</div>
                <div>Amount Due:' . ($sale->total_payable - $sale->paid_amount) . '</div>
            </div>


        </div>


        <div class="table-responsive-sm">

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th class="center">#</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>';

        foreach ($sale->sale_details as $key => $value) {

            $output .= ' <tr>
                        <td>' . ($key + 1) . '</td>
                        <td>' . $value->item->item_name . '</td>
                        <td>' . $value->price . '</td>
                        <td>' . $value->quantity . '</td>
                        <td>' . $value->sub_total . '</td>
                    </tr>';
        }

        $output .= '</tbody>
            </table>

        </div>
        <div class="row">
            <div class="col-lg-4 col-sm-5">

            </div>

            <div class="col-lg-4 col-sm-5 ml-auto">
                <table class="table table-clear table-bordered">
                    <tbody>
                    <tr>
                        <td class="left">
                            <strong>Subtotal</strong>
                        </td>
                        <td class="right">' . $sale->total_sub_total . '</td>
                    </tr>
                    <tr>
                        <td class="left">
                            <strong>Tax</strong>
                        </td>
                        <td class="right">' . $sale->tax . '</td>
                    </tr>
                    <tr>
                        <td class="left">
                            <strong>Grand Total</strong>
                        </td>
                        <td class="right">' . $sale->total_payable . '</td>
                    </tr>
                    <tr>
                        <td class="left">
                            <strong>Amount Paid</strong>
                        </td>
                        <td class="right">
                            <strong>' . $sale->paid_amount . '</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="left">
                            <strong>Amount Due</strong>
                        </td>
                        <td class="right">
                            <strong>' . ($sale->total_payable - $sale->paid_amount) . '</strong>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>

        </div>


                </div>
            </div>
        </div>
  ';

        return $output;

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::findOrFail($id);
        return view('sales.edit',compact('sale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sale = new Sale();
        $sale->updateRules($request);
        try {

             $sale->where('id',$id)->update([

                'sale_date' => Carbon::today(),
                'customer_id' => $request->customer_id,
                'total_sub_total' => $request->sub_total,
                'tax' => $request->tax,
                'total_payable' => $request->total_payable,
                'paid_amount' => $request->amount_paid,

            ]);

            $itemId = $request->itemId;
            $this->saleDetailsUpdate($request, $id, $itemId);

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('sale.index')->with('message', 'Sale Update Successful');

    }



    public function saleDetailsUpdate($request, $id, $itemId)
    {

        if ($itemId) {

            SaleDetails::where('sale_id',$id)->delete();

            foreach ($itemId as $key => $value) {

                SaleDetails::create([

                    'sale_id' => $id,
                    'item_id' => $request->itemId[$key],
                    'price' => $request->unit_prices[$key],
                    'quantity' => $request->quantities[$key],
                    'sub_total' => $request->item_sub_total[$key],

                ]);

            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);

        try{

            if ($sale){
                SaleDetails::where('sale_id',$id)->delete();
                $sale->delete();
            }

        }catch (\Exception $e){

            return redirect()->back()->with('error',$e->getMessage());
        }

        return redirect()->back()->with('message','Sale Information Delete Successful');
    }
}
