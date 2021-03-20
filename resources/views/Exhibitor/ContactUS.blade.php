@extends('layouts.Panel')
@section('Head')
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


    <script>
        function exhibitorContactUsAjax(){
            $.get("{{route('Exhibitor.exhibitorContactUsAjax')}}", {

            },function (data){
            })
        }
        setInterval(exhibitorContactUsAjax,5000)
    </script>



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
        @include('Sidebars.exhibitor-sidebar')

        <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="row">
                            <div class="col-md-6" style="height: 600px !important;">
                                <div class="card w-100" style="background-color:#006B63;color: white;">
                                    <div class="card-body">
                                        <div class="row w-100">
                                            <div class="w-100">
                                                <div style="background-color:transparent;border: 1px solid transparent ;border-radius: 5px;" class="w-100">





                                                    <div class="scroll_box ChatsDiv w-100" id="ChatsDiv" style="background-color:transparent;border: 1px solid transparent ;height: 540px;border-radius: 5px;overflow-y: auto;overflow-x:hidden ">

                                                    </div>
                                                    <div class="input-group mt-1">
                                                        <textarea id="myInput"  name="Text" type="text" rows="1" class="form-control" aria-describedby="basic-addon2"></textarea>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success" type="button" onclick="sendMessage()">Send</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mt-3 mt-md-0">
                                    <div class="card" style="background-color:#006B63;color: white;height: 620px !important">
                                        <div class="card-body">
                                            <h3>{{__("message.ContactUs")}}</h3>
                                            <h4 class="ml-md-3 ml-2" style="">{{\App\Site::find(1)->Name}}</h4>
                                            <div class="row mt-md-5">
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">

                                                </div>
                                                <div class="col-md-3"></div>
                                                <div class="col-md-9">
                                                    <i class="fa fa-home" style="font-size: 24px !important;"></i><span class="ml-md-3 ml-2" style="font-size: 18px;">{{\App\Site::find(1)->AdminLocation}}</span>
                                                </div>
                                                <div class="col-md-3 mt-md-3 mt-1"></div>
                                                <div class="col-md-9 mt-md-3 mt-1">
                                                    <i class="fa fa-phone" style="font-size: 24px !important;"></i><span class="ml-md-3 ml-2" style="font-size: 18px;">{{\App\Site::find(1)->AdminTel}}</span>
                                                </div>
                                                <div class="col-md-3 mt-md-3 mt-1"></div>
                                                <div class="col-md-9 mt-md-3 mt-1">
                                                    <i class="fa fa-envelope" style="font-size: 24px !important;"></i><span class="ml-md-3 ml-2" style="font-size: 18px;">{{\App\Site::find(1)->AdminAddress}}</span>
                                                </div>
                                            </div>
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
        <!-- /main content -->
    </div>
    <!-- /page content -->
    </body>







@endsection

@section('js')
    <script>


        myInput.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                sendMessage()
                // Trigger the button element with a click
            }
        });


        myInput.addEventListener("keyup", function(event) {
            // Number 13 is the "Enter" key on the keyboard
            if (event.keyCode === 13) {
                // Cancel the default action, if needed
                sendMessage()
                // Trigger the button element with a click
            }
        });

        setInterval(GetMesage, 3000);

        function GetMesage() {

            $.get('{{route('Exhibitor.ChatGet')}}',
                function (data) {

                    $(".ChatsDiv").empty();
                    if (data["Chat"].length <= 0){
                        var fieldhtml = '{{__('message.NoMessageAvailable')}}';
                        $('.ChatsDiv').append(fieldhtml);

                    }else {

                        for (var i = 0; i < data["Chat"].length; i++) {
                            if (data["Chat"][i]["Sender"] === 'Exhibitor') {
                                let time=data['Chat'][i]['created_at'];
                                let timeEdited = new Date(time);
                                timeEdited =timeEdited.toTimeString()
                                var sp = timeEdited.split(" ")
                                var fieldHTML = '<div class="row"><div class="col-3" style=""></div><div class="col-8 bg-success mt-2 ml-3 p-1" style="border-radius: 5px;"><p class="" style="position: relative">' + data['Chat'][i]['Text'] + '<br><span style="position: absolute;right: 10px;bottom:-12px;font-size: 11px;">'+ sp[0] + '</span></p></div></div>';
                            } else {
                                let time=data['Chat'][i]['created_at'];
                                let timeEdited = new Date(time);
                                timeEdited =timeEdited.toTimeString()
                                var sp = timeEdited.split(" ")
                                var fieldHTML = '<div class="row"><div class="col-8 bg-primary mt-2 ml-3 p-1" style="border-radius: 5px;"><p class="" style="position: relative">' + data['Chat'][i]['Text'] + '<br><span style="position: absolute;right: 10px;bottom:-12px;font-size: 11px;">'+ sp[0] + '</span></p></div><div class="col-3" style=""></div></div>';
                            }
                            $('.ChatsDiv').append(fieldHTML); //Add field html

                            var objDiv = document.getElementById("ChatsDiv");
                            objDiv.scrollTop = objDiv.scrollHeight;
                        }
                    }
                });
        }

        function sendMessage() {


            new_message = myInput.value
            myInput.value = ''
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{route('Exhibitor.ChatAdmin')}}',
                method: 'post',
                data: {
                    Text: new_message
                },
                success: function (data) {
                    $(".ChatsDiv").empty();
                    for (var i = 0; i < data["Chat"].length; i++) {
                        if (data["Chat"][i]["Sender"] === 'Exhibitor') {
                            var fieldHTML = '<div class="row"><div class="col-3" style=""></div><div class="col-8 bg-success mt-2 ml-3 p-1" style="border-radius: 5px;"><p>' + data['Chat'][i]['Text'] + '</p></div></div>';
                        } else {
                            var fieldHTML = '<div class="row"><div class="col-8 bg-primary mt-2 ml-3 p-1" style="border-radius: 5px;"><p>' + data['Chat'][i]['Text'] + '</p></div><div class="col-3" style=""></div></div>';
                        }

                     $('.ChatsDiv').append(fieldHTML);
                        var objDiv = document.getElementById("ChatsDiv");
                        objDiv.scrollTop = objDiv.scrollHeight;
                    }
                }
            });

        }



        $(".remove_underline").hover(function (){


            if($(this).parent().hasClass('user_active_menu')){

                return;
            }else{

                $(this).parent().css('background-color', '#ffffff')
                $(this).css('color', '#000000')

            }


        }, function (){


            if($(this).parent().hasClass('user_active_menu')){

                return;
            }else{

                $(this).parent().css('background-color', '')
                $(this).css('color', '#ffffff')

            }



        })



    </script>

@endsection
