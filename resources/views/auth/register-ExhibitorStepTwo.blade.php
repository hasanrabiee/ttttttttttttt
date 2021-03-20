@extends('layouts.app')
@section('content')

    <input id="hidden_val" type="hidden" value="{{\App\Site::find(1)->ExhibitorMaximumOperator}}">




    {{--Hasan Start Here !!!!--}}





    <div class="h-100 w-100 overflow" style="width:100% !important ; height:100% !important;background-size: cover;background-repeat:no-repeat;background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/poster.jpg')}}@endif">
        <div class="row mt-md-3">
            <div class="col-md-10">
            </div>
            <div class="col-md-2 col-12">
                <a class="" href="{{ url('locale/en') }}"><i
                        class="ml-2"></i>En</a>
                <a class="" href="{{ url('locale/de') }}"><i
                        class="ml-2"></i>Ge</a>
                <a class="" href="{{ url('locale/al') }}"><i
                        class="ml-2"></i>Al</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="container-fluid">
                    <div class="page-content pt-0 mt-3">
                        <!-- Main content -->
                        <div class="content-wrapper">

                            <!-- Content area -->
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-1 mr-md-5">
                                        <h3 class="">{{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 18)}}</h3>
                                    </div>
                                    <div class="col-md-4">
                                        <button data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logout-form').submit()" class="btn btn-danger ml-md-5">
                                            <i class="fa fa-sign-out"></i>
                                        </button>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>

                                <!-- Main charts -->
                                <div class="row">
                                    <div class="col-xl-12 mt-md-5">
                                        <!-- Traffic sources -->


                                        <div class="card" style="background-color:rgba(54,54,54,0.65);color: white">

                                            <div class="card-body">








                                                <form onsubmit="event.preventDefault(); areyousure();" id="mysinsin_form" class="form-inline" method="post" action="{{route('Exhibitor-Register-Two')}}">
                                                    @csrf
                                                    <input type="hidden" name="UserID" value="{{$UserID}}">
                                                    <input type="hidden" name="BoothID" value="{{$BoothID}}">

                                                    <div class="row w-100">
                                                        <div class="col-md-5">
                                                            <p class="text-left" style="color: rgb(255,255,255);font-size: 20px;">{{__('message.Pleaseaddyourstaffinformation')}} <i
                                                                    onclick="show_info('{{__('message.ModalStepTwoNum1')}}')"
                                                                    class="fa fa-info-circle" style="color: white;"
                                                                    data-toggle="tooltip"></i></p>
                                                            <div class="form-group">
                                                                <div class="field_wrapper w-100">
                                                                    <div onclick="$('#op_email').removeAttr('disabled'); $('#op_email').focus()" class="w-100 mt-md-2 mb-md-2">

                                                                        <a href="javascript:void(0);" class="btn btn-dark add_button w-100" title="Add field" >
                                                                            <p style="font-size: 20px">{{__('message.AddOperators')}} <i style=";color: #000000;margin-left: 8px"
                                                                                                                                         class="fa fa-plus-circle"></i></p>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-7 w-100" style="border-left: 2px solid white">
                                                            <div class="w-100"
                                                                 style="">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-switch float-left" style="width: 207px;">
                                                                        <input class="custom-control-input" onclick="ShowLiveConf()" type="checkbox"
                                                                               id="formCheck-2" name="need_live_conf">

                                                                        <label class="custom-control-label" for="formCheck-2"
                                                                               style="color: rgb(255,255,255);font-size: 16px;">{{__('message.NeedLiveCOnf')}} </label>
                                                                    </div>
                                                                </div>


                                                                <div style="display: none !important;" id="Live1" class="w-100">
                                                                    <div class="form-group" style="margin-top: 14px;"><input id="#javad_1"
                                                                                                                             class="form-control w-100"
                                                                                                                             type="text"
                                                                                                                             placeholder="Speaker Name * "
                                                                                                                             name="Name" value="{{old('SpeakerName')}}"><br>
                                                                    </div>
                                                                    <div class="form-group" style="margin-top: 14px;"><input id="#javad_11"
                                                                                                                             class="form-control w-100"
                                                                                                                             type="text"
                                                                                                                             placeholder="Speaker Email *"
                                                                                                                             name="email" value="{{old('email')}}"><br>
                                                                    </div>
                                                                    <div class="form-group " style="margin-top: 14px;"><input id="#javad_2"
                                                                                                                              class="form-control w-100"
                                                                                                                              type="text"
                                                                                                                              placeholder="Username * "
                                                                                                                              name="UserName" value="{{old('SpeakerUserName')}}"><br>
                                                                    </div>
                                                                    <div class="form-group" style="margin-top: 14px;"><input id="#javad_3"
                                                                                                                             class="form-control w-100"
                                                                                                                             type="password"
                                                                                                                             placeholder="Password * "
                                                                                                                             name="password"><br>
                                                                    </div>
                                                                    <div class="form-group" style="margin-top: 14px;"><input id="#javad_4"
                                                                                                                             class="form-control w-100"
                                                                                                                             type="password"
                                                                                                                             placeholder="Confirm Password * "
                                                                                                                             name="password_confirmation"><br>
                                                                    </div>
                                                                    <div class="form-group" style="margin-top: 14px;"><input id="#javad_5"
                                                                                                                             class="form-control w-100"
                                                                                                                             type="text"
                                                                                                                             placeholder="speech title * "
                                                                                                                             name="SpeechTitle" value="{{old('SpeechTitle')}}"><br>
                                                                    </div>




                                                                    <div id="Live2" style="display: none !important;">
                                                                        <p style="color: #ffffff" class="text-left mt-md-3">{{__('message.OpeningDate')}}: <span>{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->format('m-d-Y')}}</span></p>
                                                                        <div class="form-group"><input id="sinsin_date_01"
                                                                                                       placeholder="Prefered Date 1"
                                                                                                       onfocus="(this.type='date')"
                                                                                                       title="Prefered Date 1 *"
                                                                                                       class="form-control w-100 mt-3"
                                                                                                       type="text"
                                                                                                       name="PreferredDate1" value="{{old('PreferredDate1')}}">
                                                                        </div>
                                                                        <div class="form-group"><input id="sinsin_date_02"

                                                                                                       placeholder="Prefered Date 2"
                                                                                                       onfocus="(this.type='date')"
                                                                                                       title="Prefered Date 2 *"
                                                                                                       class="form-control w-100 mt-3"
                                                                                                       type="text"
                                                                                                       name="PreferredDate2" value="{{old('PreferredDate2')}}">
                                                                        </div>
                                                                        <div class="form-group"><input id="sinsin_date_03"
                                                                                                       placeholder="Prefered Date 3"
                                                                                                       onfocus="(this.type='date')"
                                                                                                       title="Prefered Date 3 *"
                                                                                                       class="form-control w-100 mt-3"
                                                                                                       type="text"
                                                                                                       name="PreferredDate3" value="{{old('PreferredDate3')}}">
                                                                        </div>


                                                                    </div>


                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                            <button class="btn btn-success w-100 mt-md-2" type="submit">
                                                <strong>{{__('message.Save')}}</strong><i class="fa fa-check" style="margin-left: 5px;"></i><br></button>
                                            {{--                                            <input id="hidden_val" type="hidden" value="{{\App\Site::find(1)->ExhibitorMaximumOperator}}">--}}
                                            </form>
                                        </div>
                                    </div>
                                    <!-- /traffic sources -->
                                </div>
                            </div>
                            <!-- /main charts -->
                        </div>
                        <!-- /content area -->
                    </div>
                </div>
            </div>
        </div>
    </div>







