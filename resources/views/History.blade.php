@extends('layouts.Panel')
@section('Head')
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="_token" content="{{csrf_token()}}"/>

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



<div class="modal fade" role="dialog" tabindex="-1" id="filter">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark">Please Choose Your Items Which You Like To Be Filtered</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">




                <h6>
                    Institutions
                </h6>
                @foreach(explode(',' , \App\ExhibitorForms::find(1)->institutionItems) as $item)
                    <a href="?institution={{$item}}" class="btn btn-dark w-50 mb-2 btn-sm">
                        {{$item}}
                    </a>
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block"
                        data-dismiss="modal" type="button">
                    {{__('message.Close')}}
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" role="dialog" tabindex="-1" id="filterVis">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-dark">Please Choose Your Items Which You Like To Be Filtered</h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close">
                <span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">

                <h6>
                    Gender
                </h6>
                @foreach(explode(',' , \App\Site::find(1)->VisitorGender) as $Gender)
                    <a href="?gender={{$Gender}}" class="btn btn-dark w-50 mb-2 btn-sm">
                        {{$Gender}}
                    </a>
                @endforeach
                <h6>
                    Profession
                </h6>
                @foreach(explode(',' , \App\Site::find(1)->VisitorProfession) as $profession)
                    <a href="?profession={{$profession}}" class="btn btn-dark w-50 mb-2 btn-sm">
                        {{$profession}}
                    </a>
                @endforeach
            </div>
            <div class="modal-footer">
                <button class="btn btn-light btn-block"
                        data-dismiss="modal" type="button">
                    {{__('message.Close')}}
                </button>
            </div>
        </div>
    </div>
</div>


{{--           End Modales--}}


    <!-- Page content -->



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

                        <div class="card p-3 card-admin" style="background-color:rgba(168,168,168,0.5);color: white">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-md-4" style="border: 1px solid white;border-radius: 5px;height: 950px;overflow-y: auto">
                                        <button class="btn btn-dark w-100 mt-2" type="button" onclick="$('#filter').modal('show')">Click to Choose Your Filter</button>

                                        <div class="input-group mt-2 mb-2">
                                            <input type="text" class="form-control" placeholder="Companies">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit">Search</button>
                                            </div>
                                        </div>



                                        @foreach($Booths as $booth)
                                            <a  href="?CompanyID={{$booth->id}}" @if(request()->CompanyID == $booth->id)
                                                 class="text-left btn btn-primary mb-2 w-100"
                                                 @else
                                                 class="text-left btn btn-outline-dark mb-2 w-100 text-white"
                                                 @endif
                                            >
                                                        {{\Illuminate\Support\Str::limit($booth->CompanyName,20)}}
                                            </a>
                                            <br>
                                        @endforeach
                                    </div>
                                    <div class="col-md-4" style="border: 1px solid white;border-radius: 5px;height: 950px;overflow-y: auto">
                                        <button class="btn btn-dark w-100 mt-2" type="button" onclick="$('#filterVis').modal('show')">Click to Choose Your Filter</button>

                                        <div class="input-group mt-2 mb-2">
                                            <input type="text" class="form-control" placeholder="Visitors">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit">Search</button>
                                            </div>
                                        </div>



                                        @foreach($Users as $user)
                                            <a href="?UserID={{$user->id}}" @if(request()->UserID == $user->id)
                                            class="text-left btn btn-primary mb-2 w-100"
                                                @else
                                                class="text-left btn btn-outline-dark mb-2 w-100 text-white"
                                                @endif
                                            >
                                                {{\Illuminate\Support\Str::limit($user->UserName,20)}}
                                            </a>
                                            <br>
                                        @endforeach
                                    </div>

                                    <div class="col-md-4">
                                        <h4>

                                            Chat History: @if(request()->CompanyID)
                                                {{\App\booth::find(request()->CompanyID)->CompanyName}}
                                            @elseif(request()->UserID)
                                                {{\App\User::find(request()->UserID)->UserName}}
                                            @endif

                                        </h4>
                                        <div style="background-color:transparent;border: 1px solid transparent ;height: 450px;border-radius: 5px;overflow-y: scroll;overflow-x:hidden " class="scroll_box">


                                            <div>

                                                @if(request()->CompanyID || request()->UserID)
                                                    @if($Chats->count() == 0)
                                                        {{__('message.NoMessageAvailable')}}
                                                    @else
                                                        @foreach($Chats as $chat)


                                                            @if($chat->Sender == 'Admin')
                                                                <div class="row">
                                                                    <div class="col-8 bg-primary mt-2 ml-3 p-1" style="border-radius: 5px;">
                                                                        {{$chat->Text}}
                                                                    </div>

                                                                    <div class="col-3"></div>
                                                                </div>
                                                            @else
                                                                <div class="row">
                                                                    <div class="col-3"></div>
                                                                    <div class="col-8 bg-success mt-2 ml-3 p-1" style="border-radius: 5px;">
                                                                        {{$chat->Text}}                                                                     </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @else
                                                    {{__('message.PleaseSelectaChatFirst')}}
                                                @endif


                                            </div>
                                        </div>
                                    </div>

                                </div>


                            </div>
                            <div class="chart position-relative" id="traffic-sources"></div>
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

@endsection
