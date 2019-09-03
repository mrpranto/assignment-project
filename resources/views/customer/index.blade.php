@extends('master')

@section('title','Customer')

@section('page_header')

    <i class="fa fa-users"></i> Customer

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
                                <input type="text" id="customer_name" name="customer_name" value="{{ old('customer_name') }}"
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
                                <textarea name="address" class="form-control" id="address">{{ old('address') }}</textarea>

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
                                class="fa fa-plus"></i>Add New Customer
                    </button>
                    <h4 class="tile-title">Customer List</h4>

                    <hr>
                    <div class="tile-body">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                            <tr>
                                <th>Sl</th>
                                <th>Customer Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($customers as $key => $customer)


                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $customer->customer_name }}</td>
                                    <td>{{ $customer->phone }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->address }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#edit{{ $customer->id }}"><i class="fa fa-pencil"></i></button>
                                        <button class="btn btn-danger btn-sm" title="Delete"
                                                onclick="delete_data('{{ $customer->id }}')">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>

                                    <form action="{{ route('customer.destroy',$customer->id) }}" id="delete_{{ $customer->id }}" method="POST">
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


    @foreach($customers as $key => $customer)


    <div class="modal fade" id="edit{{ $customer->id }}" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit @yield('title')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <form class="form-horizontal" action="{{ route('customer.update',$customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="customer_name" class="control-label col-md-4 text-right"> Customer Name <sup
                                        class="text-danger h6">*</sup> </label>
                            <div class="col-md-8">
                                <input type="text" id="customer_name" name="customer_name" value="{{ $customer->customer_name }}"
                                       class="form-control @error('item_name') is-invalid @enderror"
                                       placeholder="Item Name">

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
                                       value="{{ $customer->phone }}" type="text"
                                       class="form-control @error('phone') is-invalid @enderror"
                                       placeholder=Phone">

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
                                <input id="email" name="email" value="{{ $customer->email }}"
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
                                <textarea name="address" class="form-control" id="address">{{ $customer->address }}</textarea>

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