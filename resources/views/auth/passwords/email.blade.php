@extends('layouts.app')

@section('content')

    <header class="d-flex masthead"
            style="background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/Signin-Background-IMG.png')}}  @endif);padding: 45px;)">
        <div class="container my-auto text-center">
            <h1 class="d-inline-block mb-1" style="color: #006d60;opacity: 1;font-size: 85px;width: 1110px;">
                @if(\App\Site::find(1)->Logo1)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo1}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo2)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo2}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo3)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo3}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
            </h1>
            <h1 class="mb-1"
                style="color: black;opacity: 1;font-size: 20px;">{{__('message.PasswordResetHead')}}</h1>
            <h3 class="mb-5"></h3>
            <div>
                <form style="width: 311px;" method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        <input style="background-color: rgb(255,255,255);" class="form-control form-control-lg"
                               placeholder="Email Address" id="email" type="email" name="email"
                               value="{{ old('email') }}" required autocomplete="email" autofocus>

                    </div>
                    <div class="form-group">
                        <button class="btn btn-block" style="background-color: rgb(84,37,204);color: white"
                                type="submit">{{__('message.ForgotPassword')}}</button>

                    </div>
                    <div class="form-group">
                        <div class="form-group">
                            <a href="{{route("PassChangeViaMobile")}}">
                                <button class="btn btn-secondary btn-block mb-2" type="button"
                                        style="background-color: #6c757d !important; border-color: #6c757d !important; color: rgb(255,255,255);">Recover Password Via phoneNumber<i
                                        class="fa fa-arrow-circle-left" style="margin-left: 5px;"></i></button>
                            </a>
                            <a href="{{route('login')}}">
                                <button class="btn btn-secondary btn-block" type="button"
                                        style="background-color: #6c757d !important; border-color: #6c757d !important; color: rgb(255,255,255);">{{__('message.GOBACKLOGIN')}}<i
                                        class="fa fa-arrow-circle-left" style="margin-left: 5px;"></i></button>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
@endsection
