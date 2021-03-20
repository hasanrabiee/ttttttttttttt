@extends('layouts.Panel')
@section('content')
    <header class="d-flex masthead"
            style="background-image: url({{\App\Site::AdminBackground()}});padding: 45px;padding-top: 0px;padding-right: 0px;padding-left: 0px;">
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


                <div class="pull-right p-1 logout_section">
                    <button data-toggle="tooltip" data-placement="top" title="View Auditorium" onclick="window.open('{{route('Auditorium')}}', '_blank').submit()" class="btn btn-success">
                        <i class="fa fa-eye"></i>
                    </button>


                </div>


                <div class="d-inline float-left"
                     style="background-color: transparent;height: 26px;width: 122px;margin-left: 2px;">
                    <h6 class="text-left"
                        style="width: 115px;height: 41px;padding: 7px;color: rgb(255,255,255);margin-left: 4px;">
                        {{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 18)}} </h6>
                </div>



            </div>            <div class="d-inline-block float-left"
                 style="background-color: rgba(0,0,0,0);width: 1126px;height: 452px;margin-right: 46px;padding: 2px;padding-top: 0px;padding-right: 3px;">
                <div class="border rounded d-block float-left border"
                     style="width: 230px;height: 480px;background-color: rgba(54,54,54,0.77);padding: 7px;color: #363636;padding-top: 7px;">
                    <div>
                        <h5 class="text-left"
                            style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>
                        <div class="text-left"
                             style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;">
                            <a class="text-left" href="{{route('AdminOperator.index')}}"
                               style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>
                        <div class="text-left active-page"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;">
                            <a class="text-left" href="#" style="color: #b3b8b8;">{{__('message.History')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.Lounge')}}"
                               style="color: #b3b8b8;">{{__('message.Lounge')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.Statistics')}}"
                               style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.RegisteredVisitor')}}"
                               style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Visitors')}}<br></a>
                        </div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;">
                            <a class="text-left" href="{{route('AdminOperator.RegisteredExhibitor')}}"
                               style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Exhibitors')}}<br></a>
                        </div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.Setting')}}"
                               style="color: #b3b8b8;">{{__('message.Setting')}}</a></div>

                    </div>
                </div>
                <div class="border rounded d-block float-left border"
                     style="width: 868px;height: 452px;background-color: rgba(168,168,168,0.84);padding: 7px;color: #363636;margin-left: 22px;">
                    <div class="border rounded d-inline float-left scroll_box"
                         style="width: 224px;height: 420px;margin-top: 4px;">
                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" method="get"
                              action="{{route('AdminOperator.History')}}">
                            <div class="form-group" style="width: 305px;">
                                <input class="form-control float-left" type="search" placeholder="Companies"
                                       style="width: 163px;height: 33px;margin-bottom: 24px;font-size: 14px;"
                                       name="SearchTermBooth">
                                <button class="btn float-left shadow-none" type="submit"
                                        style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;">
                                    <i class="fa fa-search"
                                       style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i>
                                </button>
                            </div>
                        </form>
                        @foreach($Booths as $booth)
                            <div @if(request()->CompanyID == $booth->id)
                                 class="border rounded"
                                 style="background-color: #c2c5c5;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"
                                 @else
                                 style="background-color: transparent;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"
                                @endif
                            >
                                <a href="?CompanyID={{$booth->id}}">
                                    <p class="text-left d-inline float-left"
                                       style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: rgb(255,255,255);">
                                        {{$booth->CompanyName}}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="border rounded d-inline float-left scroll_box"
                         style="width: 224px;height: 420px;margin-top: 4px;margin-right: 19px;margin-left: 13px;">
                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" action="{{route('AdminOperator.History')}}">
                            <div class="form-group" style="width: 305px;"><input class="form-control float-left"
                                                                                 type="search"
                                                                                 placeholder="Visitory Name"
                                                                                 style="width: 163px;height: 33px;margin-bottom: 24px;font-size: 13px;"
                                                                                 name="SearchTermUser">
                                <button class="btn float-left shadow-none" type="submit"
                                        style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;"><i
                                        class="fa fa-search"
                                        style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i></button>
                            </div>
                        </form>
                        @foreach($Users as $user)
                            <div
                                @if(request()->UserID == $user->id)
                                class="border rounded"
                                style="background-color: #c2c5c5;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"
                                @else
                                style="background-color: transparent;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"
                                @endif
                            >
                                <a href="?UserID={{$user->id}}">
                                    <p class="text-left d-inline float-left"
                                       style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: rgb(255,255,255);">
                                        {{$user->UserName}}
                                    </p>
                                </a>
                            </div>
                        @endforeach
                    </div>



                        @if(request()->CompanyID || request()->UserID)
                            <p class="text-left">
                                <strong>{{__('message.Messages')}}:
                                    @if(request()->CompanyID)
                                        {{\App\booth::find(request()->CompanyID)->CompanyName}}
                                    @elseif(request()->UserID)
                                        {{\App\User::find(request()->UserID)->UserName}}
                                    @endif
                                </strong>
                            </p>
                        <div class="scroll_box"
                             style="height: 356px;padding: 0px;width: 353px;background-color: #ffffff;margin-top: -5px;">
                            @if($Chats->count() == 0)
                                {{__('message.NoMessageAvailable')}}
                            @else
                                @foreach($Chats as $chat)
                                    <p class="@if($chat->Sender == 'Admin' ||$chat->Sender == 'Admin-Operator') text-right @else text-left @endif border rounded"
                                       style="padding: 9px;background-color: @if($chat->Sender == 'Admin')  #36ca5c @else #0c82fe @endif ;color: rgb(255,255,255);">
                                        {{$chat->Text}}
                                    </p>
                                @endforeach
                            @endif
                        @else
                            {{__('message.PleaseSelectaChatFirst')}}
                        @endif


                    </div>
                </div>

            </div>
        </div>
    </header>
@endsection
