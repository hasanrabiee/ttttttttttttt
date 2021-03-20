@extends('layouts.Panel')
@section('Head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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

@endsection



@section('content')


{{--    @include("Sidebars.visitor-sidebar")--}}









    {{--    Hasan start here !!!--}}


    <body style="background: url('{{\App\Site::ExhibitorBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    <div>

    @include("Sidebars.visitor-sidebar")
    <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card p-3 card-inbox-ex-h" style="background-color:#006B63;color: white;">
                            <div class="card-body py-0">
                                <div class="row">

                                    <div class="col-md-4" style="border: 1px solid white;border-radius: 5px; height: 600px;overflow-y: auto">


                                        <form action="{{route("Exhibitor.Inbox")}}" method="GET" class="w-100">
                                            <div class="input-group mt-2 mb-2">

                                                <input name="SearchTerm" type="text" class="form-control" placeholder="Search...">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit">Search</button>
                                                </div>

                                            </div>
                                        </form>



                                        <div class="row">
                                            <div class="col-12 scroll_box"  id="Users" style="height: 500px !important;overflow-y: auto" onscroll="scroll_status = true">
                                                @foreach($Booths as $booth)
                                                    <a href="?CompanyID={{$booth->id}}" type="button" @if(request()->CompanyID == $booth->id) class="text-left btn btn-primary mb-2 w-100" @else class="text-white text-left btn btn-outline-dark mb-2 w-100" @endif>
                                                        {{$booth->CompanyName}}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    @if(isset($Booth))
                                        <div class="col-md-4 mt-md-0 mt-2" style="height:600px;border: 1px solid white;border-radius: 5px;overflow-y: auto">
                                            <h3 class="text-white mb-4">{{__('message.CompanyInformation')}}</h3>
                                            <img src="{{$Booth->Logo}}" style="width: 65px;">
                                            <p>{{__('message.Company')}} {{__('message.Name')}}: {{$Booth->CompanyName}}</p>
                                            <p>{{__('message.Hall')}}: {{$Booth->Hall}}</p>
                                            <p>{{__('message.Booth')}} {{__('message.number')}}: {{$Booth->Position}} </p>
                                            <p>{{__('message.AboutCompany')}} :{{$Booth->Description}}</p>
                                            <p>{{__('message.WebSite')}}: <a class="text-dark" href="{{$Booth->WebSite}}">{{$Booth->WebSite}}</a></p>

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


                                            @if ($userInfo->currentLevelOfEducation != null)
                                                <p>
                                                    {{__("message.CurrentLevelOfEducation")}} : {{$userInfo->currentLevelOfEducation}}
                                                </p>
                                            @endif

                                            @if ($userInfo->position != null)
                                                <p>
                                                    {{__("message.Position")}} : {{$userInfo->currentLevelOfEducation}}
                                                </p>
                                            @endif

                                            @if ($userInfo->admissionSemester != null)
                                                <p>
                                                    {{__("message.AdmissionSemester")}} : {{$userInfo->admissionSemester}}
                                                </p>
                                            @endif


                                            @if ($userInfo->professionInterestedToApply != null)
                                                <p>
                                                    {{__("message.ProfessionInterestedToApply")}} : {{$userInfo->professionInterestedToApply}}
                                                </p>
                                            @endif

                                            @if ($userInfo->organization != null)
                                                <p>
                                                    {{__("message.Organization")}} : {{$userInfo->organization}}
                                                </p>
                                            @endif


                                            @if ($userInfo->InterNationalPrograms != null)
                                                <p>
                                                    {{__("message.InternationalPrograms")}} : {{$userInfo->InterNationalPrograms}}
                                                </p>
                                            @endif


                                            @if ($userInfo->website != null)
                                                <p>
                                                    {{__("message.WebSite")}} : {{$userInfo->website}}
                                                </p>
                                            @endif



                                            @if ($userInfo->tel != null)
                                                <p>
                                                    {{__("message.Tel")}} : {{$userInfo->tel}}
                                                </p>
                                            @endif

                                            @if ($userInfo->profile != null)
                                                <p>
                                                    {{__("message.Profile")}} : {{$userInfo->profile}}
                                                </p>
                                            @endif









                                        </div>


                                        <div class="col-md-4 mt-md-0 mt-2">
                                            <h4>{{__('message.ChatHistory')}}</h4>
                                            <div class="scroll_box ChatsDiv" id="ChatsDiv" style="height: 460px;">

                                                @if(isset($Chat))
                                                    {{__('message.Loading')}}
                                                @endif




                                            </div>
                                            <div class="input-group mt-1">
                                                    <textarea type="text" class="form-control" aria-describedby="basic-addon2" id="myInput" rows="1"
                                                              name="Text" value="{{old('Text')}}"></textarea>
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="button" onclick="sendMessage()"> {{__('message.Send')}}</button>
                                                </div>
                                            </div>
                                        </div>


                                    @endif

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
    </body>



@section("js")


    <script>


        myInput.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                sendMessage()
                // Trigger the button element with a click
            }
        });




        var last_username = "";
        var field_html = "";





        @if (request()->input('CompanyID'))
        setInterval(GetMesage, 3000);



        function read_messages(BoothID, UserID ){


            $.get("{{route('Visitor.ChangeChatStatus')}}", {
                BoothID: BoothID,
                UserID: UserID
            },function (data){
            })

        }

        function sendMessage() {


            new_message = myInput.value
            myInput.value = ''
            const BoothID = {{request()->CompanyID}};
            const UserID = {{auth()->user()->id}};
            const url = '{{route('Visitor.InboxPost')}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: url,
                method: 'post',
                data: {
                    Text: new_message,
                    BoothID: {{request()->CompanyID}},
                    UserID: {{auth()->user()->id}},
                },
                success: function (data) {
                    console.dir(data)
                    $(".ChatsDiv").empty();
                    if (data["Chat"].length <= 0){
                        var fieldhtml = '{{__('message.NoMessageAvailable')}}';
                        $('.ChatsDiv').append(fieldhtml); //Add field html

                    }else {
                        for (var i = 0; i < data["Chat"].length; i++) {
                            if (data["Chat"][i]["Sender"] === 'Visitor') {
                                var fieldHTML = '<div class="row"><div class="col-3"></div><div class="col-8 bg-success mt-2 ml-3" style="border-radius: 5px;"><p class="nonoverflow">' + data['Chat'][i]['Text'] + '</p></div></div>';
                            } else {
                                var fieldHTML = '<div class="row"><div class="col-8 bg-primary mt-2 ml-3" style="border-radius: 5px;"><p class="nonoverflow">' + data['Chat'][i]['Text'] + '</p></div><div class="col-3"></div></div>';

                            }
                            $('.ChatsDiv').append(fieldHTML); //Add field html

                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    }
                }
            });

        }


        function GetMesage() {
            const BoothID = {{request()->CompanyID}};
            const UserID = {{auth()->user()->id}};
            read_messages(BoothID,UserID );
            $.get('{{route('Visitor.InboxGet')}}', {
                    BoothID: BoothID,
                    UserID: UserID,
                },
                function (data) {
                    $(".ChatsDiv").empty();
                    if (data["Chat"].length <= 0){
                        var fieldhtml = '{{__('message.NoMessageAvailable')}}';
                        $('.ChatsDiv').append(fieldhtml); //Add field html

                    }else {
                        for (var i = 0; i < data["Chat"].length; i++) {
                            if (data["Chat"][i]["Sender"] === 'Visitor') {
                                let time=data['Chat'][i]['created_at'];
                                let timeEdited = new Date(time);
                                timeEdited =timeEdited.toTimeString()
                                var sp = timeEdited.split(" ")
                                var fieldHTML = '<div class="row"><div class="col-3"></div><div class="col-8 bg-success mt-2 ml-3 p-1" style="border-radius: 5px;"><p class="" style="position: relative">' + data['Chat'][i]['Text'] + '<br><span style="position: absolute;right: 10px;bottom:-12px;font-size: 11px;">'+ sp[0] + '</span></p></div></div>';
                            } else {
                                let time=data['Chat'][i]['created_at'];
                                let timeEdited = new Date(time);
                                timeEdited =timeEdited.toTimeString()
                                var sp = timeEdited.split(" ")
                                var fieldHTML = '<div class="row"><div class="col-8 bg-primary mt-2 ml-3 p-1" style="border-radius: 5px;"><p class="" style="position: relative">' + data['Chat'][i]['Text'] + '<br><span style="position: absolute;right: 10px;bottom:-12px;font-size: 11px;">'+ sp[0] + '</span></p></div><div class="col-3"></div></div>';
                            }
                            $('.ChatsDiv').append(fieldHTML); //Add field html
                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    }
                });
        };
        @endif
    </script>

@endsection



@endsection
