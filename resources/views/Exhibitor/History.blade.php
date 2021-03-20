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


    {{--    Hasan start here !!!!--}}


    <body style="background: url('{{\App\Site::ExhibitorBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    <div>

       @include("Sidebars.exhibitor-sidebar")


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
                            {{__("message.Gender")}}
                        </h6>
                        @foreach(explode(',' , \App\Site::find(1)->VisitorGender) as $Gender)
                            <a href="?gender={{$Gender}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$Gender}}
                            </a>
                        @endforeach



                        <h6>
                            {{__("message.InterestedCountryToStudy")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->countryInterestedItems) as $country)
                            <a href="?country={{$country}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$country}}
                            </a>
                        @endforeach

                        <h6>
                           {{__("message.InterestedDegree")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->interestedDegreeItems) as $intDegree)
                            <a href="?interestedDegree={{$intDegree}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$intDegree}}
                            </a>
                        @endforeach
                        <h6>
                            {{__("message.InterestedField")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->interestedFieldItems) as $intField)
                            <a href="?interestedField={{$intField}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$intField}}
                            </a>
                        @endforeach

                        <h6>
                            {{__("message.OnlineDegreeProgram")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->onlineDegreeProgramsItems) as $onDegree)
                            <a href="?onDegree={{$onDegree}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$onDegree}}
                            </a>
                        @endforeach

                        <h6>
                            {{__("message.CurrentLevelOfEducation")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->educationItems) as $edu)
                            <a href="?edu={{$edu}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$edu}}
                            </a>
                        @endforeach


                        <h6>
                            {{__("message.AdmissionSemester")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->admissionSemesterItems) as $adSem)
                            <a href="?adSem={{$adSem}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$adSem}}
                            </a>
                        @endforeach

                        <h6>
                            {{__("message.Profession")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->professionInterestedItems) as $interestedProfession)
                            <a href="?intProf={{$interestedProfession}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$interestedProfession}}
                            </a>
                        @endforeach

                        <h6>
                            {{__("message.Profile")}}
                        </h6>
                        @foreach(explode(',' , \App\VisitorForm::find(1)->profileItems) as $profile)
                            <a href="?profile={{$profile}}" class="btn btn-dark w-50 mb-2 btn-sm">
                                {{$profile}}
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
                            <div class="card p-3 pc-height-exhibitor-history"
                                 style="background-color:#006B63;color: white;">
                                <div class="card-body py-0">
                                    <form action="{{route("Exhibitor.History")}}" method="get" class="w-100">
                                        <div class="row">
                                            <div class="col-md-4" style="">
                                                <button class="btn btn-dark w-100" type="button" onclick="$('#filter').modal('show')">Click to Choose Your Filter</button>
                                                <div class="input-group mt-2 mb-2">
                                                    <input type="text" name="SearchTerm" class="form-control" placeholder="Visitor Name">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit">Search</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="booth-btn booth-btn-height w-100"
                                                         style="overflow-y: auto ;height: 450px;">

                                                        @foreach($Users as $user)
                                                            <div class="col-12">
                                                                <a @if(request()->UserID == $user->id) class="text-left btn btn-primary mb-2 w-100"
                                                                   @else class="text-white text-left btn btn-outline-dark mb-2 w-100"
                                                                   @endif href="?UserID={{$user->id}}">{{$user->UserName}}</a>
                                                            </div>
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>


                                            @if(isset($User))




                                                <div class="col-md-4 mt-md-0 mt-2"
                                                     style="border: 1px solid white;border-radius: 5px;height: 600px;overflow-y: auto">
                                                    <h3 class="text-white mb-4">{{__("message.VisitorInformation")}}</h3>
                                                    <div class="text-center">
                                                        <img src="{{$User->Image}}" style="width: 65px;margin: 0 auto"
                                                             class="text-center">
                                                    </div>
                                                    <div class="text-center" style="text-transform: capitalize">
                                                        <h1>{{$User->formRule}}</h1>
                                                    </div>
                                                    <p>{{__('message.UserName')}}: {{$User->UserName}}</p>
                                                    <p>{{__('message.fn')}}: {{$User->FirstName}}</p>
                                                    <p>{{__('message.ln')}}: {{$User->LastName}}</p>
                                                    <p>{{__('message.Profession')}}: {{$User->Profession}}</p>
                                                    <p>{{__('message.Gender')}}: {{$User->Gender}}</p>
                                                    <p>{{__('message.City')}}: {{$User->City}}</p>
                                                    <p>{{__('message.Country')}}: {{$User->Country}}</p>
                                                    <p>{{__('message.BirthDate')}}: {{$User->BirthDate}}</p>

                                                    @if ($User->education != null)
                                                        <p>
                                                            {{__("message.Education")}} : {{$User->education}}
                                                        </p>
                                                    @endif

                                                    @if ($User->countryStudy != null)
                                                        <p>
                                                            {{__("message.CountryStudy")}} : {{$User->countryStudy}}
                                                        </p>
                                                    @endif

                                                    @if ($User->InterestedDegree != null)
                                                        <p>
                                                            {{__("message.InterestedDegree")}} : {{$User->InterestedDegree}}
                                                        </p>
                                                    @endif

                                                    @if ($User->languageOfStudy != null)
                                                        <p>
                                                           {{__("message.LanguageOfStudy")}} : {{$User->languageOfStudy}}
                                                        </p>
                                                    @endif

                                                    @if ($User->onlineDegreeProgram != null)
                                                        <p>
                                                            {{__("message.OnlineDegreeProgram")}} : {{$User->onlineDegreeProgram}}
                                                        </p>
                                                    @endif

                                                    @if ($User->interestedScholarShip != null)
                                                        <p>
                                                            {{__("message.InterestedScholarShip")}} : {{$User->interestedScholarShip}}
                                                        </p>
                                                    @endif


                                                    @if ($User->admissionSemester != null)
                                                        <p>
                                                            {{__("message.AdmissionSemester")}} : {{$User->admissionSemester}}
                                                        </p>
                                                    @endif

                                                    @if ($User->professionInterestedToApply != null)
                                                        <p>
                                                            {{__("message.ProfessionInterestedToApply")}} : {{$User->professionInterestedToApply}}
                                                        </p>
                                                    @endif

                                                    @if ($User->organization != null)
                                                        <p>
                                                            {{__("message.Organization")}} : {{$User->organization}}
                                                        </p>
                                                    @endif

                                                    @if ($User->InterNationalPrograms != null)
                                                        <p>
                                                            {{__("message.InternationalPrograms")}} : {{$User->InterNationalPrograms}}
                                                        </p>
                                                    @endif

                                                    @if ($User->website != null)
                                                        <p>
                                                            {{__("message.WebSite")}} : {{$User->website}}
                                                        </p>
                                                    @endif

                                                    @if ($User->tel != null)
                                                        <p>
                                                            {{__("message.Tel")}} : {{$User->tel}}
                                                        </p>
                                                    @endif

                                                    @if ($User->userCompanyName != null)
                                                        <p>
                                                            {{__("message.UserCompanyName")}} : {{$User->userCompanyName}}
                                                        </p>
                                                    @endif

                                                    @if ($User->profile != null)
                                                        <p>
                                                            {{__("message.Profile")}} : {{$User->profile}}
                                                        </p>
                                                    @endif

                                                    @if ($User->zipCode != null)
                                                        <p>
                                                           {{__("message.Zipcode")}} : {{$User->zipCode}}
                                                        </p>
                                                    @endif

                                                    @if ($User->fax != null)
                                                        <p>
                                                            {{__("message.Fax")}} : {{$User->fax}}
                                                        </p>
                                                    @endif
                                                    @if ($User->mainCompany != null)
                                                        <p>
                                                            {{__("message.MainCompany")}} : {{$User->mainCompany}}
                                                        </p>
                                                    @endif

                                                    @if ($User->position != null)
                                                        <p>
                                                            {{__("message.Position")}} : {{$User->position}}
                                                        </p>
                                                    @endif







                                                    <p class="text-left">Download CV :
                                                        <a class="btn btn-primary" href="{{$User->resume}}" target="_blank">
                                                            Download
                                                        </a>
                                                    </p>
                                                </div>




                                                <div class="col-md-4 mt-md-0 mt-2">
                                                    <h4>{{__("message.ChatHistory")}}</h4>
                                                    <div class="pc-height-visitor-history-chat"
                                                         style="background-color:transparent;border: 1px solid transparent ;border-radius: 5px;overflow-y: auto;overflow-x:hidden ">


                                                        <div>
                                                            @if(\App\Chat::where('UserID' , $User->id)->where('BoothID' , $Booth->id)->count() <= 0)
                                                                {{__('message.NoMessageAvailable')}}

                                                            @else
                                                                @foreach(\App\Chat::where('UserID' , $User->id)->where('BoothID' , $Booth->id)->get() as $chat)

                                                                    @if($chat->Sender == 'Exhibitor')
                                                                        <div class="row">
                                                                            <div class="col-3"></div>
                                                                            <div class="col-8 bg-success mt-2 ml-3 p-2"
                                                                                 style="border-radius: 5px;">{{$chat->Text}}</div>
                                                                        </div>
                                                                    @else

                                                                        <div class="row">
                                                                            <div class="col-8 bg-primary mt-2 ml-3 p-2"
                                                                                 style="border-radius: 5px;">{{$chat->Text}}</div>

                                                                            <div class="col-3"></div>
                                                                        </div>
                                                                    @endif



                                                                @endforeach
                                                            @endif

                                                        </div>



                                                    </div>
                                                </div>


                                            @endif


                                        </div>

                                    </form>
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
