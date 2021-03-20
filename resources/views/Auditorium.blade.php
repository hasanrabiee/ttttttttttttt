<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="_token" content="{{csrf_token()}}"/>
    <title>Amitiss</title>
    <script src="https://player.live-video.net/1.1.2/amazon-ivs-player.min.js"></script>

    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Bootstrap-Chat.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/iframe.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Search-Input-responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Table-With-Search-1-1.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/Table-With-Search-1.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/untitled.css')}}">


    <style>
        body {

            background-image: url("{{asset('assets/img/Auditorium.jpg')}}");
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

</head>

<body>
<div class="bootstrap_chat">
    <div class="container-fluid py-5 px-4">
        <!-- For demo purpose-->


        <div class="row rounded-lg overflow-hidden shadow">

            <!-- Chat Box-->
            <div class="col-md-5 px-0 pull-left">
                <div class="px-4 py-5 chat-box HoseinDiv" style="background-color: rgba(255,255,255,0.5);" id="sinsin">



                </div>

                <!-- Typing area -->
                <div class="input-group">
                    <input name="message" id="myInput" type="text" placeholder="Type a message"
                           aria-describedby="button-addon2"
                           class="form-control rounded-0 border-0 py-4 bg-light">
                    <div class="input-group-append">
                        <button aria-invalid="myBtn" onclick="sendMessage()" class="btn btn-link"><i
                                class="fa fa-paper-plane"></i></button>
                    </div>
                </div>

            </div>


            <div class="col-md-7 px-0 pull-right">
                <video id="video-player" class="el-player" style="width: 100%;height: 100%" playsinline
                       controls></video>

            </div>


        </div>
    </div>
</div>
<!-- sinsin JS -->

<!-- sinsin JS -->


<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>
<script src="{{asset('assets/js/bs-init.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{asset('assets/js/stylish-portfolio.js')}}"></script>
<script src="{{asset('assets/js/Table-With-Search-1.js')}}"></script>
<script>


    const playbackUrl =
        "{{\App\Site::find(1)->PlaybackUrl}}";
    const videoPlayer = document.getElementById("video-player");


    (function (IVSPlayer) {
        const PlayerState = IVSPlayer.PlayerState;
        const PlayerEventType = IVSPlayer.PlayerEventType;

        // Initialize player
        const player = IVSPlayer.create();
        player.attachHTMLVideoElement(videoPlayer);

        // Attach event listeners
        player.addEventListener(PlayerState.PLAYING, function () {
            console.log("Player State - PLAYING");
        });
        player.addEventListener(PlayerState.ENDED, function () {
            console.log("Player State - ENDED");
        });
        player.addEventListener(PlayerState.READY, function () {
            console.log("Player State - READY");
        });
        player.addEventListener(PlayerEventType.ERROR, function (err) {
            console.warn("Player Event - ERROR:", err);
        });


        // Setup stream and play
        player.setAutoplay(true);
        player.load(playbackUrl);

        // Setvolume
        player.setVolume(0.1);


    })(window.IVSPlayer);


</script>
<script>


    myInput.addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            // Cancel the default action, if needed
            sendMessage()
            // Trigger the button element with a click
        }
    });

    setInterval(GetMesage, 3000);

    $( document ).ready(function() {
        GetMesage()
    });

    function GetMesage(){

        $.get('/api/v1/AuditoriumChat/Get',{
                auditoriaID: "{{request()->segment(2)}}"
            },
            function (data, status) {
                $( ".HoseinDiv" ).empty();
                for (var i = 0; i < data["Chat"].length; i++) {
                    if (data["Chat"][i]["UserID"] === {{\Illuminate\Support\Facades\Auth::id()}}) {
                        var fieldHTML = '<div class="text-break media w-50 ml-auto mb-3 mymessage"><div class="media-body"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white">'+data["Chat"][i]["Text"]+'</p><i class="text-small mb-0 text-white">-' +  data["Chat"][i]["Username"] + '</i></div></div></div>';
                    }else {
                        var fieldHTML = '<div class="text-break media w-50 mb-3 mymessage"><div class="media-body ml-3"><div class="bg-light rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-muted">'+data["Chat"][i]["Text"] + '</p> <i class="text-small mb-0 text-muted">-' +  data["Chat"][i]["Username"] + '</i> </div></div></div>';
                    }
                    var objDiv = document.getElementById("sinsin");
                    objDiv.scrollTop = objDiv.scrollHeight;

                    $('.HoseinDiv').append(fieldHTML); //Add field html
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
            url: "{{route('Api.AudituriumPost')}}",
            method: 'post',
            data: {
                UserID: '{{\Illuminate\Support\Facades\Auth::id()}}',
                Username: '{{\Illuminate\Support\Facades\Auth::user()->UserName}}',
                auditoriaID: "{{request()->segment(2)}}",
                Text: new_message
            },
            success: function (data) {
                $( ".HoseinDiv" ).empty();
                for (var i = 0; i < data["Chat"].length; i++) {
                    if (data["Chat"][i]["UserID"] === {{\Illuminate\Support\Facades\Auth::id()}}){
                        var fieldHTML = '<div class="text-break media w-50 ml-auto mb-3 mymessage"><div class="media-body"><div class="bg-primary rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-white">'+data["Chat"][i]["Text"]+'</p><i class="text-small mb-0 text-white">-' +  data["Chat"][i]["Username"] + '</i></div></div></div>';
                    }else {
                        var fieldHTML = '<div class="text-break media w-50 mb-3 mymessage"><div class="media-body ml-3"><div class="bg-light rounded py-2 px-3 mb-2"><p class="text-small mb-0 text-muted">'+data["Chat"][i]["Text"] + '</p> <i class="text-small mb-0 text-muted">-' +  data["Chat"][i]["Username"] + '</i> </div></div></div>';
                    }
                    $('.HoseinDiv').append(fieldHTML); //Add field html

                    var objDiv = document.getElementById("sinsin");
                    objDiv.scrollTop = objDiv.scrollHeight;

                }
            }
        });


    }


</script>
</body>

</html>
