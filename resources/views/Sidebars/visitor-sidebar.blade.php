<div class="modal fade" role="dialog" tabindex="-1" id="Lang_Modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Change Language</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div class="dropdown">

                    <a style="text-decoration: none !important" class="" href="{{ url('locale/en') }}"><i
                            class="fa fa-globe"></i>English</a><br>
                    <a style="text-decoration: none !important" class="" href="{{ url('locale/de') }}"><i
                            class="fa fa-globe"></i>Germany</a><br>
                    <a style="text-decoration: none !important" class="" href="{{ url('locale/al') }}"><i
                            class="fa fa-globe"></i>Albanian</a><br>


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





<div class="modal fade" role="dialog" tabindex="-1" id="Resume_Modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark">{{__('message.Resume')}}</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">


                <div class="container">


                    <div class="row">


                        <div class="col-12">

                            <form id="resume_form" class="" method="post" action="{{route("Visitor.Resume")}}" enctype="multipart/form-data">
                                @csrf


                                <div class="form-group ">

                                    <input name="resume" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">{{__('message.Resume')}}</label>

                                </div>






                            </form>

                        </div>

                    </div>


                </div>





            </div>
            <div class="modal-footer">
                <button onclick="resume_form.submit()" class="btn btn-success btn-block" type="button">{{__('message.Upload')}}
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" tabindex="-1" id="avatar_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>{{__('message.ChangeAvatarPhoto')}}</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <form action="{{route('Visitor.UpdateAvatar')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="file" name="Avatar">
                    </div>
                    <button class="btn btn-success btn-block" type="submit">{{__('message.UpdateAvatar')}}<i class="fa fa-save" style="margin-left: 9px;"></i></button></form>
            </div>
            <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">{{__('message.Close')}}</button></div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" role="dialog" tabindex="-1" id="info">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Visitor Panel Tutorial</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
                <div class="text-left mb-2">
                    <a target="_blank" href="{{\App\Site::first()->visitorPanelPDF}}" class="btn text-left btn-primary">PDF Guide</a>
                </div>
                <iframe width="420" height="315"
                        src="{{\App\Site::first()->visitorPanelVideo}}">
                </iframe>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" role="dialog" tabindex="-1" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Change Language</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <div class="dropdown">

                    <a style="text-decoration: none !important" class="" href="{{ url('locale/en') }}"><i
                            class="fa fa-globe"></i>English</a><br>
                    <a style="text-decoration: none !important" class="" href="{{ url('locale/de') }}"><i
                            class="fa fa-globe"></i>Germany</a><br>
                    <a style="text-decoration: none !important" class="" href="{{ url('locale/al') }}"><i
                            class="fa fa-globe"></i>Albanian</a><br>


                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close
                </button>
            </div>
        </div>
    </div>
</div>




{{--    Hassan Start Here !!!--}}

<body style="background: url('{{\App\Site::VisitorBackground()}}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;
    ;">
<div>

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md">
        <div class="navbar-brand wmin-200">
            <a  class="d-inline-block" >
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
                {{--                    <div class="card-header header-elements-inline">--}}
                {{--                    </div>--}}

                <!-- User menu -->
                    <div class="sidebar-user">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 mb-3 mt-n3 text-white">
                                    @include('Sidebars.time')
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <a title="logout" class="btn btn-dark btn-sm " href="{{ route('logout') }}" style="font-size:12px;color: #c5c5c5;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>

                                    <a title="language" type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#Lang_Modal').modal('show')" class="btn btn-dark btn-sm text-white"><i class="fa fa-globe" style="font-size: 15px;"></i></a>

                                    <a title="info" type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#info').modal('show')" class="btn btn-dark btn-sm"><i class="fa fa-info-circle"></i></a>

{{--                                    <a href="" type="button" title="info" class="btn btn-info btn-sm" data-toggle="tooltip" onclick="$('#info').modal('show')" ><i class="fa fa-info-circle"></i></a>--}}


                                </div>
                            </div>
                            <div class="media">

                                <div class="mr-3">

                                    {{--                                    <a href="#"><img src="Chrysanthemum.jpg" width="38" height="38" class="rounded-circle" alt=""></a>--}}
                                    <a data-toggle="modal" href="#avatar_modal" role="button"><img class="rounded-circle" width="38" height="38" src="{{asset(\Illuminate\Support\Facades\Auth::user()->Image)}}"></a>
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
                        <ul class="nav nav-sidebar" data-nav-type="accordion" style="height: 520px !important ;">
                            <!-- Main -->
                            <li class="nav-item">
                                <a href="{{route('Visitor.index')}}" class="nav-link @if( Request::is("*index*")) active @endif">
                                    <i class="fa fa-home"></i>
                                    <span>
										{{__('message.Profile')}}
                                </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route("Visitor.inbox")}}" class="nav-link @if( Request::is("*inbox*")) active @endif">
                                    <i class="fa fa-envelope"></i>
                                    <span>
										{{__('message.Inbox')}}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('Visitor.Meeting')}}" class="nav-link @if( Request::is("*Meeting*")) active @endif"><i class="fa fas fa-camera"></i> <span>{{__("message.Meeting")}}</span></a>
                            </li>

                            <li class="nav-item">
                                <a href="{{route('Visitor.VisitHistory')}}" class="nav-link @if( Request::is("*History*")) active @endif"><i class="fa fas fa-history"></i> <span>{{__('message.History')}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('Visitor.Payment')}}" class="nav-link @if( Request::is("*Payment*")) active @endif"><i class="fa fab fa-paypal"></i> <span>{{__('message.Payment')}}</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('Visitor.Contact')}}" class="nav-link @if( Request::is("*Contact*")) active @endif"><i class="fa fa-phone"></i> <span>{{__('message.ContactSupportTeam')}}</span></a>
                            </li>


                            <li class="nav-item text-center mt-md-5">
                                <a href="http://amitisgroup.net/HTML5/" class="" target="_blank"><span class="btn btn-success btn-lg">{{__('message.EnterExhabition')}}</span></a>
                            </li>


                            <li class="nav-item text-center mt-md-2">

                                <div class="btn-group">
                                    <a class="btn btn-dark" target="_blank" href="{{route("Auditorium")}}">
                                        Auditorium
                                    </a>
                                    <a  class="btn btn-info" target="_blank" href="{{route("Lounge")}}">
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

