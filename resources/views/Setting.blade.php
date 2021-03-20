@extends('layouts.Panel')
@section("Head")

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">

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
                        <div class="card" style="background-color:rgba(168,168,168,0.5);color: white;height: 1050px;">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">



                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item ">
                                        <a class="nav-link active" id="Setting-tab" data-toggle="tab" href="#Setting" role="tab" aria-controls="Setting" aria-selected="true"><span style="color: black">Setting</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-white nav-link" id="Auditorium-tab" data-toggle="tab" href="#Auditorium" role="tab" aria-controls="Auditorium" aria-selected="false"><span style="color: black">Auditorium Setting</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-white nav-link" id="BackUp-tab" data-toggle="tab" href="#BackUp" role="tab" aria-controls="BackUp" aria-selected="false"><span style="color: black">BackUp</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-white nav-link" id="Language-tab" data-toggle="tab" href="#Language" role="tab" aria-controls="Language" aria-selected="false"><span style="color: black">Add Language</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="text-white nav-link" id="Export-tab" data-toggle="tab" href="#Export" role="tab" aria-controls="Export" aria-selected="false"><span style="color: black">Export And Email</span></a>
                                    </li>
                                </ul>


                                <form action="{{route('Admin.SettingPost')}}" class="w-100" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content" id="myTabContent">



                                        <div class="tab-pane fade show active" id="Setting" role="tabpanel" aria-labelledby="Setting-tab">


                                            <div class="row">
                                                <div class="col-md-7">
                                                    <form action="">
                                                        <div class="form-group">
                                                            <label for="">
                                                                Opening Date:
                                                            </label>

                                                            <a href="{{route('Admin.send-notification-to-users', ['title' =>  \App\Site::find(1)->ExhabitionTitle, 'message' => \App\Site::find(1)->ExhabitionTitle . " is open for registration"])}}?redirect=1" class="btn btn-success mb-1">
                                                                <i class="fa fa-bell"></i>
                                                                Send Openning notification to all users</a>

                                                            <input type="date" class="form-control" id="my_date" name="StartDate" value="{{$Site->StartDate}}">
                                                        </div>
                                                        <h5>
                                                            Upload Your Logo
                                                        </h5>
                                                        <div class="form-group">
                                                            <label for="">
                                                                Logo 1:
                                                            </label>
                                                            <input type="file" class="form-control-file" name="Logo1">
                                                            @if (\App\Site::first()->Logo1 != null && \App\Site::first()->Logo1 != "1")
                                                                <span class="text-success">Uploaded</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">
                                                                Logo 2:
                                                            </label>
                                                            <input type="file" class="form-control-file" name="Logo2">
                                                            @if (\App\Site::first()->Logo2 != null)
                                                                <span class="text-success">Uploaded</span>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">
                                                                Logo 3:
                                                            </label>
                                                            <input type="file" class="form-control-file" name="Logo3">
                                                            @if (\App\Site::first()->Logo3 != null)
                                                                <span class="text-success">Uploaded</span>
                                                            @endif
                                                        </div>
                                                        <h5>
                                                            Admin Background
                                                        </h5>
                                                        <div class="form-group">
                                                            <input type="file" class="form-control-file" name="AdminBackground">
                                                            @if (\App\Site::first()->AdminBackground != null)
                                                                <span class="text-success">Uploaded</span>
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-5 mt-md-5">


                                                    <a href="{{route('Admin.BackUp')}}" class="btn btn-success w-100 mt-md-5" style="font-size: 18px;">BackUp</a>
                                                    <a href="#PassWordModal" class="btn btn-info w-100 mt-1" style="font-size: 18px;" role="button" data-toggle="modal">Change Password</a>
                                                    <a href="" class="btn btn-danger w-100 mt-1" style="font-size: 18px;">Reset</a>
                                                    <a href="#" onclick="$('#notif_modal').modal('show')" class="btn btn-primary w-100 mt-1" role="button" data-toggle="modal" style="font-size: 18px;">Send Notifications</a>



                                                </div>
                                            </div>

                                            <h5>
                                                Terms And Conditions
                                            </h5>
                                            <div class="row">
                                                <div class="col-md-8">

                                                    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>
                                                    <label for="">

                                                    </label>
                                                    <textarea name="editor1">{{\App\Site::first()->Terms}}</textarea>
                                                    <script>
                                                        CKEDITOR.replace( 'editor1' );
                                                    </script>

                                                </div>
                                                <div class="col-md-4">


                                                    <h3>Contact Information</h3>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Phone Number" name="SiteName" value="{{$Site->Name}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Phone Number" name="AdminTel" value="{{$Site->AdminTel}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Address" name="AdminLocation" value="{{$Site->AdminLocation}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" placeholder="Email" name="AdminAddress" value="{{$Site->AdminAddress}}">
                                                    </div>


                                                </div>
                                            </div>

                                            <div class="form-group mt-3">
                                                <button class="btn btn-success w-100">Save</button>
                                            </div>


                                        </div>


                                        <div class="tab-pane fade" id="Auditorium" role="tabpanel" aria-labelledby="Auditorium-tab">

                                            <h3>Auditorium Setting</h3>

                                            <div class="form-group">
                                                <label for="">
                                                    Stream Key :
                                                </label>
                                                <input type="text" class="form-control" name="StreamKey" value="{{$Site->StreamKey}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">
                                                    Rtmp Address :
                                                </label>
                                                <input type="text" class="form-control" name="RtmpAddress" value="{{$Site->RtmpAddress}}">
                                            </div>
                                            <div class="form-group">
                                                <label for="">
                                                    PlayBack Url :
                                                </label>
                                                <input type="text" class="form-control" name="PlaybackUrl" value="{{$Site->PlaybackUrl}}">
                                            </div>


                                        </div>

                                        <div class="tab-pane fade" id="BackUp" role="tabpanel" aria-labelledby="BackUp-tab">
                                            <h3>Download Your BackUps</h3>

                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                <th>Time</th>
                                                <th>Action</th>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        time
                                                    </td>
                                                    <td>
                                                        <a href="" class="btn btn-sm btn-primary w-25">
                                                            <i class="fa fa-download"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="Language" role="tabpanel" aria-labelledby="Language-tab">

                                            <h3>Add Your Custom Language</h3>

                                            <div class="row">
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label for="">
                                                            Upload Your New Language Table
                                                        </label>
                                                        <input type="file" class="form-control-file">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="">
                                                            Write Display Name of Your Language
                                                        </label>
                                                        <input type="text" class="form-control">
                                                    </div>

                                                    <input type="submit" class="btn btn-success w-100" value="Add to Your List">

                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-4">
                                                    <h3>Language List</h3>
                                                    <div style="height: 300px;background-color:white;border-radius: 5px;overflow-y: auto">
                                                        <table class="w-100 table table-bordered">
                                                            <tr class="text-center">
                                                                <td>En</td>
                                                                <td><a href="" class="btn btn-sm btn-danger">Delete</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>Fr</td>
                                                                <td><a href="" class="btn btn-sm btn-danger">Delete</a></td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>Al</td>
                                                                <td><a href="" class="btn btn-sm btn-danger">Delete</a></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="Export" role="tabpanel" aria-labelledby="Export-tab">

                                            <h3>Exports And Emails</h3>
                                            <a href="{{route('Admin.ExportVisitors')}}" class="btn btn-info w-100 mb-2">
                                                Export Visitors Information
                                            </a>
                                            <a href="{{route('Admin.ExportExhibitors')}}" class="btn btn-primary w-100 mb-2">
                                                Export Exhibitors Information
                                            </a>
                                            <a href="{{route('Admin.ExportFeedbacks')}}" class="btn btn-dark w-100 mb-2">
                                                Export Visitors Feedback
                                            </a>
                                            <br>
                                            <br>
                                            <form action="{{route("Admin.ReminderEmail")}}" method="post" class="w-100">
                                                @csrf
                                                <button class="btn btn-secondary w-100 mb-2" type="submit">
                                                    Send Opening Date Reminder Email to Users
                                                </button>
                                            </form>

                                            <form action="{{route("Admin.ExhibitorsFeedbacksEmail")}}" method="post" class="w-100">
                                                @csrf
                                                <button class="btn btn-warning w-100 mb-2" type="submit">
                                                    Send Questioner Email To Exhibitors
                                                </button>
                                            </form>

                                            <form action="{{route("Admin.ThanksEmail")}}" method="post" class="w-100">
                                                @csrf
                                                <button class="btn btn-success w-100 mb-2" type="submit">
                                                    Send Thanks Email to Exhibitors
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                            </div>
                        </div>
                        <!-- /traffic sources -->
                    </div>
                </div>
                </form>
                <!-- /main charts -->
            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->


    <div  class="modal fade" role="dialog" tabindex="-1" id="notif_modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-dark">Notification Information</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <form action="{{route('Admin.send-notification-modal')}}" method="post">
                    <div class="modal-body text-dark">

                        @csrf

                        <div class="form-group">
                            <label for="">
                                Title:
                            </label>
                            <input name="title" type="text" class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="">
                                Body:
                            </label>
                            <textarea name="body"  class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">

                        <button class="btn btn-success w-100">

                            <i class="fa fa-paper-plane"></i>
                            Send Notifications</button>
                        <button class="btn btn-light btn-block"
                                data-dismiss="modal" type="button">
                            {{__('message.Close')}}
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


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
