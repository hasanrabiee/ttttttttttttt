@extends('layouts.app')
@section('content')
    <header class="d-flex masthead" style="background-image: url({{\App\Site::find(1)->SigninBackground}});padding: 45px;padding-top: 31px;padding-right: 0px;padding-left: 0px;">
        <div class="container my-auto text-center">
            <h1 class="d-inline-block mb-1" style="color: #006d60;opacity: 1;font-size: 85px;width: 1110px;">
                @if(\App\Site::find(1)->Logo1)
                    <img class="float-right" src="{{asset(\App\Site::find(1)->Logo1)}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo2)
                    <img class="float-right" src="{{asset(\App\Site::find(1)->Logo2)}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo3)
                    <img class="float-right" src="{{asset(\App\Site::find(1)->Logo3)}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
            </h1>

            <h3 class="mb-5"></h3>
            <div style="background-color: rgb(54,54,54,65%);width: 1117px;height: 397px;margin-right: 10px;">
                <div class="text-left" style="padding: 39px;padding-top: 49px;">
                    <h3 style="color: rgb(255,255,255);">{{__('message.YourAccountActivated')}}
                        <i class="fa fa-check" style="color: rgb(21,241,2);"></i></h3>
                    <h4 class="text-break" style="color: rgb(255,255,255);">{!! __('message.ThanksforCompletingRegistration') !!}</h4>
                </div>

                <a class="remove_underline" href="{{ route('home') }}" style="font-size: 15px;color: #c5c5c5;margin-bottom: 16px;" ><button class="btn btn-success">{{__('message.RedirectToPanel')}}</button></a>




            </div>
            <div class="overlay"></div>
            <div></div>
        </div>
    </header>
@endsection
