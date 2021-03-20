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
    {{--    <header class="d-flex masthead" style="background-image: url({{\App\Site::AdminBackground()}});padding: 45px;padding-top: 0px;padding-right: 0px;padding-left: 0px;">--}}
    {{--        <div class="container my-auto text-center">--}}
    {{--            <h3 class="mb-5"></h3>--}}
    {{--            <div class="pull-right d-inline m-0">--}}


    {{--                @if(\App\Site::find(1)->Logo1)--}}
    {{--                    <img class="float-right" src="{{\App\Site::find(1)->Logo1}}"--}}
    {{--                         style="width: 113px;margin-right: 34px;">--}}
    {{--                @endif--}}
    {{--                @if(\App\Site::find(1)->Logo2)--}}
    {{--                    <img class="float-right" src="{{\App\Site::find(1)->Logo2}}"--}}
    {{--                         style="width: 113px;margin-right: 34px;">--}}
    {{--                @endif--}}
    {{--                @if(\App\Site::find(1)->Logo3)--}}
    {{--                    <img class="float-right" src="{{\App\Site::find(1)->Logo3}}"--}}
    {{--                         style="width: 113px;margin-right: 34px;">--}}
    {{--                @endif--}}

    {{--            </div>--}}

    {{--            <div style="width: 354px;height: 45px;background-color: #525252; margin-top: 70px" class="rounded">--}}

    {{--                <div class="pull-right p-1">--}}
    {{--                    <button type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#Lang_Modal').modal('show')" class="btn btn-warning">--}}
    {{--                        <i class="fa fa-globe"></i>--}}
    {{--                    </button>--}}
    {{--                    <div class="modal fade" role="dialog" tabindex="-1" id="Lang_Modal">--}}
    {{--                        <div class="modal-dialog" role="document">--}}
    {{--                            <div class="modal-content">--}}
    {{--                                <div class="modal-header">--}}

    {{--                                    <h4>{{__('message.ChangeLang')}}</h4>--}}
    {{--                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span--}}
    {{--                                            aria-hidden="true">×</span></button>--}}
    {{--                                </div>--}}
    {{--                                <div class="modal-body">--}}
    {{--                                    <div class="dropdown">--}}
    {{--                                        <a style="text-decoration: none !important" class="" href="{{ url('locale/en') }}"><i--}}
    {{--                                                class="fa fa-globe"></i>English</a><br>--}}
    {{--                                        <a style="text-decoration: none !important" class="" href="{{ url('locale/de') }}"><i--}}
    {{--                                                class="fa fa-globe"></i>German</a><br>--}}
    {{--                                        <a style="text-decoration: none !important" class="" href="{{ url('locale/al') }}"><i--}}
    {{--                                                class="fa fa-globe"></i>Shqip</a><br>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="modal-footer">--}}
    {{--                                    <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close--}}
    {{--                                    </button>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}

    {{--                </div>--}}

    {{--                <div class="pull-right p-1 logout_section">--}}
    {{--                    <button data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logout-form').submit()" class="btn btn-danger">--}}
    {{--                        <i class="fa fa-sign-out"></i>--}}
    {{--                    </button>--}}

    {{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
    {{--                        @csrf--}}
    {{--                    </form>--}}


    {{--                </div>--}}



    {{--                <div class="d-inline float-left"--}}
    {{--                     style="background-color: transparent;height: 26px;width: 122px;margin-left: 2px;">--}}
    {{--                    <h5 class="text-left"--}}
    {{--                        style="width: 115px;height: 41px;padding: 7px;color: rgb(255,255,255);margin-left: 4px;">--}}
    {{--                        {{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 10)}} </h5>--}}
    {{--                </div>--}}



    {{--            </div>--}}
    {{--            <div class="d-inline-block float-left" style="background-color: rgba(0,0,0,0);width: 1126px;height: 452px;margin-right: 46px;padding: 2px;padding-top: 0px;padding-right: 3px;">--}}
    {{--                <div class="border rounded d-block float-left border" style="width: 230px;height: 480px;background-color: rgba(54,54,54,0.77);padding: 7px;color: #363636;padding-top: 7px;">--}}
    {{--                    <div>--}}
    {{--                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>--}}
    {{--                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.index')}}" style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;"><a class="text-left" href="{{route('Admin.History')}}" style="color: #b3b8b8;">{{__('message.History')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Lounge')}}" style="color: #b3b8b8;">{{__('message.Lounge')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Statistics')}}" style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>--}}
    {{--                        <div class="text-left active-page" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="#" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Visitors')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.RegisteredExhibitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Exhibitors')}}<br></a></div>--}}
    {{--                                                <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.Auditorium')}}" style="color: #b3b8b8;">{{__('message.Auditorium')}} {{__('message.Schedule')}}<br></a></div>--}}

    {{--                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Create')}} {{__('message.Event')}}</h5>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Setting')}}" style="color: #b3b8b8;">{{__('message.Setting')}}</a></div>--}}

    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Signin')}}" style="color: #b3b8b8;">{{__('message.Signin')}} {{__('message.Page')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.VisitorSetting')}}" style="color: #b3b8b8;">{{__('message.Visitor')}} {{__('message.Page')}}</a></div>--}}
    {{--                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.ExhibitorSetting')}}" style="color: #b3b8b8;">{{__('message.Exhibitor')}} {{__('message.Page')}}</a></div>--}}
    {{--                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.AppAdjustment')}}" style="color: #b3b8b8;">{{__('message.App')}} {{__('message.Adjustment')}}<br></a></div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="border rounded d-block float-left border" style="width: 861px;height: 452px;background-color: rgba(168,168,168,0.84);padding: 7px;color: #363636;margin-left: 22px;">--}}
    {{--                    <div class="border rounded d-inline float-left scroll_box" style="width: 277px;height: 369px;margin-top: 4px;">--}}
    {{--                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" method="get" action="{{route('Admin.RegisteredVisitor')}}">--}}
    {{--                            <div class="form-group" style="width: 402px;">--}}
    {{--                                <input class="form-control float-left" type="search" placeholder="Registered Visitors List" style="width: 211px;height: 33px;margin-bottom: 24px;" name="SearchTerm">--}}
    {{--                                <button class="btn float-left shadow-none" type="submit" style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;">--}}
    {{--                                    <i class="fa fa-search" style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i>--}}
    {{--                                </button>--}}
    {{--                            </div>--}}
    {{--                        </form>--}}

    {{--                        @foreach($Users as $user)--}}
    {{--                            <a href="?UserID={{$user->id}}">--}}

    {{--                            <div--}}
    {{--                            @if(request()->UserID == $user->id)--}}
    {{--                            class="border rounded" style="background-color: #c2c5c5;height: 40px;width: 258px;margin-left: 4px;margin-top: 5px;"--}}
    {{--                                @else--}}
    {{--                                style="background-color: transparent;height: 40px;width: 258px;margin-left: 4px;margin-top: 5px;"--}}
    {{--                                @endif--}}
    {{--                            >--}}
    {{--                            <p class="text-left d-inline float-left" style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: #000000;">--}}
    {{--                                {{\Illuminate\Support\Str::limit($user->UserName , 12)}}--}}
    {{--                            </p>--}}
    {{--                            @if($user->AccountStatus == 'Suspend')--}}
    {{--                                <div class="text-right border rounded float-right" style="height: 29px;width: 89px;margin-top: 4px;margin-right: 14px;padding: 0px;background-color: #ed1c24;">--}}
    {{--                                    <p class="d-inline" style="margin-right: 6px;color: rgb(255,255,255);">{{__('message.Suspended')}}</p>--}}
    {{--                                </div>--}}
    {{--                                @endif--}}
    {{--                        </div>--}}
    {{--                            </a>--}}

    {{--                        @endforeach--}}
    {{--                        </div>--}}
    {{--                    @if(request()->UserID)--}}
    {{--                    <div class="border rounded float-left" style="width: 542px;height: 430px;margin-top: 5px;margin-left: 12px;background-color: #ffffff;">--}}

    {{--                        <div class="border rounded border-dark" style="height: 270px;width: 527px;margin-left: 7px;margin-top: 4px;padding: 14px;padding-top: 7px;padding-bottom: -1px;">--}}

    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.fn')}}:</strong>&nbsp;<span>{{$User->FirstName}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.ln')}}:&nbsp;</strong><span>{{$User->LastName}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Gender')}}:&nbsp;</strong><span>{{$User->Gender}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.BirthDate')}}:</strong>&nbsp;<span>{{$User->BirthDate}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Profession')}}:</strong>&nbsp;<span>{{$User->Profession}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.City')}}:</strong>&nbsp;<span>{{$User->City}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Country')}}:&nbsp;</strong><span>{{$User->Country}}</span></p>--}}
    {{--                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.email')}}:&nbsp;</strong><span>{{$User->email}}</span></p>--}}
    {{--                            <p class="text-left" style=" color: #7b7b7b;margin-bottom: 5px;"><strong>Feedback:&nbsp;</strong><span onclick="Swal.fire('{{$User->VisitExperience}}')" style="cursor:pointer;" class="fa fa-info"></span>--}}

    {{--                            </p>--}}


    {{--                        </div>--}}
    {{--                        <p class="text-left" style="color: #7b7b7b;margin-bottom: 26px;margin-left: 12px;margin-top: 14px;font-size: 24px;width: 544px;">{{__('message.Payment')}}:--}}
    {{--                            @if($User->Payment == 'Paid')--}}
    {{--                            <button class="border rounded" style="margin-left: 30px;background-color: #05c965;color: rgb(255,255,255);padding: 0px;padding-right: 33px;padding-left: 36px;" onclick="areyousure()">{{__('message.Paid')}}</button>--}}
    {{--                            @else--}}
    {{--                            <button class="border rounded" style="margin-left: 30px;background-color: #e91515;color: rgb(255,255,255);padding: 0px;padding-right: 33px;padding-left: 36px;" onclick="areyousure()">{{__('message.Unpaid')}}</button>--}}
    {{--                            @endif--}}
    {{--                        </p>--}}
    {{--                        <form class="float-left" style="margin-left: 16px;height: 63px;margin-bottom: -25px;" method="get" action="{{route('Admin.SuspendUser' , $User->id)}}">--}}
    {{--                            <div class="form-group text-left" style="margin-bottom: 3px;height: -9px;">--}}
    {{--                                <p class="float-left" style="font-size: 19px;color: rgb(221,20,20);">--}}
    {{--                                    <strong>{{__('message.Suspended')}} {{__('message.user')}}:</strong>--}}
    {{--                                    <input type="checkbox" style="width: 21px;height: 17px;margin-left: 6px;" name="AccountStatus" @if($User->AccountStatus == 'Suspend') checked @endif>--}}
    {{--                                </p>--}}
    {{--                            </div>--}}
    {{--                            <button class="btn btn-block float-right" type="submit" style="margin-bottom: 0px;margin-top: -9px;background-color: #05c965;color: rgb(255,255,255);">--}}
    {{--                                {{__('message.Save')}}--}}
    {{--                            </button>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                        <form id="mysinsin_form" action="{{route('Admin.UserPaid')}}" method="post">--}}
    {{--                            @csrf--}}
    {{--                            <input type="hidden" value="{{$User->id}}" name="UserID">--}}
    {{--                        </form>--}}
    {{--                        @endif--}}
    {{--                </div>--}}

    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </header>--}}




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
                        <div class="card" style="background-color:rgba(168,168,168,0.5);color: white">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-hover table-bordered table-light">
                                    <thead>
                                        <th>id</th>
                                        <th>name</th>
                                        <th>status</th>
                                        <th>action</th>
                                    </thead>

                                    <tbody>

                                    @foreach($forms as $key=>$form)

                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$form->name}}</td>
                                            <td>
                                                @if ($form->status==0)
                                                    <button class="btn btn-danger p-0">Deactive</button>
                                                @else
                                                    <button class="btn btn-success p-0">Active</button>
                                                @endif
                                            </td>

                                            <td>
                                                @if ($form->status==0)
                                                    <form action="{{route("Admin.FormActivate",$form->id)}}" method="post">
                                                        @csrf
                                                        <input type="submit" value="activate" class="btn btn-primary p-0">
                                                    </form>
                                                @else
                                                    <form action="{{route("Admin.FormActivate",$form->id)}}" method="post">
                                                        @csrf
                                                        <input type="submit" value="Deactivate" class="btn btn-dark p-0">
                                                    </form>
                                                @endif
                                            </td>

                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
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





@endsection
@section('js')
    <script>
        function areyousure() {
            Swal.fire({
                title: 'Note: Are You Sure to Change Payment Status??',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire('Saved!', '', 'success')
                    confirmed_sinsin = true
                    $("#mysinsin_form").removeAttr('onsubmit').submit()
                    return true
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                    confirmed_sinsin = false
                    return false
                }
            })
        };

    </script>
@endsection
