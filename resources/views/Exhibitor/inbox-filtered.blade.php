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


    @include("Sidebars.time")


{{--Modals--}}

    <div class="modal fade" role="dialog" tabindex="-1" id="filter">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-dark">Please Choose Your Items Which You Like To Be Filtered</h4>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">




                    <h6>
                        Gender
                    </h6>
                    @foreach(explode(',' , \App\Site::find(1)->VisitorGender) as $Gender)
                        <a href="?gender={{$Gender}}" class="btn btn-dark w-50 mb-2 btn-sm">
                            {{$Gender}}
                        </a>
                    @endforeach
                    <h6>
                        Profession
                    </h6>
                    @foreach(explode(',' , \App\Site::find(1)->VisitorProfession) as $profession)
                        <a href="?profession={{$profession}}" class="btn btn-dark w-50 mb-2 btn-sm">
                            {{$profession}}
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





{{--    /Modals--}}



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
        <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card p-3 card-inbox-ex-h" style="background-color:rgba(54,54,54,0.65);color: white;">
                            <div class="card-body py-0">
                                <div class="row">

                                    <div class="col-md-4" style="border: 1px solid white;border-radius: 5px; height: 600px;overflow-y: auto">


                                        <form action="{{route("Exhibitor.Inbox")}}" method="GET" class="w-100">
                                            <button class="btn btn-dark w-100 mt-2" type="button" onclick="$('#filter').modal('show')">Click to Choose Your Filter</button>
                                            <div class="input-group mt-2 mb-2">

                                                <input name="SearchTerm" type="text" class="form-control" placeholder="Search...">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit">Search</button>
                                                    <button  class="btn shadow-none" type="button"
                                                             style=""><i id="visiotr_refresh" class="fa fa-cog text-dark"
                                                                         style="font-size: 20px;"></i></button>
                                                </div>

                                            </div>
                                        </form>



                                        <div class="row">
                                            <div class="col-12">




                                                @foreach($Users as $user_one)


                                                    @if(request()->UserID == $user_one->id)


                                                        <div class="row">
                                                            <div class="col-9 w-100">
                                                                <a href="?UserID={{$user_one->id}}" class="btn btn-primary w-100 mb-2">
                                                                    {{\Illuminate\Support\Str::limit($user_one->UserName , 12)}}
                                                                </a>

                                                            </div>
                                                            <div class="col-3">
                                                                <button class=" btn btn-dark text-center border rounded-circle" type="button"
                                                                        style="width: 30px;margin-left: 10px;height: 28px;padding: 1px;margin-top: 3px;">
                                                                    {{\App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count()}}
                                                                </button>
                                                            </div>
                                                        </div>

                                                    @else

                                                        <div class="row">
                                                            <div class="col-9">
                                                                <a href="?UserID={{$user_one->id}}" class="text-white btn btn-outline-dark mb-2 w-100">
                                                                    {{\Illuminate\Support\Str::limit($user_one->UserName , 12)}}
                                                                </a>
                                                            </div>

                                                            <div class="col-3">
                                                                <button class=" btn @if (\App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count() > 0) btn-success @else btn-dark @endif text-center border rounded-circle" type="button"
                                                                        style="width: 30px;margin-left: 10px;height: 28px;padding: 1px;margin-top: 3px;">

                                                                    {{\App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count() == 0 ? '0' : \App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count()}}

                                                                </button>
                                                            </div>
                                                        </div>


                                                    @endif






                                                @endforeach





                                            </div>
                                        </div>
                                    </div>

                                    @if (request("UserID"))

                                        <div class="col-md-4" style="border: 2px solid white;border-radius: 5px;">
                                            <h3 class="text-white mb-2">Visitor Information</h3>
                                            <div class="text-center">
                                                <img src="{{\App\User::find(request("UserID"))->Image}}" style="width: 65px;margin: 0 auto"
                                                     class="text-center">

                                            </div>
                                            <p>{{__('message.UserName')}}: {{\App\User::find(request("UserID"))->UserName}}</p>
                                            <p>{{__('message.fn')}}: {{\App\User::find(request("UserID"))->FirstName}}</p>
                                            <p>{{__('message.ln')}}: {{\App\User::find(request("UserID"))->LastName}}</p>
                                            <p>{{__('message.Profession')}}: {{\App\User::find(request("UserID"))->Profession}}</p>
                                            <p>{{__('message.Gender')}}: {{\App\User::find(request("UserID"))->Gender}}</p>
                                            <p>
                                            <p class="text-left">Download CV : <a target="_blank" class="btn btn-primary"
                                                                                  href="{{\App\User::find(request("UserID"))->resume}}">Download</a>
                                            </p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="text-left">
                                                <strong>{{__('message.Messages')}}:
                                                    @if(request()->UserID)
                                                        {{\App\User::find(request()->UserID)->UserName}}
                                                    @endif
                                                </strong>
                                            </p>

                                            <div>
                                                <div class="scroll_box ChatsDiv" id="ChatsDiv" style="height: 460px;">


                                                    @if(isset($Chat))
                                                        {{__('message.Loading')}}
                                                    @else
                                                        @if(\Illuminate\Support\Facades\Auth::user()->ChatMode == 'Available')
                                                            {{__('message.PleaseSelectaChatFirst')}}
                                                        @else
                                                            {{__('message.MakeChatModeAvailable')}}
                                                        @endif
                                                    @endif


                                                </div>
                                            </div>
                                            <div
                                                @if(\Illuminate\Support\Facades\Auth::user()->ChatMode != 'Available') style="display: none" @endif>

                                                <div class="input-group mt-1">
                                                    <textarea type="text" class="form-control" aria-describedby="basic-addon2" id="myInput" rows="1"
                                                              name="Text" value="{{old('Text')}}"></textarea>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="button" onclick="sendMessage()"> {{__('message.Send')}}</button>
                                                    </div>
                                                </div>



                                                {{--                                                <input class="border rounded border-dark form-control d-inline" type="text"--}}
                                                {{--                                                       style="margin-right: 17px;width: 208px;"--}}
                                                {{--                                                       id="myInput"--}}
                                                {{--                                                       name="Text" value="{{old('Text')}}">--}}
                                                {{--                                                <button class="btn btn-success d-inline" onclick="sendMessage()"--}}
                                                {{--                                                        style="height: 36px;width: 103px;">--}}
                                                {{--                                                    {{__('message.Send')}}--}}
                                                {{--                                                </button>--}}
                                            </div>

                                            <div class="mt-3">
                                                <button
                                                    @if(\Illuminate\Support\Facades\Auth::user()->ChatMode == 'Available')  class="btn btn-dark"
                                                    disabled @else class="btn btn-success" @endif><a
                                                        href="@if(\Illuminate\Support\Facades\Auth::user()->ChatMode != 'Available') ?Mode=Available @else #  @endif"
                                                        class="text-light">{{__('message.ImAvailable')}}</a></button>
                                                <button @if(\Illuminate\Support\Facades\Auth::user()->ChatMode == 'Busy')   class="btn btn-dark"
                                                        disabled @else class="btn btn-danger" @endif><a
                                                        href=" @if(\Illuminate\Support\Facades\Auth::user()->ChatMode != 'Busy' ) ?Mode=Busy @else #  @endif"
                                                        class="text-light">{{__('message.ImBusy')}}</a></button>
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



