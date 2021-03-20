@extends('layouts.app')
@section("Head")
    <link rel="stylesheet" href="{{asset("assets/bootstrap/css/bootstrap.min-form.css")}}">

    <style>
        ::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
            color: #006B63 !important;
            opacity: 1; /* Firefox */;
        }
    </style>
@endsection
@section('content')




    <div class="h-100 w-100 overflow" style="width:100% !important ; height:100% !important;background-size: cover;background-repeat:no-repeat;background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/poster.jpg')}}@endif">
        <div class="row mt-md-3">
            <div class="col-8 col-md-9">
            </div>
            <div class="col-4 col-md-3">


                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#help">Help</button>

                <!-- Modal -->
                <div id="help" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark">Visitor Registeration Guide </h5><br>
                            </div>
                            <div class="modal-body text-center">
                                <div class="text-left mb-2">
                                    <a href="{{\App\Site::first()->visitorRegistrationPDF}}" class="btn text-left btn-primary">PDF Guide</a>
                                </div>
                                <iframe width="420" height="315"
                                        src="{{\App\Site::first()->visitorRegistrationVideo}}">
                                </iframe>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
                <a class="" href="{{ url('locale/en') }}"><i
                        class="ml-2"></i>En</a>
                <a class="" href="{{ url('locale/de') }}"><i
                        class="ml-2"></i>Ge</a>
                <a class="" href="{{ url('locale/al') }}"><i
                        class="ml-2"></i>Al</a>
                <br>
                <span style="font-size: 12px;border-radius: 5px;opacity: 0.7" class="bg-dark p-1 text-white">
                    Last Activity: {{\Carbon\Carbon::now()->toDayDateTimeString()}}
                </span>
            </div>
        </div>




        <div class="">
            <div class="container-fluid h-100">
                <div class="row">
                </div>
                <div class="row h-100 justify-content-center align-items-center">
                    <div class="row mt-md-5 ">
                        <div class="col-md-12">


                            <!-- Page content -->
                            <div class="page-content pt-0 mt-3 w-100">
                                <!-- Main content -->
                                <div class="content-wrapper">

                                    <!-- Content area -->
                                    <div class="content">

                                        <!-- Main charts -->
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <!-- Traffic sources -->
                                                <h2 class="stroke-title text-white">Visitor Registration</h2>


                                                <div class="card w-100" style="background-color:rgba(255,255,255,1);color: black;height: 1000px;position: relative">
                                                    <div class="card-body w-100" style="font-size: 14px;">
                                                        <h3 class="mb-3">Select Category Which You Want to Register</h3>
                                                        <div class="row">
                                                            <div class="col-12 text-center">
                                                                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                                                                    @if (\App\VisitorForm::first()->studentStatus == "active")
                                                                        <a class="nav-link w-100 mb-2 btn btn-primary"  href="{{route("register")}}">STUDENTS</a>
                                                                    @endif

                                                                    @if (\App\VisitorForm::first()->jobSeekerStatus == "active")
                                                                        <a class="nav-link btn btn-primary mb-2" href="{{route("registerJobSeeker")}}">JOBSEEKERS</a>
                                                                    @endif

                                                                    @if (\App\VisitorForm::first()->companyStatus == "active")
                                                                        <a class="nav-link btn btn-primary mb-2" href="{{route("registerCompanyUser")}}">COMPANY INSTITUTION ORGANIZATION</a>
                                                                    @endif



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
                                <!-- /main content -->
                            </div>
                            <!-- /page content -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>











@endsection
