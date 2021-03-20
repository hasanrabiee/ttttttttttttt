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



{{--    Hasan start here !!!!!--}}





    <!-- Page content -->
    <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    <div class="page-content pt-0">







    @include("Sidebars.admin-sidebar")




        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card card-admin" style="background-color:rgba(168,168,168,0.5);color: white">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">

                                </div>
                            </div>
                            <div class="card-body">
                                <h5>Theme</h5>



                                <form class="w-100" method="post" action="{{route('Admin.VisitorSettingPost')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for=""><h6>{{__('message.BackgroundPicture')}}</h6></label>
                                        <input type="file" name="VisitorBackGround">
                                        @if (\App\Site::first()->VisitorBackGround != null)
                                            <span class="text-success">Uploaded</span>
                                        @endif
                                    </div>
                                    <h5>Info</h5>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Welcome" name="VisitorWelcome" value="{{$Site->VisitorWelcome}}">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="About Visitor" rows="5" name="VisitorAbout">{{$Site->VisitorAbout}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="About Payment" rows="5"name="VisitorAboutPayment">{{$Site->VisitorAboutPayment}}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="Entrance Fee" disabled class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="0" class="form-control" name="VisitorPayment" value="{{$Site->VisitorPayment}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="$"class="form-control" value="{{$Site->MoneyType}}" name="MoneyType">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">
                                                    Add Video Tutorial Youtube Link For Visitor Registration :
                                                </label>
                                                <input type="text" class="form-control" name="visitorRegistrationVideo" value="{{$Site->visitorRegistrationVideo}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Upload Tutorial PDF for Visitor Registration :
                                                </label>
                                                <input type="file" name="visitorRegistrationPDF" class="form-control-file">
                                                @if (\App\Site::first()->visitorRegistrationPDF != null)
                                                    <span class="text-success">Uploaded</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Add Video Tutorial Youtube Link For Visitor Panel :
                                                </label>
                                                <input type="text" class="form-control" name="visitorPanelVideo" value="{{$Site->visitorPanelVideo}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                   Upload Tutorial PDF for Visitor Panel:
                                                </label>
                                                <input type="file" class="form-control-file" name="visitorPanelPDF">
                                                @if (\App\Site::first()->visitorPanelPDF != null)
                                                    <span class="text-success">Uploaded</span>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <input type="submit" class="btn btn-success btn-lg w-100" value="save">
                                </form>
                            </div>
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
