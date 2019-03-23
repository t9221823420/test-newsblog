<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test</title>


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="http://work055.local/js/scripts.js"></script>

    <style>
        body {
            font-size: 1.5rem !important;
        }
    </style>

</head>
<body>

    <div class="row">

        <div class="menu col-md-2">
            <div class="container">
                @include("layouts" . request()->route()->getPrefix() . "._menu")
            </div>
        </div>

        <div class="content col-md-10">
            <div class="container">
                @yield('content')
            </div>
        </div>

    </div>

<script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>
</html>