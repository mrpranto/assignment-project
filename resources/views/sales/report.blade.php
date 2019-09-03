@extends('master')

@section('title','Sale Report')

@section('page_header')

    <i class="fa fa-book"></i> Sale Report

@stop


@section('css')

@stop



@section('content')



    <main class="app-content">

        <iframe src="{{ route('sale.pdf',$sale->id) }}" width="857" height="1150"></iframe>


        {{--<div class="row">--}}
            {{--<div class="col-md-12">--}}
                {{--<div class="tile">--}}


        {{--<div class="row mb-3">--}}

            {{--<div class="col-sm-6 text-left">--}}
                {{--<h5 class="mb-3">To,</h5>--}}
                {{--<div>--}}
                    {{--<strong>Customer Info</strong>--}}
                {{--</div>--}}
                {{--<div>Mr/Mrs/Miss. {{ $sale->customer->customer_name }}</div>--}}
                {{--<div>{{ $sale->customer->address }}</div>--}}
                {{--<div>Phone: {{ $sale->customer->phone }}</div>--}}
            {{--</div>--}}

            {{--<div class="col-sm-6 text-right">--}}
                {{--<div>--}}
                    {{--<strong> # Invoice No:201900</strong>--}}
                {{--</div>--}}
                {{--<div>Date:</div>--}}
                {{--<div>Grand Total:</div>--}}
                {{--<div>Amount Paid:</div>--}}
                {{--<div>Amount Due:</div>--}}
            {{--</div>--}}


        {{--</div>--}}


        {{--<div class="table-responsive-sm">--}}

            {{--<table class="table table-striped table-bordered">--}}
                {{--<thead>--}}
                {{--<tr>--}}
                    {{--<th class="center">#</th>--}}
                    {{--<th>Item Name</th>--}}
                    {{--<th>Price</th>--}}
                    {{--<th>Quantity</th>--}}
                    {{--<th>Total</th>--}}
                {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}

                {{--@foreach($sale->sale_details  as $key => $value)--}}


                    {{--<tr>--}}
                        {{--<td>{{ $key+1 }}</td>--}}
                        {{--<td>{{ $value->item->item_name }}</td>--}}
                        {{--<td>{{ $value->price }}</td>--}}
                        {{--<td>{{ $value->quantity }}</td>--}}
                        {{--<td>{{ $value->sub_total }}</td>--}}
                    {{--</tr>--}}

                {{--@endforeach--}}

                {{--</tbody>--}}
            {{--</table>--}}

        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-lg-4 col-sm-5">--}}

            {{--</div>--}}

            {{--<div class="col-lg-4 col-sm-5 ml-auto">--}}
                {{--<table class="table table-clear table-bordered">--}}
                    {{--<tbody>--}}
                    {{--<tr>--}}
                        {{--<td class="left">--}}
                            {{--<strong>Subtotal</strong>--}}
                        {{--</td>--}}
                        {{--<td class="right">{{ $sale->total_sub_total .' tk'}}</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="left">--}}
                            {{--<strong>Tax</strong>--}}
                        {{--</td>--}}
                        {{--<td class="right">{{ $sale->tax .' tk'}}</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="left">--}}
                            {{--<strong>Grand Total</strong>--}}
                        {{--</td>--}}
                        {{--<td class="right">{{ $sale->total_payable .' tk'}}</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="left">--}}
                            {{--<strong>Amount Paid</strong>--}}
                        {{--</td>--}}
                        {{--<td class="right">--}}
                            {{--<strong>{{ $sale->paid_amount .' tk'}}</strong>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td class="left">--}}
                            {{--<strong>Amount Due</strong>--}}
                        {{--</td>--}}
                        {{--<td class="right">--}}
                            {{--<strong>{{ $sale->total_payable - $sale->paid_amount .' tk'}}</strong>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--</tbody>--}}
                {{--</table>--}}

            {{--</div>--}}

        {{--</div>--}}


                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

    </main>




@stop



@section('js')



@stop