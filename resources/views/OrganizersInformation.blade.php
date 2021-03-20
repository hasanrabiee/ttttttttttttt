@extends('layouts.Panel')
@section("Head")

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset("css/hasan-custom.css")}}">

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



<body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;
    ;">


<div class="page-content pt-0 mt-3">

@include("Sidebars.admin-sidebar")

<!-- Main content -->
    <div class="content-wrapper">

        <!-- Content area -->
        <div class="content">

            <!-- Main charts -->
            <div class="row">
                <div class="col-xl-12">
                    <!-- Traffic sources -->
                    <div class="card card-admin" style="background-color:rgba(168,168,168,0.5);color: white">
                        <div class="card-header header-elements-inline">

                            <div class="header-elements">
                            </div>
                        </div>
                        <div class="card-body">
                            <h5>Organizers</h5>
                            <form class="w-100" method="post" action="{{route('Admin.OrganizersPost')}}"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 text-center">


                                        <div class="image-upload mt-md-2">
                                            <img
                                                src="{{asset('assets/img/download.jpg')}}"
                                                onclick="$('#Poster1').trigger('click');"
                                                class="cursor-pointer w-25">
                                            <input type="file" id="Poster1" name="profile"
                                                   style="display:none;"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Firstname:</label>
                                            <input type="text" class="form-control" name="firstname">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Surname:</label>
                                            <input type="text" class="form-control" name="surname">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Phone Number:</label>
                                            <input type="text" class="form-control" name="phoneNumber">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Email:</label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                    </div>

                                    <input type="submit" value="Add to List" class="btn btn-success w-100">

                                </div>

                            </form>

                            <div class="row">
                                <div class="col-md-4" style="border-right: 2px solid white">
                                    <h3 class="text-white">Organizers Names</h3>

                                    @foreach($Organizers as $Organizer)

                                    <div class="row">
                                        <div class="col-md-8">
                                            <a href="?OrganizerID={{$Organizer->id}}" @if(request("OrganizerID") == $Organizer->id) class="btn btn-primary w-100 mb-2 text-dark" @else class="btn btn-outline-dark w-100 mb-2 text-dark" @endif >
                                                {{$Organizer->surname}}
                                            </a>
                                        </div>
                                        <div class="col-md-4">
                                            <form action="{{route("Admin.DeleteOrganizer",$Organizer->id)}}" method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-danger" value="Delete">
                                            </form>
                                        </div>
                                    </div>


                                    @endforeach

                                </div>
                                @if ($OrganizerID != null)

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4 ml-md-3 mt-md-3">
                                                <img src="{{\App\Organizer::find($OrganizerID)->profile}}" alt="" class="w-100">
                                            </div>
                                            <div class="col-md-7">
                                                <div class="ml-md-3 mt-md-3 text-white">
                                                    <p>FirstName: {{\App\Organizer::find($OrganizerID)->firstname}}</p>
                                                    <p>Surname: {{\App\Organizer::find($OrganizerID)->surname}}</p>
                                                    <p>PhoneNumber: {{\App\Organizer::find($OrganizerID)->phoneNumber}}</p>
                                                    <p>Email: {{\App\Organizer::find($OrganizerID)->email}}</p>
                                                </div>
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


</body>


