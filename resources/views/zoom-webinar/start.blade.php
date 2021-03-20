<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Join Zoom Webinar</title>
        <meta charset="utf-8" />
        <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.0/css/bootstrap.css" />
        <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.9.0/css/react-select.css"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>


<body class="ReactModal__Body--open">


    <input type="hidden" id="role" value="{{ \request()->role ?? $role }}">
    @if(\Illuminate\Support\Facades\Session::get('Speaker') != null )
        <input type="hidden" id="user_name" value="Speaker_{{ \App\Speaker::find(\Illuminate\Support\Facades\Session::get('Speaker')->id)->nickname  }}">

    @elseif (\Illuminate\Support\Facades\Auth::user()->Rule == 'Admin')
        <input type="hidden" id="user_name" value="Speaker_WebsiteAdmin">

    @else
        <input type="hidden" id="user_name" value="Attendee_{{ @\Illuminate\Support\Facades\Auth::User()->UserName}}">


    @endif

    <input type="hidden" id="meeting_id" value="{{$webinar->webinar_id}}">
    <input type="hidden" id="meeting_password" value="{{$webinar->webinar_password}}">
    <input type="hidden" id="zoom_api_key" value="{{env('ZOOM_CLIENT_KEY')}}">
    <input type="hidden" id="zoom_api_secret" value="{{env('ZOOM_CLIENT_SECRET')}}">


    <div id="zmmtg-root"></div>
    <div id="aria-notify-area"></div>
      <!-- import ZoomMtg dependencies -->
    <script src="https://source.zoom.us/1.9.0/lib/vendor/react.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/react-dom.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/redux.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/redux-thunk.min.js"></script>
    <script src="https://source.zoom.us/1.9.0/lib/vendor/lodash.min.js"></script>

    <!-- import ZoomMtg -->
    <script src="https://source.zoom.us/zoom-meeting-1.9.0.min.js"></script>

    <script src="https://source.zoom.us/1.8.3/lib/vendor/jquery.min.js"></script>




    <script type="text/javascript">

    $(document).ready(function(){
        ZoomMtg.setZoomJSLib('https://dmogdx0jrul3u.cloudfront.net/1.9.0/lib', '/av');
        ZoomMtg.preLoadWasm();
        ZoomMtg.prepareJssdk();

        const role = document.getElementById("role");
        const zoomMeeting = document.getElementById("zmmtg-root");
        const user_name = document.getElementById("user_name");
        const meeting_id = document.getElementById('meeting_id');
        const meeting_password = document.getElementById("meeting_password");
        const zoom_api_key = document.getElementById("zoom_api_key");
        const zoom_api_secret = document.getElementById("zoom_api_secret");
        const prev_url = document.referrer;
        const userName = document.getElementById("user_name");

        const signature = ZoomMtg.generateSignature({
            meetingNumber: meeting_id.value,
            apiKey: zoom_api_key.value,
            apiSecret: zoom_api_secret.value,
            role: role.value,
            success: function (res) {
            console.log(res.result);
            },
        });
        ZoomMtg.init({


            leaveUrl: `{{\Illuminate\Support\Facades\URL::to('/')}}`,


            isSupportAV: true,
            isSupportChat: true,
            success: function (res) {
                ZoomMtg.join(
                    {
                        meetingNumber: meeting_id.value,
                        userName: userName.value,
                        userEmail : '{{$role == 1 ? env('WEBINAR_MAIL') : \Illuminate\Support\Facades\Auth::user()->email}}',
                        signature: signature,
                        apiKey: zoom_api_key.value,
                        passWord: meeting_password.value,
                        success: function(res){

                            $('#nav-tool').hide();
                            console.log('join webinar success');
                        },
                        error: function(res) {
                            console.log(res);
                        }
                    }
                );
            },
            error: function(res) {

                console.log(res);
            }
        });

        ZoomMtg.endMeeting({
            success:() => {
                console.log('a')
            }
        });

        ZoomMtg.leaveMeeting({
            success:() => {
                console.log('b')
            }
        });
        });





    </script>




</body>
</html>
