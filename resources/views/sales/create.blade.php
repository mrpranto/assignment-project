@extends('master')

@section('title','Add New Sale')

@section('page_header')

    <i class="fa fa-shopping-cart"></i> Add New Sale

@stop


@section('css')

@stop



@section('content')


    <div class="modal fade" id="addnew" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New @yield('title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form class="form-horizontal" action="{{ route('customer.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="customer_name" class="control-label col-md-4 text-right">Customer Name <sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input type="text" id="customer_name" name="customer_name"
                                       value="{{ old('customer_name') }}"
                                       class="form-control @error('customer_name') is-invalid @enderror"
                                       placeholder="Customer Name">

                                @error('customer_name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="whole_sale_price" class="control-label col-md-4 text-right"> Phone</label>
                            <div class="col-md-8">
                                <input id="phone" name="phone"
                                       value="{{ old('phone') }}" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder="Phone">

                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="email" class="control-label col-md-4 text-right"> Email</label>
                            <div class="col-md-8">
                                <input id="email" name="email" value="{{ old('email') }}"
                                       type="text" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="address" class="control-label col-md-4 text-right">Address </label>
                            <div class="col-md-8">
                                <textarea name="address" class="form-control"
                                          id="address">{{ old('address') }}</textarea>

                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check-circle"></i> Save
                        </button>
                    </div>

                </form>


            </div>
        </div>
    </div>





    <main class="app-content">

        {{--@include('partials._app_title')--}}

        @if ($errors->any())
            <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->get('error'))
            <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button>
                {{ session()->get('error') }}
            </div>
        @endif

        <form action="{{ route('sale.store') }}" method="post">

            @csrf

            <div class="row">
                <div class="col-sm-9">

                    <div class="bs-componen">
                        <div class="card">
                            <h4 class="card-header bg-primary text-white">
                                <span class="float-left">Add New Seal</span>
                                <span class="float-right" id="changeAmount"></span>
                            </h4>
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="form-group">
                                            <label for="customer" class="h5">Customer</label>
                                            <input type="text" id="customer" autofocus name="customer" value="{{ old('customer') }}"
                                                    class="form-control" placeholder="Search Customer..">
                                            <input type="text" id="customer_id" name="customer_id" value="{{ old('customer_id') }}"
                                                   class="form-control" style="display: none;">
                                            @error('customer')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>


                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#addnew" style="margin-top: 29px;"><i
                                                        class="fa fa-plus"></i>Add New Customer
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <div class='row'>

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered col-md-12" id="table">
                                                <thead>
                                                <tr>
                                                    <th style="width: 25%;">Item Name</th>
                                                    <th style="display: none">Item ID</th>
                                                    <th>Price</th>
                                                    <th style="width: 20%;">Quantity</th>
                                                    <th style="width: 20%;">Subtotal</th>
                                                    <th>
                                                        Action
                                                    </th>

                                                </tr>
                                                </thead>
                                                <tbody>


                                                @if (old('itemName') == true)
                                                    @foreach(old('itemName') as $key => $value)

                                                        <tr>
                                                            <td>
                                                                <input type="text" data-type="itemName" name="itemName[]"
                                                                       value="{{ old('itemName')[$key] }}" id="itemName_1"
                                                                       class="form-control autocomplete_txt itemName"
                                                                       autocomplete="off" >
                                                            </td>

                                                            <td style="display: none">
                                                                <input type="text" data-type="itemId"
                                                                       value="{{ old('itemId')[$key] }}" name="itemId[]"
                                                                       id="itemId" class="form-control autocomplete_txt"
                                                                       autocomplete="off">
                                                            </td>

                                                            <td>
                                                                <input type="text" tabindex="-1" name="unit_prices[]"
                                                                       value="{{ old('unit_prices')[$key] }}" id="price_1" readonly
                                                                       class="form-control changesNo" autocomplete="off"
                                                                       onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                                       onpaste="return false;">
                                                            </td>

                                                            <td>
                                                                <input type="text" name="quantities[]"
                                                                       value="{{ old('quantities')[$key] }}" id="quantity_1"
                                                                       class="form-control changesNo" autocomplete="off"
                                                                       onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                                       onpaste="return false;">
                                                            </td>

                                                            <td>
                                                                <input type="text" readonly name="item_sub_total[]"
                                                                       value="{{ old('item_sub_total')[$key] }}" id="total_1"
                                                                       class="form-control totalLinePrice" tabindex="-1"
                                                                       autocomplete="off"
                                                                       onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                                       onpaste="return false;">
                                                            </td>

                                                            <td>
                                                                <div class="btn-group mr-2">
                                                                    <button type="button" tabindex="-1"
                                                                            class="btn btn-danger btn-sm" id="delete_1"
                                                                            title="Delete This Row" onclick="removeRow(this)"><i
                                                                                class="fa fa-trash"></i></button>
                                                                </div>
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                @else

                                                    <tr>
                                                        <td>
                                                            <input type="text" data-type="itemName" name="itemName[]"
                                                                   value="" id="itemName_1"
                                                                   class="form-control autocomplete_txt itemName"
                                                                   autocomplete="off" >
                                                        </td>

                                                        <td style="display: none">
                                                            <input type="text" data-type="itemId"
                                                                   value="" name="itemId[]"
                                                                   id="itemId_1" class="form-control autocomplete_txt"
                                                                   autocomplete="off">
                                                        </td>

                                                        <td>
                                                            <input type="text" tabindex="-1" name="unit_prices[]"
                                                                   value="" id="price_1" readonly
                                                                   class="form-control changesNo" autocomplete="off"
                                                                   onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                                   onpaste="return false;">
                                                        </td>

                                                        <td>
                                                            <input type="text" name="quantities[]"
                                                                   value="" id="quantity_1"
                                                                   class="form-control changesNo" autocomplete="off"
                                                                   onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                                   onpaste="return false;">
                                                        </td>

                                                        <td>
                                                            <input type="text" readonly name="item_sub_total[]"
                                                                   value="" id="total_1"
                                                                   class="form-control totalLinePrice" tabindex="-1"
                                                                   autocomplete="off"
                                                                   onkeypress="return IsNumeric(event);" ondrop="return false;"
                                                                   onpaste="return false;">
                                                        </td>

                                                        <td>
                                                            <div class="btn-group mr-2">
                                                                <button type="button" tabindex="-1"
                                                                        class="btn btn-danger btn-sm" id="delete_1"
                                                                        title="Delete This Row" onclick="removeRow(this)"><i
                                                                            class="fa fa-trash"></i></button>
                                                            </div>
                                                        </td>

                                                    </tr>

                                                @endif


                                                </tbody>

                                            </table>
                                        </div>
                                    </div>


                                    <div class='col-xs-12 col-sm-12 text-right'>
                                        <button class="btn btn-primary btn-sm addmore" tabindex="-1" id="addMore" type="button">+
                                            Add More
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>


                <div class="col-sm-3">

                    <div class="bs-component">
                        <div class="card">
                            <h4 class="card-header bg-primary text-white">Total</h4>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="my-input">Sub Total</label>
                                    <input type="number" step="0.00"
                                           class="form-control"
                                           name="sub_total" id="subTotal" value="{{ old('sub_total') }}" readonly
                                           tabindex="-1" placeholder="Subtotal"
                                           autocomplete="off" onkeypress="return IsNumeric(event);"
                                           ondrop="return false;" onpaste="return false;">
                                    @error('sub_total')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>



                                <div class="form-group">
                                    <label for="my-input">Tax %</label>
                                    <input type="number" step="0.00" class="form-control" id="tax"
                                           value="{{ old('tax') }}" name="tax"
                                           placeholder="Tax" autocomplete="off"
                                           onkeypress="return IsNumeric(event);" ondrop="return false;"
                                           onpaste="return false;">
                                </div>



                                <div class="form-group">
                                    <label for="my-input">Total Payable</label>
                                    <input type="number" step="0.00"
                                           class="form-control"
                                           name="total_payable" value="{{ old('total_payable') }}" readonly
                                           tabindex="-1" id="totalAftertax" placeholder="Total"
                                           style="font-size: 24px;font-weight: bolder; color: #0d1214;"
                                           autocomplete="off" onkeypress="return IsNumeric(event);"
                                           ondrop="return false;" onpaste="return false;">

                                    @error('total_payable')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>




                                <div class="form-group">
                                    <label for="my-input">Due Amount</label>
                                    <input type="number" step="0.00" readonly tabindex="-1" class="form-control amountDue"
                                           name="amountDue" value="{{ old('amountDue') }}" id="amountDue"
                                           placeholder="Amount Due" autocomplete="off"
                                           onchange="changeAmountShow()">


                                </div>


                                <div class="form-group">
                                    <label for="my-input">Paid Amount</label>
                                    <input type="number" step="0.00"
                                           class="form-control"
                                           name="amount_paid" value="{{ old('amount_paid') ? : 0 }}"
                                           id="amountPaid" onkeyup="amount()" value="0" min="0" placeholder="Receive Amount"
                                           autocomplete="off"
                                           style="font-size: 24px;font-weight: bolder; color: #0d1214;">

                                    @error('amount_paid')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="row">
                                    <div class="col-sm-8">
                                        <button type="submit" class="btn btn-sm btn-info btn-block">Save</button>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="{{ route('sale.index') }}" class="btn btn-sm btn-danger btn-block">List</a>
                                    </div>
                                </div>


                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </form>



    </main>




@stop



@section('js')

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>






    <script type="text/javascript">


        jQuery(function ($) {
            $("#customer").autocomplete({
                source: "{{ route('get-customer') }}",
                minLength: 1,
                select: function (key, value) {
                    console.log(value)
                    $('#customer').val(value.item.value)
                    $('#customer_id').val(value.item.customer_id)
                }
            })
        })

        function submitForm() {
            document.saleForm.submit();
            document.saleForm.method='post';
        }

        $(document).ready(function(){
            amount();
        })

        function amount() {
            var amountPaid =  parseFloat($('#amountPaid').val());
            // console.log(amountPaid)
            if (amountPaid != '0'){

                document.onkeydown = function () {
                    if (window.event.keyCode == '13') {
                        submitForm();
                    }
                }

            }else {

                $('form').bind("keypress", function(e) {
                    if (e.keyCode == 13) {
                        e.preventDefault();
                        return false;
                    }
                });

                document.onkeydown = function () {
                    if (event.keyCode == 13) {
                        row_increment()
                    }
                }

            }
        }



        $(".addmore").on('click', function () {
            row_increment()
        });

        function row_increment() {

            var i = $('table tr').length ;
            html = '<tr >';
            html += '<td><input type="text" required data-type="itemName" name="itemName[]" id="itemName_' + i + '" class="form-control autocomplete_txt" autocomplete="off"></td>';
            html += '<td style="display: none"><input type="text" required data-type="itemId" name="itemId[]" id="itemId_' + i + '" class="form-control autocomplete_txt" autocomplete="off"></td>';
            html += '<td><input type="text" required tabindex="-1" name="unit_prices[]" readonly id="price_' + i + '" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html += '<td><input type="text" required name="quantities[]" id="quantity_' + i + '" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html += '<td><input type="text" name="item_sub_total[]" readonly tabindex="-1" id="total_' + i + '" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>';
            html += '<td> <button type="button" class="btn btn-danger btn-sm delete" title="Delete This Row" onclick="removeRow(this)"><i class="fa fa-trash"></i></button></td>';
            html += '</tr>';
            $('table').append(html);
            document.getElementById('itemName_'+i).focus();
            i++;

        }

        function removeRow  (el) {
            $(el).parents("tr").remove()
            calculateTotal();
        }
        //autocomplete script
        $(document).on('keypress', '.autocomplete_txt', function () {
            console.log('Barcode')
            type = $(this).data('type');

            $(this).autocomplete({
                source: function (request, response) {
                    $.ajax({
                        url: "{{ route('searchProduct') }}",
                        data: {
                            products : request.products
                        },
                        dataType: "json",
                        success: function(data){
                            var resp = $.map(data,function(obj){
                                console.log(obj)
                                return {
                                    label: obj.item_name,
                                    value: obj.item_name,
                                    data: obj
                                }
                            });
                            // response(resp);
                            response($.ui.autocomplete.filter(resp, request.term));
                        }
                    });
                },
                autoFocus: true,
                minLength: 1,

                select: function (event, ui) {
                    // console.log(ui)

                    var names = ui.item.data;
                        id_arr = $(this).attr('id');
                        id = id_arr.split("_");
                        $('#itemName_' + id[1]).val(names['item_name']);
                        $('#itemId_' + id[1]).val(names['id']);
                        $('#quantity_' + id[1]).val(1);
                        $('#price_' + id[1]).val(names['retail_price']);
                        $('#total_' + id[1]).val(1*names['retail_price']);
                        calculateTotal();
                }

            });
        });

        //price change
        $(document).on('change keyup blur', '.changesNo', function () {
            id_arr = $(this).attr('id');
            id = id_arr.split("_");
            quantity = $('#quantity_' + id[1]).val();
            price = $('#price_' + id[1]).val();
            discount = $('#discount_' + id[1]).val();
            price_qty = (parseFloat(price)*parseFloat(quantity)).toFixed(2);
            if (quantity != '' && price != '') $('#total_'+id[1]).val(parseFloat(price_qty));

            calculateTotal();
        });


        $(document).on('change keyup blur', '#tax', function () {
            calculateTotal();
        });

        //total price calculation
        function calculateTotal() {
            subTotal = 0;
            total = 0;
            $('.totalLinePrice').each(function () {
                if ($(this).val() != '') subTotal += parseFloat($(this).val());
            });
            tax = $('#tax').val();

            if (tax != '' && typeof(tax) != "undefined") {
                discountAmount = subTotal * (parseFloat(tax) / 100);
                total = subTotal + discountAmount;
            } else {
                $('#discountAmount').val(0);
                total = subTotal;
            }


            $('#subTotal').val(subTotal.toFixed(2));
            $('#totalAftertax').val(total.toFixed(2));
            $('#paid_amount').val(total.toFixed(2));
            calculateAmountDue();
        }

        $(document).on('change keyup blur', '#amountPaid', function () {
            calculateAmountDue();
        });

        //due amount calculation
        function calculateAmountDue() {
            amountPaid = $('#amountPaid').val();
            total = $('#totalAftertax').val();
            if (amountPaid != '' && typeof(amountPaid) != "undefined") {
                amountDue = parseFloat(total) - parseFloat(amountPaid);

                $('.amountDue').val(amountDue.toFixed(2));
                if ((amountDue) < parseFloat(0)) {
                    $('#changeAmount').text("Change Amount : "+ Math.abs(amountDue));
                }else if ((amountDue) > parseFloat(0)) {
                    $('#changeAmount').text("Due Amount : "+ amountDue);
                }else if ((amountDue) == parseFloat(0.00)) {
                    $('#changeAmount').text("Due Amount : "+ amountDue);
                }

            } else {
                total = parseFloat(total).toFixed(2);
                $('.amountDue').val(total);
                $('#changeAmount').text("Due Amount : "+ total);
            }
        }


        //It restrict the non-numbers
        var specialKeys = new Array();
        specialKeys.push(8, 46); //Backspace
        function IsNumeric(e) {
            var keyCode = e.which ? e.which : e.keyCode;
            // console.log(keyCode);
            var ret = ((keyCode >= 48 && keyCode <= 57) || specialKeys.indexOf(keyCode) != -1);
            return ret;
        }


    </script>



@stop