@extends('layouts.Panel')
@section('content')
    <header class="d-flex masthead" style="background-image: url({{\App\Site::AdminBackground()}});padding: 45px;padding-top: 0px;padding-right: 0px;padding-left: 0px;">
        <div class="container my-auto text-center">
            <h3 class="mb-5"></h3>
         <div class="pull-right d-inline m-0">


                @if(\App\Site::find(1)->Logo1)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo1}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo2)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo2}}"
                         style="width: 113px;margin-right: 34px;">
                @endif
                @if(\App\Site::find(1)->Logo3)
                    <img class="float-right" src="{{\App\Site::find(1)->Logo3}}"
                         style="width: 113px;margin-right: 34px;">
                @endif

            </div>

            <div style="width: 354px;height: 45px;background-color: #525252; margin-top: 70px" class="rounded">

                <div class="pull-right p-1">
                    <button type="button" data-toggle="tooltip" data-placement="top" title="Change Language" onclick="$('#Lang_Modal').modal('show')" class="btn btn-warning">
                        <i class="fa fa-globe"></i>
                    </button>
                    <div class="modal fade" role="dialog" tabindex="-1" id="Lang_Modal">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                                                        <h4>{{__('message.ChangeLang')}}</h4>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">×</span></button>
                                </div>
                                <div class="modal-body">

                                    <div class="dropdown">

                                        <a style="text-decoration: none !important" class="" href="{{ url('locale/en') }}"><i
                                                class="fa fa-globe"></i>English</a><br>
                                        <a style="text-decoration: none !important" class="" href="{{ url('locale/de') }}"><i
                                                class="fa fa-globe"></i>German</a><br>
                                        <a style="text-decoration: none !important" class="" href="{{ url('locale/al') }}"><i
                                                class="fa fa-globe"></i>Shqip</a><br>


                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-light btn-block" data-dismiss="modal" type="button">Close
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="pull-right p-1 logout_section">
                    <button data-toggle="tooltip" data-placement="top" title="Logout" onclick="document.getElementById('logout-form').submit()" class="btn btn-danger">
                        <i class="fa fa-sign-out"></i>
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>


                </div>

                <div class="pull-right p-1 logout_section">
                    <button data-toggle="tooltip" data-placement="top" title="View Auditorium" onclick="window.open('{{route('Auditorium')}}', '_blank').submit()" class="btn btn-success">
                        <i class="fa fa-eye"></i>
                    </button>


                </div>





                <div class="d-inline float-left"
                     style="background-color: transparent;height: 26px;width: 122px;margin-left: 2px;">
                    <h6 class="text-left"
                        style="width: 115px;height: 41px;padding: 7px;color: rgb(255,255,255);margin-left: 4px;">
                        {{\Illuminate\Support\Str::limit(\Illuminate\Support\Facades\Auth::user()->UserName , 18)}} </h6>
                </div>



            </div>
            <div class="d-inline-block float-left" style="background-color: rgba(0,0,0,0);width: 1126px;height: 452px;margin-right: 46px;padding: 2px;padding-top: 0px;padding-right: 3px;">
                <div class="border rounded d-block float-left border" style="width: 230px;height: 480px;background-color: rgba(54,54,54,0.77);padding: 7px;color: #363636;padding-top: 7px;">
                    <div>
                        <h5 class="text-left" style="color: rgb(255,255,255);">{{__('message.Manage')}} {{__('message.Event')}}</h5>
                        <div class="text-left" style="/*background-color: #00000000;*/height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="{{route('AdminOperator.index')}}" style="color: #b3b8b8;">{{__('message.Inbox')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #363636;"><a class="text-left" href="{{route('AdminOperator.History')}}" style="color: #b3b8b8;">{{__('message.History')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('AdminOperator.Lounge')}}" style="color: #b3b8b8;">{{__('message.Lounge')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('AdminOperator.Statistics')}}" style="color: #b3b8b8;">{{__('message.Statistics')}}</a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('AdminOperator.RegisteredVisitor')}}" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Visitors')}}<br></a></div>
                        <div class="text-left active-page" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;color: #b3b8b8;"><a class="text-left" href="#" style="color: #b3b8b8;">{{__('message.Registered')}} {{__('message.Exhibitors')}}<br></a></div>
                        <div class="text-left" style="background-color: #00000000;height: 30px;margin-top: 1px;padding: 2px;padding-bottom: -1px;padding-top: -2px;padding-left: 13px;width: 216px;"><a class="text-left" href="{{route('AdminOperator.Setting')}}" style="color: #b3b8b8;">{{__('message.Setting')}}</a></div>

                    </div>
                </div>
                <div class="border rounded d-block float-left border" style="width: 861px;height: 452px;background-color: rgba(168,168,168,0.84);padding: 7px;color: #363636;margin-left: 22px;">
                    <div class="border rounded d-inline float-left scroll_box" style="width: 277px;height: 369px;margin-top: 4px;">
                        <form style="height: 7px;margin-bottom: 23px;width: 205px;" action="{{route('AdminOperator.RegisteredExhibitor')}}">
                            <div class="form-group" style="width: 402px;">
                                <input class="form-control float-left" type="search" placeholder="Registered Exhibitors List" style="width: 222px;height: 33px;margin-bottom: 24px;" name="SearchTerm">
                                <button class="btn float-left shadow-none" type="submit" style="width: 1px;margin-right: 16px;margin-bottom: 31px;margin-top: -4px;"><i class="fa fa-search" style="font-size: 20px;margin-bottom: 16px;margin-right: 19px;"></i></button></div>
                        </form>

                        @foreach($Booths as $booth)
                            <a href="?BoothID={{$booth->id}}">

                            <div
                            @if(request()->BoothID == $booth->id)
                            class="border rounded" style="background-color: #c2c5c5;height: 40px;width: 258px;margin-left: 4px;margin-top: 5px;"
                                @else
                                style="background-color: transparent;height: 40px;width: 258px;margin-left: 4px;margin-top: 5px;"
                                @endif
                            >
                            <p class="text-left d-inline float-left" style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: #000000;">{{\Illuminate\Support\Str::limit($booth->CompanyName , 8)}}</p>
                            <div class="text-right border rounded float-right" style="height: 29px;width: 89px;margin-top: 4px;margin-right: 14px;padding: 0px;background-color: @if($booth->User->AccountStatus == 'Active') #05c965 @else #363636 @endif ;padding-left: 4px;">
                                <p class="d-inline float-left" style="margin-right: 6px;color: rgb(255,255,255);">
                                    @if($booth->User->AccountStatus == 'Active') {{__('message.Confirmed')}} @else {{__('message.Pending')}} @endif
                                </p>
                            </div>
                        </div>
                            </a>

                        @endforeach
                    </div>
                    @if(request()->BoothID)
                    <div class="border rounded float-left" style="width: 542px;height: 423px;margin-top: 5px;margin-left: 12px;background-color: #ffffff;">
                        <div class="border rounded border-dark" style="height: 260px;width: 527px;margin-left: 7px;margin-top: 9px;padding: 14px;padding-top: 7px;padding-bottom: -1px;">
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Company')}} {{__('message.Name')}}:</strong>&nbsp;<span>{{$Booth->CompanyName}}</span></p>
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Company')}} {{__('message.Representative')}}:&nbsp;</strong><span>{{$Booth->Representative}}</span></p>
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.WebSite')}}:&nbsp;</strong><span>{{$Booth->WebSite}}</span></p>
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Position')}}:</strong>&nbsp;<span>{{$Booth->User->Position}}</span></p>
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Tel')}}:</strong>&nbsp;<span>{{$Booth->User->PhoneNumber}}</span></p>
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.Country')}}:&nbsp;</strong><span>{{$Booth->User->Country}}</span></p>
                            <p class="text-left" style="color: #7b7b7b;margin-bottom: 5px;"><strong>{{__('message.email')}}:&nbsp;</strong><span>{{$Booth->User->email}}</span></p>
                            <div><a class="btn btn-primary btn-sm" role="button" data-toggle="modal" href="#job_vacan_mod" title="{{__('message.JobVacancies')}}" style="width: 142px;font-size: 17px;margin-right: 15px;">{{\Illuminate\Support\Str::limit(__('message.JobVacancies'), 10)}}</a>
                                <a class="btn btn-primary btn-sm" role="button" data-toggle="modal" href="#operators_modal" title="{{__('message.Operators')}}" style="width: 142px;font-size: 17px;margin-right: 16px;">{{\Illuminate\Support\Str::limit(__('message.Operators'), 10)}} </a>
                                <a class="btn btn-primary btn-sm" role="button" data-toggle="modal" href="#booth_info_modal" title="{{__('message.BoothInfo')}}" style="width: 142px;font-size: 17px;">{{\Illuminate\Support\Str::limit(__('message.BoothInfo'), 10)}} </a>
                                <div class="modal fade" role="dialog" tabindex="-1" id="job_vacan_mod" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>{{__('message.JobVacancies')}}</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                            <div class="modal-body">
                                                <div class="col-md-12 search-table-col" style="margin-top: 4px;">
                                                    <div class="form-group pull-right col-lg-4"><input type="text" class="search form-control" placeholder="Search" style="width: 122px;"></div><span class="counter pull-right"></span>
                                                    <div class="table-responsive table-bordered table table-hover table-bordered results">
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bill-header cs">
                                                            <tr>
                                                                <th id="trs-hd" class="col-lg-1">{{__('message.Title')}}</th>
                                                                <th id="trs-hd" class="col-lg-1">{{__('message.Description')}}</th>
                                                                <th id="trs-hd" class="col-lg-2">{{__('message.Count')}}</th>
                                                                <th id="trs-hd" class="col-lg-3">{{__('message.Salary')}} €</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="warning no-result">
                                                                <td colspan="12"><i class="fa fa-warning"></i>&nbsp;{{__('message.NoResult')}}</td>
                                                            </tr>
                                                            @foreach($Booth->Jobs as $job)
                                                                <tr>
                                                                    <td>{{$job->Title}}</td>
                                                                    <td class="scroll_box" style="height: 101px;">{{$job->Description}}</td>
                                                                    <td>{{$job->Number}}</td>
                                                                    <td>{{$job->Salary}} €</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">{{__('message.Close')}}</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" role="dialog" tabindex="-1" id="operators_modal" style="width: 1244px; display: none;" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>{{__('message.ListOfOperators')}}</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                            <div class="modal-body">
                                                <div class="col-md-12 search-table-col" style="margin-top: 35px;">
                                                    <div class="form-group pull-right col-lg-4" style="margin-top: -37px;"><input type="text" class="search form-control" placeholder="Search..."></div><span class="counter pull-right"></span>
                                                    <div class="table-responsive table-bordered table table-hover table-bordered results" style="margin-top: -36px;">
                                                        <table class="table table-bordered table-hover">
                                                            <thead class="bill-header cs">
                                                            <tr>
                                                                <th id="trs-hd" class="col-lg-1">{{__('message.number')}}</th>
                                                                <th id="trs-hd" class="col-lg-2">{{__('message.fn')}}</th>
                                                                <th id="trs-hd" class="col-lg-3">{{__('message.ln')}}</th>
                                                                <th id="trs-hd" class="col-lg-2">{{__('message.Tel')}}</th>
                                                                <th id="trs-hd" class="col-lg-2">{{__('message.Email')}}</th>
                                                                <th id="trs-hd" class="col-lg-2">{{__('message.Action')}}</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr class="warning no-result">
                                                                <td colspan="12"><i class="fa fa-warning"></i>&nbsp; {{__('message.NoResult')}}</td>
                                                            </tr>
                                                            @foreach(\App\booth::Oprators($Booth->id) as $Oprator)
                                                                <tr>
                                                                    <td>{{$loop->iteration}}</td>
                                                                    <td>{{$Oprator->FirstName}}</td>
                                                                    <td>{{$Oprator->LastName}}</td>
                                                                    <td>{{$Oprator->PhoneNumber}}</td>
                                                                    <td>{{$Oprator->email}}</td>
                                                                    <td>
                                                                        <a class="btn @if($Oprator->AccountStatus == 'Active') btn-danger @else btn-success @endif" role="button" data-toggle="tooltip" data-bs-tooltip="" style="margin-left: 5px;" href="{{route('Admin.SuspendUserWithUrl' , $Oprator->id)}}" title="" data-original-title="Suspend User">
                                                                            <i class="fa fa-user-times" style="font-size: 15px;"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">{{__('message.Close')}}</button></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" role="dialog" tabindex="-1" id="booth_info_modal" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4>{{__('message.BIFFLA')}}</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
                                            <div class="modal-body">
                                                <p class="text-left text-muted"><strong>{{__('message.CLL')}}</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Logo}}</a></span></p>
                                                <p class="text-left text-muted"><strong>{{__('message.P1L')}}</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Poster1}}</a></span></p>
                                                <p class="text-left text-muted"><strong>{{__('message.P2L')}}</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Poster2}}</a></span></p>
                                                <p class="text-left text-muted"><strong>{{__('message.P3L')}}</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Poster3}}</a></span></p>
                                                <p class="text-left text-muted"><strong>{{__('message.BFL')}}</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Doc1}}</a></span></p>
                                                <p class="text-left text-muted"><strong>{{__('message.VFL')}}</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Video}}</a></span></p>
                                            </div>
                                            <p class="text-left text-muted" style="margin-left: 19px;"><strong>{{__('message.ATC')}}:</strong><span style="margin-left: 13px;"><a class="text-break" href="#" style="width: -54px;">{{$Booth->Description}}</a></span></p>
                                            <div class="modal-footer"><button class="btn btn-light btn-block" data-dismiss="modal" type="button">{{__('message.Close')}}</button></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-left" style="color: #7b7b7b;margin-bottom: 26px;margin-left: 12px;margin-top: 14px;font-size: 24px;width: 544px;">Payment:
                            @if($Booth->User->Payment == 'Paid')
                            <button class="border rounded" style="margin-left: 30px;background-color: #05c965;color: rgb(255,255,255);padding: 0px;padding-right: 33px;padding-left: 36px;" onclick="areyousurePayment()">{{__('message.Paid')}}</button>
                            @else
                            <button class="border rounded" style="margin-left: 30px;background-color: #e91515;color: rgb(255,255,255);padding: 0px;padding-right: 33px;padding-left: 36px;" onclick="areyousurePayment()">{{__('message.Unpaid')}}</button>
                                @endif
                        </p>
                        <form class="float-left" style="margin-left: 16px;height: 63px;margin-bottom: -25px;" action="{{route('AdminOperator.SuspendBooth' , $Booth->id)}}">
                            <div class="form-group text-left" style="margin-bottom: 3px;height: -9px;">
                                <p class="float-left" style="font-size: 19px;color: rgb(17,138,65);"><strong>{{__('message.ConfirmtheExhibitor')}} : </strong><input type="checkbox" style="width: 21px;height: 17px;margin-left: 6px;" name="BoothStatus" @if($Booth->User->AccountStatus == 'Active') checked @endif></p>
                            </div>
                            <button class="btn btn-block float-right" type="submit" style="margin-bottom: 0px;margin-top: -9px;background-color: #05c965;color: rgb(255,255,255);">{{__('message.Save')}}</button>
                        </form>
                    </div>
                        <form id="mysinsin_form2" action="{{route('AdminOperator.UserPaid')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$Booth->User->id}}" name="UserID">
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </header>
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
@endsection
