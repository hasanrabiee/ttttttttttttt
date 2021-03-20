@extends('layouts.app')

@section('content')
    <header class="d-flex masthead"
            style="background-image: url({{\App\Site::find(1)->SigninBackground}});padding: 45px;">
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

            <h3 class="mb-5"></h3>
            <h1 class="mb-5" style="color: #006d60;opacity: 1;font-size: 50px;">{{__('message.COnfirmtYoyrPassword')}}</h1>
            <h3 class="mb-5"></h3>
            <div>
                <form method="POST" action="{{ route('password.confirm') }}" style="width: 311px;" >
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg @error('password') border border-danger @enderror" type="password" placeholder="password" autofocus=""
                               required=""  style="background-color: rgb(255,255,255);" name="password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success btn-block btn-lg
               " type="submit" style="background-color: #6c757d;">{{__('message.confirm')}}
                        </button>
                    </div>

                </form>
            </div>
            <div class="overlay"></div>












@endsection