@endsection
@section('js')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            var maxField = $("#hidden_val").val(); //Input fields increment limitation
            var fieldHTML = '<div><input type="email" name="OperatorEmails[]" value="" class="form-control mt-md-3 w-75" placeholder="Operator Email" /><a href="javascript:void(0);" class="remove_button"><i class="fa fa-minus-circle" style="font-size: 30px;color: #ffffff;margin-left: 10px;margin-top: 10px;"></i></a></div>'; //New input field html
            var x = 0; //Initial field counter is 1
            //Once add button is clicked
            $('.add_button').click(function () {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter

                    $('.field_wrapper').append(fieldHTML); //Add field html
                }
            });
            //Once remove button is clicked
            $('.field_wrapper').on('click', '.remove_button', function (e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });

        function show_info(javad) {
            Swal.fire({
                text: javad,
                icon: 'info'
            })
        }


        function areyousure() {
            Swal.fire({
                title: '{{__('message.Step3Error')}}',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `{{__('message.NExtPage')}}`,
                denyButtonText: `{{__('message.StayinPage')}}`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Saved!', '', 'success')
                    confirmed_sinsin = true
                    $("#mysinsin_form").removeAttr('onsubmit').submit()
                    return true
                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                    confirmed_sinsin = false
                    return false
                }
            })
        };

    </script>

    <script>

        document.getElementById("sinsin_date_01").min = "{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->format('Y-m-d')}}";
        document.getElementById("sinsin_date_01").max = "{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->addDays(9)->format('Y-m-d')}}";
        document.getElementById("sinsin_date_02").min = "{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->format('Y-m-d')}}";
        document.getElementById("sinsin_date_02").max = "{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->addDays(9)->format('Y-m-d')}}";
        document.getElementById("sinsin_date_03").min = "{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->format('Y-m-d')}}";
        document.getElementById("sinsin_date_03").max = "{{\Carbon\Carbon::parse(\App\Site::find(1)->StartDate)->addDays(9)->format('Y-m-d')}}";

        function ShowLiveConf() {
            var css = $('#Live1').css('display');
            var css2 = $('#Live2').css('display');
            if (css === 'none' && css2 === 'none') {
                $('#Live1').show(300);
                $('#Live2').show(400);
                $("#sinsin_date_01").prop('required', true);
                $("[name='SpeakerName']").prop('required', true);
                $("[name='SpeakerUserName']").prop('required', true);
                $("[name='password']").prop('required', true);
                $("[name='password_confirmation']").prop('required', true);
                $("[name='SpeechTitle']").prop('required', true);







            } else {
                $('#Live1').hide(400);
                $('#Live2').hide(300);
                $("#sinsin_date_01").removeAttr('required');
                $("[name='SpeakerName']").removeAttr('required');
                $("[name='SpeakerUserName']").removeAttr('required');
                $("[name='password']").removeAttr('required');
                $("[name='password_confirmation']").removeAttr('required');
                $("[name='SpeechTitle']").removeAttr('required');
            }
        }

    </script>


@endsection
