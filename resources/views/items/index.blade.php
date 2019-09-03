@extends('master')

@section('title','Items')

@section('page_header')

    <i class="fa fa-bandcamp"></i> Items

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


                <form class="form-horizontal" action="{{ route('item.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="account_name" class="control-label col-md-4 text-right">Item Name <sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input type="text" id="item_name" name="item_name" value="{{ old('item_name') }}"
                                       class="form-control @error('item_name') is-invalid @enderror"
                                       placeholder="Item Name">

                                @error('item_name')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="account_no" class="control-label col-md-4 text-right">Stock Type </label>
                            <div class="col-md-8">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="stock_type" value="1" checked><span
                                                class="label-text">Stock</span>
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    <label>
                                        <input type="radio" name="stock_type" value="0"><span class="label-text">Not Stock</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="account_no" class="control-label col-md-4 text-right">Item Type </label>
                            <div class="col-md-8">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="item_type" value="1" checked><span class="label-text">Standard</span>
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    <label>
                                        <input type="radio" name="item_type" value="0"><span
                                                class="label-text">Kit</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="branch_name" class="control-label col-md-4 text-right">Description </label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control" id="" rows="4"></textarea>
                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="whole_sale_price" class="control-label col-md-4 text-right">Whole Sale Price<sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input id="whole_sale_price" name="whole_sale_price"
                                       value="{{ old('whole_sale_price') }}" type="text"
                                       class="form-control @error('whole_sale_price') is-invalid @enderror"
                                       placeholder="Whole Sale Price">

                                @error('whole_sale_price')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="branch_name" class="control-label col-md-4 text-right">Retail Price<sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input id="retail_price" name="retail_price" value="{{ old('retail_price') }}"
                                       type="text" class="form-control @error('retail_price') is-invalid @enderror"
                                       placeholder="Retail Price">

                                @error('retail_price')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="receive_quantity" class="control-label col-md-4 text-right">Receiving
                                Quantity<sup class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input id="receive_quantity" name="receive_quantity"
                                       value="{{ old('receive_quantity') }}" type="text"
                                       class="form-control @error('receive_quantity') is-invalid @enderror"
                                       placeholder="Receiving Quantity">

                                @error('receive_quantity')
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
                                <th>Item Name</th>
                                <th>Stock Type</th>
                                <th>Item Type</th>
                                <th>Whole Sale Price</th>
                                <th>Retail Price</th>
                                <th>Receiving Quantity</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($items as $key => $item)


                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->item_name }}</td>
                                    <td>{{ $item->stock_type == 1 ? 'Stock Available' : 'Not Available' }}</td>
                                    <td>{{ $item->item_type == 1 ? 'Standard' : 'Kit' }}</td>
                                    <td>{{ $item->wholeSale_price }}</td>
                                    <td>{{ $item->retail_price }}</td>
                                    <td>{{ $item->receiving_quantity }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#edit{{ $item->id }}"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Delete"
                                                onclick="delete_data('{{ $item->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                    <form action="{{ route('item.destroy',$item->id) }}" id="delete_{{ $item->id }}" method="POST">
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


    @foreach($items as $key => $item)


    <div class="modal fade" id="edit{{ $item->id }}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit @yield('title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form class="form-horizontal" action="{{ route('item.update',$item->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="account_name" class="control-label col-md-4 text-right">Item Name <sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input type="text" id="item_name" name="item_name" value="{{ $item->item_name }}"
                                       class="form-control @error('item_name') is-invalid @enderror"
                                       placeholder="Item Name">

                                @error('item_name')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="account_no" class="control-label col-md-4 text-right">Stock Type </label>
                            <div class="col-md-8">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="stock_type" value="1" {{ $item->stock_type == 1 ? 'checked' : '' }} ><span
                                                class="label-text">Stock</span>
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    <label>
                                        <input type="radio" name="stock_type" value="0" {{ $item->stock_type == 0 ? 'checked' : '' }}><span class="label-text">Not Stock</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="account_no" class="control-label col-md-4 text-right">Item Type </label>
                            <div class="col-md-8">
                                <div class="animated-radio-button">
                                    <label>
                                        <input type="radio" name="item_type" value="1" {{ $item->item_type == 1 ? 'checked' : '' }}><span class="label-text">Standard</span>
                                    </label>
                                    &nbsp;
                                    &nbsp;
                                    <label>
                                        <input type="radio" name="item_type" value="0" {{ $item->item_type == 0 ? 'checked' : '' }}><span
                                                class="label-text">Kit</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="branch_name" class="control-label col-md-4 text-right">Description </label>
                            <div class="col-md-8">
                                <textarea name="description" class="form-control" id="" rows="4">{{ $item->description }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row add_asterisk">
                            <label for="whole_sale_price" class="control-label col-md-4 text-right">Whole Sale Price<sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input id="whole_sale_price" name="whole_sale_price"
                                       value="{{ $item->wholeSale_price }}" type="text"
                                       class="form-control @error('whole_sale_price') is-invalid @enderror"
                                       placeholder="Whole Sale Price">

                                @error('whole_sale_price')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="branch_name" class="control-label col-md-4 text-right">Retail Price<sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input id="retail_price" name="retail_price" value="{{ $item->retail_price }}"
                                       type="text" class="form-control @error('retail_price') is-invalid @enderror"
                                       placeholder="Retail Price">

                                @error('retail_price')
                                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                                @enderror

                            </div>
                        </div>


                        <div class="form-group row add_asterisk">
                            <label for="receive_quantity" class="control-label col-md-4 text-right">Receiving
                                Quantity<sup class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input id="receive_quantity" name="receive_quantity"
                                       value="{{ $item->receiving_quantity }}" type="text"
                                       class="form-control @error('receive_quantity') is-invalid @enderror"
                                       placeholder="Receiving Quantity">

                                @error('receive_quantity')
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
                            <i class="fa fa-check-circle"></i> Update
                        </button>
                    </div>

                </form>


            </div>
        </div>
    </div>


    @endforeach


@stop



@section('js')


    <!-- Page specific javascripts-->
    <!-- Data table plugin-->
    <script type="text/javascript" src="{{ asset('asset/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('asset/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>

    <!-- Google analytics script-->
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


        if (document.location.hostname == 'pratikborsadiya.in') {
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
            ga('create', 'UA-72504830-1', 'auto');
            ga('send', 'pageview');
        }
    </script>





@stop