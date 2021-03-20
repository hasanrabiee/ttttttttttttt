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

    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>


@endsection
@section('content')






    {{--Hasan start here --}}


    <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">



    <!-- Page content -->

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
                        <div class="card card-admin" style="background-color:rgba(168,168,168,0.5);color: white">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <h5>{{__('message.Theme')}}</h5>

                                <form class="w-100" method="post" action="{{route('Admin.SigninPost')}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for=""><h6>{{__("message.BackgroundPicture")}}</h6></label>
                                        <input type="file" class="form-control-file" name="SigninBackground">
                                        @if (\App\Site::first()->SigninBackground != null)
                                            <span class="text-success">Uploaded</span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for=""><h6>{{__("message.ExhabitionEventTitle")}}</h6></label>
                                        <input type="text" class="form-control" name="ExhabitionTitle" value="{{$Site->ExhabitionTitle}}">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-success w-100" value="Save">
                                    </div>
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






    {{--    Tabs tabs--}}








@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            var fieldHTML = '<div><input type="text" name="OperatorEmails[]" value="" class="form-control" placeholder="Operator Email" /><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus-circle" style="font-size: 30px;color: #ffffff;margin-left: 10px"></i></a></div>'; //New input field html

            //Once add button is clicked
            $('.add_button').click(function () {
                $('.field_wrapper').append(fieldHTML); //Add field html
            });

            //Once remove button is clicked
            $('.field_wrapper').on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });



    </script>
@endsection


