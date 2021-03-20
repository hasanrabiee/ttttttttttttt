@extends('layouts.Panel')
@section("Head")


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
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
    {{--                                                                        <h4>{{__('message.ChangeLang')}}</h4>--}}

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
    {{--                    <h6 class="text-left"--}}
    {{--                        style="width: 115px;height: 41px;padding: 7px;color: rgb(255,255,255);margin-left: 4px;">--}}
    {{--                        {{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 18)}} </h6>--}}
    {{--                </div>--}}



    {{--            </div>--}}


    {{--            <div class="d-inline-block float-left" style="background-color: rgba(0,0,0,0);width: 1126px;height: 452px;margin-right: 46px;padding: 2px;padding-top: 0px;padding-right: 3px;">--}}
    {{--                <div class="border rounded d-block float-left border" style="width: 230px;height: 480px;background-color: rgba(54,54,54,0.77);padding: 7px;color: #363636;padding-top: 7px;">--}}
    {{--                    <div>--}}
    {{--                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>--}}
    {{--                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.index')}}" style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;"><a class="text-left" href="{{route('Admin.History')}}" style="color: #b3b8b8;">{{__('message.History')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;"><a class="text-left" href="{{route('Admin.Lounge')}}" style="color: #b3b8b8;">{{__('message.Lounge')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Statistics')}}" style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.RegisteredVisitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Visitors')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.RegisteredExhibitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Exhibitors')}}<br></a></div>--}}
    {{--                        <div class="text-left active-page" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="#" style="color: #b3b8b8;">{{__('message.Auditorium')}} {{__('message.Schedule')}}<br></a></div>--}}
    {{--                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Create')}} {{__('message.Event')}}</h5>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Setting')}}" style="color: #b3b8b8;">{{__('message.Setting')}}</a></div>--}}

    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('Admin.Signin')}}" style="color: #b3b8b8;">{{__('message.Signin')}} {{__('message.Page')}}</a></div>--}}
    {{--                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.VisitorSetting')}}" style="color: #b3b8b8;">{{__('message.Visitor')}} {{__('message.Page')}}</a></div>--}}
    {{--                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.ExhibitorSetting')}}" style="color: #b3b8b8;">{{__('message.Exhibitor')}} {{__('message.Page')}}</a></div>--}}
    {{--                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('Admin.AppAdjustment')}}" style="color: #b3b8b8;">{{__('message.App')}} {{__('message.Adjustment')}}<br></a></div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="border rounded d-block float-left border scroll_box" style="width: 861px;height: 452px;background-color: #a8a8a8d7;padding: 7px;color: #363636;margin-left: 22px;">--}}
    {{--                    <div class="border rounded d-inline float-left scroll_box" style="width: 117px;height: 426px;margin-top: 4px;">--}}
    {{--                        @foreach($Days as $day)--}}
    {{--                            <a href="?Day={{$day}}">--}}
    {{--                            <div--}}
    {{--                                @if(request()->Day == $day)--}}

    {{--                                class="border rounded" style="background-color: #c2c5c5;height: 33px;width: 101px;margin: 0px;margin-left: 4px;margin-top: 5px;padding: 3px;margin-right: 9px;"--}}
    {{--                                    @else--}}
    {{--                                     style="height: 33px;width: 101px;margin: 0px;margin-left: 4px;margin-top: 5px;padding: 3px;margin-right: 9px;"--}}
    {{--                                    @endif--}}
    {{--                                >--}}
    {{--                                <p class="text-left d-inline float-left" style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: #000000;font-size: 12px;">{{$day}}</p>--}}
    {{--                            </div>--}}
    {{--                            </a>--}}
    {{--                        @endforeach--}}



    {{--                        <a class="btn btn-success" role="button" style="height: 34px;width: 105px;margin-top: -14px;font-size: 13px;padding: 0px;padding-top: 5px;" href="{{route('Admin.AuditoriumExport')}}">{{__('message.ViewFinalTable')}}</a></div>--}}

    {{--                    @if(isset($Day))--}}
    {{--                        <div class="border rounded float-left scroll_box" style="width: 714px;height: 423px;margin-top: 5px;margin-left: 12px;background-color: #ffffff;">--}}
    {{--                            <div class="border rounded border-dark float-left scroll_box" style="height: 395px;width: 356px;margin-left: 7px;margin-top: 9px;padding: 14px;padding-top: 7px;padding-bottom: -1px;">--}}
    {{--                                <div></div>--}}
    {{--                                <h5>{{__('message.RequestedSpeakersforthisday')}}</h5>--}}
    {{--                                <div class="table-responsive">--}}
    {{--                                    <table class="table">--}}
    {{--                                        <thead>--}}
    {{--                                        <tr>--}}
    {{--                                            <th>{{__('message.Speaker')}} {{__('message.Name')}}</th>--}}
    {{--                                            <th>{{__('message.Company')}}</th>--}}
    {{--                                        </tr>--}}
    {{--                                        </thead>--}}
    {{--                                        <tbody style="width: 457px;">--}}
    {{--                                        @foreach($Speakers2 as $speaker)--}}
    {{--                                        <tr>--}}
    {{--                                            <td>{{$speaker->UserName}}</td>--}}
    {{--                                            <td>--}}
    {{--                                                @if($speaker->BoothID != null)--}}
    {{--                                                    {{\App\booth::find($speaker->BoothID)->CompanyName}}--}}
    {{--                                                @else--}}
    {{--                                                {{__('message.No')}} {{__('message.Company')}}--}}
    {{--                                                @endif--}}
    {{--                                            </td>--}}
    {{--                                        </tr>--}}
    {{--                                        @endforeach--}}
    {{--                                        </tbody>--}}
    {{--                                    </table>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            <div class="border rounded border-dark float-left scroll_box" style="height: 395px;width: 327px;margin-left: 7px;margin-top: 9px;padding: 14px;padding-top: 7px;padding-bottom: -1px;">--}}
    {{--                                <h5 class="d-inline">{{__('message.ScheduleSheet')}} <i onclick="window.open('{{route('Auditorium')}}','_blank')" style="cursor:pointer;" class="btn btn-success fa fa-eye"></i><br></h5><label style="width: 165px;">{{__('message.scheduledSpeakers')}}:</label><span>{{\App\Auditorium::count()}}</span><label style="width: 165px;">{{__('message.RequestedSpeakers')}}:</label><span>{{\App\Speaker::count()}}</span>--}}
    {{--                                <a style="display: block" class="btn btn-primary btn-block btn-sm d-inline float-left over" role="button" data-toggle="modal" href="#speaker_name" style="margin-bottom: 8px;width: 118px;height: 50px;">{{__('message.AddCompanySpeaker')}}</a>--}}
    {{--                                <a style="display: block" class="btn btn-primary btn-block btn-sm d-inline float-left over" role="button" data-toggle="modal" href="#SpeakerModal" style="margin-bottom: 8px;width: 118px;height: 50px;">{{__('message.AddIndividualSpeaker')}}</a>--}}
    {{--                                <a href="{{route('Admin.AuditoriumPublish')}}" style="display: block" class="btn btn-primary btn-block btn-sm d-inline float-left over" role="button"   style="margin-bottom: 8px;width: 118px;height: 50px;">{{__('message.PublishSheet')}}</a>--}}


    {{--                                <div style="width: 109px;margin-bottom: 9px;margin-top: 3px;">--}}
    {{--                                  <div class="modal fade" role="dialog" tabindex="-1" id="speaker_name">--}}
    {{--                                        <div class="modal-dialog" role="document">--}}
    {{--                                            <div class="modal-content">--}}
    {{--                                                <div class="modal-header">--}}
    {{--                                                    <h4>{{__('message.SelectSpeaker')}}</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>--}}
    {{--                                                <div class="modal-body scroll_box" style="padding: 16px;">--}}
    {{--                                                    <form  action="{{route('Admin.AuditoriumPost')}}" method="post">--}}
    {{--                                                        <input type="hidden" value="{{request()->Day}}" name="Day">--}}
    {{--                                                        @csrf--}}
    {{--                                                        <p><strong>{{__('message.AdjustTimeforSpeech')}}</strong></p>--}}
    {{--                                                        <label>{{__('message.Begin')}} * :&nbsp;</label>--}}
    {{--                                                        <input class="form-control" type="time" required="" name="Start" value="{{old('Start')}}">--}}
    {{--                                                        <label style="margin-left: -1px;">{{__('message.End')}} * :&nbsp;</label>--}}
    {{--                                                        <input class="form-control" type="time" required="" name="End" value="{{old('End')}}">--}}
    {{--                                                        <p style="margin-top: 18px;"><strong>{{__('message.SelectSpeaker')}} * :</strong></p>--}}
    {{--                                                        <select class="custom-select" style="width: 373px;" name="SpeakerID">--}}
    {{--                                                            @if(old('SpeakerID'))--}}
    {{--                                                                <option selected value="{{old('SpeakerID')}}">{{old('SpeakerID')}}</option>--}}
    {{--                                                            @else--}}
    {{--                                                                <option disabled selected>{{__('message.SelectSpeaker')}}</option>--}}
    {{--                                                            @endif--}}
    {{--                                                            @foreach($Speakers as $speaker)--}}
    {{--                                                                @if($speaker->Status == 'None')--}}
    {{--                                                                <option value="{{$speaker->id}}">{{$speaker->UserName}}</option>--}}
    {{--                                                                @endif--}}
    {{--                                                            @endforeach--}}
    {{--                                                        </select>--}}
    {{--                                                        <button class="btn btn-success" type="submit">{{__('message.Save')}}</button>--}}
    {{--                                                    </form>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">{{__('message.Close')}}</button></div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}



    {{--                                  <div class="modal fade" role="dialog" tabindex="-1" id="SpeakerModal">--}}
    {{--                                        <div class="modal-dialog" role="document">--}}
    {{--                                            <div class="modal-content">--}}
    {{--                                                <div class="modal-header">--}}
    {{--                                                    <h4> {{__('message.CreateSpeaker')}}</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>--}}
    {{--                                                <div class="modal-body scroll_box" style="padding: 16px;">--}}
    {{--                                                    <form  action="{{route('Admin.SpeakerPost')}}" method="post">--}}
    {{--                                                        <input type="hidden" value="{{request()->Day}}" name="Day">--}}

    {{--                                                        @csrf--}}
    {{--                                                        <div class="col" style="margin-left: 50px">--}}
    {{--                                                        <p><strong>{{__('message.AddSpeakertoSpeakerListManually')}}</strong></p>--}}
    {{--                                                        <label>Name * :&nbsp;</label>--}}
    {{--                                                        <input class="form-control" type="text" required="" name="Name" value="{{old('Name')}}">--}}


    {{--                                                        <label style="margin-left: -1px;">{{__('message.email')}} * :&nbsp;</label>--}}
    {{--                                                            <input class="form-control" type="email" required="" name="email" value="{{old('email')}}">--}}


    {{--                                                            <label style="margin-left: -1px;">{{__('message.UserName')}} * :&nbsp;</label>--}}
    {{--                                                        <input class="form-control" type="text" required="" name="UserName" value="{{old('UserName')}}">--}}


    {{--                                                        <label style="margin-left: -1px;">{{__('message.password')}} * :&nbsp;</label>--}}
    {{--                                                        <input class="form-control" type="password" required="" name="password" value="{{old('password')}}">--}}


    {{--                                                            <label style="margin-left: -1px;">{{__('message.passwordConfrimation')}} * : </label>--}}
    {{--                                                        <input class="form-control" type="password" required="" name="password_confirmation" value="{{old('password_confirmation')}}">--}}


    {{--                                                        <label style="margin-left: -1px;">{{__('message.SpeechTitle')}} * : &nbsp;</label>--}}
    {{--                                                        <input class="form-control" type="text" required="" name="SpeechTitle" value="{{old('SpeechTitle')}}">--}}



    {{--                                                        <button class="form-control btn btn-success" type="submit">{{__('message.Save')}}</button>--}}
    {{--                                                        </div>--}}
    {{--                                                    </form>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">{{__('message.Close')}}</button></div>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="table-responsive">--}}
    {{--                                    <table class="table">--}}
    {{--                                        <thead>--}}
    {{--                                        <tr>--}}
    {{--                                            <th style="width: 199px;">{{__('message.Speaker')}} {{__('message.Name')}}</th>--}}
    {{--                                            <th>{{__('message.Time')}}</th>--}}
    {{--                                            <th>{{__('message.Action')}}</th>--}}
    {{--                                        </tr>--}}
    {{--                                        </thead>--}}
    {{--                                        <tbody style="width: 457px;">--}}
    {{--                                        @foreach($RegisteredSpeakers as $speaker)--}}
    {{--                                        <tr>--}}
    {{--                                            <td style="font-size: 14px;">{{$speaker->Speaker->UserName}}</td>--}}
    {{--                                            <td style="font-size: 12px;padding-left: 0px;padding-right: 0px;">{{\Carbon\Carbon::parse($speaker->Start)->format('H:i')}} - {{\Carbon\Carbon::parse($speaker->End)->format('H:i')}}</td>--}}
    {{--                                            <td><a href="{{route('Admin.RemoveSpeaker', $speaker->Speaker->id)}}" class="btn btn-danger">Delete</a></td>--}}
    {{--                                        </tr>--}}
    {{--                                        @endforeach--}}

    {{--                                        </tbody>--}}
    {{--                                    </table>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    @else--}}
    {{--                        <div class="border rounded float-left" style="width: 714px;height: 423px;margin-top: 5px;margin-left: 12px;">--}}
    {{--                            <h3 style="margin-top: 200px;margin-left: 250px">{{__('message.SelectDayFirst')}}</h3>--}}

    {{--                        </div>--}}
    {{--                    @endif--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </header>--}}




    {{--    Hasan start here !!!!--}}






    {{--    Hasan start Here !!!!--}}




    <body style="background: url('{{\App\Site::ExhibitorBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    <div>


    @include("Sidebars.exhibitor-sidebar")







    <!-- Main content -->



        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card pc-height-visitor-meeting" style="background-color:rgba(54,54,54,0.65);color: white;">
                            <div class="card-body">
                                <div class="row">




                                    {{--                                    Auditorium Date Link--}}


                                    <div class="col-md-2">
                                        <h3 class="text-dark">Dates</h3>
                                        <a href="" class="btn btn-primary text-white w-100 mb-2">12.23.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.24.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.25.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.26.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.27.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.28.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.29.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.30.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.31.2020</a>
                                        <a href="" class="btn btn-outline-dark text-white w-100 mb-2">12.23.2020</a>
                                    </div>

                                    {{--                                    /Auditorium Date Link--}}


                                    <div class="col-md-10 bg-white text-dark" style="border-radius: 5px;">
                                        <div class="container mt-4">
                                            <h3 class="mb-md-2">Add Conference Video Link </h3>

                                            <div class="form-group">
                                                <label for="">
                                                    Conference Title
                                                </label>
                                                <input type="text" class="form-control" placeholder="Add Recorded Youtube Link">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Conference Title
                                                </label>
                                                <input type="text" class="form-control" placeholder="Add Recorded Youtube Link">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Conference Title
                                                </label>
                                                <input type="text" class="form-control" placeholder="Add Recorded Youtube Link">
                                            </div>
                                            <input type="submit" value="Submit Your Request" class="btn btn-success w-100">
                                        </div>
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



        <!--/Main Content  -->
    </div>


    </div>
    </body>









@endsection
