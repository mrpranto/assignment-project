@extends('master')

@section('title','Sale')

@section('page_header')

    <i class="fa fa-cart"></i> Sale

@stop


@section('css')

@stop



@section('content')



    <div class="modal fade" id="addnew" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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

        @include('partials._app_title')

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


        <div class="row">
            <div class="col-md-12">
                <div class="tile">
                    <button class="btn btn-primary" style="float: right;" data-toggle="modal" data-target="#addnew"><i
                                class="fa fa-plus"></i>Add New Item
                    </button>
                    <h4 class="tile-title">Item List</h4>

                    <hr>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th>
                                <th>Sub Total</th>
                                <th>Tax</th>
                                <th>Total Payable</th>
                                <th>Paid Amount</th>
                                <th>Total item</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($sales as $key => $sale)

                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $sale->customer->customer_name }}</td>
                                    <td>{{ $sale->total_sub_total }}</td>
                                    <td>{{ $sale->tax }}</td>
                                    <td>{{ $sale->total_payable }}</td>
                                    <td>{{ $sale->paid_amount }}</td>
                                    <td>{{ $sale->sale_details->count() }}</td>
                                    <td>

                                        <a href="{{ route('sale.edit',$sale->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('sale.show',$sale->id) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                                        <button class="btn btn-danger btn-sm" title="Delete"
                                                onclick="delete_data('{{ $sale->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                    <form action="{{ route('sale.destroy',$sale->id) }}" id="delete_{{ $sale->id }}" method="POST">
                                        @csrf
                                        @method("DELETE")
                                    </form>

                                </tr>

                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </main>




@stop



@section('js')

    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('asset/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

    <script type="text/javascript">

        function delete_data(id) {
            swal({
                title: "Are you sure ?",
                text: "You want to delete this data ?",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it.",
                cancelButtonText: "No, cancel it.",
                closeOnConfirm: false,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    $('#delete_' + id).submit();
                    ;
                }
            });
        }

    </script>

@stop