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



            </div>
            <div class="d-inline-block float-left"
                 style="background-color: rgba(0,0,0,0);width: 1126px;height: 452px;margin-right: 46px;padding: 2px;padding-top: 0px;padding-right: 3px;">
                <div class="border rounded d-block float-left border"
                     style="width: 230px;height: 480px;background-color: rgba(54,54,54,0.77);padding: 7px;color: #363636;padding-top: 7px;">
                    <div>
                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>
                        <div class="text-left"
                             style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;">
                            <a class="text-left" href="{{route('AdminOperator.index')}}" style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;">
                            <a class="text-left" href="{{route('AdminOperator.History')}}" style="color: #b3b8b8;">{{__('message.History')}}</a>
                        </div>
                        <div class="text-left active-page"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.Lounge')}}" style="color: #b3b8b8;">{{__('message.Lounge')}}</a>
                        </div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.Statistics')}}" style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.RegisteredVisitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Visitors')}}<br></a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;">
                            <a class="text-left" href="{{route('AdminOperator.RegisteredExhibitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Exhibitors')}}<br></a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('AdminOperator.Setting')}}" style="color: #b3b8b8;">{{__('message.Setting')}}</a></div>

                    </div>
                </div>
                <div class="border rounded d-block float-left border"
                     style="width: 861px;height: 452px;background-color: rgba(168,168,168,0.84);padding: 7px;color: #363636;margin-left: 22px;">
                    <div class="border rounded"
                         style="color: #c2c5c5;height: 40px;background-color: #363636;width: 222px;padding: 7px;">
                        <p style="color: #c2c5c5;">Manage Groups</p>
                    </div>
                    <div class="border rounded d-inline float-left scroll_box"
                         style="width: 220px;height: 233px;margin-top: 4px;">
                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" action="#search_company">
                            <div class="form-group" style="width: 402px;" onblur="is_typing = false" onfocus="is_typing = true">
                                <input class="form-control float-left"
                                                                                 type="search" placeholder="Search..."
                                                                                 style="width: 163px;height: 33px;margin-bottom: 24px;"
                                                                                 name="search">
                                <button onblur="is_typing = false" onfocus="is_typing = true" class="btn float-left shadow-none" type="submit" style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;"><i
                                        class="fa fa-search"
                                        style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i></button>
                            </div>
                        </form>


                        @foreach($Lounges as $loung)
                            <div
                                @if(request()->LoungID == $loung->id)
                                class="border rounded"
                                style="background-color: #c2c5c5;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"
                                    @else
                                style="background-color: transparent;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"
                                    @endif
                                >
                                <a href="?LoungID={{$loung->id}}">
                                    <p class="text-left d-inline float-left"
                                       style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: rgb(255,255,255);">{{$loung->Name}}</p>

                                </a>
                            </div>
                        @endforeach
                    </div>


                    @if(request()->LoungID)
                        <div class="border rounded float-left"
                             style="width: 607px;height: 389px;margin-top: 4px;margin-left: 12px;background-color: #c2c5c5;">
                            <p class="text-left" style="margin-left: 11px;">{{$Lounge->Name}}</p>
                            <div class="border rounded float-left scroll_box"
                                 style="background-color: #6f6d6d;height: 337px;margin-bottom: 9px;">
                                @foreach(json_decode($Lounge->Members) as $Member)
                                <div
                                    style="background-color: transparent;height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;">
                                    <p class="text-left d-inline float-left" style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: rgb(255,255,255);">
                                        {{\App\User::find($Member)->UserName}}
                                    </p>
                                    @if(\App\User::find($Member)->Rule =='Visitor' || \App\User::find($Member)->Rule == 'Exhibitor' || \App\User::find($Member)->Rule == 'ExhibitorOperator')
                                    <a href="?RemoveUser={{$Member}}&LoungeID={{$Lounge->id}}">
                                        <i class="fa fa-minus-circle float-right" style="color: rgb(209,28,28);width: 40px;height: 38px;font-size: 34px;"></i>
                                    </a>
                                        @endif

                                </div>
                                    @endforeach
                            </div>
                            <div class="border rounded-0 float-left"
                                 style="width: 350px;margin-right: 1px;margin-left: 6px;margin-bottom: 8px;height: 318px;">
                                <div class="scroll_box" style="height: 264px;margin-bottom: 11px;" id="ChatsDiv">

                                    @foreach($Chats as $chat)
                                    <div class="border rounded border-primary @if($chat->UserID == \Illuminate\Support\Facades\Auth::id())  float-right @else float-left  @endif  nonoverflow scroll_box"
                                         style="height: 52px;width: 190px;margin-bottom: 17px;padding: 5px;background-color: @if($chat->UserID == \Illuminate\Support\Facades\Auth::id()) #0c82fe  @else #36ca5c @endif  ;color: rgb(255,255,255);">
                                        <p class="nonoverflow">{{$chat->Text}}</p>
                                        <small>Sender: {{\App\User::find($chat->UserID)->UserName}}</small>
                                    </div>
                                    @endforeach

                                </div>
                                <form class="form-inline d-inline" method="post" action="{{route('AdminOperator.SendMessagetoLounge' , $Lounge->id)}}">
                                    @csrf
                                    <input
                                        class="border rounded border-dark form-control d-inline" type="text"
                                        style="margin-right: 17px;width: 208px;" onblur="is_typing = false" onfocus="is_typing = true" name="Text" value="{{old('Text')}}">
                                    <button class="btn btn-success d-inline" type="submit"
                                            style="height: 36px;width: 103px;">Send
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
@endsection
@section('js')
    <script>
        let is_typing = false;

        setInterval(function(){

            if(is_typing == false)
                location.reload()

        }, 5000);

    </script>
    <script>
        var objDiv = document.getElementById("ChatsDiv");
        objDiv.scrollTop = objDiv.scrollHeight;
    </script>
@endsection
