@extends('layouts.Panel')
@section('Head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="_token" content="{{csrf_token()}}"/>

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



{{--    Hasan start here !!! --}}



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
                            <div class="card-body">
                                <h5>Theme</h5>
                                <form class="w-100" method="post" action="{{route('Admin.ExhibitorSettingPost')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for=""><h6>{{__('message.BackgroundPicture')}}</h6></label>
                                        <input type="file" name="ExhibitorBackGround">
                                        @if (\App\Site::first()->ExhibitorBackGround != null)
                                            <span class="text-success">{{__("message.Uploaded")}}</span>
                                        @endif
                                    </div>
                                    <h5>Info</h5>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="{{__("message.ExhibitorWelcome")}}" name="ExhibitorWelcome" value="{{$Site->ExhibitorWelcome}}">
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" rows="5" placeholder="{{__("message.AboutPayment")}}" name="ExhibitorAbout">{{$Site->ExhibitorAbout}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" placeholder="{{__("message.ExhibitorAboutPayment")}}" rows="5" name="ExhibitorAboutPayment">{{$Site->ExhibitorAboutPayment}}</textarea>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="{{__("message.EntranceFee")}}" disabled class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="text" placeholder="0" class="form-control"  name="ExhibitorPayment" value="{{$Site->ExhibitorPayment}}">
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
                                                <label>{{__('message.MaxiumOperatorsCount')}}</label>
                                                <input class="form-control" type="number"  placeholder="Maxium Operators Count" name="ExhibitorMaximumOperator" value="{{$Site->ExhibitorMaximumOperator}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">
                                                   {{__("message.AddVideoTutorialYoutubeLinkForExhibitorRegistration")}}
                                                </label>
                                                <input type="text" class="form-control" name="exRegistrationVideo" value="{{$Site->exRegistrationVideo}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    {{__("message.UploadTutorialPDFForExhibitorRegistration")}}
                                                </label>
                                                <input type="file" name="exRegistrationPDF" class="form-control-file">
                                                @if (\App\Site::first()->exRegistrationPDF != null)
                                                    <span class="text-success">Uploaded</span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    {{__("message.AddVideoTutorialYoutubeLinkForExhibitorPanel")}}
                                                </label>
                                                <input type="text" class="form-control" name="exPanelVideo" value="{{$Site->exPanelVideo}}">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    {{__("message.UploadTutorialPDFForVisitorPanel")}}
                                                </label>
                                                <input type="file" class="form-control-file" name="exPanelPDF">
                                                @if (\App\Site::first()->exPanelPDF != null)
                                                    <span class="text-success">{{__("message.Uploaded")}}</span>
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
