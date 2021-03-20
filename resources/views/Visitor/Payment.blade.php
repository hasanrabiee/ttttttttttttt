@extends('layouts.Panel')

@section("Head")


    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/hasan-custom.css")}}" rel="stylesheet" type="text/css">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script src="{{asset("js/jquery.min.js")}}"></script>
    <script src="{{asset("js/bootstrap.bundler.js")}}"></script>
    <script src="{{asset("js/blockui.min.js")}}"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset("js/d3.min.js")}}"></script>
    <script src="{{asset("js/d3tooltip.js")}}"></script>
    <script src="{{asset("js/switchery.min.js")}}"></script>
    <script src="{{asset("js/momment.min.js")}}"></script>
    <script src="{{asset("js/app2.js")}}"></script>
    <script src="{{asset("js/dashboard.js")}}"></script>
    <script src="https://use.fontawesome.com/fd423b8d2f.js"></script>
    <!-- /theme JS files -->


@endsection



@section('content')



    @include("Sidebars.visitor-sidebar")


            <!-- Main content -->



            <div class="content-wrapper" style="overflow-x: hidden">

                <!-- Content area -->
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Traffic sources -->
                            <div class="card" style="background-color:#006B63;color: white;height: 570px">
                                <div class="card-header header-elements-inline">

                                    <div class="header-elements">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            @if(\Illuminate\Support\Facades\Auth::user()->Payment == 'UnPaid')
                                                <div class="alert alert-danger">

                                                    <p>
                                                        <strong>{{__('message.Paid')}}: <span id="price_id">{{\App\Site::find(1)->VisitorPayment}}</span>
                                                            $</strong>
                                                    </p>
                                                    <p class="nonoverflow" style="margin-top: 24px;padding: 16px;">
                                                        {{\App\Site::find(1)->ExhibitorAboutPayment}}
                                                    </p>
                                                    <button id='paypal_btn' class="btn btn-primary btn-block" type="button"
                                                            style="margin-top: 16px;height: 61px;">
                                                        {{__('message.PayWithPayPal')}}<i class="fa fa-dollar" style="margin-left: 5px;"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <div class="alert alert-success">
                                                    <p class="">
                                                        <strong>{{__('message.Paid')}}</strong></p>
                                                    <h3>{{__("message.ThankYouPayment")}}</h3>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="text-center">
                                                <p style="font-size: 18px;">
                                                    {{__("message.Payment")}}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <div class="text-center">
                                                <img src="PayPal-Logo.png" alt="" style="width: 300px;">
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                            <!-- /traffic sources -->
                        </div>
                    </div>
                    <!-- /main charts -->
                </div>
                <!-- /content area -->
            </div>



            <!--/Main Content  -->
        </div>


    </div>
    </body>






@endsection


@section("js")


    <script>

        my_price_var = document.getElementById('price_id').innerText

        if(my_price_var == '' || my_price_var == '0' || my_price_var == 0){


            document.getElementById('price_id').innerText = 'Free'
            $('#paypal_btn').prop('disabled', true)
            $('#paypal_btn').text('{{__('message.ExFree')}}')

        }

    </script>




@stop
