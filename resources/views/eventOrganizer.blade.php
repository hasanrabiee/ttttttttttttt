@extends('layouts.Panel')
@section("Head")

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">

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

    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>


@endsection
<!-- Page content -->

<div class="page-content pt-0 mt-3">

<!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content">

            <!-- Main charts -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- Traffic sources -->
                    <div class="card" style="background-color:rgba(168,168,168,0.5);color: white">
                        <div class="container-fluid p-3 m-0" style="background-color: black">
                            <h1 class="text-white">
                                Event Organizer
                            </h1>
                        </div>
                        <div class="card-body" style="height: 600px;">

                            <div class="row">
                                <div class="col-md-4" style="border-right: 2px solid white;height: 600px;">
                                    @foreach($Organizers as $Organizer)
                                        <a href="?OrganizerID={{$Organizer->id}}" class="mb-2 w-100">
                                            <div class="w-100">
                                                <div @if(request("OrganizerID") == $Organizer->id) class="row w-100 bg-white mb-2" @else class="row w-100 mb-2" @endif>

                                                    <div class="col-md-4 mb-2 w-100 p-1">
                                                        <img src="{{$Organizer->profile}}" alt="" class="mt-1" style="width:50px;height:50px;border-radius: 50%;"><span class="ml-md-2 text-dark">{{$Organizer->firstname}}</span>
                                                    </div>


                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>


                                @if ($OrganizerID != null)
                                <div class="col-md-8">
                                    <div style="background-color:white;height: 570px;border-radius: 5px;" class="p-3">
                                        <img src="{{\App\Organizer::find($OrganizerID)->profile}}" alt="" style="width: 100px;">

                                        <div class="text-dark ml-md-2 mt-md-2">
                                            <h5>FirstName: {{\App\Organizer::find($OrganizerID)->firstname}}</h5>
                                            <h5>Surname: {{\App\Organizer::find($OrganizerID)->surname}}</h5>
                                            <h5>PhoneNumber: {{\App\Organizer::find($OrganizerID)->phoneNumber}}</h5>
                                            <h5>Email: {{\App\Organizer::find($OrganizerID)->email}}</h5>
                                        </div>
                                    </div>
                                </div>
                                @endif
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



