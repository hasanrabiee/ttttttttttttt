<!DOCTYPE html>
<html lang="{{\Illuminate\Support\Facades\App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>{{\App\Site::find(1)->Name}}</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
    <style>
        body{
            font-family: "Poppins" !important;
        }
    </style>
    @yield('Head')
</head>

<body id="page-top">

@yield('content')







    <div class="modal fade" id="ErrorModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Site Errors</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div
                    class="modal-body">


                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                            <div>{{$error}}</div>
                            <br>
                        @endforeach

                    @elseif(session('errors'))
                        {{session('errors')->first('msg')}}
                    @endif


                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>




<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{asset('assets/js/script.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://www.gstatic.com/firebasejs/8.2.10/firebase.js"></script>
<script>

    var firebaseConfig = {
        apiKey: "AIzaSyCMXujTAlzYgOH0-AjBte4db5CdTEL8bRs",
        authDomain: "amitiss-sinsin.firebaseapp.com",
        projectId: "amitiss-sinsin",
        storageBucket: "amitiss-sinsin.appspot.com",
        messagingSenderId: "305097980822",
        appId: "1:305097980822:web:557e23feea10296bd8fbb7",
        measurementId: "G-DH5MSZY0LT"
    };

    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function initFirebaseMessagingRegistration() {
        messaging
            .requestPermission()
            .then(function () {
                return messaging.getToken()
            })
            .then(function(token) {
                console.log(token);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route("save-token") }}',
                    type: 'POST',
                    data: {
                        token: token
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        alert('Notifications Enabled Successfully');
                    },
                    error: function (err) {
                        console.log('User Chat Token Error'+ err);
                    },
                });

            }).catch(function (err) {
            console.log('User Chat Token Error'+ err);
        });
    }

    messaging.onMessage(function(payload) {
        const noteTitle = payload.notification.title;
        const noteOptions = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(noteTitle, noteOptions);
    });

</script>
<script>

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
@yield('js')
    @if(session('errors'))
        @php
            $err = '';
                foreach ($errors->all() as $error) {
                    $err .= $error . '<br>';
                }
                    \RealRashid\SweetAlert\Facades\Alert::error($err)
        @endphp
        {{--<script type="text/javascript">
            $(window).on('load', function () {
                $('#ErrorModal').modal('show');
            });
        </script>--}}
    @endif
@include('sweetalert::alert')

</body>
</html>
