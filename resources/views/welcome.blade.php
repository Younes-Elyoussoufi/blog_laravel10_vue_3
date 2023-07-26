<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
      {{-- <base href="site//public"> --}}

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

         <link href="{{asset('admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
            <link
                href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
                rel="stylesheet">

         <link href="{{asset('admin/css/sb-admin-2.min.css')}}" rel="stylesheet">
      
        <link rel="preconnect" href="{{asset('site/https://fonts.bunny.net')}}">
        <link rel="icon" href="{{asset('site/img/favicon.png')}}">
        <link rel="stylesheet" href="{{asset('site/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('site/css/animate.css')}}">
        <link rel="stylesheet" href="{{asset('site/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{asset('site/css/themify-icons.css')}}">
        <link rel="stylesheet" href="{{asset('site/css/liner_icon.css')}}">
        <link rel="stylesheet" href="{{asset('site/css/search.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('site/css/style.css')}}">


       
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased" id='app'>
    
        @vite('resources/js/app.js')

    <script src="{{asset('site/js/jquery-1.12.1.min.js')}}"></script>
    <script src="{{asset('site/js/popper.min.js')}}"></script>
    <script src="{{asset('site/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('site/js/custom.js')}}"></script>
    {{-- <script src="{{asset('admin/vendor/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{asset('admin/js/sb-admin-2.min.js')}}"></script>
    <script src="{{asset('admin/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('admin/js/demo/chart-pie-demo.js')}}"></script>

    </body>
</html>
