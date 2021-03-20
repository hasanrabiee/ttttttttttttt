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




    @include("Sidebars.visitor-sidebar")





    <!-- Main content -->

    <div class="content-wrapper" style="overflow-x: hidden">

    <!-- Content area -->
        <div class="content">

            <!-- Main charts -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- Traffic sources -->

                    <div class="card pc-height-visitor-history  "
                         style="background-color:#006B63;color: white">
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-md-4">
                                    <form onblur="is_typing = false" onfocus="is_typing = true" action="#search_company"
                                          class="w-100">
                                        <div class="input-group mt-2 mb-2 w-100">
                                            <input type="text" class="form-control"
                                                   placeholder="{{__('message.CompanyName')}}" name="search">
                                            <div class="input-group-append">
                                                <button class="btn btn-success"
                                                        type="submit">{{__('message.Search')}}</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div style="height: 500px;overflow-y: auto;overflow-x: hidden">
                                        <table class="table">
                                            <thead>
                                            <th>{{__("message.CompanyName")}}</th>
                                            <th>{{__("message.RequestedDate")}}</th>
                                            </thead>
                                        </table>



                                        @foreach ($meetings as $item)


                                            @if(\request()->has('rid') && $item->id == \request()->rid)


                                                <a href="?rid={{$item->id}}" class="btn btn-primary text-white w-100 mb-2 text-left">
                                                    <div class="row">
                                                        <div class="col-5">
                                                    <span title="{{\App\booth::where('UserID', $item->exhibitor_id)->first()->CompanyName}}">
                                                                                                                {{\Illuminate\Support\Str::limit(\App\booth::where('UserID', $item->exhibitor_id)->first()->CompanyName, 10)}}

                                                    </span>
                                                        </div>
                                                        <div class="col-7">{{$item->request_time}}</div>
                                                    </div>
                                                </a>

                                                @else



                                                <a href="?rid={{$item->id}}" class="btn btn-outline-dark text-white w-100 mb-2 text-left">
                                                    <div class="row">
                                                        <div class="col-5">
                                                    <span title="{{\App\booth::where('UserID', $item->exhibitor_id)->first()->CompanyName}}">
                                                                                                                {{\Illuminate\Support\Str::limit(\App\booth::where('UserID', $item->exhibitor_id)->first()->CompanyName, 10)}}

                                                    </span>
                                                        </div>
                                                        <div class="col-7">{{$item->request_time}}</div>
                                                    </div>
                                                </a>


@endif
                                        @endforeach



                                    </div>

                                </div>

                                <div class="col-md-8">



                                    @if(\request()->has('rid'))

                                        @if($selected_meeting->status == 'none')


                                        <div class="alert alert-info mt-md-5" style="height: 500px;">
                                        <h4>
                                            <i class="fa fa-clock-o"></i>
                                            {{__("message.Date")}} {{$selected_meeting->request_time}}</h4>

                                        <h4>

                                            <i class="fa fa-pencil"></i>
                                                {{__("message.PendingExhibitorMeeting")}}

                                        </h4>


                                            @elseif($selected_meeting->status == 'rejected')


                                                <div class="alert alert-danger mt-md-5" style="height: 500px;">
                                                    <h4>
                                                        <i class="fa fa-clock-o"></i>

                                                        {{__("message.Date")}}: {{$selected_meeting->request_time}}</h4>



                                                    <h4>
                                                        <i class="fa fa-pencil"></i>

                                                       {{__("message.RejectedExhibitorMeeting")}}

                                                    </h4>



                                                    @elseif($selected_meeting->status == 'accepted')


                                                        <div class="alert alert-success mt-md-5" style="height: 500px;">
                                                            <h4>
                                                                <i class="fa fa-clock-o"></i>
                                                                {{__("message.Date")}}: {{$selected_meeting->request_time}}</h4>



                                                            <h4>
                                                                <i class="fa fa-pencil"></i>
                                                                {{__("message.AcceptedExhibitorMeeting")}}
                                                                </h4>




                                                            @if (\Carbon\Carbon::today()->toDateString() == \Carbon\Carbon::parse($meeting_exhibitor->request_time)->toDateString() or \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($meeting_exhibitor->request_time)) and \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($meeting_exhibitor->request_time)->addMinutes(30)) )

                                                                <a href="{{route('Visitor.meeting.join', $meeting_exhibitor->meeting_id )}}" class="btn btn-block btn-primary">
                                                                    <i class="fa fa-bullhorn"></i>
                                                                    {{__("message.EnterMeeting")}}
                                                                </a>


                                                            @elseif (\Carbon\Carbon::today()->toDateString() == \Carbon\Carbon::parse($meeting_exhibitor->request_time)->toDateString() and  \Carbon\Carbon::now()->toTimeString() < \Carbon\Carbon::parse($meeting_exhibitor->request_time)->toTimeString()  )
                                                                <button disabled=""  class="btn btn-dark w-100">
                                                                    {{__("message.MeetingNotStartedYet")}}
                                                                </button>
                                                            @else
                                                                <button disabled=""  class="btn btn-dark w-100">
                                                                    {{__("message.NoAction")}}
                                                                </button>
                                                            @endif







                                                            @endif


                                    </div>


                                        @endif



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
    <!-- /main content -->
    </div>


    </div>
    </body>





@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function show_info(javad) {
            Swal.fire({
                text: javad,
            })
        }
    </script>
@endsection
