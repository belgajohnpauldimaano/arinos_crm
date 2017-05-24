<!DOCtype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Arinos CRM</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="robots" content="index, follow">

    <!-- Styles -->
    <link href="{{ asset('css/normalize.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <!-- Your JS files here -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <![endif]-->

    @yield('styles')
    
</head>
<body id="top">
<div class="container">
    
    @yield('content')

</div> <!-- .container -->

<div id="colophon" class="site-footer" role="contentinfo">

</div> <!-- .site-footer -->

@yield('scripts')

</body>
</html>