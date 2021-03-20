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







{{--    hasan start here !!!!--}}



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
                                        <div class="col-md-4">
                                            <form onblur="is_typing = false" onfocus="is_typing = true" action="{{route('Admin.RegisteredExhibitor')}}" class="w-100">
                                                <div class="input-group mt-2 mb-2">
                                                    <input type="text" class="form-control" name="SearchTerm" placeholder="{{__('message.Registered')}} {{__('message.Exhibitors')}} List">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-success" type="submit">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="p-1" style="border: 1px solid white;border-radius: 5px;height: 850px;overflow-y: auto;overflow-x: hidden">

                                                @foreach($Booths as $booth)
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <a href="?BoothID={{$booth->id}}" @if(request()->BoothID == $booth->id) class="btn btn-primary mb-3 w-100" @else class="text-white btn btn-outline-dark mb-3 w-100" @endif>
                                                                {{\Illuminate\Support\Str::limit($booth->CompanyName , 12)}}
                                                                <a href="?delete_group=99"></a>
                                                            </a>
                                                        </div>
                                                        <div class="col-5">
                                                    <span @if($booth->User->AccountStatus == 'Active') class="btn btn-success w-100" @else class="btn btn-dark w-100" @endif style="font-size: 12px">
                                                        @if($booth->User->AccountStatus == 'Active') {{__('message.Confirmed')}} @else {{__('message.Pending')}} @endif
                                                    </span>
                                                        </div>
                                                    </div>

                                                @endforeach
                                            </div>

                                            <form action="{{route("Admin.SuspendUncompletedBooths")}}" class="w-100" method="post">
                                                @csrf
                                                <input type="submit" class="btn btn-secondary w-100 mt-2" value="Suspend Exhibitors with Uncompleted Booth">
                                            </form>

                                    </div>
                                    @if(request()->BoothID)
                                    <div class="col-md-8">
                                        <div class="row">


                                            <div class="col-12 ml-md-1 mt-2 mt-md-0" style="border: 1px solid white;border-radius: 5px;height: 700px;overflow-y: auto">
                                                <div class="ml-md-3 mt-2">
                                                    <div class="text-center">
                                                        <img src="{{$Booth->Logo}}" alt="" width="100">
                                                    </div>

                                                    <h3>
                                                        Booth Location : Hall {{$Booth->Hall}}  -  @if ($Booth->Position != null) No. {{$Booth->Position}} @else Not Chosen @endif
                                                    </h3>

                                                    <p><strong>{{__('message.Company')}} {{__('message.Name')}}
                                                            :</strong>&nbsp;<span>{{$Booth->CompanyName}}</span></p>
                                                    <p><strong>{{__('message.Company')}} {{__('message.Representative')}}
                                                            :&nbsp;</strong><span>{{$Booth->Representative}}</span></p>
                                                    <p><strong>{{__('message.WebSite')}}:&nbsp;</strong><span>{{$Booth->WebSite}}</span></p>
                                                    <p> <strong>{{__('message.Position')}}
                                                            :</strong>&nbsp;<span>{{$Booth->User->Position}}</span></p>
                                                    <p><strong>{{__('message.Country')}}
                                                            :&nbsp;</strong><span>{{$Booth->User->Country}}</span></p>
                                                    <p><strong>{{__('message.email')}}:&nbsp;</strong><span>{{$Booth->User->email}}</span></p>

                                                    <p><strong>{{__('message.Tel')}}:</strong>&nbsp;<span>{{$Booth->User->PhoneNumber}}</span></p>

                                                    @if ($Booth->User->companyAddress != null)
                                                        <p><strong>Company Address:&nbsp;</strong><span>{{$Booth->User->companyAddress}}</span></p>
                                                    @endif

                                                    @if ($Booth->User->zipCode != null)
                                                        <p><strong>Zip Code:&nbsp;</strong><span>{{$Booth->User->zipCode}}</span></p>
                                                    @endif

                                                    @if ($Booth->User->mainCompany != null)
                                                        <p><strong>Main Company:&nbsp;</strong><span>{{$Booth->User->mainCompany}}</span></p>
                                                    @endif

                                                    @if ($Booth->User->institutionEmail != null)
                                                        <p><strong>Institution Email:&nbsp;</strong><span>{{$Booth->User->institutionEmail}}</span></p>
                                                    @endif

                                                    @if ($Booth->User->phone != null)
                                                        <p><strong>phone:&nbsp;</strong><span>{{$Booth->User->phone}}</span></p>
                                                    @endif

                                                    @if ($Booth->User->fax != null)
                                                        <p><strong>fax:&nbsp;</strong><span>{{$Booth->User->fax}}</span></p>
                                                    @endif

                                                    @if ($Booth->User->institution != null)
                                                        <p><strong>institution:&nbsp;</strong><span>{{$Booth->User->institution}}</span></p>
                                                    @endif



                                                    <p>Payment :
                                                        @if($Booth->User->Payment == 'Paid')
                                                            <button class="btn btn-success p-0"
                                                                    onclick="areyousurePayment()">{{__('message.Paid')}}</button>
                                                        @else
                                                            <button class="btn btn-danger p-0"
                                                                    onclick="areyousurePayment()">{{__('message.Unpaid')}}</button>
                                                        @endif</p>
                                                    <br>
                                                    <div class="row mb-2">
                                                        <div class="col-md-4">






                                                            <a class="btn text-white w-100" data-toggle="modal" href="#job_vacan_mod" style="background-color:#808080;">
                                                                Job Vacancies
                                                            </a>
                                                        </div>
                                                        <div class="col-md-4 mt-2 mt-md-0">
                                                            <a data-toggle="modal" href="#operators_modal" class="btn text-white w-100" style="background-color:#808080;">
                                                                Operators
                                                            </a>
                                                        </div>
                                                        <div class="col-md-4 mt-2 mt-md-0">
                                                            <a data-toggle="modal" href="#booth_info_modal" class="btn text-white w-100" style="background-color:#808080;">
                                                                Booth Info
                                                            </a>
                                                        </div>


                                                    </div>

                                                </div>

                                            </div>

                                            <div class="container mt-3">

                                                <form class="w-100"
                                                      action="{{route('Admin.SuspendBooth' , $Booth->id)}}">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group text-left">
                                                                <h3 class="text-success">
                                                                    {{__('message.ConfirmtheExhibitor')}}:
                                                                    <input type="checkbox" style="width: 21px;height: 17px;margin-left: 6px;"
                                                                           name="BoothStatus"
                                                                           @if($Booth->User->AccountStatus == 'Active') checked @endif>
                                                                </h3>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div style="position: absolute;right: 0px;">
                                                                <a onclick="event.preventDefault() ; return areyousure()" id="mysinsin_form"
                                                                   href="{{route('Admin.RemoveExhibitor' , $Booth->id)}}">
                                                                    <button class="btn btn-danger" type="button">{{__('message.DeleteCompany')}}</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-success w-100" type="submit">
                                                        {{__('message.Save')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
{{--                                        Modals--}}
                                        <div class="modal fade text-dark" role="dialog" tabindex="-1" id="job_vacan_mod"
                                             aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>{{__('message.JobVacancies')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
{{----}}

                                                        @foreach($Booth->Jobs as $job)
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
                                                        <button class="btn btn-light btn-block" data-dismiss="modal"
                                                                type="button">{{__('message.Close')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" role="dialog" tabindex="-1" id="operators_modal"
                                             style="width: 1244px; display: none;" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>{{__('message.ListOfOperators')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-md-12 search-table-col" style="margin-top: 35px;">
                                                            <div class="form-group pull-right col-lg-4"
                                                                 style="margin-top: -37px;"><input type="text"
                                                                                                   class="search form-control"
                                                                                                   placeholder="Search...">
                                                            </div>
                                                            <span class="counter pull-right"></span>
                                                            <div
                                                                class="table-responsive table-bordered table table-hover table-bordered results"
                                                                style="margin-top: -36px;">
                                                                <table class="table table-bordered table-hover">
                                                                    <thead class="bill-header cs">
                                                                    <tr>
                                                                        <th id="trs-hd"
                                                                            class="col-lg-1">{{__('message.number')}}</th>
                                                                        <th id="trs-hd"
                                                                            class="col-lg-2">{{__('message.fn')}}</th>
                                                                        <th id="trs-hd"
                                                                            class="col-lg-3">{{__('message.ln')}}</th>
                                                                        <th id="trs-hd"
                                                                            class="col-lg-2">{{__('message.Tel')}}</th>
                                                                        <th id="trs-hd"
                                                                            class="col-lg-2">{{__('message.Email')}}</th>
                                                                        <th id="trs-hd"
                                                                            class="col-lg-2">{{__('message.Action')}}</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr class="warning no-result">
                                                                        <td colspan="12"><i
                                                                                class="fa fa-warning"></i>&nbsp; {{__('message.NoResult')}}
                                                                        </td>
                                                                    </tr>
                                                                    @foreach(\App\booth::Oprators($Booth->id) as $Oprator)
                                                                        <tr>
                                                                            <td>{{$loop->iteration}}</td>
                                                                            <td>{{$Oprator->FirstName}}</td>
                                                                            <td>{{$Oprator->LastName}}</td>
                                                                            <td>{{$Oprator->PhoneNumber}}</td>
                                                                            <td>{{$Oprator->email}}</td>
                                                                            <td>
                                                                                <a class="btn @if($Oprator->AccountStatus == 'Active') btn-danger @else btn-success @endif"
                                                                                   role="button" data-toggle="tooltip"
                                                                                   data-bs-tooltip=""
                                                                                   style="margin-left: 5px;"
                                                                                   href="{{route('Admin.SuspendUserWithUrl' , $Oprator->id)}}"
                                                                                   title=""
                                                                                   data-original-title="Suspend User">
                                                                                    <i class="fa fa-user-times"
                                                                                       style="font-size: 15px;"></i>
                                                                                </a>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-light btn-block" data-dismiss="modal"
                                                                type="button">{{__('message.Close')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" role="dialog" tabindex="-1" id="booth_info_modal"
                                             aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4>{{__('message.BIFFLA')}}</h4>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close"><span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p class="text-left text-muted">
                                                            <strong>{{__('message.CLL')}}</strong><span
                                                                style="margin-left: 13px;"><a class="text-break" target="_blank" href="{{$Booth->Logo}}"
                                                                                              style="width: -54px;">{{$Booth->Logo}}</a></span>
                                                        </p>
                                                        <p class="text-left text-muted">
                                                            <strong>{{__('message.P1L')}}</strong><span
                                                                style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->Poster1}}"
                                                                                              style="width: -54px;">{{$Booth->Poster1}}</a></span>
                                                        </p>
                                                        <p class="text-left text-muted">
                                                            <strong>{{__('message.P2L')}}</strong><span
                                                                style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->Poster2}}#"
                                                                                              style="width: -54px;">{{$Booth->Poster2}}</a></span>
                                                        </p>
                                                        <p class="text-left text-muted">
                                                            <strong>{{__('message.P3L')}}</strong><span
                                                                style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->Poster3}}"
                                                                                              style="width: -54px;">{{$Booth->Poster3}}</a></span>
                                                        </p>
                                                        <p class="text-left text-muted">
                                                            <strong>{{__('message.BFL')}}</strong><span
                                                                style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->Doc1}}"
                                                                                              style="width: -54px;">{{$Booth->Doc1}}</a></span>
                                                        </p>
                                                        <p class="text-left text-muted">
                                                            <strong>{{__('message.VFL')}}</strong><span
                                                                style="margin-left: 13px;"><a target="_blank" class="text-break" href="#"
                                                                                              style="width: -54px;">{{$Booth->Video}}</a></span>
                                                        </p>
                                                    </div>
                                                    <p class="text-left text-muted" style="margin-left: 19px;">
                                                        <strong>{{__('message.ATC')}}:</strong><span
                                                            style="margin-left: 13px;"><a class="text-break" href="#"
                                                                                          style="width: -54px;">{{$Booth->Description}}</a></span>
                                                    </p>

                                                    <p class="text-left text-muted" style="margin-left: 19px;">
                                                        <strong>Instagram Link:</strong><span
                                                            style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->instagram}}"
                                                                                          style="width: -54px;">{{$Booth->instagram}}</a></span>
                                                    </p>

                                                    <p class="text-left text-muted" style="margin-left: 19px;">
                                                        <strong>Facebook Link:</strong><span
                                                            style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->facebook}}"
                                                                                          style="width: -54px;">{{$Booth->facebook}}</a></span>
                                                    </p>

                                                    <p class="text-left text-muted" style="margin-left: 19px;">
                                                        <strong>Linkedin Link:</strong><span
                                                            style="margin-left: 13px;"><a target="_blank" class="text-break" href="{{$Booth->linkedin}}"
                                                                                          style="width: -54px;">{{$Booth->linkedin}}</a></span>
                                                    </p>

                                                    <div class="modal-footer">
                                                        <button class="btn btn-light btn-block" data-dismiss="modal"
                                                                type="button">{{__('message.Close')}}</button>
                                                    </div>
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





@endsection


@section('js')

    <script>
        function areyousurePayment() {
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
                    $("#mysinsin_form2").removeAttr('onsubmit').submit()
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

        function areyousure() {
            Swal.fire({
                title: 'By Delete this All the Company Data will be removed, Are You Sure to Delete This Company?',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Delete Company`,
                denyButtonText: `Cancel`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Deleted!', '', 'success')
                    confirmed_sinsin = true
                    $("#mysinsin_form").removeAttr('onclick')
                    window.location.replace($("#mysinsin_form").attr('href'))

                    return true
                } else if (result.isDenied) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Oops...',
                        text: 'Company Not Deleted',
                    })
                    confirmed_sinsin = false
                    return false
                }
            })
        };

    </script>

@stop

