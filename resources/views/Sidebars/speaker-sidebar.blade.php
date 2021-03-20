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
                <form action="{{route('Auditorium.UpdateAvatar')}}" method="post"
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
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h5 class="modal-title">Exhibitor Panel Tutorial</h5>
            </div>
            <div class="modal-body text-center">
                <div class="text-left mb-2">
                    <a href="{{\App\Site::first()->exPanelPDF}}" class="btn text-left btn-primary">PDF Guide</a>
                </div>
                <iframe width="420" height="315"
                        src="{{\App\Site::first()->exPanelVideo}}">
                </iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <a title="logout" class="btn btn-dark btn-sm " href="{{ route('logout') }}" style="font-size:12px;color: #c5c5c5;" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i></a>

                                <a title="language" type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#Lang_Modal').modal('show')" class="btn btn-warning btn-sm text-dark"><i class="fa fa-globe" style="font-size: 15px;"></i></a>

                                <a href="" title="info" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-info-circle"></i></a>


                            </div>
                        </div>


                        <div class="media">

                            <div class="mr-3">
                                <a href="#avatar_modal" data-toggle="modal" role="button"><img class="rounded-circle" width="38" height="38" src="{{\App\Speaker::find(\Illuminate\Support\Facades\Session::get('Speaker')->id)->avatar}}"></a>
                            </div>

                            <div class="media-body">
                                <div class="media-title font-weight-semibold mt-md-2">{{\App\Speaker::find(\Illuminate\Support\Facades\Session::get('Speaker')->id)->UserName}}     </div>

                                {{--                                    <span class="btn btn-danger btn-sm">Logout</span>--}}

                            </div>

                        </div>





                    </div>
                </div>
                <!-- /user menu -->

                <!-- Main navigation -->
                <div class="card-body p-0">
                    <ul class="nav nav-sidebar" data-nav-type="accordion" style="height: 575px !important ;">
                        <!-- Main -->
                        <li class="nav-item">
                            <a href="{{route('Exhibitor.index')}}" class="nav-link active">
                                        <span>
										{{__('message.Profile')}}
                                </span>
                            </a>
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
