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



    <!-- Page content -->
<body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;
    ;">

    <div class="page-content pt-0">
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
                                <div class="row">
                                    <div class="col-md-4" style="border: 1px solid white;border-radius: 5px;height: 450px;overflow-y: auto;height: 950px;">
                                        <div class="input-group mt-2 mb-2">
                                            <input type="text" class="form-control" placeholder="Registered Visitors List">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit">Search</button>
                                            </div>
                                        </div>



                                        @foreach($Users as $user)
                                            <div class="row w-100">
                                                <div class="col-8">
                                                    <a href="?UserID={{$user->id}}" @if(request()->UserID == $user->id)
                                                    class="btn btn-primary w-100 mb-2"
                                                       @else
                                                       class="btn btn-outline-dark text-white w-100 mb-2"
                                                        @endif
                                                    >
                                                        {{\Illuminate\Support\Str::limit($user->UserName , 20)}}
                                                    </a>
                                                </div>

                                                <div class="col-3">
                                                    @if($user->AccountStatus == 'Suspend')
                                                        <div class="btn btn-danger">
                                                            {{__('message.Suspended')}}
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if(request()->UserID)
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-12 ml-md-1 mt-2 mt-md-0" style="border: 1px solid white;border-radius: 5px;height: 775px;">
                                                <div class="ml-md-3 mt-2 mb-3">
                                                    <div class="text-center">
                                                        <img src="{{$User->Image}}" alt="" width="100">
                                                    </div>
                                                    <p>
                                                        <strong>{{__('message.fn')}}:</strong>&nbsp;<span>{{$User->FirstName}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>{{__('message.ln')}}:&nbsp;</strong><span>{{$User->LastName}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>{{__('message.Gender')}}:&nbsp;</strong><span>{{$User->Gender}}</span>
                                                    </p>

                                                    <p>
                                                        <strong>{{__('message.Profession')}}:</strong>&nbsp;<span>{{$User->Profession}}</span>

                                                    </p>
                                                    <p>
                                                        <strong>{{__('message.City')}}:</strong>&nbsp;<span>{{$User->City}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>{{__('message.Country')}}:&nbsp;</strong><span>{{$User->Country}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>{{__('message.email')}}:&nbsp;</strong><span>{{$User->email}}</span>
                                                    </p>
                                                    <p>
                                                        <strong>Feedback:&nbsp;</strong><span>{{$User->VisitExperience}}</span>
                                                    </p>



                                                    @if ($User->education != null)
                                                        <p>
                                                            <strong>Education:&nbsp;</strong><span>{{$User->education}}</span>
                                                        </p>
                                                    @endif

                                                    @if ($User->countryStudy != null)
                                                        <p>
                                                            <strong>countryStudy:&nbsp;</strong><span>{{$User->countryStudy}}</span>
                                                        </p>
                                                    @endif

                                                    @if ($User->InterestedDegree != null)
                                                        <p>
                                                            <strong>InterestedDegree:&nbsp;</strong><span>{{$User->InterestedDegree}}</span>
                                                        </p>
                                                    @endif

                                                    @if ($User->InterestedField != null)
                                                        <p>
                                                            <strong>InterestedField:&nbsp;</strong><span>{{$User->InterestedField}}</span>
                                                        </p>
                                                    @endif

                                                    @if ($User->languageOfStudy != null)
                                                        <p>
                                                            <strong>Language Of Study:&nbsp;</strong><span>{{$User->languageOfStudy}}</span>
                                                        </p>
                                                    @endif

                                                    @if ($User->onlineDegreeProgram != null)
                                                        <p>
                                                            <strong>Online Degree Program:&nbsp;</strong><span>{{$User->onlineDegreeProgram}}</span>
                                                        </p>
                                                    @endif

                                                    @if ($User->interestedScholarShip != null)
                                                        <p>
                                                            <strong>Interested ScholarShip:&nbsp;</strong><span>{{$User->interestedScholarShip}}</span>
                                                        </p>
                                                    @endif


                                                    <p class="text-left">{{__('message.Payment')}}:
                                                        @if($User->Payment == 'Paid')
                                                            <button class="btn btn-success" onclick="areyousure()">{{__('message.Paid')}}</button>
                                                        @else
                                                            <button class="btn btn-danger" onclick="areyousure()">{{__('message.Unpaid')}}</button>
                                                        @endif
                                                    </p>
                                                </div>



                                                <form id="mysinsin_form" action="{{route('Admin.UserPaid')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$User->id}}" name="UserID">
                                                </form>


                                            </div>
                                            <form class="w-100 ml-2 mt-2" method="get" action="{{route('Admin.SuspendUser' , $User->id)}}">
                                                <div class="form-group text-left">
                                                        <strong class="text-danger" style="font-size: 18px;">{{__('message.Suspended')}} {{__('message.user')}}:</strong>
                                                        <input type="checkbox" style="width: 21px;height: 17px;margin-left: 6px;" name="AccountStatus" @if($User->AccountStatus == 'Suspend') checked @endif>
                                                    </p>
                                                </div>
                                                <button class="btn btn-block float-right" type="submit" style="margin-bottom: 0px;margin-top: -9px;background-color: #05c965;color: rgb(255,255,255);">
                                                    {{__('message.Save')}}
                                                </button>
                                            </form>
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




@endsection
@section('js')
    <script>
        function areyousure() {
            Swal.fire({
                title: 'Note: Are You Sure to Change Payment Status??',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Yes`,
                denyButtonText: `No`,
            }).then((result) => {
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
@endsection
