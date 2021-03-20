@extends('layouts.Panel')
@section('content')
    <header class="d-flex masthead" style="background-image: url({{\App\Site::AdminBackground()}});padding: 45px;padding-top: 0px;padding-right: 0px;padding-left: 0px;">
        <div class="container my-auto text-center">
            <h3 class="mb-5"></h3>
            <div class="pull-right d-inline m-0">


                @if(\App\Site::find(1)->Logo1)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo1}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo2)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo2}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo3)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo3}}"
                         style="width: 113px;margin-right: 34px;">
                @endif

            </div>

            <div style="width: 354px;height: 45px;background-color: #525252; margin-top: 70px" class="rounded">

                <div class="pull-right p-1">
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#Lang_Modal').modal('show')" class="btn btn-warning">
                        <i class="fa fa-globe"></i>
                    </button>
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

                </div>

                <div class="pull-right p-1 logout_section">
                    <button data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logout-form').submit()" class="btn btn-danger">
                        <i class="fa fa-sign-out"></i>
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>





                <div class="d-inline float-left"
                     style="background-color: transparent;height: 26px;width: 122px;margin-left: 2px;">
                    <h6 class="text-left"
                        style="width: 115px;height: 41px;padding: 7px;color: rgb(255,255,255);margin-left: 4px;">
                        {{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 18)}} </h6>
                </div>



            </div>
            <div class="d-inline-block float-left" style="background-color: rgba(0,0,0,0);width: 1126px;height: 452px;margin-right: 46px;padding: 2px;padding-top: 0px;padding-right: 3px;">
                <div class="border rounded d-block float-left border" style="width: 230px;height: 480px;background-color: rgba(54,54,54,0.77);padding: 7px;color: #363636;padding-top: 7px;">
                    <div>
                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>
                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.index')}}" style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;"><a class="text-left" href="{{route('Admin.History')}}" style="color: #b3b8b8;">{{__('message.History')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Lounge')}}" style="color: #b3b8b8;">{{__('message.Lounge')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Statistics')}}" style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.RegisteredVisitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Visitors')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.RegisteredExhibitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Exhibitors')}}<br></a></div>
                                                <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.Auditorium')}}" style="color: #b3b8b8;">{{__('message.Auditorium')}} {{__('message.Schedule')}}<br></a></div>

                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Create')}} {{__('message.Event')}}</h5>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Setting')}}" style="color: #b3b8b8;">{{__('message.Setting')}}</a></div>
                        <div class="text-left border rounded active-page" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="#" style="color: #545454;">Gallery</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Signin')}}" style="color: #b3b8b8;">{{__('message.Signin')}} {{__('message.Page')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.VisitorSetting')}}" style="color: #b3b8b8;">{{__('message.Visitor')}} {{__('message.Page')}}</a></div>
                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.ExhibitorSetting')}}" style="color: #b3b8b8;">{{__('message.Exhibitor')}} {{__('message.Page')}}</a></div>
                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.AppAdjustment')}}" style="color: #b3b8b8;">{{__('message.App')}} {{__('message.Adjustment')}}<br></a></div>
                    </div>
                </div>
                <div class="border rounded d-block float-left border" style="width: 843px;height: 452px;background-color: rgba(168,168,168,0.84);padding: 7px;color: #363636;margin-left: 22px;">
                    <h5 class="text-left" style="padding: -4px;padding-left: 42px;color: #ffffff;height: 45px;">Gallery (Uploaded Pictures):</h5>
                    <div class="scroll_box" style="background-color: transparent;height: 346px;width: 788px;margin-bottom: 0px;margin-left: 47px;padding: 10px;padding-top: 4px;margin-top: -3px;">
                    @foreach($Files as $file)
                        <div><img class="border rounded float-left" src="{{'/Uploads/'.$file->getRelativePathname()}}" style="width: 156px;margin-right: 25px;margin-bottom: 0px;margin-top: 4px;"></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection
