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
                <form style="width: 311px;" method="POST" action="{{ route('PassChangeCheckMobile') }}">
                    @csrf
                    <div class="form-group">
                        <label for="">
                            Please Insert Your Phone Number to Change Your Password.
                        </label>

                        <input type="text" class="form-control" name="phoneNumber">
                    </div>

                    <input type="submit" value="send message" class="btn btn-success">

                </form>
            </div>
@endsection
