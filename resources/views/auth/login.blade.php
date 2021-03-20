<?php



?>
@extends('layouts.app')
    <!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset("css/hasan-custom.css")}}">
    <style>
        body {
            height: 100%;
            /*background: #333;*/
            font-family: sans-serif;
        }

        .flipper {
            color: white;
            display: block;
            font-size: 50px;
            line-height: 100%;
            padding: 0;
            margin: 0;
            height: 1.7em;
        }
        .flipper.flipper-invisible {
            font-size: 0px !important;
        }

        .flipper-group {
            position: relative;
            white-space: nowrap;
            display: block;
            float: left;
            padding: 0;
            margin: 0;
        }
        .flipper-group label {
            position: absolute;
            color: black;
            font-size: 20%;
            top: 100%;
            line-height: 1em;
            left: 50%;
            -webkit-transform: translate(-50%, 0);
            transform: translate(-50%, 0);
            text-align: center;
            padding-top: .5em;
        }

        .flipper-digit {
            white-space: nowrap;
            position: relative;
            padding: 0;
            margin: 0;
            display: inline-block;
            float: left;
            height: 1.2em;
            overflow-y: hidden;
        }
        .flipper-digit span {
            font-size: 25%;
        }

        .flipper-delimiter {
            white-space: nowrap;
            display: block;
            float: left;
            padding: 0;
            margin: 0;
            color: black;
            min-width: .1em;
            white-space: nowrap;
            display: block;
            padding-top: 0.1em;
            padding-bottom: 0.1em;
            line-height: 1em;
        }

        .digit-face {
            display: block;
            visibility: hidden;
            position: relative;
            border-radius: 0.1em;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 8;
            padding-top: 0.1em;
            padding-bottom: 0.1em;
            padding-left: 0.1em;
            padding-right: 0.1em;
            box-sizing: border-box;
            text-align: center;
        }

        .digit-next {
            display: block;
            position: relative;
            border-radius: 0.1em;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 8;
            height: 1.2em;
            background: black;
            padding-top: 0.1em;
            padding-bottom: 0.1em;
            padding-left: 0.1em;
            padding-right: 0.1em;
            box-sizing: border-box;
            text-align: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .digit-top {
            z-index: 10;
            top: 0;
            left: 0;
            right: 0;
            height: 50%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            pointer-events: none;
            overflow: hidden;
            position: absolute;
            background: black;
            padding-top: 0.1em;
            padding-bottom: 0;
            padding-left: 0.1em;
            padding-right: 0.1em;
            border-top-left-radius: 0.1em;
            border-top-right-radius: 0.1em;
            box-sizing: border-box;
            text-align: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: background 0s linear, -webkit-transform 0s linear;
            transition: transform 0s linear, background 0s linear;
            transition: transform 0s linear, background 0s linear, -webkit-transform 0s linear;
            -webkit-transform-origin: 0 0.6em 0 !important;
            transform-origin: 0 0.6em 0 !important;
            -webkit-transform-style: preserve-3d !important;
            transform-style: preserve-3d !important;
            z-index: 20;
        }
        .digit-top.r {
            transition: background 0.2s linear, -webkit-transform 0.2s linear;
            transition: transform 0.2s linear, background 0.2s linear;
            transition: transform 0.2s linear, background 0.2s linear, -webkit-transform 0.2s linear;
            -webkit-transform: rotateX(90deg);
            transform: rotateX(90deg);
            background: black;
        }

        .digit-top2 {
            visibility: hidden;
            position: absolute;
            height: 50%;
            left: 0;
            right: 0;
            background: black;
            transition: -webkit-transform 0.2s linear;
            transition: transform 0.2s linear;
            transition: transform 0.2s linear, -webkit-transform 0.2s linear;
            line-height: 0em !important;
            top: 50% !important;
            bottom: auto !important;
            padding-top: 0;
            padding-bottom: 0.1em;
            padding-left: 0.1em;
            padding-right: 0.1em;
            border-bottom-left-radius: 0.1em;
            border-bottom-right-radius: 0.1em;
            overflow: hidden;
            text-align: center;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            transition: background 0s linear, -webkit-transform 0s linear;
            transition: transform 0s linear, background 0s linear;
            transition: transform 0s linear, background 0s linear, -webkit-transform 0s linear;
            -webkit-transform: rotateX(-90deg);
            transform: rotateX(-90deg);
            -webkit-transform-style: preserve-3d !important;
            transform-style: preserve-3d !important;
            -webkit-transform-origin: 0 0 0 !important;
            transform-origin: 0 0 0 !important;
            z-index: 20;
        }
        .digit-top2.r {
            visibility: visible;
            transition: background 0.2s linear 0.2s, -webkit-transform 0.2s linear 0.2s;
            transition: transform 0.2s linear 0.2s, background 0.2s linear 0.2s;
            transition: transform 0.2s linear 0.2s, background 0.2s linear 0.2s, -webkit-transform 0.2s linear 0.2s;
            -webkit-transform: rotateX(0deg);
            transform: rotateX(0deg);
            background: black;
        }

        .digit-bottom {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            pointer-events: none;
            position: absolute;
            overflow: hidden;
            background: black;
            height: 50%;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 9;
            line-height: 0em;
            padding-top: 0;
            padding-bottom: 0.1em;
            padding-left: 0.1em;
            padding-right: 0.1em;
            border-bottom-left-radius: 0.1em;
            border-bottom-right-radius: 0.1em;
            box-sizing: border-box;
            text-align: center;
            transition: none;
        }
        .digit-bottom.r {
            transition: background 0.2s linear;
            background: black;
        }

        .flipper-digit:after {
            content: "";
            position: absolute;
            height: 2px;
            background: rgba(0, 0, 0, 0.5);
            top: 50%;
            display: block;
            z-index: 30;
            left: 0;
            right: 0;
        }

        .flipper-dark {
            color: #fff;
        }
        .flipper-dark .flipper-delimiter {
            color: #333;
        }
        .flipper-dark .digit-next {
            background: #333;
        }
        .flipper-dark .digit-top {
            background: #333;
        }
        .flipper-dark .digit-top.r {
            background: black;
        }
        .flipper-dark .digit-top2 {
            background: black;
        }
        .flipper-dark .digit-top2.r {
            background: #333;
        }
        .flipper-dark .digit-bottom {
            background: #333;
        }

        .flipper-dark-labels .flipper-group label {
            color: #333;
        }

    </style>

    {{--before token--}}

    @if (request("token") == "f768bedb687e3d62675d1e956c8caac1e9842cad85db6e24a0ccc371fa166011asasas")


        <script>






            <?php
            $t = $_GET["ptoken"];
            $password = \Illuminate\Support\Facades\Cache::get($t);

            ?>



            $.getJSON("https://api.ipify.org?format=json",
                function(data) {

                    $("#gfg").html(data.ip);
                    const ip = data.ip;
                    function test(){
                        console.log("test");


                        let use = '{{\Illuminate\Support\Facades\Cache::get("username")}}';
                        let app_token = "<?php echo $t?>";
                        $.get('{{route("Api.autoLoginApp")}}', {
                                UserIP:ip,
                                app_token:app_token
                            },
                            function (data) {

                                const password = '<?php echo $password["Password"]; ?>';
                                const username = '<?php echo $password["Username"]; ?>';
                                console.log(password);
                                console.log(data);
                                console.log(data["UserName"]);
                                $("#username").val(username);
                                $("#password").val(password);
                                $("#submit").trigger("click");



                                // $.get("http://192.168.1.125:8000/api/v1/autoLoginAppDestroy", {
                                //
                                // },function (data){
                                // })

                            });

                    }

                    setInterval(test(),2000)


                })










            $.getJSON("https://api.ipify.org?format=json",
                function(data) {
                    $("#gfg").html(data.ip);
                    const ip = data.ip;
                    console.log(ip);






                }
            )







        </script>

    @endif



</head>

<body class="h-100 w-100 overflow" style="overflow-x:hidden !important;width:100% !important ; height:100% !important;background-size: cover;background-repeat:no-repeat;background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/poster.jpg')}}@endif">
<p id="gfg">

</p>

{{--    {{dd(\Illuminate\Support\Facades\Cache::get("username"))}}--}}

<div>
    <div class="row mt-md-3">
        <div class="col-7 col-md-10">
        </div>
        <div class="col-5 col-md-2">
            <a class="" href="{{ url('locale/en') }}"><i
                    class="ml-2"></i>En</a>
            <a class="" href="{{ url('locale/de') }}"><i
                    class="ml-2"></i>Ge</a>
            <a class="" href="{{ url('locale/al') }}"><i
                    class="ml-2"></i>Al</a>
        </div>
    </div>
    <div class="container text-center pt-5 pb-5">

        <div class="row">

        </div>


        <div class="row">
            <div class="col-md-12 text-center mb-2">
                <p class="text-title text-center ">
                    {{\App\Site::find(1)->ExhabitionTitle}}
                </p>
            </div>
            <div class="col-md-4">
                <p class="text-title">
                    {{--                {{\App\Site::find(1)->ExhabitionTitle}}--}}
                </p>
            </div>
            <div class="col-md-4">
                <br>
                {{--                {{dd(\Carbon\Carbon::parse(\App\Site::first()->StartDate)->addHour(9)->diffInHours(\Carbon\Carbon::parse(now())))}}--}}

                @if (\Carbon\Carbon::parse(\App\Site::first()->StartDate)->addHour(6)->addMinutes(30) >  \Carbon\Carbon::parse(now()) && \Carbon\Carbon::parse(\App\Site::first()->StartDate)->addHour(6)->addMinutes(30)->diffInHours(\Carbon\Carbon::parse(now())) > 0)
                    <div class="flipper" data-reverse="true" data-datetime="{{\App\Site::first()->StartDate}} 09:00:00" data-template="ddd|HH|ii|ss" data-labels="Days|Hours|Minutes|Seconds" id="myFlipper"></div>
                    {{--                    <div class="flipper" data-reverse="true" data-datetime="{{\Carbon\Carbon::parse(\App\Site::first()->StartDate)}} {{\Carbon\Carbon::parse(\App\Site::first()->StartDate)->addHours(6)->format("h:i:s")}}" data-template="HH|ii|ss" data-labels="Hours|Minutes|Seconds" id="myFlipper"></div>--}}
                @endif


            </div>
        </div>

        <div class="text-center">
            <div class="row">

                <div class="col-md-4"></div>

                <form class="col-sm-12 col-md-4 " method="POST" action="{{ route('login') }}">
                    @csrf
                    <h1 id="countdown"></h1>

                    <p class="text-left text-black">{{__('message.LoginText')}}</p>
                    <div class="form-group">
                        <input class="form-control @error('email') border border-danger @enderror"
                               type="text" placeholder="{{__('message.EOU')}}" autofocus=""
                               required="" value="{{ old('UserName') ?: old('email') }}"
                               name="login" id="username">
                        @error('email')
                        <span class="text text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group">


                        <input class="form-control @error('password') border border-danger @enderror"
                               type="password" placeholder="{{__('message.password')}}"
                               required="" name="password"
                               autocomplete="current-password" value="" id="password">
                        @error('password')
                        <span class="text text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-2 text-left text-dark">
                        <div class="row">
                            <div class="col-5">
                                @if (Route::has('password.request'))
                                    <a class="text-dark"  id="link-forgot"
                                       href="{{ route('password.request') }}">{{__('message.ForgotPassword')}}</a>

                                @endif
                            </div>
                            <div class="col-7">
                                <div class="w-100 ml-md-5">
                                    <span class="ml-md-5">{{__('message.Rememberme')}}</span>
                                    <input type="checkbox">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success w-100
                   " type="submit" id="submit" style="background-color: rgb(84,37,204)">{{__('message.Login')}}
                        </button>
                    </div>
                    <div class="form-group w-100">
                        <div class="row">
                            <div class="col-md-6 ">
                                <p onclick="window.open('{{route('Exhibitor-Register')}}', '_self')"
                                   class="text " style="color: darkblue;cursor: pointer"><i class="fa fa-id-card" style="margin: 5px"></i>{{__('message.signupasexhibitor')}}</p>
                            </div>
                            <div class="col-md-6">
                                <p onclick="window.open('{{route('register')}}', '_self')"
                                   class="text text-danger" style="cursor: pointer"><i class="fa fa-user" style="margin: 5px"></i>{{__('message.signupasvisitor')}}</p>
                            </div>
                            <div class="col-md-4 mt-2 mt-md-1 d-none d-md-block">
                                <a href="" class="w-md-100 logo-login-mob mt-2 mt-md-1 mt-2 text-center"><img class="w-75 logo-login-mob" src="{{asset("assets/img/icon10.png")}}" alt=""></a>
                            </div>
                            <div class="col-md-4 mt-2 mt-md-1">
                                <a href="" class="w-100 mt-2 mt-md-1 mt-2 icon-android-mob text-center"><img class="icon-android-mob w-75" src="{{asset("assets/img/androidicon.png")}}" alt=""></a>
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <div>
        <img src="{{\App\Site::first()->Logo1}}" alt="" style="position: absolute;bottom: 10px;left: 10px;height: 60px;width: 60px;">
        <img src="{{\App\Site::first()->Logo2}}" alt="" style="position: absolute;bottom: 10px;left: 80px;height: 60px;width: 60px;">
        <img src="{{\App\Site::first()->Logo3}}" alt="" style="position: absolute;bottom: 10px;left: 150px;height: 60px;width: 60px;">
    </div>

    {{--<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha384-vk5WoKIaW/vJyUAd9n/wmopsmNhiy+L2Z+SBxGYnUkunIxVxAv/UtMOhba/xskxh" crossorigin="anonymous"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{asset("js/jquery.flipper-responsive.js")}}"></script>
    <script>
        jQuery(function ($) {
            $('#myFlipper').flipper('init');
            $('#modalFlipper').flipper('init');
        });
    </script>
    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-36251023-1']);
        _gaq.push(['_setDomainName', 'jqueryscript.net']);
        _gaq.push(['_trackPageview']);

        (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();

    </script>
</div>
</body>
</html>


