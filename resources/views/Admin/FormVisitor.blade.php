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

    <style>
        input[type=checkbox] {
            zoom:2 ;
        }
    </style>
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
                        <div class="card" style="background-color:#006B63;color: white">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">

                                <h3>{{__("message.VisitorsForm")}}</h3>

                                <form action="{{route("Admin.VisitorFormPost")}}" class="w-100" method="post">
                                    @csrf



                                    <table class="table table-striped table-hover table-bordered table-light text-center">
                                        <thead>
                                        <th>{{__("message.Name")}}</th>
                                        <th>{{__("message.Status")}}</th>
                                        <th>{{__("message.Action")}}</th>
                                        </thead>


                                        <tbody>

                                        <tr>
                                            <td>Student</td>
                                            @if (\App\VisitorForm::first()->studentStatus == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="studentStatus"  @if (\App\VisitorForm::first()->studentStatus == "active") checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>jobSeeker</td>
                                            @if (\App\VisitorForm::first()->jobSeekerStatus == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="jobSeekerStatus"  @if (\App\VisitorForm::first()->jobSeekerStatus == "active") checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>company</td>
                                            @if (\App\VisitorForm::first()->companyStatus == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="companyStatus"  @if (\App\VisitorForm::first()->companyStatus == "active") checked @endif>
                                            </td>
                                        </tr>

                                        <tr class="" style="border-top: 2px solid black">
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>



                                        <tr>
                                            <td>{{__("message.Education")}}</td>
                                            @if (\App\VisitorForm::first()->education == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif

                                            <td>

                                                <input type="checkbox" value="active" style="width: 100px !important;" name="education"  @if (\App\VisitorForm::first()->education == "active") checked @endif>

                                            </td>
                                        </tr>


                                        <tr>
                                            <td>{{__("message.Gender")}}</td>
                                            @if (\App\VisitorForm::first()->gender == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif

                                            <td>

                                                <input type="checkbox" value="active" style="width: 100px !important;" name="gender"  @if (\App\VisitorForm::first()->gender == "active") checked @endif>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__("message.CountryStudy")}}</td>
                                            @if (\App\VisitorForm::first()->countryStudy == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="countryStudy"  @if (\App\VisitorForm::first()->countryStudy == "active") checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{__("message.InterestedDegree")}}</td>
                                            @if (\App\VisitorForm::first()->InterestedDegree == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="InterestedDegree"  @if (\App\VisitorForm::first()->InterestedDegree == "active") checked @endif>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>{{__("message.InterestedField")}}</td>

                                            @if (\App\VisitorForm::first()->InterestedField == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="InterestedField"  @if (\App\VisitorForm::first()->InterestedField == "active") checked @endif>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>{{__("message.LanguageOfStudy")}}</td>
                                            @if (\App\VisitorForm::first()->languageOfStudy == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="languageOfStudy"  @if (\App\VisitorForm::first()->languageOfStudy == "active") checked @endif>
                                            </td>

                                        </tr>

                                        <tr>
                                            <td>{{__("message.OnlineDegreeProgram")}}</td>
                                            @if (\App\VisitorForm::first()->onlineDegreeProgram == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="onlineDegreeProgram"  @if (\App\VisitorForm::first()->onlineDegreeProgram == "active") checked @endif>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__("message.InterestedScholarShip")}}</td>
                                            @if (\App\VisitorForm::first()->interestedScholarShip == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="interestedScholarShip"  @if (\App\VisitorForm::first()->interestedScholarShip == "active") checked @endif>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <label for="" class="text-dark">{{__("message.CurrentLevelOfEducationItems")}}</label>
                                        <input type="text" class="form-control" name="educationItems" value="{{\App\VisitorForm::first()->educationItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">{{__("message.WhatDegreeAreYouInterestedIn?")}} </label>
                                        <input type="text" class="form-control" name="interestedDegreeItems" value="{{\App\VisitorForm::first()->interestedDegreeItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">{{__("message.WhatFieldOfStudyAreYouInterestedIn?")}}</label>
                                        <input type="text" class="form-control" name="interestedFieldItems" value="{{\App\VisitorForm::first()->interestedFieldItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">{{__("message.ProfessionItems")}}</label>
                                        <input type="text" class="form-control" name="VisitorProfession" value="{{\App\Site::first()->VisitorProfession}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.Gender")}}:
                                        </label>
                                        <input type="text" class="form-control" name="VisitorGender" value="{{\App\Site::first()->VisitorGender}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.CityItems")}}:
                                        </label>
                                        <input type="text" class="form-control" name="cityItems" value="{{\App\VisitorForm::first()->cityItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.InWhichCountryAreYouInterestedInStudy")}}
                                        </label>
                                        <input type="text" class="form-control" name="countryInterestedItems" value="{{\App\VisitorForm::first()->countryInterestedItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">

                                            {{__("message.AreYouInterestedForOnlineDegreeProgram")}}

                                        </label>
                                        <input type="text" class="form-control" name="onlineDegreeProgramsItems" value="{{\App\VisitorForm::first()->onlineDegreeProgramsItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.AdmissionSemesterItems")}}:
                                        </label>
                                        <input type="text" class="form-control" name="admissionSemesterItems" value="{{\App\VisitorForm::first()->admissionSemesterItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.ProfessionInterestedItems")}}:
                                        </label>
                                        <input type="text" class="form-control" name="professionInterestedItems" value="{{\App\VisitorForm::first()->professionInterestedItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.ProfileItems")}}:
                                        </label>
                                        <input type="text" class="form-control" name="profileItems" value="{{\App\VisitorForm::first()->profileItems}}">
                                    </div>

                                    <input type="submit" value="{{__("message.SaveChanges")}}" class="btn btn-success w-100">
                                </form>
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
