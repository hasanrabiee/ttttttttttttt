
<span style="font-size: 12px;">

@if(\Illuminate\Support\Facades\Auth::isLoggedInByMasterPass())

        <h5> <span class="badge badge-primary">God Mode</span></h5>


    @endif

            Last Activity: {{\Carbon\Carbon::now()->toDayDateTimeString()}}



</span>

@if (\Illuminate\Support\Facades\Auth::user()->device_token == null)

{{--    <button id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="btn btn-danger btn-block btn-flat">--}}
{{--        <i class="fa fa-bell"></i>--}}
{{--        Allow for Notification--}}
{{--    </button>--}}


    <div>
        <span id="btn-nft-enable" onclick="initFirebaseMessagingRegistration()" class="mt-2 bell fa fa-bell" style="color: black"></span>
    </div>

@endif


