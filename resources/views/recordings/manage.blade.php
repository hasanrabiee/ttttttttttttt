@extends('layouts.Panel')
@section('Head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="_token" content="{{csrf_token()}}"/>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/layout.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/components.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/colors.min.css")}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset("css/hasan-custom.css")}}">

    <!-- /global stylesheets -->

    <!-- Core JS files -->
    {{--    <script src="{{asset("js/jquery.min.js")}}"></script>--}}
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

    <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    {{--    Hasan start here !!!!!--}}



    {{--           Modals--}}






    <!-- Page content -->


    <div class="page-content pt-0 mt-3">
    @include("Sidebars.admin-sidebar")
    <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">
            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->


                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->

                        <div class="card p-3 card-admin" style="background-color:#006B63;color: white">
                            <div class="card-body py-0">
                                <div class="row">


                                    <div class="col-md-2">

                                        <h3 class="text-dark">Recordings

                                            <i class="fa fa-film"></i>
                                        </h3>


                                        @foreach (\App\recordings::all() as $item)


                                        <a href="?id={{$item->id}}" class="btn @if(\request()->has('id') && \request()->id == $item->id) btn-primary @else btn-outline-dark @endif text-white w-100 mb-2">{{$item->title}}</a>

                                        @endforeach

                                        <a href="?" class="btn btn-success text-white w-100 mb-2">Create <i class="fa fa-plus"></i></a>
                                        <a href="{{route('recordings-users')}}" target="_blank" class="btn btn-info w-100 mb-2"> View Sheet <i class="fa fa-list"></i></a>

                                    </div>


                                    <div class="col-10"
                                         style="height: 690px;border: 2px solid white;border-radius: 5px;overflow-y: auto">
                                        <h4 class="mt-2 mb-2">

                                            @if (\request()->has('id') )
                                                Edit Recording

                                            @else

                                                Create Recording
                                            @endif

                                            <button onclick="$('#zoom_modalf').modal('show')" class="btn btn-primary d-inline">List of Zoom Recordings  <i class="fa fa-cloud"></i> </button>

                                                <div class="modal fade" role="dialog" tabindex="-1" id="zoom_modalf">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-dark">
                                                                <h4>Zoom Recordings</h4>

                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                                                        aria-hidden="true">×</span></button>
                                                            </div>
                                                            <div class="modal-body text-dark">


                                                            @foreach($zoom_recordings as $item)


                                                                <p class="d-inline">{{$loop->index + 1}}-{{explode("): ", $item)[0]}}): </p>
                                                            <a class="btn btn-primary " target="_blank" href="{{explode("): ", $item)[1]}}"><i class="fa fa-eye"></i></a>



                                                                <hr class="text-dark">



                                                            @endforeach

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                        </h4>

                                        <form class="w-100" method="post" action="{{route('Admin.recordings-create')}}">
                                            @csrf

                                            <div class="form-group">
                                                <label for=""><h6>Title</h6></label>
                                                <input type="text" class="form-control" name="title"  value="{{$current_recording->title ?? ''}}">
                                            </div>


                                            <div class="form-group">
                                                <label for=""><h6>Description</h6></label>
                                                <textarea  class="form-control" name="description">{{$current_recording->description ?? ''}}</textarea>
                                            </div>


                                            <div class="form-group">
                                                <label for=""><h6>Speakers</h6></label>
                                                <textarea  class="form-control" name="speakers">{{$current_recording->speakers ?? ''}}</textarea>
                                            </div>

                                            <div class="form-group">
                                                <label for=""><h6>Play URL</h6></label>
                                                <input type="url" class="form-control" name="play_url" value="{{$current_recording->play_url ?? ''}}">
                                            </div>


                                            <div class="form-group">
                                                <label for=""><h6>Download URL</h6></label>
                                                <input type="url" class="form-control" name="download_url"  value="{{$current_recording->download_url ?? ''}}">
                                            </div>


                                                <input type="hidden" name="active" value="1">
                                            @if (\request()->has('id'))

                                                <input type="hidden" name="rid" value="{{\request()->id}}">

                                            @endif



                                            <div class="form-group">
                                                <input type="submit" class="btn btn-success w-100" value="Save">
                                            </div>
                                        </form>


                                    </div>


                                </div>
                                <!-- /main charts -->
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- /content area -->
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->


    </body>








@endsection

