@extends('layouts.Panel')


@section("Head")

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
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




@endsection

{{--Modals --}}

<div class="modal fade" role="dialog" tabindex="-1" id="AddSpeaker">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark">{{__("message.SpeakerInformation")}}</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <form action="{{route('Admin.AddSpeaker')}}" method="post">
                <div class="modal-body text-dark">

                    @csrf

                    <div class="form-group">
                        <label for="">
                            {{__("message.UserNamee")}}:
                        </label>
                        <input name="UserName" type="text" class="form-control">
                        <input name="cid" type="hidden" value="{{\request()->has('cid') ? \request()->cid : ''}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">
                            {{__("message.fn")}}:
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
                            {{__("message.passwordConfrimation")}}:
                        </label>
                        <input name="password_confirmation" type="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">

                    <button class="btn btn-success w-100">{{__("message.Save")}}</button>
                    <button class="btn btn-light btn-block"
                            data-dismiss="modal" type="button">
                        {{__('message.Close')}}
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


{{--End Modals--}}

<!-- Page content -->

<div class="page-content pt-0 mt-3">


    {{--    INCLUDE SIDE BAR HERE !!!!--}}

    @include("Sidebars.admin-sidebar")

    {{--    INCLUDE SIDE BAR HERE !!!!--}}



    @section('content')
        <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height: 100%;
            ;"><!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card" style="background-color:#006B63;color: white">
                            <div class="card-header header-elements-inline">
                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">


                                @if (\request()->has('action') && \request()->action == 'edit')



                                    <form action="{{route('Admin.UpdateSpeaker')}}" method="post" class="w-100">
                                        @csrf

                                        <input type="hidden" name="sid" value="{{\request()->sid}}">

                                        <h4 class="text-dark">{{__("message.Edit")}} {{__("message.SpeakerInformation")}}</h4>

                                        <row>


                                            <div class="">




                                                        <div class="form-group">
                                                            <label for="">
                                                                {{__("message.UserName")}}:
                                                            </label>
                                                            <input name="UserName" value="{{$current_speakers->UserName ?? ''}}" type="text" class="form-control">
                                                            <input name="cid" type="hidden" value="{{\request()->has('cid') ? \request()->cid : ''}}" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">
                                                                {{__("message.fn")}}:
                                                            </label>
                                                            <input name="Name" value="{{$current_speakers->Name ?? ''}}" type="text" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">
                                                                {{__("message.email")}}:
                                                            </label>
                                                            <input name="email" value="{{$current_speakers->email ?? ''}}" type="email" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">
                                                                {{__("message.password")}}
                                                            </label>
                                                            <input name="password" placeholder="Optional: leave empty to have the current password" type="password" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">
                                                                {{__("message.passwordConfrimation")}}
                                                            </label>
                                                            <input name="password_confirmation" placeholder="confirm password if filled" type="password" class="form-control">
                                                        </div>

                                                        <button class="btn btn-success w-100">Update</button>
                                                        <button class="btn btn-light btn-block"
                                                                data-dismiss="modal" type="button">
                                                            {{__('message.Close')}}
                                                        </button>




                                            </div>


                                        </row>



                                    </form>


                                @else

                                    <form action="{{route('Admin.conference-create')}}" method="post" class="w-100">
                                        @csrf
                                        <div class="row">


                                            {{--                            Dates--}}


                                            <div class="col-md-2"
                                                 style="height: 530px; border: 2px solid white;border-radius: 5px">



                                                @foreach($days as $day)



                                                    <a href="?day={{$day}}" class="btn @if(\request()->has('day') && \request()->day == $day) btn-primary @else btn-outline-dark @endif text-white w-100 mt-md-2">{{$day}}</a>



                                                @endforeach




                                            </div>


                                            {{--                            /Dates--}}


                                            {{--                            Conference name input--}}


                                            @if(\request()->has('day'))

                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="">



                                                                <div class="form-group">
                                                                    <label for=""><h3>{{__("message.ConferenceTitle")}}</h3></label>
                                                                    <input name="title" value="{{isset($current_conference->title) ? $current_conference->title : ''}}" type="text" class="form-control">
                                                                    <input name="date" type="hidden" value="{{\request()->day}}" class="form-control">
                                                                </div>


                                                                <div class="form-group mt-2">
                                                                    <label for="">
                                                                        <h3>
                                                                            {{__("message.AddConferenceAbstract")}}
                                                                        </h3>
                                                                    </label>
                                                                    <textarea name="abstract" type="text" class="form-control"
                                                                              rows="5">{{isset($current_conference->abstract) ? $current_conference->abstract : ''}}</textarea>
                                                                </div>





                                                                @if(\request()->has('cid'))



                                                                    <h4 class="mt-md-3">{{__("message.SelectedConferenceSpeakers")}}</h4>
                                                                    <div class=" w-100" style="height: 238px;overflow-y: auto">
                                                                        <table
                                                                            class="table table-hover table-bordered table-light text-center">
                                                                            <thead>
                                                                                <th>{{__("message.SpeakerEmail")}}</th>
                                                                                <th>{{__("message.Edit")}}</th>
                                                                                <th>{{__("message.Delete")}}</th>
                                                                            </thead>
                                                                            <tbody>

                                                                            @foreach($speakers as $sp)


                                                                                <tr>
                                                                                    <td>{{$sp->email}}</td>
                                                                                    <td><a href="{{\request()->fullUrlWithQuery(['sid' => $sp->id, 'action' => 'edit'])}}" class="btn btn-info"><i
                                                                                                class="fa fa-edit"></i></a></td>
                                                                                    <td><a href="{{\request()->fullUrlWithQuery(['sid' => $sp->id, 'action' => 'delete'])}}" class="btn btn-danger"><i
                                                                                                class="fa fa-trash"></i></a></td>
                                                                                </tr>


                                                                            @endforeach


                                                                            </tbody>
                                                                        </table>
                                                                    </div>









                                                                    <button type="button"
                                                                            onclick="$('#AddSpeaker').modal('show')"
                                                                            class="btn btn-primary w-100" data-toggle="modal"
                                                                            data-target="#myModal">{{__("message.AddSpeakerToList")}}
                                                                    </button>


                                                                @endif


                                                            </div>
                                                        </div>


                                                        {{--                                    Requested Conference--}}

                                                        <div class="col-md-6">
                                                            <h4 class="">{{__("message.RequestedConference")}}</h4>
                                                            <div class="bg-white p-2"
                                                                 style="height: 270px;margin-top:22px;overflow-y: auto">

                                                                @foreach($conferences as $conf)

                                                                    <a href="{{\request()->fullUrlWithQuery(['cid' => $conf->id])}}" class="w-100 btn  @if(\request()->has('cid') && \request()->cid == $conf->id ) btn-primary @else btn-outline-dark @endif  mb-2">{{$conf->title}}</a>



                                                                @endforeach




                                                            </div>



                                                        </div>


                                                        {{--                                    /Requested Conference--}}


                                                    </div>
                                                </div>

                                            @endif
                                        </div>

                                        @if (\request()->has('cid'))
                                            <input type="hidden" name="update" value="1">
                                            <input type="hidden" name="cid" value="{{\request()->cid}}">
                                            <button type="submit" class="btn btn-success w-100 mt-2">

                                                {{__("message.UpdateConferenceInformation")}}
                                                <i class="fa fa-pencil"></i>

                                            </button>
                                        @else
                                            <button type="submit" class="btn btn-success w-100 mt-2">

                                                {{__("message.CreateConference")}}
                                                <i class="fa fa-plus"></i>

                                            </button>

                                        @endif










                                    </form>


                                @endif




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
