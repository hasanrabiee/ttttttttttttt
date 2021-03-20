<div class="modal fade" role="dialog" tabindex="-1" id="Lang_Modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>{{__('message.ChangeLang')}}</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div class="dropdown">

                    <a style="text-decoration: none !important" class="" href="{{ url('locale/en') }}"><i
                            class="fa fa-globe"></i>English</a><br>
                    <a style="text-decoration: none !important" class="" href="{{ url('locale/de') }}"><i
                            class="fa fa-globe"></i>German</a><br>
                    <a style="text-decoration: none !important" class="" href="{{ url('locale/al') }}"><i
                            class="fa fa-globe"></i>Shqip</a><br>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close
                </button>
            </div>
        </div>
    </div>
</div>


<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>
<div class="modal fade" role="dialog" tabindex="-1" id="avatar_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>{{__('message.ChangeAvatarPhoto')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('Exhibitor.UpdateAvatar')}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="Avatar">
                    </div>
                    <button class="btn btn-success btn-block" type="submit">{{__('message.UpdateAvatar')}} <i
                            class="fa fa-save" style="margin-left: 9px;"></i></button>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block" data-dismiss="modal" type="button">
                    {{__('message.Close')}}
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" role="dialog" tabindex="-1" id="info">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Exhibitor Panel Tutorial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="text-left mb-2">
                    <a target="_blank" href="{{\App\Site::first()->exPanelPDF}}" class="btn text-left btn-primary">PDF Guide</a>
                </div>
                <iframe width="420" height="315"
                        src="{{\App\Site::first()->exPanelVideo}}">
                </iframe>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close
                </button>
            </div>
        </div>
    </div>
</div>


<!-- Main navbar -->
<div class="navbar navbar-expand-md">
    <div class="navbar-brand wmin-200">
        <a href="profile.php" class="d-inline-block">
        </a>
    </div>

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">

        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="fa fas fa-bars" style="color: white !important;"></i>
        </button>
    </div>
</div>
<!-- /main navbar -->

<!-- Page content -->
<div class="page-content pt-0 mt-3">







    <!-- Main sidebar -->
    <div class="sidebar sidebar-light sidebar-main sidebar-expand-md align-self-start">

        <!-- Sidebar mobile toggler -->
        <div class="sidebar-mobile-toggler text-center">
            <a href="#" class="sidebar-mobile-main-toggle">
                <i class="fa fas fa-chevron-left"></i>
            </a>
            <span class="font-weight-semibold">Main sidebar</span>
            <a href="#" class="sidebar-mobile-expand">
                <i class="fa fas fa-expand"></i>
                <i class="icon-screen-normal"></i>
            </a>
        </div>
        <!-- /sidebar mobile toggler -->


        <!-- Sidebar content -->
        <div class="sidebar-content">
            <div class="card card-sidebar-mobile">

                <!-- Header -->
                <div class="card-header header-elements-inline">
                </div>

                <!-- User menu -->
                <div class="sidebar-user">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 mb-3 mt-n3 text-white">
                                @include('Sidebars.time')
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <a title="logout" class="btn btn-dark btn-sm " href="{{ route('logout') }}" style="font-size:14px;color: #c5c5c5;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>

                                <a title="language" type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#Lang_Modal').modal('show')" class="btn btn-dark btn-sm text-white"><i class="fa fa-globe" style="font-size: 15px;"></i></a>

                                <a title="info" type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#info').modal('show')" class="btn btn-dark  btn-sm"><i class="fa fa-info-circle"></i></a>


                            </div>
                        </div>
                        <div class="media">

                            <div class="mr-3">
                                <a href="#avatar_modal" data-toggle="modal" role="button"><img class="rounded-circle" width="38" height="38" src="{{asset(\Illuminate\Support\Facades\Auth::user()->Image)}}"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold mt-md-2">{{\Illuminate\Support\Facades\Auth::user()->UserName}}     </div>

                                {{--                                    <span class="btn btn-danger btn-sm">Logout</span>--}}

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /user menu -->

                <!-- Main navigation -->
                <div class="card-body p-0">
                    <ul class="nav nav-sidebar" data-nav-type="accordion" style="height: 700px !important ;">
                        <!-- Main -->
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.index')}}" class="nav-link @if( Request::is("*index*")) active @endif">
                                        <span>
										{{__('message.Profile')}}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.MyBooth')}}" class="nav-link @if( Request::is("*Booth*")) active @endif"><span>{{__('message.Booth')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.Inbox')}}" class="nav-link @if( Request::is("*nbox*")) active @endif"> <span>{{__('message.Inbox')}}</span>

                                @if (isset($newMessage) && $newMessage >0)
                                    <span class="badge badge-info ml-3"> {{__("message.NewMessage")}}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.MeetingSchedule')}}" class="nav-link @if( Request::is("*Meeting*")) active @endif"> <span>{{__("message.MeetingSchedule")}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.AddConference')}}" class="nav-link @if( Request::is("*AddC*")) active @endif"> <span>{{__("message.RequestConference")}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.History')}}" class="nav-link @if( Request::is("*History*")) active @endif"><span>{{__('message.History')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.AddStaff')}}" class="nav-link @if( Request::is("*Staff*")) active @endif"><span>{{__("message.AddStaff")}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.Statistics')}}" class="nav-link @if( Request::is("*Statistic*")) active @endif"> <span>{{__('message.Statistics')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.Payment')}}" class="nav-link @if( Request::is("*Payment*")) active @endif"><span>{{__('message.Payment')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.Confirmation')}}" class="nav-link @if( Request::is("*Confirm*")) active @endif"><span>{{__('message.ConfirmationStatus')}}</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.ContactUs')}}" class="nav-link @if( Request::is("*Contact*")) active @endif"><span>{{__('message.ContactUs')}}</span></a>
                        </li>

                        <li class="nav-item text-center mt-md-2">
                            <a href="http://amitisgroup.net/HTML5/" class="" target="_blank"><span class="btn btn-success btn-lg">{{__("message.EnterExhabition")}}</span></a>
                        </li>

                        <li class="nav-item text-center mt-md-2">

                            <div class="btn-group">
                                <a class="btn btn-dark" target="_blank" href="{{route("Auditorium")}}">
                                    Auditorium
                                </a>
                                <a class="btn btn-info" target="_blank" href="{{route("Lounge")}}">
                                    Lounge
                                </a>
                            </div>

                        </li>

                        <!-- /main -->
                    </ul>
                </div>
                <!-- /main navigation -->

            </div>
        </div>
        <!-- /sidebar content -->
    </div>
    <!-- /main sidebar -->
