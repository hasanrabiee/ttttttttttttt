@extends('layouts.Panel')
@section("Head")


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
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
                        <div class="card card-inbox-ex-h" style="background-color:#006B63;color: white;">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{route('Exhibitor.FinalizeConference')}}" method="post" class="w-100">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h4>{{__("message.SpeakerNameTable")}}</h4>
                                            <div style="overflow-y: auto;height: 450px;">
                                                <table class="table table-light table-hover table-bordered text-center"
                                                       style="">
                                                    <thead>
                                                    <th>id</th>
                                                    <th>{{__("message.SpeakerName")}}</th>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($speakers as $speaker)

                                                        <tr>
                                                            <td>{{$loop->index + 1}}</td>
                                                            <td>{{$speaker->email}}</td>
                                                        </tr>

                                                    @endforeach

                                                    </tbody>
                                                </table>
                                            </div>


                                            @if($can_submit == 'yes')
                                            <button type="button" onclick="$('#AddSpeaker').modal('show')"
                                                    class="btn btn-primary w-100">{{__("message.AddSpeakerToList")}}
                                            </button>
                                                @endif
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="hidden" name="abstract" id="abstract_box" value="">
                                                <label for="">
                                                    {{__("message.PleaseWriteYourConferenceTitle")}}
                                                </label>
                                                <input name="title" value="{{\request()->old('title')}} {{isset($current_conference->title) ? $current_conference->title : ''}}" type="text" class="form-control" @if(isset($current_conference->title)) disabled @endif>
                                            </div>


                                            <div class="form-group">
                                                <label for="">
                                                    {{__("message.PleaseWriteAbstractYourConference")}}
                                                </label>
                                                <textarea name="abstract" type="text" class="form-control"
                                                          rows="10" @if(isset($current_conference->abstract)) disabled @endif>{{\request()->old('abstract')}} {{isset($current_conference->abstract) ? $current_conference->abstract : ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h4 class="mt-3 mt-md-0">
                                                {{__("message.SuggestThreeDatesPreferForConference")}}
                                            </h4>
                                            <div class="form-group">
                                                <label for="">Prefer Date1 :</label>
                                                <input name="date1" value="{{isset($current_conference->date1)  ? $current_conference->date1 : ''}}" @if (isset($current_conference->date1))
                                                    disabled="disabled"
                                                @endif type="date" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Prefer Date2 :</label>
                                                <input name="date2" value="{{isset($current_conference->date2)  ? $current_conference->date2 : ''}}" @if (isset($current_conference->date2))
                                                disabled="disabled"
                                                       @endif type="date" class="form-control">                                            </div>
                                            <div class="form-group">
                                                <label for="">Prefer Date3 :</label>
                                                <input name="date3" value="{{isset($current_conference->date3)  ? $current_conference->date3 : ''}}" @if (isset($current_conference->date3))
                                                disabled="disabled"
                                                       @endif type="date" class="form-control">                                            </div>
                                        </div>
                                    </div>
                                    @if($can_submit == 'yes')

                                    <input type="submit" class="mt-3 btn btn-success w-100" value="Submit Your Request">

                                        @endif




                                    @if (isset($current_conference->booth) && \App\Conference::where('booth', $current_conference->booth)->first() != null)

                                        @php
                                        $conference = \App\Conference::where('booth', $current_conference->booth)->first();
                                        @endphp














                                        @if (\Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($conference->start_time))  )

                                            <a href="{{route('AuditoriumPlay',$conference->id)  }}" class="btn btn-dark btn-block"
                                               role="button" disabled="">{{__("message.NotStartedYet")}}
                                                <i class="fa fa-hourglass"></i>
                                            </a>

                                        @elseif (\Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($conference->start_time)) and \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($conference->end_time)) )


                                            @if ($conference->started )

                                                <a href="{{route('join-webinar',$conference->id)  }}" class="btn btn-success btn-block"
                                                   role="button" disabled="">{{__("message.ClickToJoinTheConference")}}
                                                    <i class="fa fa-plus"></i>
                                                </a>

                                            @else


                                                <a href="{{route('join-webinar',$conference->id)  }}" class="btn btn-success btn-block"
                                                   role="button" disabled="">{{__("message.ClickToJoinTheConference")}}
                                                    <i class="fa fa-plus"></i>
                                                </a>


                                            @endif









                                        @elseif (\Carbon\Carbon::today() > \Carbon\Carbon::parse($conference->start_date) or ( \Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($conference->end_time))  ))


                                            @if($conference->recorded_video)



                                                <a href="{{$conference->recorded_video}}" class="btn btn-danger btn-block"
                                                   role="button" disabled="">{{__("message.RecordedVideo")}}
                                                    <i class="fa fa-film"></i>
                                                </a>




                                            @endif

                                            <a href="{{route('AuditoriumPlay',$conference->id)  }}"
                                               class="btn btn-outline-dark btn-block"
                                               role="button" disabled="">{{__("message.ConferenceIsOver")}}
                                                <i class="fa fa-cancel"></i>
                                            </a>


                                        @else


                                            <a href="{{route('AuditoriumPlay',$conference->id)  }}"
                                               class="btn btn-outline-dark btn-block"
                                               role="button" disabled="">{{__("message.NoAction")}}
                                                <i class="fa fa-cancel"></i>
                                            </a>



                                        @endif



















                                    @endif











                                </form>

                                <div class="modal fade" role="dialog" tabindex="-1" id="AddSpeaker">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="text-dark">{{__("message.SpeakerInformation")}}</h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                            </div>
                                            <form action="{{route('Exhibitor.AddSpeaker')}}" method="post">
                                                <div class="modal-body text-dark">

                                                    @csrf

                                                    <div class="form-group">
                                                        <label for="">
                                                            {{__("message.UserName")}}:
                                                        </label>
                                                        <input name="UserName" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">
                                                            {{__("message.Name")}}:
                                                        </label>
                                                        <input name="Name" type="text" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">
                                                            {{__("message.Email")}}:
                                                        </label>
                                                        <input name="email" type="email" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">
                                                            {{__("message.password")}}:
                                                        </label>
                                                        <input name="password" type="password" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">
                                                            {{__("message.passwordConfrimation")}}
                                                        </label>
                                                        <input name="password_confirmation" type="password" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                            <button class="btn btn-success w-100">Save</button>
                                            <button class="btn btn-light btn-block"
                                                    data-dismiss="modal" type="button">
                                                {{__('message.Close')}}
                                            </button>
                                        </div>
                                            </form>

                                        </div>
                                </div>
                            </div>


                        {{--                                Boot strap Modal Start Here !!!--}}



                        <!-- Trigger the modal with a button -->
                        {{--                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>--}}

                        <!-- Modal -->



                            {{--                                Bootstrap Modal End Here !!! --}}


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




    </script>




@stop
