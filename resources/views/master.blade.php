<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="description">
    <!-- Twitter meta-->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:site" content="@pratikborsadiya">
    <meta property="twitter:creator" content="@pratikborsadiya">
    <!-- Open Graph Meta-->
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('asset/css/main.css') }}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
<!-- Navbar-->

@include('partials._header')

<!-- Sidebar menu-->
@include('partials._sidebar')

@yield('content')


<!-- Essential javascripts for application to work-->
<script src="{{ asset('asset/js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('asset/js/popper.min.js') }}"></script>
<script src="{{ asset('asset/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('asset/js/main.js') }}"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="{{ asset('asset/js/plugins/pace.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('asset/js/plugins/sweetalert.min.js') }}"></script>
@yield('js')

<script type="text/javascript">

    @if(session()->get('message'))
        swal({
            title: "Success!",
            text: "{{ session()->get('message') }}",
            type: "success",
            timer: 3000
        });
    @endif

</script>

</body>
</html>