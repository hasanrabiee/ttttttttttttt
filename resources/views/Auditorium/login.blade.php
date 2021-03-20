@extends('layouts.app')

@section('content')


    <header class="d-flex masthead"
            style="background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/Signin-Background-IMG.png')}}  @endif);padding: 45px;">
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
                style="color: #006d60;opacity: 1;font-size: 85px;">{{\App\Site::find(1)->ExhabitionTitle}}</h1>
            <h3 class="text-light">Speaker Login</h3>
            <h3 class="mb-5"></h3>
            <div>
                <form style="width: 311px;" method="POST" action="{{ route('Auditorium.LoginPost') }}">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg @error('UserName') border border-danger @enderror"
                               type="text" placeholder="UserName" autofocus=""
                               required="" value="{{ old('UserName') }}" style="background-color: rgb(255,255,255);"
                               name="UserName">
                        @error('UserName')
                        <span class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <input class="form-control form-control-lg @error('password') border border-danger @enderror"
                               type="password" placeholder="Password"
                               required="" style="background-color: rgb(255,255,255);" name="password"
                               autocomplete="current-password">
                        @error('password')
                        <span class="text text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">

                        <p class="float-right" style="color: rgb(150,150,150);">Remember me
                            <input type="checkbox" style="margin-left: 8px;">
                        </p>
                    </div>

                    <div class="form-group">
                        <button class="btn btn-success btn-block btn-lg
               " type="submit" style="background-color: #6c757d;">Login
                        </button>

                    </div>

                </form>



            </div>


@endsection
