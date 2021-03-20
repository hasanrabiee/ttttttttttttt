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



    @include("Sidebars.visitor-sidebar")
    {{--           Modals--}}

    <div class="modal fade" role="dialog" tabindex="-1" id="filter">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-dark">{{__("message.ItemFiltered")}}</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">




                    <h6>
                        {{__("message.Profile")}}
                    </h6>
                    @foreach(explode(',' , \App\VisitorForm::find(1)->profileItems) as $item)
                        <a href="?profile={{$item}}" class="btn btn-dark w-50 mb-2 btn-sm">
                            {{$item}}
                        </a>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light btn-block"
                            data-dismiss="modal" type="button">
                        {{__('message.Close')}}
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{--           End Modales--}}


            <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card p-3 pc-height-visitor-history" style="background-color:#006B63;color: white;">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-md-4" style="">
                                        <form onblur="is_typing = false" onfocus="is_typing = true" action="" class="w-100" method="GET">
                                            <div class="input-group mt-2 mb-2 w-100">
                                                <button class="btn btn-dark w-100" type="button" onclick="$('#filter').modal('show')">Click to Choose Your Filter</button>

                                                <input type="text" class="form-control" placeholder="{{__('message.CompanyName')}}" name="search">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit">{{__('message.Search')}}</button>
                                                    </div>
                                            </div>
                                        </form>
                                        <div class="row">
                                                <div class="w-100 booth-btn booth-btn-height" style="overflow-y: auto ;height: 450px;">
                                                    @foreach($Booths as $booth)
                                                        <div class="col-12">
                                                            <a href="?CompanyID={{$booth->id}}" type="button" @if(request()->CompanyID == $booth->id) class="text-left btn btn-primary mb-2 w-100" @else class="text-white text-left btn btn-outline-dark mb-2 w-100" @endif>
                                                                {{$booth->CompanyName}}
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                    </div>



                                    @if(isset($Booth))
                                        <div class="col-md-4 mt-md-0 mt-2" style="border: 1px solid white;border-radius: 5px;height: 500px;overflow-y: auto">
                                            <h3 class="text-white mb-4">{{__('message.CompanyInformation')}}</h3>
                                            <img src="{{$Booth->Logo}}" style="width: 65px;">
                                            <p>{{__('message.Company')}} {{__('message.Name')}}: {{$Booth->CompanyName}}</p>
                                            <p>{{__('message.Hall')}}: {{$Booth->Hall}}</p>
                                            <p>{{__('message.Booth')}} {{__('message.number')}}: {{$Booth->Position}} </p>
                                            <p>{{__('message.AboutCompany')}} :{{$Booth->Description}}</p>
                                            <p>{{__('message.WebSite')}}: <a class="text-primary" target="_blank" href="{{$Booth->WebSite}}">{{$Booth->WebSite}}</a></p>

                                            @if ($userInfo->companyAddress != null)
                                                <p>
                                                    {{__("message.CompanyAddress")}} : {{$userInfo->companyAddress}}
                                                </p>
                                            @endif

                                            @if ($userInfo->zipCode != null)
                                                <p>
                                                    {{__("message.Zipcode")}} : {{$userInfo->zipCode}}
                                                </p>
                                            @endif

                                            @if ($userInfo->mainCompany != null)
                                                <p>
                                                    {{__("message.MainCompany")}} : {{$userInfo->mainCompany}}
                                                </p>
                                            @endif

                                            @if ($userInfo->institutionEmail != null)
                                                <p>
                                                    {{__("message.InstitutionEmail")}} : {{$userInfo->institutionEmail}}
                                                </p>
                                            @endif

                                            @if ($userInfo->phone != null)
                                                <p>
                                                    {{__("message.Tel")}} : {{$userInfo->phone}}
                                                </p>
                                            @endif

                                            @if ($userInfo->fax != null)
                                                <p>
                                                    {{__("message.Fax")}} : {{$userInfo->fax}}
                                                </p>
                                            @endif

                                            @if ($userInfo->institution != null)
                                                <p>
                                                    {{__("message.Institution")}} : {{$userInfo->institution}}
                                                </p>
                                            @endif

                                            @if ($userInfo->education != null)
                                                <p>
                                                    {{__("message.Education")}} : {{$userInfo->education}}
                                                </p>
                                            @endif

                                            @if ($userInfo->countryStudy != null)
                                                <p>
                                                    {{__("message.CountryStudy")}} : {{$userInfo->countryStudy}}
                                                </p>
                                            @endif

                                            @if ($userInfo->InterestedDegree != null)
                                                <p>
                                                    {{__("message.InterestedDegree")}} : {{$userInfo->InterestedDegree}}
                                                </p>
                                            @endif

                                            @if ($userInfo->InterestedField != null)
                                                <p>
                                                    {{__("message.InterestedField")}} : {{$userInfo->InterestedField}}
                                                </p>
                                            @endif

                                            @if ($userInfo->languageOfStudy != null)
                                                <p>
                                                    {{__("message.LanguageOfStudy")}} : {{$userInfo->languageOfStudy}}
                                                </p>
                                            @endif


                                            @if ($userInfo->onlineDegreeProgram != null)
                                                <p>
                                                    {{__("message.OnlineDegreeProgram")}} : {{$userInfo->onlineDegreeProgram}}
                                                </p>
                                            @endif

                                            @if ($userInfo->interestedScholarShip != null)
                                                <p>
                                                    {{__("message.InterestedScholarShip")}} : {{$userInfo->interestedScholarShip}}
                                                </p>
                                            @endif


                                        </div>


                                        <div class="col-md-4 mt-md-0 mt-2">
                                            <h4 class="mb-3"><span class="fa fa-briefcase"></span> Swag Bag </h4>

                                            <div class="row">
                                                <div class="col-md-4 mb-2 mb-md-0">
                                                    <a target="_blank" href="{{$Booth->Poster1}}"><img src="{{$Booth->Poster1}}" alt="" class="w-100 h-100 mb-2 mb-md-0"></a>
                                                </div>
                                                <div class="col-md-4 mb-2 mb-md-0">
                                                    <a target="_blank" href="{{$Booth->Poster2}}"><img src="{{$Booth->Poster2}}" alt="" class="w-100 h-100 mb-2 mb-md-0"></a>
                                                </div>
                                                <div class="col-md-4 mb-2 mb-md-0">
                                                    <a target="_blank" href="{{$Booth->Poster3}}"><img src="{{$Booth->Poster3}}" alt="" class="w-100 h-100 mb-2 mb-md-0"></a>
                                                </div>
                                            </div>

                                            <br>

                                            @if ($Booth->Doc1 != "")
                                                <div class="mb-3">
                                                    <span class="fa fa-file-pdf-o" style="font-size: 24px;">&nbsp;</span><a href="{{$Booth->Doc1}}" class="text-white" style="font-size: 20px;" target="_blank">Download Company Brochure</a>
                                                </div>
                                            @endif
                                            @if ($Booth->Video != "")
                                                <div>
                                                    <span class="fa fa-video-camera" style="font-size: 24px;">&nbsp;</span><a href="{{$Booth->Video}}" class="text-white" style="font-size: 20px;" target="_blank">See Company Movie</a>
                                                </div>
                                            @endif
                                            <h4 class="mt-3">{{__("message.SocialMediaLinks")}} </h4>
                                            <div class="row mt-5">

                                                <div class="col-4 text-center">
                                                    @if (!Str::startsWith($Booth->facebook, ["http://", "https://"]))

                                                        <a target="_blank" href="https://{{$Booth->facebook}}" class="w-75">
                                                            <img src="{{asset("assets/img/facebook-icon.png")}}" alt="" class="w-75">
                                                        </a>
                                                    @else

                                                        <a target="_blank" href="{{$Booth->facebook}}" class="w-75">
                                                            <img src="{{asset("assets/img/facebook-icon.png")}}" alt="" class="w-75">
                                                        </a>

                                                    @endif

                                                </div>
                                                <div class="col-4 text-center">
                                                    @if (!Str::startsWith($Booth->linkedin, ["http://", "https://"]))

                                                        <a target="_blank" href="https://{{$Booth->linkedin}}" class="w-75">
                                                            <img src="{{asset("assets/img/linkedin-icon.png")}}" alt="" class="w-75">
                                                        </a>
                                                    @else

                                                        <a target="_blank" href="{{$Booth->linkedin}}" class="w-75">
                                                            <img src="{{asset("assets/img/linkedin-icon.png")}}" alt="" class="w-75">
                                                        </a>

                                                    @endif
                                                </div>
                                                <div class="col-4 text-center">

                                                    @if (!Str::startsWith($Booth->instagram, ["http://", "https://"]))

                                                        <a target="_blank" href="https://{{$Booth->instagram}}" class="w-75">
                                                            <img src="{{asset("assets/img/instagram-icon.png")}}" alt="" class="w-75">
                                                        </a>
                                                    @else

                                                        <a target="_blank" href="{{$Booth->instagram}}" class="w-75">
                                                            <img src="{{asset("assets/img/instagram-icon.png")}}" alt="" class="w-75">
                                                        </a>

                                                    @endif
                                                </div>
                                            </div>


                                        </div>


                                    @endif


                                </div>


                            </div>
                            <div class="chart position-relative" id="traffic-sources"></div>
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
    </body>






@endsection
