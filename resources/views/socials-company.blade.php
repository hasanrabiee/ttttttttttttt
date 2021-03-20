@extends('layouts.Panel')

@section("Head")


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/hasan-custom.css")}}" rel="stylesheet" type="text/css">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="{{asset("js/bootstrap.bundler.js")}}"></script>
    <script src="{{asset("js/blockui.min.js")}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset("js/d3.min.js")}}"></script>
    <script src="{{asset("js/d3tooltip.js")}}"></script>
    <script src="{{asset("js/switchery.min.js")}}"></script>
    <script src="{{asset("js/momment.min.js")}}"></script>
    <script src="{{asset("js/app2.js")}}"></script>
    <script src="{{asset("js/dashboard.js")}}"></script>
    <script src="https://use.fontawesome.com/fd423b8d2f.js"></script>
    <!-- /theme JS files -->


@endsection

@section('content')


<body style="background-color:#0e0c41;overflow-x: hidden">

    <div class="container text-white">
        <div class="row">
            <div class="col-md-4 mt-md-2">
                <h1>{{$Booth->CompanyName}}</h1>
            </div>
            <div class="col-md-4 mt-md-3">
                <h3>WE'RE ON SOCIAL MEDIA</h3>
            </div>
        </div>



        <div class="row">
            <div class="col-md-4">
                <a href="{{$Booth->linkedin}}">
                    <img src="{{asset("assets/img/linkdinlogo.png")}}" alt="" class="w-100">
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{$Booth->facebook}}">
                    <img src="{{asset("assets/img/facebooklogo.png")}}" alt="" class="w-100">
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{$Booth->instagram}}">
                    <img src="{{asset("assets/img/instagramlogo.png")}}" alt="" class="w-100">
                </a>
            </div>
        </div>

    </div>

</body>


@endsection
</html>
