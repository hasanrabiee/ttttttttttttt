@extends('layouts.Panel')
@section('Head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="_token" content="{{csrf_token()}}"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset("css/hasan-custom.css")}}" type="text/css">

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

{{--    <script>--}}
{{--        function visitorContactUsAjax(){--}}
{{--            $.get("{{route('Visitor.visitorContactUsAjax')}}", {--}}

{{--            },function (data){--}}
{{--            })--}}
{{--        }--}}
{{--    </script>--}}


@endsection
@section('content')


    {{--    Hasan start here !!!!--}}
    <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">

    <!-- Page content -->
    <div class="page-content pt-0 mt-3">
    @include("Sidebars.admin-sidebar")

    <!-- Main content -->
        <div class="content-wrapper">


            <!-- Content area -->
            <div class="content">


                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card p-3 card-admin" style="background-color:#006B63;color: white">
                            <div class="card-body py-0">
                                <h3>Visitor Inbox</h3>
                                <div class="row">
                                    <div class="col-md-4" style="border: 1px solid white;border-radius: 5px;height: 950px;">

                                        <form action="{{route('Admin.VisitorInbox')}}" class="w-100">
                                            <div class="input-group mt-2 mb-2">
                                                <input type="text" class="form-control" placeholder="{{__('message.UserName')}}" name="SearchTermUser">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit">Search</button>
                                                    <button  class="btn shadow-none" type="button"
                                                             style=""><i id="visiotr_refresh"
                                                                         class="fa fa-cog text-dark"
                                                                         style="font-size: 20px;"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                        <div id="Users" class="scroll_box" onscroll="scroll_status = true" onblur="scroll_status = false" style="height: 430px !important;">
                                            @include("user-list-data")
                                        </div>
                                        <br>
                                    </div>
                                    @if (request()->UserID)
                                        <div class="col-md-4" style="border: 1px solid white;border-radius: 5px;height: 950px;">
                                            <div class="mt-2">
                                                <h3>{{\App\User::find(request()->UserID)->UserName}} Information</h3>
                                                <div class="text-center">
                                                    <img src="{{\App\User::find(request()->UserID)->Image}}" alt="" style="width: 50px;height: 50px;border-radius: 50%">
                                                </div>
                                                <p class="font-size-lg"><strong>{{__("message.fn")}}:</strong>{{\App\User::find(request()->UserID)->FirstName}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.ln")}}:</strong>{{\App\User::find(request()->UserID)->LastName}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.Gender")}}:</strong>{{\App\User::find(request()->UserID)->Gender}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.Profession")}}:</strong>{{\App\User::find(request()->UserID)->Profession}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.City")}}:</strong>{{\App\User::find(request()->UserID)->City}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.Country")}}:</strong>{{\App\User::find(request()->UserID)->Country}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.Email")}}:</strong>{{\App\User::find(request()->UserID)->email}}</p>
                                                <p class="font-size-lg"><strong>{{__("message.FeedBack")}}:</strong>{{\App\User::find(request()->UserID)->VisitExperience}}</p>


                                                @if (\App\User::find(request()->UserID)->education != null)
                                                    <p>
                                                        {{__("message.Education")}} : {{\App\User::find(request()->UserID)->education}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->countyStudy != null)
                                                    <p>
                                                        {{__("message.CountryStudy")}} : {{\App\User::find(request()->UserID)->countyStudy}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->InterestedDegree != null)
                                                    <p>
                                                        {{__("message.InterestedDegree")}} : {{\App\User::find(request()->UserID)->InterestedDegree}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->InterestedField != null)
                                                    <p>
                                                        {{__("message.InterestedField")}}: {{\App\User::find(request()->UserID)->InterestedField}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->languageOfStudy != null)
                                                    <p>
                                                        {{__("message.LanguageOfStudy")}} : {{\App\User::find(request()->UserID)->languageOfStudy}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->onlineDegreeProgram != null)
                                                    <p>

                                                        {{__("message.OnlineDegreeProgram")}} : {{\App\User::find(request()->UserID)->onlineDegreeProgram}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->interestedScholarShip != null)
                                                    <p>
                                                        {{__("message.InterestedScholarShip")}} : {{\App\User::find(request()->UserID)->interestedScholarShip}}
                                                    </p>
                                                @endif


                                                @if (\App\User::find(request()->UserID)->currentLevelOfEducation != null)
                                                    <p>
                                                        {{__("message.CurrentLevelOfEducation")}} : {{\App\User::find(request()->UserID)->currentLevelOfEducation}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->position != null)
                                                    <p>
                                                        {{__("message.Position")}} : {{\App\User::find(request()->UserID)->currentLevelOfEducation}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->admissionSemester != null)
                                                    <p>
                                                        {{__("message.AdmissionSemester")}} : {{\App\User::find(request()->UserID)->admissionSemester}}
                                                    </p>
                                                @endif


                                                @if (\App\User::find(request()->UserID)->professionInterestedToApply != null)
                                                    <p>
                                                        {{__("message.ProfessionInterestedToApply")}} : {{\App\User::find(request()->UserID)->professionInterestedToApply}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->organization != null)
                                                    <p>
                                                        {{__("message.Organization")}} : {{\App\User::find(request()->UserID)->organization}}
                                                    </p>
                                                @endif


                                                @if (\App\User::find(request()->UserID)->InterNationalPrograms != null)
                                                    <p>
                                                        {{__("message.InternationalPrograms")}} : {{\App\User::find(request()->UserID)->InterNationalPrograms}}
                                                    </p>
                                                @endif


                                                @if (\App\User::find(request()->UserID)->website != null)
                                                    <p>
                                                        {{__("message.WebSite")}} : {{\App\User::find(request()->UserID)->website}}
                                                    </p>
                                                @endif



                                                @if (\App\User::find(request()->UserID)->tel != null)
                                                    <p>
                                                        {{__("message.Tel")}} : {{\App\User::find(request()->UserID)->tel}}
                                                    </p>
                                                @endif

                                                @if (\App\User::find(request()->UserID)->profile != null)
                                                    <p>
                                                        {{__("message.Profile")}} : {{\App\User::find(request()->UserID)->profile}}
                                                    </p>
                                                @endif


                                            </div>
                                        </div>
                                    @endif
                                    @if(request()->UserID)
                                        <div class="col-md-4">
                                            <h4>
                                                <strong>{{__('message.Messages')}}:
                                                    @if(request()->UserID)
                                                        {{\App\User::find(request()->UserID)->UserName}}
                                                    @endif
                                                </strong>
                                            </h4>
                                            <div style="background-color:transparent;border: 1px solid transparent ;height: 450px;border-radius: 5px;overflow-x:hidden ">

                                                <div>
                                                    <div class="scroll_box ChatsDiv" id="ChatsDiv">
                                                        @if($Chats->count() == 0)
                                                            {{__('message.NoMessageAvailable')}}
                                                        @else
                                                            <p>Loading...</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                @if(request()->CompanyID)
                                                    <input type="hidden" id="Mode" value="{{request()->CompanyID}}">
                                                @elseif(request()->UserID)
                                                    <input type="hidden" id="Mode" value="{{request()->UserID}}">
                                                @endif
                                                <textarea class="form-control" type="text"
                                                          id="myInput"
                                                          name="Text" value="{{old('Text')}}"></textarea>
                                                <input type="hidden" name="Mode" id="MOOdee"
                                                       value="@if(request()->CompanyID) Company @else User @endif">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" onclick="sendMessage()">
                                                        {{__('message.Send')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                                @endif
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
@section('js')
    @if(request()->CompanyID || request()->UserID)

        <script>
            setInterval(GetMesage, 3000);

            function read_messages() {
                console.log("test")
                var ID = document.getElementById('Mode').value;
                console.log("tessst");
                $.get("{{route('Admin.ChangeChatStatus')}}", {
                    ID: ID,
                    UserID: {{\Illuminate\Support\Facades\Auth::id()}}
                }, function (data) {
                })
            }

            setInterval(read_messages,10000)



            myInput.addEventListener("keyup", function (event) {
                // Number 13 is the "Enter" key on the keyboard
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    sendMessage()
                    // Trigger the button element with a click
                }
            });

            function sendMessage() {
                new_message = myInput.value
                myInput.value = ''
                var ID = document.getElementById('Mode').value;
                var Mode = document.getElementById('MOOdee').value;
                var url = '{{route('Admin.SendMessage')}}';
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
                        Mode: Mode,
                        UserID: {{\Illuminate\Support\Facades\Auth::id()}},
                        ID: ID
                    },
                    success: function (data) {
                        $(".ChatsDiv").empty();
                        for (var i = 0; i < data["Chat"].length; i++) {

                            if (data["Chat"][i]["Sender"] === {{\Illuminate\Support\Facades\Auth::id()}}) {
                                var fieldHTML = '<div class="row"><div class="col-3"></div><div class="col-8 bg-success mt-2 ml-3" style="border-radius: 5px;"><p class="">' + data['Chat'][i]['Text'] + '</p></div></div>';
                            } else {
                                var fieldHTML = '<div class="row"><div class="col-8 bg-primary mt-2 ml-3" style="border-radius: 5px;"><p class="">' + data['Chat'][i]['Text'] + '</p></div><div class="col-3"></div></div>';
                            }


                            $('.ChatsDiv').append(fieldHTML);
                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    }
                });
            }

            function GetMesage() {
                var ID = document.getElementById('Mode').value;
                var Mode = document.getElementById('MOOdee').value;
                // read_messages(ID)
                $.get('{{route('Admin.InboxChatGet')}}', {
                        Mode: Mode,
                        ID: ID,
                        UserID: {{\Illuminate\Support\Facades\Auth::id()}}
                    },
                    function (data) {
                        $(".ChatsDiv").empty();
                        if (data["Chat"].length <= 0) {
                            var fieldhtml = '{{__('message.NoMessageAvailable')}}';
                            $('.ChatsDiv').append(fieldhtml); //Add field html
                        } else {
                            for (var i = 0; i < data["Chat"].length; i++) {
                                if (data["Chat"][i]["Sender"] === 'Admin') {
                                    let time=data['Chat'][i]['created_at'];

                                    let timeEdited = new Date(time);
                                    timeEdited =timeEdited.toTimeString()
                                    var sp = timeEdited.split(" ")
                                    // console.log(sp[0])



                                    var fieldHTML = '<div class="row"><div class="col-3"></div><div class="col-8 bg-success mt-2 ml-3 p-1" style="border-radius: 5px;"><p class="" style="position: relative">' + data['Chat'][i]['Text'] + '<br><span style="position: absolute;right: 10px;bottom:-12px;font-size: 11px;">'+ sp[0] + '</span></p></div></div>';
                                    console.log(typeof sp[0])
                                } else {
                                    let time=data['Chat'][i]['created_at'];

                                    let timeEdited = new Date(time);
                                    timeEdited =timeEdited.toTimeString()
                                    var sp = timeEdited.split(" ")
                                    var fieldHTML = '<div class="row"><div class="col-8 bg-primary mt-2 ml-3 p-1" style="border-radius: 5px;"><p class="">' + data['Chat'][i]['Text'] + '<br><span style="position: absolute;right: 10px;bottom:0px;font-size: 11px;">'+ sp[0] + '</span></p></div></div>';
                                    ;
                                }
                                $('.ChatsDiv').append(fieldHTML); //Add field html
                            }
                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    });
            }
        </script>

    @endif
    <script>
        var company_page = 1;
        var user_page = 1;
        var scroll_status = false;

        function RefreshPage() {
            if (scroll_status == false) {
                $('#visiotr_refresh').trigger('click');
                $('#company_refresh').trigger('click');
            }else {
                scroll_status = false;
            }
        }
        setInterval(RefreshPage, 10000);
        $('#visiotr_refresh').click(function () {
            $(this).addClass('fa-spin');
            var $el = $(this);
            setTimeout(function () {
                $el.removeClass('fa-spin');
            }, 2000);
            reloadUsers()
        });
        $('#company_refresh').click(function () {
            $(this).addClass('fa-spin');
            var $el = $(this);
            setTimeout(function () {
                $el.removeClass('fa-spin');
            }, 2000);
            reloadCompanies()
        });
        function reloadUsers() {
            user_page = 1;
            $('#Users').empty();
            loadMoreDataUsers(user_page)
        }
        function reloadCompanies() {
            company_page = 1;
            $('#Companys').empty()
            loadMoreDataCompanys(company_page)
        }


        $(".scroll_box").on("scroll", function () {


            if ($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {


                if ($(this).attr("id") == "Companys") {

                    company_page++;

                    $('#company_refresh').addClass('fa-spin');
                    var $el = $('#company_refresh');
                    setTimeout(function () {
                        $el.removeClass('fa-spin');
                    }, 2000);

                    loadMoreDataCompanys(company_page);


                }

                if ($(this).attr("id") == "Users") {

                    user_page++;
                    $('#visiotr_refresh').addClass('fa-spin');
                    var $el = $('#visiotr_refresh');
                    setTimeout(function () {
                        $el.removeClass('fa-spin');
                    }, 2000);

                    loadMoreDataUsers(user_page);

                }


            }


        });


        function loadMoreDataUsers(page) {
            $.ajax(
                {
                    url: '?page=' + page @if(\request()->UserID) + '&UserID={{\request()->UserID}}' @endif,
                    type: "get",
                    beforeSend: function () {
                        $('.ajax-load').show();
                    }
                })
                .done(function (data) {
                    if (data.users_list == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    console.log(data.users_list)
                    $("#Users").append(data.users_list);
                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }


        function loadMoreDataCompanys(page) {
            $.ajax(
                {
                    url: '?page=' + page @if(\request()->CompanyID) + '&CompanyID={{\request()->CompanyID}}' @endif ,
                    type: "get",
                    beforeSend: function () {
                        $('.ajax-load').show();
                    }
                })
                .done(function (data) {
                    if (data.booth_list == " ") {
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#Companys").append(data.booth_list);

                })
                .fail(function (jqXHR, ajaxOptions, thrownError) {
                    alert('server not responding...');
                });
        }


    </script>



@endsection

