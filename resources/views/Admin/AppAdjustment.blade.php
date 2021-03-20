@extends('layouts.Panel')
@section("Head")

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset("css/hasan-custom.css")}}">

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



    <!-- Page content -->
<body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;
    ;">
    <div class="page-content pt-0 mt-3">


    @include("Sidebars.admin-sidebar")



        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card card-admin" style="background-color:#006B63;color: white">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <form method="post" action="{{route('Admin.AppAdjustmentPost')}}" enctype="multipart/form-data"
                                  class="w-100">
                                @csrf
                            <div class="card-body" style="height: 900px;overflow-y: auto">
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" style="font-size:12px;margin-left:-20px !important;color: black" id="nav-entrance-tab" data-toggle="tab" href="#nav-entrance" role="tab" aria-controls="nav-entrance" aria-selected="true">{{__("message.Entrance")}}</a>
                                        <a class="nav-item nav-link" style="font-size:12px;color:black" id="nav-lobby-tab" data-toggle="tab" href="#nav-lobby" role="tab" aria-controls="nav-lobby" aria-selected="true">{{__("message.Lobby")}}</a>
                                        <a class="nav-item nav-link" style="font-size:12px;color:black" id="nav-hall-tab" data-toggle="tab" href="#nav-hall" role="tab" aria-controls="nav-hall" aria-selected="true">{{__("message.Hall")}}</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-entrance" role="tabpanel" aria-labelledby="nav-entrance-tab">

                                        <h4>{{__("message.UploadYourImages")}}</h4>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/entrance.png")}}" alt="" class="w-100">
                                            </div>

                                            <!--                                        Entrance File Inputs-->

                                            <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">

                                                                <label for="">Picture A (1200*1200)</label>
                                                                <input type="file" class="form-control-file" name="Main1">
                                                                @if (\App\Hall::first()->Main1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B (408*652)</label>
                                                                <input type="file" class="form-control-file" name="Main2">
                                                                @if (\App\Hall::first()->Main2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture C (200*760)</label>
                                                                <input type="file" class="form-control-file" name="Main3">
                                                                @if (\App\Hall::first()->Main3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>

                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Picture D (200*760)</label>
                                                                <input type="file" class="form-control-file" name="Main4">
                                                                @if (\App\Hall::first()->Main4 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture E (200*760)</label>
                                                                <input type="file" class="form-control-file" name="Main5">
                                                                @if (\App\Hall::first()->Main5 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture F (200*760)</label>
                                                                <input type="file" class="form-control-file" name="Main6">
                                                                @if (\App\Hall::first()->Main6 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>



                                            <!--                                        /Entrance File Inputs-->
                                        </div>


                                    </div>
                                    <div class="tab-pane fade" id="nav-lobby" role="tabpanel" aria-labelledby="nav-lobby-tab">
                                        <h4>Upload Your Images</h4>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/lobby.png")}}" alt="" class="w-100">
                                            </div>

                                            <!--                                        Lobby File Inputs-->

                                            <div class="col-md-6">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Picture A (1212*507)</label>
                                                                <input type="file" class="form-control-file" name="Loby1">
                                                                @if (\App\Hall::first()->Loby1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Picture A Link
                                                                </label>
                                                                <input type="text" class="form-control" name="lobyLink1" value="{{\App\Hall::first()->lobyLink1}}">

                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B (664*1200)</label>
                                                                <input type="file" class="form-control-file" name="Loby2" >
                                                                @if (\App\Hall::first()->Loby2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Picture B Link
                                                                </label>
                                                                <input type="text" class="form-control" name="lobyLink2" value="{{\App\Hall::first()->lobyLink2}}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="">Picture C (664*1200)</label>
                                                                <input type="file" class="form-control-file" name="Loby3">
                                                                @if (\App\Hall::first()->Loby3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Picture C Link
                                                                </label>
                                                                <input type="text" class="form-control" name="lobyLink3" value="{{\App\Hall::first()->lobyLink3}}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture D (664*1200)</label>
                                                                <input type="file" class="form-control-file" name="Loby4">
                                                                @if (\App\Hall::first()->Loby4 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Picture D Link
                                                                </label>
                                                                <input type="text" class="form-control" name="lobyLink4" value="{{\App\Hall::first()->lobyLink4}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">
                                                            Welcome Video in Lobby
                                                        </label>
                                                        <input type="text" class="form-control" name="welcomeVideo" value="{{\App\Hall::first()->welcomeVideo}}">
                                                    </div>

                                            </div>



                                            <!--                                        /Lobby File Inputs-->
                                        </div>



                                    </div>












                                    <div class="tab-pane fade" id="nav-hall" role="tabpanel" aria-labelledby="nav-hall-tab">

                                        <h4>Upload Your Images</h4>
                                        <h5>Wall Poster(1490*700)</h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/wallposter-.png")}}" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/wallposter-guid.png")}}" alt="" class="w-100">
                                            </div>

                                            <!--                                        Hall File Inputs-->

                                            <div class="col-md-12">

                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture A1</label>
                                                                <input type="file" class="form-control-file" name="Wallposter1">
                                                                @if (\App\Hall::first()->Wallposter1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture A2</label>
                                                                <input type="file" class="form-control-file" name="Wallposter2">
                                                                @if (\App\Hall::first()->Wallposter2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture B1</label>
                                                                <input type="file" class="form-control-file" name="Wallposter3">
                                                                @if (\App\Hall::first()->Wallposter3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B2</label>
                                                                <input type="file" class="form-control-file" name="Wallposter4">
                                                                @if (\App\Hall::first()->Wallposter4 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture C1</label>
                                                                <input type="file" class="form-control-file" name="Wallposter5">
                                                                @if (\App\Hall::first()->Wallposter5 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture C2</label>
                                                                <input type="file" class="form-control-file" name="Wallposter6">
                                                                @if (\App\Hall::first()->Wallposter6 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture D1</label>
                                                                <input type="file" class="form-control-file" name="Wallposter7">
                                                                @if (\App\Hall::first()->Wallposter7 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture D2</label>
                                                                <input type="file" class="form-control-file" name="Wallposter8">
                                                                @if (\App\Hall::first()->Wallposter8 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>



                                        </div>
                                        <hr>
                                        <h5>Grounded Billboard(1920*1200)</h5>


                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/grounded-bilboard.png")}}" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/grounded-bilboard-guid.png")}}" alt="" class="w-100">
                                            </div>

                                            <!--                                        Hall File Inputs-->

                                            <div class="col-md-12">

                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture A</label>
                                                                <input type="file" class="form-control-file" name="Stand1">
                                                                @if (\App\Hall::first()->Stand1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B</label>
                                                                <input type="file" class="form-control-file" name="Stand2">
                                                                @if (\App\Hall::first()->Stand2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture C</label>
                                                                <input type="file" class="form-control-file" name="Stand3">
                                                                @if (\App\Hall::first()->Stand3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture D</label>
                                                                <input type="file" class="form-control-file" name="Stand4">
                                                                @if (\App\Hall::first()->Stand4 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture E</label>
                                                                <input type="file" class="form-control-file" name="Stand5">
                                                                @if (\App\Hall::first()->Stand5 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture F</label>
                                                                <input type="file" class="form-control-file" name="Stand6">
                                                                @if (\App\Hall::first()->Stand6 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture G</label>
                                                                <input type="file" class="form-control-file" name="Stand7">
                                                                @if (\App\Hall::first()->Stand7 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <h5>Grounded Poster(1920*1000)</h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/grounded-poster.png")}}" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-center">
                                                    <img src="{{asset("assets/img/03.png")}}" alt="" class="w-50" height="400">
                                                </div>
                                            </div>

                                            <!--                                        Hall File Inputs-->

                                            <div class="col-md-12">
                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture A1</label>
                                                                <input type="file" class="form-control-file" name="Billboard1">
                                                                @if (\App\Hall::first()->Billboard1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture A2</label>
                                                                <input type="file" class="form-control-file" name="Billboard2">
                                                                @if (\App\Hall::first()->Billboard2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture B1</label>
                                                                <input type="file" class="form-control-file" name="Billboard3">
                                                                @if (\App\Hall::first()->Billboard3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B2</label>
                                                                <input type="file" class="form-control-file" name="Billboard4">
                                                                @if (\App\Hall::first()->Billboard4 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture C1</label>
                                                                <input type="file" class="form-control-file" name="Billboard5">
                                                                @if (\App\Hall::first()->Billboard5 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture C2</label>
                                                                <input type="file" class="form-control-file" name="Billboard6">
                                                                @if (\App\Hall::first()->Billboard6 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">

                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <h5>Hanging Billboard 1 (2000*150)</h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/hanging-bilboard-type01.png")}}" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/hanging-bilboard-type01-guid.png")}}" alt="" class="w-100">
                                            </div>

                                            <!--                                        Hall File Inputs-->

                                            <div class="col-md-12">

                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture A</label>
                                                                <input type="file" class="form-control-file" name="Panposter1">
                                                                @if (\App\Hall::first()->Panposter1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture B</label>
                                                                <input type="file" class="form-control-file" name="Panposter2">
                                                                @if (\App\Hall::first()->Panposter2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture C</label>
                                                                <input type="file" class="form-control-file" name="Panposter3">
                                                                @if (\App\Hall::first()->Panposter3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                        </div>
                                                    </div>

                                            </div>
                                        </div>
                                        <hr>
                                        <h5 class="mt-5">Hanging Billboard2(1600*380)</h5>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/hanging-bilboard-type02.png")}}" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-6">
                                                <img src="{{asset("assets/img/hanging-bilboard-type02-guid.png")}}" alt="" class="w-100">
                                            </div>

                                            <!--                                        Hall File Inputs-->

                                            <div class="col-md-12">

                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture A1</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter1">
                                                                @if (\App\Hall::first()->Rotationposter1 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture A2</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter2">
                                                                @if (\App\Hall::first()->Rotationposter2 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture A3</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter3">
                                                                @if (\App\Hall::first()->Rotationposter3 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture A4</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter4">
                                                                @if (\App\Hall::first()->Rotationposter4 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture B1</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter5">
                                                                @if (\App\Hall::first()->Rotationposter5 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B2</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter6">
                                                                @if (\App\Hall::first()->Rotationposter6 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B3</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter7">
                                                                @if (\App\Hall::first()->Rotationposter7 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture B4</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter8">
                                                                @if (\App\Hall::first()->Rotationposter8 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture C1</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter9">
                                                                @if (\App\Hall::first()->Rotationposter9 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture C2</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter10">
                                                                @if (\App\Hall::first()->Rotationposter10 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture C3</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter11">
                                                                @if (\App\Hall::first()->Rotationposter11 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture C4</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter12">
                                                                @if (\App\Hall::first()->Rotationposter12 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture D1</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter13">
                                                                @if (\App\Hall::first()->Rotationposter13 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture D2</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter14">
                                                                @if (\App\Hall::first()->Rotationposter14 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture D3</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter15">
                                                                @if (\App\Hall::first()->Rotationposter15 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture D4</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter16">
                                                                @if (\App\Hall::first()->Rotationposter16 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture E1</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter17">
                                                                @if (\App\Hall::first()->Rotationposter17 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture E2</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter18">
                                                                @if (\App\Hall::first()->Rotationposter18 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture E3</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter19">
                                                                @if (\App\Hall::first()->Rotationposter19 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture E4</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter20">
                                                                @if (\App\Hall::first()->Rotationposter20 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="">Picture F1</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter21">
                                                                @if (\App\Hall::first()->Rotationposter21 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture F2</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter22">
                                                                @if (\App\Hall::first()->Rotationposter22 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture F3</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter23">
                                                                @if (\App\Hall::first()->Rotationposter23 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">Picture F4</label>
                                                                <input type="file" class="form-control-file" name="Rotationposter24">
                                                                @if (\App\Hall::first()->Rotationposter24 != null)
                                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <img src="{{asset("assets/img/expostation.png")}}" alt="" class="w-100 mt-3">
                                                        </div>

                                                    </div>
                                            </div>
                                        </div>




                                    </div>















                                    <div class="tab-pane fade" id="nav-lounge" role="tabpanel" aria-labelledby="nav-lounge-tab">



                                        <table class="table table-bordered table-hover table-light text-center mb-5 table-responsive-sm">
                                            <thead>
                                            <th>
                                                {{__('message.Name')}}
                                            </th>
                                            <th>
                                                {{__('message.Member')}} {{__('message.Count')}}
                                            </th>
                                            <th>
                                                {{__('message.Create')}} {{__('message.Date')}}
                                            </th>
                                            <th>
                                                {{__('message.Action')}}
                                            </th>
                                            </thead>
                                            <tbody>
                                            @foreach(\App\Lounge::all() as $lounge)
                                                <tr>
                                                    <td>{{$lounge->Name}}</td>
                                                    <td>{{count(json_decode($lounge->Members))}}</td>
                                                    <td>{{\Carbon\Carbon::instance($lounge->created_at)->format('Y-m-d')}}</td>
                                                    <td>
                                                        <a class="btn btn-danger" role="button"
                                                           href="{{route('Admin.RemoveLoungeWithUrl' , $lounge->id)}}"><i
                                                                class="fa fa-trash w-100" style="font-size: 15px;"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                        <h3>{{__("message.CreateGroup")}}:</h3>




                                    </div>
                                </div>

                            </div>
                                <input type="submit" value="Save Your Changes" class="btn btn-success w-100">
                            </form>




                        </div>
                        <!-- /traffic sources -->
                    </div>
                </div>
                <!-- /main charts -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->

</body>

@endsection

@section('js')
    <script>
        // var form = document.getElementById("Form1");
        //
        // document.getElementById("Submit1").addEventListener("click", function () {
        //     form.submit();
        // });
    </script>
@endsection
