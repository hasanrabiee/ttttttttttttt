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





    {{--    Hasan start Here !!!!--}}




    <body style="background: url('{{\App\Site::ExhibitorBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    <div>


    @include("Sidebars.exhibitor-sidebar")







    <!-- Main content -->



        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card pc-height-visitor-meeting" style="background-color:#006B63;color: white;">
                            <div class="card-body">
                                <div class="row">




                                    {{--                                    Auditorium Date Link--}}


                                    <div class="col-md-2">
                                        <h3 class="text-dark">{{__("message.Date")}}</h3>
                                        <a href="" class="btn btn-primary text-white w-100 mb-2">12.23.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.24.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.25.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.26.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.27.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.28.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.29.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.30.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.31.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.23.2020</a>
                                    </div>



                                    <div class="col-md-10 bg-white text-dark" style="border-radius: 5px;">
                                        <div class="container mt-4">
                                            <h3 class="mb-md-2">

                                                {{__("message.AddConferenceVideoLink")}}


                                            </h3>

                                            <div class="form-group">
                                                <label for="">
                                                    Conference Title
                                                </label>
                                                <input type="text" class="form-control" placeholder="Add Recorded Youtube Link">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Conference Title
                                                </label>
                                                <input type="text" class="form-control" placeholder="Add Recorded Youtube Link">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Conference Title
                                                </label>
                                                <input type="text" class="form-control" placeholder="Add Recorded Youtube Link">
                                            </div>
                                            <input type="submit" value="Submit Your Request" class="btn btn-success w-100">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- /traffic sources -->
                    </div>
                </div>
                <!-- /main charts -->
            </div>
            <!-- /content area -->
        </div>



        <!--/Main Content  -->
    </div>


    </div>
    </body>









@endsection
