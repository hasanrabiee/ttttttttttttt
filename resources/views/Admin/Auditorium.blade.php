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
    {{--    <script src="{{asset("js/jquery.min.js")}}"></script>--}}
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

    <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    {{--    Hasan start here !!!!!--}}



    {{--           Modals--}}






    <!-- Page content -->



    <div class="page-content pt-0 mt-3">
    @include("Sidebars.admin-sidebar")
    <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">
            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->


                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->

                        <div class="card p-3 card-admin" style="background-color:#006B63;color: white">
                            <div class="card-body py-0">
                                <div class="row">






                                    <div class="col-md-2">

                                        <h3 class="text-dark">Dates</h3>

                                        @foreach($Days as $day)

                                            <a href="?day={{$day}}" class="btn  @if(\request()->has('day') && \request()->day == $day) btn-primary @else btn-outline-dark @endif text-white w-100 mb-2">{{$day}}</a>

                                        @endforeach














                                    </div>








                                    @if (\request()->has('day'))


                                        <div class="col-md-5 mt-3 mt-md-0" style="height: 690px;border: 2px solid white;border-radius: 5px;overflow-y: auto">
                                            <h4 class="mt-2 mb-2">

                                                {{__("message.RequestedConferenceForSelectedDay")}}

                                            </h4>
                                            <table class="table table-hover table-striped table-bordered table-light">
                                                <thead>
                                                <th>{{__("message.ConferenceTitle")}}</th>
                                                <th>{{__("message.CompanyName")}}</th>
                                                <th>{{__("message.Speaker")}}</th>
                                                </thead>
                                                <tbody>

                                                @foreach($current_day_confs as $cd_conf)


                                                    <tr>
                                                        @if($cd_conf->used == 'notselected')
                                                            <td>{{\Illuminate\Support\Str::limit($cd_conf->title, 10, '...')}}</td>
                                                            <td>{{ $cd_conf->booth != 0  ? \App\booth::where('id', $cd_conf->booth)->first()->CompanyName : 'Admin'       }}</td>
                                                            <td>{{\App\Speaker::where('cid', $cd_conf->id)->get()->count()}}</td>
                                                        @endif

                                                    </tr>

                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>




                                        <div class="col-md-5">
                                            <h4 class="mt-2 mt-md-0">
                                                {{__("message.ScheduleSheet")}}
                                                <i class="fa fa-calendar"></i>
                                            </h4>
                                            <p>{{__("message.ScheduledConference")}} : 1</p>
                                            <p>{{__("message.RequestedConference")}} : 1</p>

                                            <button type="button" onclick="$('#AddSpeaker').modal('show')" class="btn btn-primary w-100">Add Conference to Auditorium
                                                <i class="fa fa-plus"></i>
                                            </button>




                                            <div class="modal fade" role="dialog" tabindex="-1" id="AddSpeaker">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="text-dark">{{__("message.AddConferenceToAuditorium")}}
                                                                <i class="fa fa-plus"></i></h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                        </div>


                                                        <form action="{{route('Admin.AuditoriumCreate')}}" method="POST">

                                                            @csrf


                                                            <div class="modal-body text-dark">
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        {{__("message.Begin")}}:
                                                                    </label>
                                                                    <input name="start_time" type="time" class="form-control">
                                                                    <input name="day" value="{{\request()->day}}" type="hidden">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        {{__("message.End")}}:
                                                                    </label>
                                                                    <input name="end_time" type="time" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        {{__("message.SelectConference")}}
                                                                    </label>
                                                                    <select name="cid" id="" class="form-control">




                                                                        @foreach($all_conf_reqs as $item)

                                                                            <option value="{{$item->id}}">
                                                                                {{$item->title}}
                                                                            </option>

                                                                        @endforeach


                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">
                                                                        {{__("message.SelectConference")}}
                                                                    </label>
                                                                    <select name="hall" id="" class="form-control">
                                                                        <option value="A">
                                                                            Hall-A
                                                                        </option>
                                                                        <option value="B">
                                                                            Hall-B
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">


                                                                <button class="btn btn-success w-100" type="submit">Save</button>
                                                                <button class="btn btn-light btn-block"
                                                                        data-dismiss="modal" type="button">
                                                                    {{__('message.Close')}}
                                                                </button>
                                                            </div>

                                                        </form>


                                                    </div>
                                                </div>
                                            </div>

                                            <a href="{{route('Admin.AuditoriumPublish')}}" class="btn btn-primary w-100 mt-2">{{__("message.PublishSheet")}}
                                                <i class="fa fa-send"></i>
                                            </a>
                                            <a href="{{route('Auditorium')}}" target="_blank" class="btn btn-info w-100 mt-2">{{__("message.ViewAuditoriumAgenda")}}
                                                <i class="fa fa-eye"></i>
                                            </a>

                                            <table class="mt-5 table table-striped table-bordered table-hover table-light">
                                                <thead>
                                                    <th>{{__("message.ConferenceTitle")}}</th>
                                                    <th>{{__("message.Time")}}</th>
                                                    <th>{{__("message.HallName")}}</th>
                                                    <th>{{__("message.Action")}}</th>
                                                </thead>

                                                <tbody>

                                                @foreach(\App\Conference::where('start_date', \request()->day)->get() as $conf)

                                                    <tr>
                                                        <td>{{\Illuminate\Support\Str::limit($conf->title, 10 , '...')}}</td>
                                                        <td>{{$conf->start_time}} - {{$conf->end_time}}</td>
                                                        <td>{{$conf->hall}}</td>

                                                        <td>


                                                            @if (\Carbon\Carbon::parse(\Carbon\Carbon::now()->format('Y-m-d'))->eq(\Carbon\Carbon::parse($conf->start_date)) && \Carbon\Carbon::now()->gte(\Carbon\Carbon::parse($conf->start_time)) && \Carbon\Carbon::now()->lte(\Carbon\Carbon::parse($conf->end_time)))
                                                                <a href="{{route('Admin.create-webinar',$conf->id)  }}"  target="_blank" class="btn btn-success btn-block"><i class="fa fa-play"></i></a>

                                                            @else
                                                                <button  class="btn btn-dark btn-block" disabled=""><i class="fa fa-play"></i></button>

                                                            @endif


                                                                <a href="{{route('Admin.AuditoriumDelete', $conf->id)}}" class="btn btn-danger my-delete  btn-block"><i class="fa fa-trash"></i></a>



                                                        </td>
                                                    </tr>

                                                @endforeach


                                                </tbody>
                                            </table>
                                        </div>

                                    @endif



                                </div>
                                <!-- /main charts -->
                            </div>
                        </div>
                    </div>
                </div>





            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->


    </body>








@endsection

@section("js")


    <script>

        $(".my-delete").on("click", function (e){

            e.preventDefault()
            const urlToRedirect = e.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty


            var result = Swal.fire({
                title: 'Note: Are You Sure Deleting this Conference?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Saved!', '', 'success')
                    window.location = urlToRedirect
                    return true
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'error')
                    return false
                }
            })



        })



    </script>




    @endsection
