<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<?php   $title=DB::table('companydetails')->get(); ?>
    <title> {{$title[0]->name }}</title>

    <link href="{{ asset('public/assets/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('public/assets/vendors/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{asset('public/assets/vendors/animate.css/animate.min.css')}}" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{asset('public/assets/build/css/custom.min.css')}}" rel="stylesheet">
    <script src="{{asset('public/assets/vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- comman function -->
    <script type="text/javascript" src="{{asset('public/js/common.js')}}"></script>

    <script src="{{asset('public/js/jquery.validate.min.js')}}"></script>
</head>
<body class="login">
    <div>
        <a class="hiddenanchor" id="signup"></a>
        <a class="hiddenanchor" id="signin"></a>

            @yield('content')
            @yield('script')

    </div>
</body>
</html>
