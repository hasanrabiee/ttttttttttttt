@extends('layouts.Panel')

@section("Head")


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
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





    {{--Hasan start here !!!!!--}}


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
            <div class="content-wrapper" style="overflow: hidden">

                <!-- Content area -->
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-xl-12">
                            <form action="{{route('Exhibitor.UpdateBooth')}}" method="post"
                                  enctype="multipart/form-data" class="w-100">
                            @csrf
                            <!-- Traffic sources -->
                                <div class="card p-3" style="background-color:#006B63;color: white">
                                    <div class="card-body py-0">
                                        <div class="alert alert-warning">

                                            {{__("message.BoothNote")}}

                                        </div>
                                        <div class="row">
                                            <div class="col-md-7 font-size-lg">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="image-upload">
                                                            <img
                                                                src="@if($Booth->Poster1) {{$Booth->Poster1}} @else {{asset('assets/img/download.jpg')}} @endif"
                                                                onclick="$('#Poster1').trigger('click');"
                                                                style="width: 200px;height: 200px;"
                                                                class="cursor-pointer w-75">
                                                            <input type="file" id="Poster1" name="Poster1"
                                                                   style="display:none;width: 200px !important;height: 200px !important;"/><span>
                                                        @if($Booth->Type == 'A')
                                                                    poster1(630*700)
                                                                @elseif($Booth->Type == 'B')
                                                                    poster1(500*700)
                                                                @elseif($Booth->Type == 'C')
                                                                    poster1(700*700)
                                                                @elseif($Booth->Type == 'D')
                                                                    poster1(630x700)
                                                                @endif
                                                    </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="image-upload">
                                                            <img
                                                                src="@if($Booth->Poster2) {{$Booth->Poster2}} @else {{asset('assets/img/download.jpg')}} @endif"
                                                                onclick="$('#Poster2').trigger('click');"
                                                                class="cursor-pointer w-75"
                                                                style="margin: 5px;width: 200px;height: 200px;">
                                                            <input type="file" id="Poster2" name="Poster2"
                                                                   style="display:none"/><span>
                                                        @if($Booth->Type == 'A')
                                                                    poster2(640x1920)
                                                                @elseif($Booth->Type == 'B')
                                                                    poster2(590x990)
                                                                @elseif($Booth->Type == 'C')
                                                                    poster2(700x700)
                                                                @elseif($Booth->Type == 'D')
                                                                    poster2(870x1920)
                                                                @endif

                                                    </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="image-upload">
                                                            <img
                                                                src="@if($Booth->Poster3) {{$Booth->Poster3}} @else {{asset('assets/img/download.jpg')}} @endif"
                                                                onclick="$('#Poster3').trigger('click');"
                                                                class="cursor-pointer w-75"
                                                                style="margin: 5px;width: 200px;height: 200px;">
                                                            <input type="file" id="Poster3" name="Poster3"
                                                                   style="display:none"/><span>

                                                    @if($Booth->Type == 'A')
                                                                    poster3(860x700)
                                                                @elseif($Booth->Type == 'B')
                                                                    poster3(805x1920)
                                                                @elseif($Booth->Type == 'C')
                                                                    poster3(700x700)
                                                                @elseif($Booth->Type == 'D')
                                                                    poster3(720x700)
                                                                @endif
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="border: 1px solid white">
                                                <div class="form-group mt-2">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label for="">
                                                                {{__("message.Upload")}} PDF (max:20MB)
                                                            </label>

                                                            <input type="file" class="form-control-file" name="PdfFile">
                                                        </div>
                                                        <div class="col-6 mt-md-2">
                                                            @if ($Booth->Doc1 != null)
                                                                <a target="_blank" href="{{$Booth->Doc1}}" class="btn btn-primary w-100">View Brochure</a>
                                                            @endif
                                                        </div>
                                                    </div>


                                                </div>
                                                <hr style="border: 1px solid white">
                                                <div class="form-group mt-2">

                                                    <label for="">
                                                        {{__("message.YoutubeVideoLink")}}
                                                    </label>
                                                    <input type="url" class="form-control" name="Video"
                                                           value="{{$Booth->Video}}">
                                                </div>

                                                <div class="form-group mt-2">

                                                    <label for="">
                                                        {{__("message.YourCompanyWebSite")}}
                                                    </label>
                                                    <input type="text" class="form-control" name="WebSite"
                                                           value="{{$Booth->WebSite}}">
                                                </div>

                                                <button class="btn btn-dark w-100 mt-2" type="button"
                                                        onclick="$('#BoothColor').modal('show')">{{__('message.AdjustBoothColors')}}</button>
                                                <button class="btn btn-info w-100 mt-2" type="button"
                                                        onclick="$('#BoothLogo').modal('show')">{{__('message.BoothLogo')}}</button>
                                                <button class="btn btn-primary w-100 mt-2" type="button"
                                                        onclick="$('#Social').modal('show')">Social Medias Links</button>



                                                <div class="modal fade" role="dialog" tabindex="-1" id="Social">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content text-dark">
                                                            <div class="modal-header">
                                                                <h4>{{__("message.SocialMediaLinks")}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <h6>{{__("message.AddSocial")}}</h6>
                                                                <div class="form-group">
                                                                    <label for="">Linkedin Link:</label>
                                                                    <input type="text" class="form-control" name="linkedin" value="{{$Booth->linkedin}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Facebook Link:</label>
                                                                    <input type="text" class="form-control" name="facebook" value="{{$Booth->facebook}}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="">Instagram Link:</label>
                                                                    <input type="text" class="form-control" name="instagram" value="{{$Booth->instagram}}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">

                                                                <p class="mb-2">
                                                                    {{__("message.AfterSettingYourMediaLink")}}
                                                                </p>

                                                                <button class="btn btn-success w-100" data-dismiss="modal" type="button">
                                                                    {{__("message.Set")}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                                <div class="modal text-dark fade" role="dialog" tabindex="-1" id="BoothLogo">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4>{{__('message.BoothLogo')}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <img src="{{$Booth->Logo}}" alt="no_picture" class="img-thumbnail">

                                                                <br>

                                                                <div class="form-group">
                                                                    <input class="form-control" type="file" name="Logo">
                                                                </div>


                                                            </div>
                                                            <div class="modal-footer">
                                                                <p class="mb-2">
                                                                    {{__("message.AfterSelectingLogo")}}
                                                                </p>
                                                                <button class="btn btn-success w-100" data-dismiss="modal" type="button">
                                                                    {{__("message.Select")}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="modal fade" role="dialog" tabindex="-1" id="BoothColor">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="text-dark">{{__('message.SelectBoothColor')}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <p class="text-left text-dark">{{__('message.BoothBodyColor')}}
                                                                        <br></p>
                                                                    <input class="form-control" type="color"
                                                                           name="Color2"
                                                                           value="{{$Booth->Color2}}" id="Color2">
                                                                </div>
                                                                <div class="form-group">
                                                                    <p class="text-left text-dark">{{__('message.BoothHeaderColor')}}
                                                                        <br></p>
                                                                    <input class="form-control" type="color"
                                                                           name="Color1"
                                                                           value="{{$Booth->Color1}}" id="Color1">
                                                                </div>
                                                                <div class="form-group">
                                                                    <p class="text-left text-dark">{{__('message.BoothTextColor')}}</p>
                                                                    <input class="form-control" type="color"
                                                                           name="WebSiteColor"
                                                                           value="{{$Booth->WebSiteColor}}"
                                                                           id="WebSiteColor">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <p class="text-dark mb-2">
                                                                    {{__("message.AfterSelectingColor")}}
                                                                </p>
                                                                <button class="btn btn-success btn-block"
                                                                        data-dismiss="modal" type="button">
                                                                    {{__("message.Select")}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>



                                            </div>
                                            <div class="col-md-5">
                                                <img src="{{asset('assets/img/Booth'.$Booth->Type.'.png')}}" alt=""
                                                     class="w-100">


                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <p>
                                                            <strong>{{__('message.Hall')}}: {{$Booth->Hall}}</strong>
                                                        </p>
                                                        </p>
                                                        <p>
                                                            {{__('message.Booth')}} Type: {{$Booth->Type}}
                                                        </p>
                                                        <p>
                                                            {{__('message.Booth')}} Number: {{$Booth->Position}}
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <a target="_blank" href="/Showroom" class="btn btn-info w-100">See
                                                            Booth in 3D</a>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" value="Save Your Changes"
                                                class="btn btn-success w-100 mt-2">{{__('message.Save')}}</button>
                                    </div>
                                </div>
                            </form>
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



@endsection
