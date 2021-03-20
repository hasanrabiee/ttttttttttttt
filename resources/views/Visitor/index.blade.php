
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{--    <script>--}}
    {{--        $.getJSON("https://api.ipify.org?format=json",--}}
    {{--            function(data) {--}}
    {{--                $("#gfg").html(data.ip);--}}
    {{--                const ip = data.ip;--}}

    {{--                function visitorIP(ip){--}}
    {{--                    $.get("{{route('Visitor.ChangeIP')}}", {--}}
    {{--                        ip: ip,--}}
    {{--                    },function (data){--}}
    {{--                    })--}}
    {{--                }--}}

    {{--                setInterval(visitorIP(ip),1000)--}}

    {{--            })--}}



    {{--    </script>--}}

    <!-- /theme JS files -->


    <script>

    </script>



@endsection


@section('content')




    @include("Sidebars.visitor-sidebar")





    <!-- Main content -->

    <div class="content-wrapper" style="overflow-x: hidden">

        <!-- Content area -->
        <div class="content">

            <!-- Main charts -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- Traffic sources -->

                    <div class="card" style="background-color:#006B63;color: white">
                        <div class="card-header header-elements-inline">
                            @if (auth()->user()->formRule != null)
                                <h1 style="text-transform: capitalize">
                                    {{\Illuminate\Support\Facades\Auth::user()->formRule}}
                                </h1>
                            @endif
                            @if(\Illuminate\Support\Facades\Auth::user()->AccountStatus == 'Active')
                                <button class="btn btn-success ml-md-n5">{{__('message.AccountActive')}}</button>
                            @else
                                <button class="btn btn-danger ml-md-n5">{{__('message.AccountSuspended')}}</button>
                            @endif


                            <div class="header-elements">
                            </div>
                        </div>
                        <div class="chart position-relative" id="traffic-sources"></div>
                    </div>

                    <div class="card p-3" style="background-color:#006B63;color: white">
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-6 font-size-lg">

                                    <p>{{__("message.Title")}}: {{\Illuminate\Support\Facades\Auth::user()->Gender}}</p>


                                    <p>{{__('message.fn')}}  : {{\Illuminate\Support\Facades\Auth::user()->FirstName}}</p>
                                    <p>{{__('message.ln')}} : {{\Illuminate\Support\Facades\Auth::user()->LastName}}</p>
                                    <p>{{__('message.Email')}}: {{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                                    <p>{{__('message.BirthDate')}}: {{\Illuminate\Support\Facades\Auth::user()->BirthDate}}</p>
                                    <p>{{__('message.Country')}}: {{\Illuminate\Support\Facades\Auth::user()->Country}}</p>
                                    <p>{{__('message.City')}}: {{\Illuminate\Support\Facades\Auth::user()->City}}</p>

                                    @if (auth()->user()->currentLevelOfEducation != null)
                                        <p>
                                            {{__("message.CurrentLevelOfEducation")}} : {{\Illuminate\Support\Facades\Auth::user()->currentLevelOfEducation}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->countryStudy != null)
                                        <p>
                                            {{__("message.InterestedCountryToStudy")}} : {{\Illuminate\Support\Facades\Auth::user()->countryStudy}}
                                        </p>
                                    @endif

                                </div>









                                <div class="col-6 font-size-lg">
                                    @if (auth()->user()->InterestedDegree != null)
                                        <p>
                                            {{__("message.InterestedDegree")}} : {{\Illuminate\Support\Facades\Auth::user()->InterestedDegree}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->InterestedField != null)
                                        <p>
                                            {{__("message.InterestedField")}}: {{\Illuminate\Support\Facades\Auth::user()->InterestedField}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->languageOfStudy != null)
                                        <p>
                                           {{__("message.LanguageOfStudy")}} : {{\Illuminate\Support\Facades\Auth::user()->languageOfStudy}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->onlineDegreeProgram != null)
                                        <p>
                                            {{__("message.OnlineDegreeProgram")}} : {{\Illuminate\Support\Facades\Auth::user()->onlineDegreeProgram}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->interestedScholarShip != null)
                                        <p>
                                            {{__("message.InterestedScholarShip")}} : {{\Illuminate\Support\Facades\Auth::user()->interestedScholarShip}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->admissionSemester != null)
                                        <p>
                                            {{__("message.AdmissionSemester")}} : {{\Illuminate\Support\Facades\Auth::user()->admissionSemester}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->professionInterestedToApply != null)
                                        <p>
                                            {{__("message.ProfessionInterestedToApply")}} : {{\Illuminate\Support\Facades\Auth::user()->professionInterestedToApply}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->organization != null)
                                        <p>
                                            {{__("message.Organization")}} : {{\Illuminate\Support\Facades\Auth::user()->organization}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->InterNationalPrograms != null)
                                        <p>
                                            {{__("message.InternationalPrograms")}} : {{\Illuminate\Support\Facades\Auth::user()->InterNationalPrograms}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->website != null)
                                        <p>
                                            {{__("message.WebSite")}} : {{\Illuminate\Support\Facades\Auth::user()->website}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->tel != null)
                                        <p>
                                            {{__("message.Tel")}} : {{\Illuminate\Support\Facades\Auth::user()->tel}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->userCompanyName != null)
                                        <p>
                                           {{__("message.UserCompanyName")}} : {{\Illuminate\Support\Facades\Auth::user()->userCompanyName}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->profile != null)
                                        <p>
                                            {{__("message.Profile")}} : {{\Illuminate\Support\Facades\Auth::user()->profile}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->zipCode != null)
                                        <p>
                                            {{__("message.Profile")}} : {{\Illuminate\Support\Facades\Auth::user()->zipCode}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->fax != null)
                                        <p>
                                            {{__("message.Fax")}} : {{\Illuminate\Support\Facades\Auth::user()->fax}}
                                        </p>
                                    @endif
                                    @if (auth()->user()->mainCompany != null)
                                        <p>
                                            {{__("message.MainCompany")}} : {{\Illuminate\Support\Facades\Auth::user()->mainCompany}}
                                        </p>
                                    @endif

                                    @if (auth()->user()->position != null)
                                        <p>
                                            {{__("message.Position")}} : {{\Illuminate\Support\Facades\Auth::user()->position}}
                                        </p>
                                    @endif
                                    <button  data-toggle="tooltip" data-placement="top" title="Upload Resume" onclick="$('#Resume_Modal').modal('show')" class="btn btn-dark w-md-50">
                                        <span class="fa fa-upload"></span>
                                        {{__("message.Resume")}}</button>
                                    @if (auth()->user()->resume != null )
                                        <a href="{{auth()->user()->resume}}" class="btn btn-info w-md-50 mt-1">Download Resume</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="chart position-relative" id="traffic-sources"></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card p-3" style="background-color:#006B63;color: white">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <form action="{{route('Visitor.ChangePassword')}}" method="post" class="w-100">
                                            @csrf
                                            <div class="form-group col-12">
                                                <input class="form-control" type="password" placeholder="{{__('message.OldPass2')}}" name="OldPassword">
                                            </div>

                                            <div class="form-group col-12">
                                                <input class="form-control" type="password" placeholder="{{__('message.NewPass2')}}" name="password">
                                            </div>

                                            <div class="form-group col-12">
                                                <input class="form-control" type="password" placeholder="{{__('message.passwordConfrimation')}}" name="password_confirmation">                                                </div>

                                            <div class="form-group text-center">
                                                {{--                                                    <input type="submit" class="btn btn-success ml-2" value="Update Password">--}}
                                                <button class="btn btn-success ml-2" type="submit">{{__('message.Update')}}</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="chart position-relative" id="traffic-sources"></div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card p-3" style="background-color:#006B63;color: white">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <form method="post" action="{{route('Visitor.VisitExperience')}}" class="w-100">
                                            @csrf
                                            <div class="form-group col-12">
                                                <textarea type="text" class="form-control" rows="5" style="padding-bottom: 19px;" placeholder="{{__('message.VisitExp')}}..."  name="VisitExperience">{!! \Illuminate\Support\Facades\Auth::user()->VisitExperience !!}</textarea>
                                            </div>
                                            <div class="form-group text-center">
                                                <button class="btn btn-success ml-2" type="submit">{{__('message.Send')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="chart position-relative" id="traffic-sources"></div>
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


    </div>
    </body>





@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function show_info(javad) {
            Swal.fire({
                text: javad,
            })
        }
    </script>
@endsection