@endsection
@section('js')
    <script>
        var scroll_status = false;

        var company_page = 1;
        var user_page = 1;
        function RefreshPage() {
            if (scroll_status == false) {
                $('#visiotr_refresh').trigger('click');
            }else {
                scroll_status = false;
            }
        }
        setInterval(RefreshPage, 10000);


        $( '#visiotr_refresh' ).click(function() {
            $( this ).addClass( 'fa-spin' );
            var $el = $(this);
            setTimeout(function() { $el.removeClass( 'fa-spin' ); }, 2000);
            reloadUsers()


        });
        function reloadUsers(){

            user_page = 1;
            $('#Users').empty()
            loadMoreDataUsers(user_page)



        }


        $(".scroll_box").on("scroll", function(){


            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                    user_page++;
                    $( '#visiotr_refresh' ).addClass( 'fa-spin' );
                    var $el = $('#visiotr_refresh');
                    setTimeout(function() { $el.removeClass( 'fa-spin' ); }, 2000);
                    loadMoreDataUsers(user_page);
                }
        });



        function loadMoreDataUsers(page){
            $.ajax(
                {
                    url: '?page=' + page @if(\request()->UserID) + '&UserID={{\request()->UserID}}' @endif,
                    type: "get",
                    beforeSend: function()
                    {
                        $('.ajax-load').show();
                    }
                })
                .done(function(data)
                {
                    if(data.users_list == " "){
                        $('.ajax-load').html("No more records found");
                        return;
                    }
                    $('.ajax-load').hide();
                    $("#Users").append(data.Users);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError)
                {
                    alert('server not responding...');
                });
        }


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





        @if (request()->input('UserID'))
        setInterval(GetMesage, 3000);



        function read_messages(BoothID, UserID ){


            $.get("{{route('Exhibitor.ChangeChatStatus')}}", {
                BoothID: BoothID,
                UserID: UserID
            },function (data){
            })

        }

        function sendMessage() {



            new_message = myInput.value
            myInput.value = ''
            const BoothID = {{$Booth->id}}
            const UserID = {{request()->UserID}};
            const Status= 'New';
            console.log(Status)
            const url = '{{route('Exhibitor.InboxPost')}}';
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
                    BoothID: BoothID,
                    UserID: UserID,
                    Status: Status
                },
                success: function (data) {
                    console.log(data)
                    $(".ChatsDiv").empty();
                    if (data["Chat"].length <= 0){
                        var fieldhtml = '{{__('message.NoMessageAvailable')}}';
                        $('.ChatsDiv').append(fieldhtml); //Add field html

                    }else {
                        for (var i = 0; i < data["Chat"].length; i++) {
                            if (data["Chat"][i]["Sender"] === 'Exhibitor') {


                                // <div class="col-8 bg-success mt-2 ml-3" style="border-radius: 5px;">
                                //     Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea, laudantium, voluptates. Adipisci aspernatur at commodi dolor et hic itaque odio provident quae, unde? Distinctio, est explicabo incidunt pariatur soluta totam.
                                // </div>
                                // <div class="col-3"></div>



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
            const BoothID = {{$Booth->id}}
            const UserID = {{request()->UserID}};

            read_messages(BoothID,UserID )


            $.get('{{route('Exhibitor.InboxGet')}}', {
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
                            if (data["Chat"][i]["Sender"] === 'Exhibitor') {
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
        }

        @endif





    </script>
@endsection
