@extends('layouts.Panel')

@section("Head")


    <meta name="_token" content="{{csrf_token()}}"/>



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




    <style>
        .hide{
            display: none !important;
        }

        input[type=checkbox] {
            display:none;
        }

        input#thing1[type=checkbox] + label
        {
            background-image: url("BoothA.png");
            background-size: 150px 70px;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            border-color: transparent;
            border-radius: 5px;
            border-style: solid;
            height: 74px;
            width: 175px;
            display:inline-block;
            padding:10px;
            cursor: pointer;
        }
        input#thing2[type=checkbox] + label
        {
            background-image: url("BoothB.png");
            background-size: 150px 70px;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            border-color: transparent;
            border-radius: 5px;
            border-style: solid;
            height: 74px;
            width: 175px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }
        input#thing3[type=checkbox] + label
        {
            background-image: url("BoothC.png");
            background-size: 150px 70px;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            border-color: transparent;
            border-radius: 5px;
            border-style: solid;
            height: 74px;
            width: 175px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }
        input#thing4[type=checkbox] + label
        {
            background-image: url("BoothD.png");
            background-size: 150px 70px;
            background-position: 50% 50%;
            background-repeat: no-repeat;
            border-radius: 5px;
            border-color: transparent;
            border-style: solid;
            height: 74px;
            width: 175px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }
        input#thing1[type=checkbox]:checked + label
        {
            background-size: 250px 106px;
            background-position: 50% 50%;
            border-color: green;
            border-style: solid;
            border-radius: 5px;
            height: 111px;
            width: 262.5px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }
        input#thing2[type=checkbox]:checked + label
        {
            background-size: 250px 106px;
            background-position: 50% 50%;
            border-color: green;
            border-style: solid;
            border-radius: 5px;
            height: 111px;
            width: 262.5px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }
        input#thing3[type=checkbox]:checked + label
        {
            background-size: 250px 106px;
            background-position: 50% 50%;
            border-color: green;
            border-style: solid;
            border-radius: 5px;
            height: 111px;
            width: 262.5px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }
        input#thing4[type=checkbox]:checked + label
        {
            background-size: 250px 106px;
            background-position: 50% 50%;
            border-color: green;
            border-style: solid;
            border-radius: 5px;
            height: 111px;
            width: 262.5px;
            display:inline-block;
            padding: 0 0 0 0px;
            cursor: pointer;
        }


        .selectbooth {
            background-color: #06E4E8 !important;
        }
        .closebooth {
            background-color: #F900C9 !important;
        }
        .openbooth {
            background-color: #939393;
            cursor: pointer;;
        }
        .Submited {
            background-color: #1c7430 important;
        }
        .activetypes {
            background-color: #dfdfdf !important;
        }

        @media only screen and (min-width: 1200px) {
            .margin{
                margin-top: 10px !important;
            }
        }

    </style>




@endsection



@section('content')

