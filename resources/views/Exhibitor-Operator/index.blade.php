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


{{--    Hasan start here !!!!!--}}

<div class="modal fade" role="dialog" tabindex="-1" id="view_jobs" style="height: 500px;overflow-y: auto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4><strong>{{__('message.JobVacanciesDetails')}}</strong><br></h4>
                <button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach(\App\Jobs::where('BoothID' , $Booth->id)->get() as $job)
                    <div class="main-modal" style="position:relative;">
                        <div style="background-color:#b2caeb;" class="p-3">
                            <h4 style="font-weight: bolder;">
                                {{$job->Title}}
                            </h4>
                        </div>

                        <div>
                            <p>
                                {{$job->Description}}
                            </p>
                        </div>

                        <div>
                            <h6 style="font-weight: bolder">Number Of Vacencies :</h6>
                            <p>
                                {{$job->Number}}
                            </p>
                        </div>

                        <div>
                            <h6 style="font-weight: bolder">Salary :</h6>
                            <p>
                                {{$job->Salary}} €
                            </p>
                        </div>
                    </div>
                @endforeach





            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-block" data-dismiss="modal"
                        aria-label="Close">
                    {{__('message.Close')}}
                </button>

            </div>

        </div>
    </div>
</div>


        @include("Sidebars.exhibitorOperator-sidebar")






            <!-- Main content -->

            <div class="content-wrapper" style="overflow-x: hidden">

                <div class="content">

                    <!-- Main charts -->
                    <div class="row">
                        <div class="col-xl-12">
                            <!-- Traffic sources -->

                            <div class="card" style="background-color:#006B63;color: white">
                                <div class="card-header header-elements-inline">
                                    <h6 class="card-title">Profile Information</h6>

                                    @if(\Illuminate\Support\Facades\Auth::user()->AccountStatus == 'Active')
                                        <button class="btn btn-success ml-md-n5">{{__('message.AccountActive')}}</button>
                                    @else
                                        <button class="btn btn-danger ml-md-n5">{{__('message.AccountSuspended')}}</button>
                                    @endif


                                    <div class="header-elements">
                                    </div>
                                </div>
                                <div class="chart position-relative" id="traffic-sources"></div>
                            </div>

                            <div class="card p-3" style="background-color:rgba(54,54,54,0.65);color: white">
                                <div class="card-body py-0">
                                    <div class="row">
                                        <div class="col-md-6 col-12 font-size-lg">
                                            <p>{{__('message.Position')}}: {{\Illuminate\Support\Facades\Auth::user()->PositionUser}}</p>
                                            <p>{{__('message.WebSite')}}: <a href="{{$Booth->WebSite}}">{{$Booth->WebSite}}</a></p>
                                            <p>{{__('message.Company')}} {{__('message.Representative')}}: {{$Booth->Representative}}</p>
                                            <p>{{__('message.Company')}} {{__('message.email')}}: {{$Booth->User->email }}</p>
                                            <p>{{__('message.Company')}} {{__('message.Name')}}: {{$Booth->CompanyName}}</p>


                                            @if ($Booth->User->companyAddress != null)
                                                <p>
                                                    Company Address : {{$Booth->User->companyAddress}}
                                                </p>
                                            @endif

                                            @if ($Booth->User->zipCode != null)
                                                <p>
                                                    Zip Code : {{$Booth->User->zipCode}}
                                                </p>
                                            @endif

                                            @if ($Booth->User->mainCompany != null)
                                                <p>
                                                    Main Company : {{$Booth->User->mainCompany}}
                                                </p>
                                            @endif

                                            @if ($Booth->User->institutionEmail != null)
                                                <p>
                                                    Institution Email : {{$Booth->User->institutionEmail}}
                                                </p>
                                            @endif

                                            @if ($Booth->User->phone != null)
                                                <p>
                                                    phone : {{$Booth->User->phone }}
                                                </p>
                                            @endif

                                            @if ($Booth->User->fax != null)
                                                <p>
                                                    Fax : {{$Booth->User->fax}}
                                                </p>
                                            @endif

                                            @if ($Booth->User->institution != null)
                                                <p>
                                                    Institution : {{$Booth->User->institution}}
                                                </p>
                                            @endif


                                        </div>
                                        <div class="col-md-6 col-12 font-size-lg">
                                            <div class="btn-group w-50">

                                                <a  class="btn btn-info w-100" data-toggle="modal" href="#view_jobs">
                                                    {{__('message.ViewJobs')}}
                                                </a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="chart position-relative" id="traffic-sources"></div>
                            </div>
                            <div class="row">

                                <div class="col-xl-6">
                                    <div class="card p-3" style="background-color:rgba(54,54,54,0.65);color: white;height: 250px;">
                                        <div class="card-body py-0">
                                            <p>
                                                First Name: {{\Illuminate\Support\Facades\Auth::user()->FirstName}}
                                            </p>
                                            <p>
                                                Last Name: {{\Illuminate\Support\Facades\Auth::user()->LastName}}
                                            </p>
                                            <p>
                                                Email: {{\Illuminate\Support\Facades\Auth::user()->email}}</p>
                                            <p>
                                                Tel: {{\Illuminate\Support\Facades\Auth::user()->PhoneNumber}}
                                            </p>
                                        </div>
                                        <div class="chart position-relative" id="traffic-sources"></div>
                                    </div>
                                </div>



                                <div class="col-xl-6">
                                    <div class="card p-3" style="background-color:rgba(54,54,54,0.65);;color: white">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <form action="{{route('ExhibitorOperator.ChangePassword')}}" method="post" class="w-100">
                                                    @csrf
                                                    <div class="form-group col-12">
                                                        <input class="form-control" type="password" placeholder="{{__('message.Old')}} {{__('message.password')}}"
                                                               name="OldPassword">
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <input class="form-control" type="password" placeholder="{{__('message.New')}} {{__('message.password')}}"
                                                               name="password">
                                                    </div>

                                                    <div class="form-group col-12">
                                                        <input class="form-control" type="password" placeholder="{{__('message.passwordConfrimation')}}" name="password_confirmation">                                                </div>

                                                    <div class="form-group text-center">
                                                        {{--                                                    <input type="submit" class="btn btn-success ml-2" value="Update Password">--}}
                                                        <button class="btn btn-success ml-2" type="submit">{{__('message.Update')}}</button> <i
                                                            class="fa fa-info-circle" style="color: black;margin-left: 5px"
                                                            data-toggle="tooltip"
                                                            onclick="show_info('{{__('message.passwordHint')}}')"></i>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="chart position-relative" id="traffic-sources"></div>
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


    </div>
    </body>




@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function show_info(javad) {
            Swal.fire({
                text: javad,
            })
        }
    </script>
@endsection
