<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Amitiss</title>
    <script src="https://player.live-video.net/1.1.2/amazon-ivs-player.min.js"></script>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="assets/css/Bootstrap-Chat.css">
    <link rel="stylesheet" href="assets/css/iframe.css">
    <link rel="stylesheet" href="assets/css/Search-Input-responsive.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-1-1.css">
    <link rel="stylesheet" href="assets/css/Table-With-Search-1.css">
    <link rel="stylesheet" href="assets/css/untitled.css">


    <style>
        body {

            background-image: url("{{asset('assets/img/Auditorium.png')}}");
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
                <div class="px-4 py-5 chat-box " style="background-color: rgba(255,255,255,0.5);"  id="sinsin">
                    <!-- Sender Message-->
                    <div class="media w-50 mb-3" ><img
                            src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user"
                            width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-muted">Test which is a new approach all solutions</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div>

                    <!-- Reciever Message-->
                    <div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-white">Test which is a new approach to have all
                                    solutions</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div>

                    <!-- Sender Message-->
                    <div class="media w-50 mb-3"><img
                            src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user"
                            width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-muted">Test, which is a new approach to have</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div>


                    <!-- Reciever Message-->
                    <div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div>

                    <!-- Sender Message-->
                    <div class="media w-50 mb-3"><img
                            src="https://res.cloudinary.com/mhmd/image/upload/v1564960395/avatar_usae7z.svg" alt="user"
                            width="50" class="rounded-circle">
                        <div class="media-body ml-3">
                            <div class="bg-light rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-muted">Test, which is a new approach</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div>

                    <!-- Reciever Message-->
                    <div class="media w-50 ml-auto mb-3">
                        <div class="media-body">
                            <div class="bg-primary rounded py-2 px-3 mb-2">
                                <p class="text-small mb-0 text-white">Apollo University, Delhi, India Test</p>
                            </div>
                            <p class="small text-muted">12:00 PM | Aug 13</p>
                        </div>
                    </div>

                </div>

                <!-- Typing area -->
                <form action="#send_message" class="bg-light">
                    <div class="input-group" >
                        <input name="message"  type="text" placeholder="Type a message" aria-describedby="button-addon2"
                               class="form-control rounded-0 border-0 py-4 bg-light">
                        <div class="input-group-append">
                            <button id="button-addon2" type="submit" class="btn btn-link"><i
                                    class="fa fa-paper-plane"></i></button>
                        </div>
                    </div>
                </form>

            </div>








            <div class="col-md-7 px-0 pull-right">
                <video id="video-player"  class="el-player" style="width: 100%;height: 100%"  playsinline controls></video>

            </div>







        </div>
    </div>
</div>
<!-- sinsin JS -->
<script>
    var objDiv = document.getElementById("sinsin");
    objDiv.scrollTop = objDiv.scrollHeight;
</script>
<!-- sinsin JS -->



<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/bs-init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="assets/js/stylish-portfolio.js"></script>
<script src="assets/js/Table-With-Search-1.js"></script>
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
</body>

</html>
