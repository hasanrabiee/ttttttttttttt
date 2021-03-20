@extends('layouts.Panel')
@section('Head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="_token" content="{{csrf_token()}}"/>
@endsection
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
                    <img class="float-right" src="{{\App\Site::find(1)->Logo3}}" style="width: 113px;margin-right: 34px;">
                @endif
            </div>
            <div style="width: 354px;height: 45px;background-color: #525252; margin-top: 70px" class="rounded">
                <div class="pull-right p-1">
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Change Language"
                            onclick="$('#Lang_Modal').modal('show')" class="btn btn-warning">
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
                                        <a style="text-decoration: none !important" class=""
                                           href="{{ url('locale/en') }}"><i
                                                class="fa fa-globe"></i>English</a><br>
                                        <a style="text-decoration: none !important" class=""
                                           href="{{ url('locale/de') }}"><i
                                                class="fa fa-globe"></i>German</a><br>
                                        <a style="text-decoration: none !important" class=""
                                           href="{{ url('locale/al') }}"><i
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
                    <button data-toggle="tooltip" data-placement="top" title="Logout"
                            onclick="document.getElementById('logout-form').submit()" class="btn btn-danger">
                        <i class="fa fa-sign-out"></i>
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
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
                        <h5 class="text-left"
                            style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>
                        <div class="text-left active-page"
                             style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;">
                            <a class="text-left" href="{{route('AdminOperator.index')}}"
                               style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;">
                            <a class="text-left" href="{{route('AdminOperator.History')}}"
                               style="color: #b3b8b8;">{{__('message.History')}}</a></div>
                        <div class="text-left"
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="{{route('AdminOperator.Lounge')}}"
                               style="color: #b3b8b8;">{{__('message.Lounge')}}</a></div>
                        <div class="text-left "
                             style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;">
                            <a class="text-left" href="#" style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>
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
                     style="width: 868px;height: 422px;background-color: rgba(168,168,168,0.84);padding: 7px;color: #363636;margin-left: 22px;">
                    <div id="company_box" class="border rounded d-inline float-left "
                         style="width: auto;;margin-top: 4px;" onscroll="is_typing = true;">
                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" method="get"
                              action="{{route('AdminOperator.index')}}">
                            <div class="form-group" style="width: 305px;">
                                <input class="form-control float-left" type="search"
                                       placeholder="{{__('message.Company')}} {{__('message.Name')}}"
                                       style="width: 163px;height: 33px;margin-bottom: 24px;font-size: 14px;"
                                       name="SearchTermBooth" value="{{request()->SearchTermBooth}}">
                                <button class="btn float-left shadow-none" type="button"
                                        style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;"><i
                                        id="company_refresh"
                                        class="fa fa-cog text-dark "
                                        style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i></button>
                            </div>
                        </form>
                        <div id="Companys" class="scroll_box" onscroll="scroll_status = true" onblur="scroll_status = false" style="height: 350px !important;">
                            @include("company-list-data")
                        </div>
                    </div>
                    <div id="user_box" class="border rounded d-inline float-left "
                         style="width: auto;height:422;margin-top: 4px;margin-right: 19px;margin-left: 13px;"
                         onscroll="is_typing = true;" >
                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" action="{{route('AdminOperator.index')}}">
                            <div class="form-group" style="width: 305px;"><input class="form-control float-left"
                                                                                 type="search"
                                                                                 placeholder="{{__('message.UserName')}}"
                                                                                 style="width: 163px;height: 33px;margin-bottom: 24px;font-size: 13px;" name="SearchTermUser">
                                <button class="btn float-left shadow-none" type="button"
                                        style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;"><i
                                        id="visiotr_refresh"
                                        class="fa fa-cog text-dark"
                                        style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i></button>
                            </div>
                        </form>
                        <div id="Users" class="scroll_box" onscroll="scroll_status = true" onblur="scroll_status = false" style="height: 350px !important;">
                            @include("user-list-data")
                        </div>
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
                        <div>
                            <div class="scroll_box ChatsDiv"
                                 style="height: 264px;margin-bottom: 11px;background-color: #edecec;" id="ChatsDiv" >
                                @if($Chats->count() == 0)
                                    {{__('message.NoMessageAvailable')}}
                                @else
                                    <p>Loading...</p>
                                @endif
                            </div>
                            @if(request()->CompanyID)
                                <input type="hidden" id="Mode" value="{{request()->CompanyID}}">
                            @elseif(request()->UserID)
                                <input type="hidden" id="Mode" value="{{request()->UserID}}">
                            @endif
                            <input class="border rounded border-dark form-control d-inline" type="text"
                                   style="margin-right: 17px;width: 208px;"
                                   id="myInput"
                                   name="Text" value="{{old('Text')}}">
                            <input type="hidden" name="Mode" id="MOOdee"
                                   value="@if(request()->CompanyID) Company @else User @endif">
                            <button class="btn btn-success d-inline" onclick="sendMessage()"
                                    style="height: 36px;width: 103px;">
                                {{__('message.Send')}}
                            </button>
                        </div>
                    @else
                        <p class="text-left"><strong>{{__('message.Messages')}}:</strong></p>
                        <div class="scroll_box" style="height: 264px;margin-bottom: 11px;background-color: #edecec;">
                            {{__('message.PleaseSelectaChatFirst')}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </header>
@endsection
@section('js')
    @if(request()->CompanyID || request()->UserID)

        <script>
            setInterval(GetMesage, 3000);

            function read_messages(ID) {
                $.get("{{route('AdminOperator.ChangeChatStatus')}}", {
                    ID: ID,
                    UserID: {{\Illuminate\Support\Facades\Auth::id()}}
                }, function (data) {
                })
            }

            function GetMesage() {
                var ID = document.getElementById('Mode').value;
                var Mode = document.getElementById('MOOdee').value;
                read_messages(ID)
                $.get('{{route('AdminOperator.InboxChatGet')}}', {
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
                                    var fieldHTML = '<div class="border rounded border-primary float-right nonoverflow scroll_box" style="height: 52px;width: 190px;margin-bottom: 17px;padding: 5px;background-color: #36ca5c;color: rgb(255,255,255);"><p class="nonoverflow">' + data['Chat'][i]['Text'] + '</p></div>';
                                } else {
                                    var fieldHTML = '<div class="border rounded border-primary float-left nonoverflow scroll_box" style="height: 52px;width: 210px;margin-bottom: 9px;padding: 8px;background-color: #0c82fe;"><p class="nonoverflow" style="color: rgb(255,255,255);">' + data['Chat'][i]['Text'] + '</p></div>';
                                }
                                $('.ChatsDiv').append(fieldHTML); //Add field html
                            }
                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    });
            }

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
                var url = '{{route('AdminOperator.SendMessage')}}';
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
                                var fieldHTML = '<div class="border rounded border-primary float-right nonoverflow scroll_box" style="height: 52px;width: 190px;margin-bottom: 17px;padding: 5px;background-color: #36ca5c;color: rgb(255,255,255);"><p class="nonoverflow">' + data['Chat'][i]['Text'] + '</p></div>';
                            } else {
                                var fieldHTML = '<div class="border rounded border-primary float-left nonoverflow scroll_box" style="height: 52px;width: 210px;margin-bottom: 9px;padding: 8px;background-color: #0c82fe;"><p class="nonoverflow" style="color: rgb(255,255,255);">' + data['Chat'][i]['Text'] + '</p></div>';
                            }


                            $('.ChatsDiv').append(fieldHTML);
                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
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
            $('#Users').empty()
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

