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







            @include("Sidebars.exhibitorOperator-sidebar")

            <!-- Main content -->
            <div class="content-wrapper" style="overflow-x: hidden">

                <!-- Content area -->
                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Traffic sources -->
                            <div class="card p-3 pc-height-exhibitor-history" style="background-color:#006B63;color: white;">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-md-4" style="">
                                            <button class="btn btn-dark w-100" type="button" onclick="$('#filter').modal('show')">Click to Choose Your Filter</button>
                                            <form action="" class="w-100">
                                                <div class="input-group mt-2 mb-2">
                                                    <input type="text" class="form-control" placeholder="Visitor Name" name="search">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="row">
                                                <div class="booth-btn booth-btn-height w-100" style="overflow-y: auto ;height: 450px;">


                                                    @foreach($Users as $user)
                                                        <div class="col-12">
                                                            <a @if(request()->UserID == $user->id) class="text-left btn btn-primary mb-2 w-100" @else class="text-white text-left btn btn-outline-dark mb-2 w-100" @endif href="?UserID={{$user->id}}">{{$user->UserName}}</a>
                                                        </div>
                                                    @endforeach





                                                </div>
                                            </div>
                                        </div>



                                        @if(isset($User))


                                            <div class="col-md-4 mt-md-0 mt-2" style="border: 1px solid white;border-radius: 5px;height: 550px;overflow-y: scroll">
                                                <h3 class="text-dark mb-4">Visitor Information</h3>
                                                <div class="text-center">
                                                    <img src="{{$User->Image}}" style="width: 65px;margin: 0 auto" class="text-center" >

                                                </div>
                                                <p>{{__('message.UserName')}}: {{$User->UserName}}</p>
                                                <p>{{__('message.fn')}}: {{$User->FirstName}}</p>
                                                <p>{{__('message.ln')}}: {{$User->LastName}}</p>
                                                <p>{{__('message.Profession')}}: {{$User->Profession}}</p>
                                                <p>{{__('message.Gender')}}: {{$User->Gender}}</p>

                                                @if ($User->education != null)
                                                    <p>
                                                        Education : {{$User->education}}
                                                    </p>
                                                @endif

                                                @if ($User->countryStudy != null)
                                                    <p>
                                                        Country Study : {{$User->countryStudy}}
                                                    </p>
                                                @endif

                                                @if ($User->InterestedDegree != null)
                                                    <p>
                                                        Interested Degree : {{$User->InterestedDegree}}
                                                    </p>
                                                @endif

                                                @if ($User->languageOfStudy != null)
                                                    <p>
                                                        Language Of Study : {{$User->languageOfStudy}}
                                                    </p>
                                                @endif

                                                @if ($User->onlineDegreeProgram != null)
                                                    <p>
                                                        Online Degree Program : {{$User->onlineDegreeProgram}}
                                                    </p>
                                                @endif

                                                @if ($User->interestedScholarShip != null)
                                                    <p>
                                                        Interested Scholar Ship : {{$User->onlineDegreeProgram}}
                                                    </p>
                                                @endif



                                                <p><p class="text-left">Download CV : <a class="btn btn-primary" href="{{$User->resume}}">Download</a></p></p>

                                            </div>


                                            <div class="col-md-4 mt-md-0 mt-2">
                                                <h4>Chat History</h4>
                                                <div class="pc-height-visitor-history-chat" style="background-color:transparent;border: 1px solid transparent ;border-radius: 5px;overflow-y: auto;overflow-x:hidden ">



                                                    <div>
                                                        @if(\App\Chat::where('UserID' , $User->id)->where('BoothID' , $Booth->id)->count() <= 0)
                                                            {{__('message.NoMessageAvailable')}}

                                                        @else
                                                            @foreach(\App\Chat::where('UserID' , $User->id)->where('BoothID' , $Booth->id)->get() as $chat)

                                                                @if($chat->Sender == 'Exhibitor')
                                                                    <div class="row">
                                                                        <div class="col-3"></div>
                                                                        <div class="col-8 bg-success mt-2 ml-3 p-2" style="border-radius: 5px;">{{$chat->Text}}</div>
                                                                    </div>
                                                                @else

                                                                    <div class="row">
                                                                        <div class="col-8 bg-primary mt-2 ml-3 p-2" style="border-radius: 5px;">{{$chat->Text}}</div>

                                                                        <div class="col-3"></div>
                                                                    </div>
                                                                @endif



                                                            @endforeach
                                                        @endif

                                                    </div>

                                                </div>
                                            </div>


                                        @endif


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
