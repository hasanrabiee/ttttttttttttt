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

    {{--    Hasan start here !!!!--}}



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
                        <div class="card" style="background-color:#006B63;color: white;height: 630px">

                            <div class="card-body">
                                <h5>
                                    {{__("message.PleaseAddYourStaff")}}
                                </h5>
                                <div class="row">
                                    <div class="col-md-6">

                                        @if (\App\Site::first()->ExhibitorMaximumOperator - $opCount > 0)
                                            <h6>Remain Operator : {{\App\Site::first()->ExhibitorMaximumOperator - $opCount}}</h6>
                                            <form action="{{route("Exhibitor-Register-Two")}}" class="w-100 mt-3 mt-md-5" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="">
                                                        {{__("message.PleaseEnterOperatorEmailAddress")}}
                                                    </label>
                                                    <input type="email" class="form-control" name="OperatorEmail">
                                                </div>
                                                <input type="submit" class="btn btn-primary w-100" value="Add Staff">
                                            </form>

                                        @else

                                            <div class="alert alert-danger mt-3 mt-md-5">

                                                {{__("message.YouReachedTheMaxOperator")}}

                                            </div>

                                        @endif



                                    </div>
                                    <div class="col-md-6">

                                        <div style="height: 500px;background-color:white;border-radius: 5px;" class="mt-3 mt-md-5">
                                            <div class="w-100 bg-dark" style="height: 75px;border-radius: 5px 5px 0 0 ">
                                                <br>
                                                <h3 class="ml-3 mt-n1">{{__("message.YourStaffEmailList")}}</h3>
                                            </div>
                                            <table class="table table-hover table-bordered table-striped">

                                                @foreach($emails as $key=>$email)

                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$email->email}}</td>
                                                    <td class="text-center">

                                                        @if (\App\User::where("email",$email->email)->get()->count() > 0)
                                                            <button class="btn btn-sm btn-success w-100">
                                                                {{__("message.Registered")}}
                                                            </button>
                                                        @else
                                                            <button class="btn btn-sm btn-dark w-100">
                                                                {{__("message.Pending")}}
                                                            </button>
                                                        @endif
                                                    </td>
                                                </tr>

                                                @endforeach


                                            </table>
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


@section("js")







@stop