{{--    test aaagggggaaaaaain--}}








































        <style>
            .selectbooth {
                background-color: #06E4E8 !important;
            }
            .closebooth {
                background-color: #F900C9 !important;
            }
            .openbooth {
                background-color: #939393;
                cursor: pointer;;
            }
            .Submited {
                background-color: #1c7430 important;
            }
            .activetypes {
                background-color: #dfdfdf !important;
            }
        </style>

        <div class="container my-auto text-center" style="margin-top: -30px !important;">

            <div>


                <div class="modal fade" role="dialog" tabindex="-1" id="BoothImagesModalNmidonmChiCHi">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4>Booth Type Image</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                            <div class="modal-body">
                                <img id="BoothIamgeHosein" style="max-height: 500px">
                             </div>
                            <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close</button></div>
                        </div>
                    </div>
                </div>


                <div>

                    <div>
                        <form onsubmit="event.preventDefault(); areyousure();" id="mysinsin_form"
                            style="margin-top: 17px;" method="post" enctype="multipart/form-data"
                            action="{{route('Exhibitor-Register-ThreePost')}}">
                            @method('PUT')
                            @csrf


                            <input type="hidden" id="boothid_value" name="Position"
                                   @if(isset($Booth->Position)) value="{{\App\booth::PositionConvertor($Booth->Position)}}" @endif>
                            <input type="hidden" id="hall_value" name="Hall"
                                   @if(isset($Booth->Position)) value="{{$Booth->Hall}}" @endif>


                            <div class="form-group" style="margin-bottom: 0.4rem">
                                <div class="col">
                                    <div class="modal fade" role="dialog" tabindex="-1" id="job_vac_modal">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4><strong>{{__('message.SelectBoothColor')}}</strong><br></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <p class="text-left">{{__('message.BoothBodyColor')}}<br></p>
                                                        <input class="form-control" type="color" name="Color2"
                                                               value="{{$Booth->Color2}}" id="Color2" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-left">{{__('message.BoothHeaderColor')}}<br></p>
                                                        <input class="form-control" type="color" name="Color1"
                                                               value="{{$Booth->Color1}}" id="Color1" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <p class="text-left">{{__('message.BoothTextColor')}}</p>
                                                        <input class="form-control" type="color" name="WebSiteColor"
                                                               value="{{$Booth->WebSiteColor}}" id="WebSiteColor" required>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success btn-block" data-dismiss="modal"
                                                            type="button">{{__('message.Save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0.4rem">
                                <div class="col">
                                    <div class="modal fade" role="dialog" tabindex="-1" id="BoothData">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4><strong>{{__('message.FillBoothData')}}</strong><br></h4>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <p class="text-left">{{__('message.BoothHeaderName')}}<br></p>
                                                        <input class="form-control" type="text" name="HeaderName" id="HeaderName" required=""
                                                               value="{{$Booth->HeaderName}}"
                                                               placeholder="Max Characters 22" maxlength="22">

                                                    </div>

                                                    <div class="form-group">
                                                        <p class="text-left">{{__('message.AboutCompany')}}</p>


                                                        <textarea maxlength="300" name="Description"
                                                                  class="form-control" id="Description"
                                                                  placeholder="Max Characters 300" required>{{$Booth->Description ?? old('Description')}}</textarea>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success btn-block" data-dismiss="modal"
                                                            type="button">{{__('message.Save')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="modal fade" role="dialog" tabindex="-1" id="ImageModal">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4><strong>{{__('message.BoothImage')}} (512x512)</strong><br></h4>
                                            <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <div class="col">

                                                    <p class="d-inline"
                                                       style="color: rgb(255,255,255);margin-top: 13px;margin-left: 8px;">
                                                        {{__('message.UploadCompanyLogofortheBooth')}} </p>
                                                    <input id="test" type="file" style="margin-top: 13px;margin-left: 17px;"

                                                           value="{{$Booth->Logo}}"
                                                           name="Logo"
                                                           accept="image/*">
                                                </div>

                                            </div>

                                            <div>
                                                <img src="{{$Booth->Logo}}" style="max-width: 400px">
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-success btn-block" data-dismiss="modal"
                                                    type="button">{{__('message.Save')}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <input type="hidden" name="Mode" id="my_mode">



                        </form>

                    </div>
                </div>
            </div>
            <div></div>
        </div>





    {{--    Hasan start Here !!!!--}}



<div class="h-100 w-100 overflow" style="width:100% !important ; height:100% !important;background-size: cover;background-repeat:no-repeat;background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/poster.jpg')}}@endif">

    <!-- Page content -->
    <div class="page-content pt-0 mt-3">
        <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">
                <div class="row mt-md-3">
                    <div class="col-md-10">
                    </div>
                    <div class="col-md-2 col-12">
                        <a class="" href="{{ url('locale/en') }}"><i
                                class="ml-2"></i>En</a>
                        <a class="" href="{{ url('locale/de') }}"><i
                                class="ml-2"></i>Ge</a>
                        <a class="" href="{{ url('locale/al') }}"><i
                                class="ml-2"></i>Al</a>
                    </div>
                </div>
                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row mb-2">
                                    <div class="col-md-1 mr-md-5">
                                        <h4 class="">{{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 18)}}</h4>
                                    </div>
                                    <div class="col-md-4 ml-md-2">
                                        <button data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logout-form').submit()" class="btn btn-danger ml-md-5">
                                            <i class="fa fa-sign-out"></i>
                                        </button>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                                <div class="card" style="background-color:rgba(54,54,54,0.65);color: white">
                                    <div class="card-header header-elements-inline">

                                        <div class="header-elements">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form onsubmit="event.preventDefault(); areyousure();" id="mysinsin_form" method="post" enctype="multipart/form-data"
                                              action="{{route('Exhibitor-Register-ThreePost')}}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="boothid_value" name="Position"
                                                   @if(isset($Booth->Position)) value="{{\App\booth::PositionConvertor($Booth->Position)}}" @endif>
                                            <input type="hidden" id="hall_value" name="Hall"
                                                   @if(isset($Booth->Position)) value="{{$Booth->Hall}}" @endif>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4>{{__('message.Chooseyourboothtype')}}</h4>
                                                    <br>
                                                    <div class="text-center">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="map-booth" id="booth_type_a" onclick="highlight_booth('A')"
                                                                     style=""><img
                                                                        class="w-100 cursor-pointer" src="{{asset('assets/img/booth-01.png')}}" onclick="openImage('{{asset('assets/img/BoothA.png')}}')" />
                                                                    <p class="text-center" style="color: rgb(255,255,255);">Type A</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="map-booth" id="booth_type_b" onclick="highlight_booth('B')"
                                                                ><img class="w-100 cursor-pointer"
                                                                      src="{{asset('assets/img/booth-02.png')}}"
                                                                      onclick="openImage('{{asset('assets/img/BoothB.png')}}')" />
                                                                    <p class="text-center" style="color: rgb(255,255,255);">Type B</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="map-booth" id="booth_type_c" onclick="highlight_booth('C')"
                                                                ><img class="w-100 cursor-pointer"
                                                                      src="{{asset('assets/img/booth-03.png')}}"
                                                                      onclick="openImage('{{asset('assets/img/BoothC.png')}}')" />
                                                                    <p class="text-center" style="color: rgb(255,255,255);">Type C</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="map-booth" id="booth_type_d" onclick="highlight_booth('D')"
                                                                ><img
                                                                        class="w-100 cursor-pointer" src="{{asset('assets/img/booth-04.png')}}"
                                                                        onclick="openImage('{{asset('assets/img/BoothD.png')}}')">
                                                                    <p class="text-center" style="color: rgb(255,255,255);">Type D</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div style="border: 1px solid white ; border-radius: 5px;" class="col-md-6 ml-md-4 p-2 mt-md-5">
                                                            <h6>{{__('message.SBL')}} &nbsp;&nbsp;&nbsp; <i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i><i class="fa fa-angle-double-right"></i></h6>
                                                        <script>
                                                            $(document).ready(function (){
                                                                $(".map-booth").click(function (){
                                                                    $(".map-hide").removeClass("hide");
                                                                });
                                                            })
                                                        </script>
                                                    </div>
                                                    <div class="col-md-6">

                                                    </div>
                                                    <div class="col-md-6 ml-md-4" style="border-radius: 5px;border: 1px solid white">
                                                        <div class="row">
                                                            <div class="col-md-12" >
                                                                <h4 class="mt-2">
                                                                    {{__('message.BoothOptions')}}
                                                                </h4>
                                                                <p>
                                                                    {{__('message.Numberofposters')}} : 3
                                                                </p>
                                                                <p>
                                                                    {{__('message.Numberofinformationdesc')}} : 1
                                                                </p>
                                                                <p>
                                                                    {{__('message.YoutubeVideoLink')}} : 1
                                                                </p>
                                                                <p>
                                                                    {{__('message.Brochure')}} : 1
                                                                </p>
                                                            </div>
                                                            <div class="col-md-12 mt-2">

                                                                <a class="btn btn-info w-100 mb-2" role="button" data-toggle="modal"
                                                                   href="#job_vac_modal"
                                                                >{{__('message.AdjustBoothColors')}}
                                                                </a>
                                                                <br>


                                                                <a class="btn btn-info w-100 mb-2" role="button" data-toggle="modal"
                                                                   href="#BoothData"
                                                                >{{__('message.AdjustBoothData')}}
                                                                </a>

                                                                <br>


                                                                <a class="btn btn-info w-100 mb-2" role="button" data-toggle="modal"
                                                                   href="#ImageModal"
                                                                >{{__('message.BoothLogo')}}

                                                                </a>


                                                                <br>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-5 mt-5 mt-md-0 text-center">
                                                        <div style="margin-bottom: 5px;margin-top: -14px;">
                                                            <button disabled="true" onclick="put_hall_id('a')" id="hall_a" class="btn" type="button"
                                                                    style="background-color: #1fbeb0;color: rgb(255,255,255);margin-right: 7px;height: 36px;">
                                                                Hall A
                                                            </button>
                                                            <button id="hall_b" class="btn" type="button"
                                                                    style="background-color: #1fbeb0;color: rgb(255,255,255);margin-right: 7px;height: 36px;"
                                                                    disabled="true" onclick="put_hall_id('b')">Hall B
                                                            </button>
                                                            <button disabled="true" onclick="put_hall_id('c')" id="hall_c" class="btn" type="button"
                                                                    style="background-color: #1fbeb0;color: rgb(255,255,255);margin-right: 7px;height: 36px;"
                                                                    disabled="">Hall C
                                                            </button>
                                                            <button disabled="true" onclick="put_hall_id('d')" id="hall_d" class="btn" type="button"
                                                                    style="background-color: #1fbeb0;color: rgb(255,255,255);margin-right: 7px;height: 36px;"
                                                                    disabled="true">Hall D
                                                            </button>
                                                        </div>



                                                        <div class="w-100 text-center">
                                                            <div style="background-color: #888686;height: 384px;width: 333px;padding: 14px;padding-top: 27px;margin: 0 auto" class="hide map-hide">
                                                                <div class="float-left" style="margin-right: 22px;">
                                                                    <div id="booth_17" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: 36px;padding-top: 0px;"></div>
                                                                    <div id="booth_18" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_19" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                </div>
                                                                <div class="float-left" style="margin-right: -17px;">
                                                                    <div id="booth_25" class="openbooth"
                                                                         style="height: 22px;width: 60px;background-color: #939393; cursor: pointer;;margin-bottom: 30px;margin-top: -23px;padding-top: 0px;"></div>
                                                                    <div id="booth_01" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: -23px;padding-top: 0px;"></div>
                                                                    <div id="booth_12" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: 0px;padding-top: 0px;"></div>
                                                                    <div id="booth_07" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_03" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_20" class="openbooth"
                                                                         style="height: 24px;width: 70px;background-color: #939393; cursor: pointer;;margin-bottom: 38px;padding-bottom: 15px;margin-top: -12px;"></div>
                                                                </div>
                                                                <div class="float-left" style="margin-right: 29px;">
                                                                    <div id="booth_11" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: 6px;padding-top: 0px;"></div>
                                                                    <div id="booth_02" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_13" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_08" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                </div>
                                                                <div class="float-left" style="margin-right: -17px;margin-left: 10px;">
                                                                    <div id="booth_24" class="openbooth"
                                                                         style="height: 22px;width: 60px;background-color: #939393; cursor: pointer;;margin-bottom: 30px;margin-top: -23px;padding-top: 0px;"></div>
                                                                    <div id="booth_04" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: -23px;padding-top: 0px;"></div>
                                                                    <div id="booth_15" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: 0px;padding-top: 0px;"></div>
                                                                    <div id="booth_09" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_06" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_21" class="openbooth"
                                                                         style="height: 24px;width: 70px;background-color: #939393; cursor: pointer;;margin-bottom: 38px;padding-bottom: 15px;margin-top: -12px;"></div>
                                                                </div>
                                                                <div class="d-inline-block float-left" style="margin-right: 30px;">
                                                                    <div id="booth_14" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: 6px;padding-top: 0px;"></div>
                                                                    <div id="booth_05" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_10" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                    <div id="booth_16" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;"></div>
                                                                </div>
                                                                <div class="d-inline-block float-left" style="margin-right: 0px;">
                                                                    <div id="booth_23" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: -76px;margin-top: 54px;"></div>
                                                                    <div id="booth_22" class="openbooth"
                                                                         style="height: 59px;width: 26px;background-color: #939393; cursor: pointer;;margin-bottom: 24px;margin-top: 173px;position: relative"></div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col" style="transform: rotate(270deg);margin-top: 30px;margin-left: 15px;position: absolute;top: 320px;left: 140px;">
                                                                        <p class="text-light">{{__('message.Entrance')}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>



                                            </div>
                                            <div class="text-center mt-3">


                                                <div class="form-group">

{{--                                                    <button id="my_jafar_01" onclick="document.getElementById('my_mode').value = 'Test'"--}}
{{--                                                                                               class="btn  btn-block" style="display: none; width: 300px;background-color: #a8a8a8;"--}}
{{--                                                                                             onmouseover="this.style.backgroundColor='#363636'"--}}
{{--                                                                                               onmouseleave="this.style.backgroundColor='#a8a8a8'"--}}
{{--                                                                                         type="submit">--}}
{{--                                                                                          {{__('message.Save')}} & {{__('message.SeeBoothin3D')}}--}}

{{--                                                                                        <i class="fa fa-check" style="margin-left: 6px;"></i>--}}
{{--                                                                                      </button>--}}

{{--                                                    <a onclick="$('#my_jafar_01').trigger('click')" class="btn  btn-dark w-100" target="_blank"--}}
{{--                                                       href="/Showroom/"--}}
{{--                                                    >--}}
{{--                                                        {{__('message.Save')}} & {{__('message.SeeBoothin3D')}}--}}
{{--                                                    </a>--}}
                                                </div>
                                                <input type="hidden" name="Mode" id="my_mode">
                                                <button onclick="document.getElementById('my_mode').value = 'Finish'"
                                                        class="btn btn-success w-100" type="submit"
                                                >
                                                    <i class="fa fa-flag-checkered" style="margin-right: 6px;"></i>
                                                    {{__('message.CompleteRegistration')}}
                                                    <i class="fa fa-flag-checkered" style="margin-left: 6px;"></i>
                                                </button>

                                            </div>
                                        </form>
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
        <!-- /main content -->
    </div>
    <!-- /page content -->

</div>




    @endsection

@section('js')
    <script>
        function openImage(ImageUrl){

            $("#BoothIamgeHosein").attr("src",ImageUrl);
            $('#BoothImagesModalNmidonmChiCHi').modal('show');

        }
    </script>
    <script>
        const url_boooooooth = "/api/v1/booth/occupied/"
        const url_hall = "/api/v1/hall/full/"
        const hall_ids = [1, 2, 3, 4];
        const hall_names = ['a', 'b', 'c', 'd']
        var number;

        function reserve_booths(hall_id) {
            for (var i = 1; i < 26; i++) {
                (function (i) {
                    $.ajax({
                        url: url_boooooooth + hall_id + "/booth_" + i,
                        type: 'GET',
                        async: false,
                        success: function (data) {
                            Data = JSON.parse(data);
                            if (Data === "Full") {
                                if (i.toString().length == 1) {
                                    i = '0' + i;
                                }
                                var element = document.getElementById("booth_" + i);
                                element.classList.remove("openbooth");
                                element.classList.add("closebooth");
                            }
                        }
                    });
                })(i);
            }


            /* $.get(url_boooooooth.replace("booth_id", i).replace("hall_id", hall_id), function (data) {
                 console.log(data)
                 if (data === "na") {
                     var element = document.getElementById("booth_" + i);
                     element.classList.remove("openbooth");
                     element.classList.add("closebooth");
                 }
             });*/
        }

        function show_halls() {
            let CanContinue = true;
            for (var i = 0; i < hall_ids.length; i++) {
                (function (i) {
                    if (CanContinue === true) {
                        $.ajax({
                            url: url_hall + hall_ids[i],
                            type: 'GET',
                            async: false,
                            success: function (data) {
                                Data = JSON.parse(data);
                                if (Data === "NotFull") {
                                    document.getElementById('hall_' + hall_names[i]).disabled = false;
                                    reserve_booths(hall_ids[i]);
                                    $('#hall_value').val(hall_names[i])

                                    CanContinue = false;
                                }
                            }
                        });
                    }

                })(i);
            }
        }

        show_halls()

        last_position = '0';

        $(".closebooth").click(function () {

            swal.fire("Booth is Occupied, Choose another booth")


        });
        $(".openbooth").click(function () {


            if($(this).hasClass('activetypes')){

                try{
                    $('#'+last_position).addClass('activetypes')

                }catch (e){
                    console.log(e)
                }

                $(".openbooth").each(function () {
                    $(this).removeClass("selectbooth");
                });
                $(this).removeClass("activetypes");
                $(this).addClass("selectbooth");
                last_position = $(this).attr("id")

                $('#boothid_value').val($(this).attr("id"))
            }else{
                swal.fire('{{__('message.BoothNot')}}')
            }


        })

        function highlight_booth(booth_type) {

            $('.selected_booth').each(function () {
                $(this).removeClass('selected_booth')
            })


            $('.selectbooth').each(function (){
                $(this).removeClass('selectbooth')
            })

            if (booth_type == 'A') {



                $('#booth_type_a').addClass("selected_booth")
                $('.activetypes').each(function () {
                    $(this).removeClass('activetypes')
                    $(this).addClass('unselectable')
                })

                if (document.getElementById("booth_01").classList.contains('closebooth') != true) {
                    $("#booth_01").addClass("activetypes");
                    $("#booth_01").removeClass('unselectable')

                }
                if (document.getElementById("booth_02").classList.contains('closebooth') != true) {
                    $("#booth_02").addClass("activetypes");
                    $("#booth_02").removeClass('unselectable')

                }
                if (document.getElementById("booth_03").classList.contains('closebooth') != true) {
                    $("#booth_03").addClass("activetypes");
                    $("#booth_03").removeClass('unselectable')

                }
                if (document.getElementById("booth_04").classList.contains('closebooth') != true) {
                    $("#booth_04").addClass("activetypes");
                    $("#booth_04").removeClass('unselectable')

                }
                if (document.getElementById("booth_05").classList.contains('closebooth') != true) {
                    $("#booth_05").addClass("activetypes");
                    $("#booth_05").removeClass('unselectable')

                }
                if (document.getElementById("booth_06").classList.contains('closebooth') != true) {
                    $("#booth_06").addClass("activetypes");
                    $("#booth_06").removeClass('unselectable')

                }

            } else if (booth_type == 'B') {

                $('#booth_type_b').addClass("selected_booth")
                $('.activetypes').each(function () {
                    $(this).removeClass('activetypes')
                    $(this).addClass('unselectable')
                })


                if (document.getElementById("booth_07").classList.contains('closebooth') != true) {
                    $("#booth_07").addClass("activetypes");
                    $("#booth_07").removeClass('unselectable')

                }
                if (document.getElementById("booth_08").classList.contains('closebooth') != true) {
                    $("#booth_08").addClass("activetypes");
                    $("#booth_08").removeClass('unselectable')
                }
                if (document.getElementById("booth_09").classList.contains('closebooth') != true) {
                    $("#booth_09").addClass("activetypes");
                    $("#booth_09").removeClass('unselectable')
                }
                if (document.getElementById("booth_10").classList.contains('closebooth') != true) {
                    $("#booth_10").addClass("activetypes");
                    $("#booth_10").removeClass('unselectable')
                }


            } else if (booth_type == 'C') {

                $('#booth_type_c').addClass("selected_booth")
                $('.activetypes').each(function () {
                    $(this).removeClass('activetypes')
                    $(this).addClass('unselectable')
                })


                if (document.getElementById("booth_11").classList.contains('closebooth') != true) {
                    $("#booth_11").addClass("activetypes");
                    $("#booth_11").removeClass('unselectable')
                }
                if (document.getElementById("booth_12").classList.contains('closebooth') != true) {
                    $("#booth_12").addClass("activetypes");
                    $("#booth_12").removeClass('unselectable')
                }
                if (document.getElementById("booth_13").classList.contains('closebooth') != true) {
                    $("#booth_13").addClass("activetypes");
                    $("#booth_13").removeClass('unselectable')

                }
                if (document.getElementById("booth_14").classList.contains('closebooth') != true) {
                    $("#booth_14").addClass("activetypes");
                    $("#booth_14").removeClass('unselectable')
                }
                if (document.getElementById("booth_15").classList.contains('closebooth') != true) {
                    $("#booth_15").addClass("activetypes");
                    $("#booth_15").removeClass('unselectable')
                }
                if (document.getElementById("booth_16").classList.contains('closebooth') != true) {
                    $("#booth_16").addClass("activetypes");
                    $("#booth_16").removeClass('unselectable')
                }


            } else if (booth_type == 'D') {

                $('#booth_type_d').addClass("selected_booth")
                $('.activetypes').each(function () {
                    $(this).removeClass('activetypes')
                    $(this).addClass('unselectable')
                })


                if (document.getElementById("booth_17").classList.contains('closebooth') != true) {
                    $("#booth_17").addClass("activetypes");
                    $("#booth_17").removeClass('unselectable')
                }
                if (document.getElementById("booth_18").classList.contains('closebooth') != true) {
                    $("#booth_18").addClass("activetypes");
                    $("#booth_18").removeClass('unselectable')
                }
                if (document.getElementById("booth_19").classList.contains('closebooth') != true) {
                    $("#booth_19").addClass("activetypes");
                    $("#booth_19").removeClass('unselectable')
                }
                if (document.getElementById("booth_20").classList.contains('closebooth') != true) {
                    $("#booth_20").addClass("activetypes");
                    $("#booth_20").removeClass('unselectable')
                }
                if (document.getElementById("booth_21").classList.contains('closebooth') != true) {
                    $("#booth_21").addClass("activetypes");
                    $("#booth_21").removeClass('unselectable')
                }
                if (document.getElementById("booth_22").classList.contains('closebooth') != true) {
                    $("#booth_22").addClass("activetypes");
                    $("#booth_22").removeClass('unselectable')
                }
                if (document.getElementById("booth_23").classList.contains('closebooth') != true) {
                    $("#booth_23").addClass("activetypes");
                    $("#booth_23").removeClass('unselectable')
                }
                if (document.getElementById("booth_24").classList.contains('closebooth') != true) {
                    $("#booth_24").addClass("activetypes");
                    $("#booth_24").removeClass('unselectable')
                }
                if (document.getElementById("booth_25").classList.contains('closebooth') != true) {
                    $("#booth_25").addClass("activetypes");
                    $("#booth_25").removeClass('unselectable')
                }

            } else {
                return 1;
            }


        }

        function put_hall_id(javad) {


            $('#hall_value').val(javad)
        }

        var inputids = [
            'Color1' , 'Color2' , 'WebSiteColor' , 'HeaderName' , 'Description'
        ];
        var isValid = true;


        function areyousure() {
            var a = document.getElementById('Color1').value;
            var b = document.getElementById('Color2').value;
            var c = document.getElementById('WebSiteColor').value;
            var d = "ddasdas";
            var e = document.getElementById('HeaderName').value;
            // var f = document.getElementById('test').value;

            if (a == null || a == "", b == null || b == "", c == null || c == "", d == null || d == "" , e == null || e == ""){

                Swal.fire({
                    icon: 'error',
                    title: '{{__('message.PleaseFillAllFields')}}',
                })
                return false;
            }else {
                if(document.getElementById('my_mode').value == 'Finish'){
                    Swal.fire({
                        title: '{{__('message.Step3Error')}}',
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: `{{__('message.NExtPage')}}`,
                        denyButtonText: `{{__('message.StayinPage')}}`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire('Saved!', '', 'success')
                            confirmed_sinsin = true
                            $("#mysinsin_form").removeAttr('onsubmit').submit()
                            return true
                        } else if (result.isDenied) {
                            Swal.fire('{{__('message.cans')}}', '', 'info')
                            confirmed_sinsin = false
                            return false
                        }
                    })

                }else {
                    confirmed_sinsin = true
                    $("#mysinsin_form").removeAttr('onsubmit').submit()
                    return true;
                }

            }


        }

    </script>



@endsection
