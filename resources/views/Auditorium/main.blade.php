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
    @include("Sidebars.speaker-sidebar")

    <!-- Main content -->



        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card" style="background-color:rgba(54,54,54,0.65);color: white;height: 630px">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3>Profile Information</h3>
                                    </div>
                                    <div class="col-md-6">









                                            @if (\Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($conference->start_time))  )

                                                <a href="{{route('AuditoriumPlay',$conference->id)  }}" class="btn btn-dark btn-block"
                                                   role="button" disabled="">Not started yet
                                                    <i class="fa fa-hourglass"></i>
                                                </a>

                                            @elseif (\Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($conference->start_time)) and \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($conference->end_time)) )



                                                @if ($conference->started)
                                                    <a href="{{route('join-webinar',$conference->id)  }}" class="btn btn-success btn-block"
                                                       role="button" disabled="">Join Conference
                                                        <i class="fa fa-plus"></i>
                                                    </a>

                                                @else


                                                    <a href="{{route('join-webinar',$conference->id)  }}" class="btn btn-warning btn-block"
                                                       role="button" disabled="">host has not started the conference yet...
                                                        <i class="fa fa-users"></i>
                                                    </a>

                                                @endif



                                            @elseif (\Carbon\Carbon::today() > \Carbon\Carbon::parse($conference->start_date) or ( \Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($conference->end_time))  ))


                                                @if($conference->recorded_video)



                                                    <a href="{{$conference->recorded_video}}" class="btn btn-danger btn-block"
                                                       role="button" disabled="">Recorded video
                                                        <i class="fa fa-film"></i>
                                                    </a>




                                                @endif

                                                <a href="{{route('AuditoriumPlay',$conference->id)  }}"
                                                   class="btn btn-outline-dark btn-block"
                                                   role="button" disabled="">Conference is over
                                                    <i class="fa fa-cancel"></i>
                                                </a>


                                            @else


                                                <a href="{{route('AuditoriumPlay',$conference->id)  }}"
                                                   class="btn btn-outline-dark btn-block"
                                                   role="button" disabled="">No action
                                                    <i class="fa fa-cancel"></i>
                                                </a>



                                            @endif














                                    </div>
                                </div>
                                <div class="mt-3">
                                    <div class="row bg-white text-dark p-2 m-1" style="border-radius: 5px;">
                                        <div class="col-md-6">
                                            <p>Speaker Name: {{\App\Speaker::find(\Illuminate\Support\Facades\Session::get('Speaker')->id)->Name}}</p>
                                            <p>Speaker Username: {{\App\Speaker::find(\Illuminate\Support\Facades\Session::get('Speaker')->id)->UserName}}</p>
                                            <p>Speaker Title: {{$conference->title}}</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p>Conference Date: {{$conference->start_date}}</p>
                                            <p>Start Time: {{$conference->start_time}}</p>
                                            <p>End Time: {{$conference->end_time}}</p>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <form action="{{route('Auditorium.UpdateProfile')}}" method="post" class="w-100" enctype="multipart/form-data">

                                                @csrf
                                                <div class="form-group mt-2">
                                                    <label for="">
                                                        Please Write About Yourself In Order To Show it To The Audience
                                                    </label>
                                                    <textarea name="abstract" id="" cols="30" rows="5" class="form-control">{{\App\Speaker::find(\Illuminate\Support\Facades\Session::get('Speaker')->id)->abstract}}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">
                                                        Please Upload Your Pamphlet (PDF)
                                                    </label>
                                                    <input type="file" name="PdfFile" class="form-control-file">
                                                </div>
                                                <input type="submit" value="Update" class="btn btn-primary btn-block">

                                            </form>

                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <form action="{{route('Auditorium.ChangePassword')}}" method="post" class="w-100">
                                                @csrf
                                                <p>Change Your Password</p>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="OldPassword" placeholder="Type Your Old Password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control" name="password" placeholder="Type Your New Password">
                                                </div>
                                                <div class="form-group">
                                                    <input type="password" class="form-control"  name="password_confirmation" placeholder="Type Your New Password Again">
                                                </div>

                                                <input type="submit" value="Change Password" class="btn btn-success w-100">
                                            </form>
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


    <script>

        my_price_var = document.getElementById('price_id').innerText

        if (my_price_var == '' || my_price_var == '0' || my_price_var == 0) {


            document.getElementById('price_id').innerText = 'Free'
            $('#paypal_btn').prop('disabled', true)
            $('#paypal_btn').text('{{__('message.ExFree')}}')

        }

    </script>




@stop
