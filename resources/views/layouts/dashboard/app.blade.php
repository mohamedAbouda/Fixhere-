<!DOCTYPE html>
<html lang="en" style="height:100%;">
<head content="A">
    <meta charset="utf-8">
    <title>{{ config('app.name') }} Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content=" bootstrap,graphic,hex" />
    <meta name="description" content="CRM" />
    <meta name="author" content="Abdulrahman Khaled">
    <link rel="shortcut icon" href="ico/favicon.png">
    <!-- Core CSS -->
    <link href="{{ asset('panel-assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet">
    <!-- Style Library -->
    <link href="{{ asset('panel-assets/css/style-library-1.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/blocks.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('panel-assets/css/navigations.css') }}" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="{{ asset('panel-assets/js/html5shiv.js') }}"></script>
    <script src="{{ asset('panel-assets/js/respond.min.js') }}"></script>
    <![endif]-->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700italic,700,800,800italic">

    {{ Html::style('panel-assets/css/sweetalert.css') }}
    <style>
    .table-borderless > tbody > tr > td,
    .table-borderless > tbody > tr > th,
    .table-borderless > tfoot > tr > td,
    .table-borderless > tfoot > tr > th,
    .table-borderless > thead > tr > td,
    .table-borderless > thead > tr > th {
        border: none;
    }

    .select2-selection {
        display: block !important;
        width: 100% !important;
        height: 34px !important;
        padding: 6px 12px !important;
        font-size: 14px !important;
        line-height: 1.42857143 !important;
        color: #555 !important;
        background-color: #fff !important;
        background-image: none !important;
        border: 1px solid #ccc !important;
        border-radius: 4px !important;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075) !important;
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s !important;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s !important;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s !important;
        border: 2px solid #ecf0f1 !important;
        border-top-width: 2px !important;
        border-right-width: 2px !important;
        border-bottom-width: 2px !important;
        border-left-width: 2px !important;
        border-top-style: solid !important;
        border-right-style: solid !important;
        border-bottom-style: solid !important;
        border-left-style: solid !important;
        border-top-color: rgb(236, 240, 241) !important;
        border-right-color: rgb(236, 240, 241) !important;
        border-bottom-color: rgb(236, 240, 241) !important;
        border-left-color: rgb(236, 240, 241) !important;
        border-radius: 0 !important;
        color: #34495e !important;
        font-size: 14px !important;
        line-height: 1.467 !important;
        padding: 8px 12px !important;
        height: 40px !important;
        border-radius: 6px !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        -webkit-transition: border .25s linear, color .25s linear, background-color .25s linear !important;
        transition: border .25s linear, color .25s linear, background-color .25s linear !important;
        border-width: 1px !important;
        border-color: rgb(157, 160, 160) !important;
        border-style: solid !important;
        border-radius: 3px !important;
        background-color: rgb(255, 255, 255) !important;
        font-size: 13px !important;
        font-family: 'Open Sans' !important;
        font-weight: 400 !important;
    }
    </style>
    @yield('stylesheets')
</head>
<body data-spy="scroll" data-target="#bs-sidebar-navbar-collapse-1">

    @include('layouts.dashboard.parts.sidebar')
    @include('layouts.dashboard.parts.topbar')

    <main id="main" style="margin-left: 90px;">

        <section id="add-contact">
            <div class="container">
                <div class="col-md-12">
                    @yield('section-title')
                    @yield('content')
                </div>
            </div>
        </section>
    </main>
    <script type="text/javascript" src="{{ asset('panel-assets/js/jquery-1.11.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('panel-assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('panel-assets/js/plugins.js') }}"></script>
    <!-- <script src="https://maps.google.com/maps/api/js?sensor=true"></script> -->
    <script type="text/javascript" src="{{ asset('panel-assets/js/bskit-scripts.js') }}"></script>
    <script type="text/javascript" src="{{ asset('panel-assets/js/scripts.js') }}"></script>

    @yield('scripts')

    {{ Html::script('panel-assets/js/sweetalert.min.js') }}
    @include('sweet::alert')
</body>
</html>
