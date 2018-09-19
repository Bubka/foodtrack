<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="robots" content="noindex, nofollow">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <title>Food</title>

    <link href="{{ asset('css/app.css') }}" media="all" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <style>
        .twitter-typeahead,
        .tt-hint,
        .tt-input,
        .tt-menu {
            width: 100% !important;
            /*font-weight: normal;*/
        }

        ul.timeline {
            list-style-type: none;
            position: relative;
        }
        ul.timeline:before {
            content: ' ';
            background: #d4d9df;
            display: inline-block;
            position: absolute;
            left: 29px;
            width: 2px;
            height: 100%;
            z-index: 400;
        }
        ul.timeline > li {
            margin: 20px 0;
            padding-left: 20px;
        }
        ul.timeline > li:before {
            content: ' ';
            background: white;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #22c0e8;
            left: 20px;
            width: 20px;
            height: 20px;
            z-index: 400;
        }
     </style>

</head>
<body>
    @isset($intakeDate)
        @include('partials.header')
    @endisset
    <main role="main" class="container" style="padding-bottom: 70px;">
        <br />
        @yield('content')
    </main>
    @include('partials.footer')
</body>
</html>
