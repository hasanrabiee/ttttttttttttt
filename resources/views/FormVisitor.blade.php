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
                        <div class="card" style="background-color:rgba(168,168,168,0.5);color: white">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">

                                <h3>Visitor Forms</h3>

                                <form action="{{route("Admin.VisitorFormPost")}}" class="w-100" method="post">
                                    @csrf

                                    <table class="table table-striped table-hover table-bordered table-light text-center">
                                        <thead>
                                        <th>name</th>
                                        <th>status</th>
                                        <th>action</th>
                                        </thead>


                                        <tbody>
                                            <tr>
                                                <td>education</td>
                                                @if (\App\VisitorForm::first()->education == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif

                                                <td>

                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="education"  @if (\App\VisitorForm::first()->education == "active") checked @endif>

                                                </td>
                                            </tr>


                                            <tr>
                                                <td>gender</td>
                                                @if (\App\VisitorForm::first()->gender == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif

                                                <td>

                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="gender"  @if (\App\VisitorForm::first()->gender == "active") checked @endif>

                                                </td>
                                            </tr>

                                            <tr>
                                                <td>countryStudy</td>
                                                @if (\App\VisitorForm::first()->countryStudy == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif                                            <td>
                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="countryStudy"  @if (\App\VisitorForm::first()->countryStudy == "active") checked @endif>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>InterstedDegree</td>
                                                @if (\App\VisitorForm::first()->InterestedDegree == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif
                                                <td>
                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="InterestedDegree"  @if (\App\VisitorForm::first()->InterestedDegree == "active") checked @endif>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>InterestedField</td>

                                                @if (\App\VisitorForm::first()->InterestedField == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif
                                                <td>
                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="InterestedField"  @if (\App\VisitorForm::first()->InterestedField == "active") checked @endif>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>languageOfStudy</td>
                                                @if (\App\VisitorForm::first()->languageOfStudy == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif
                                                <td>
                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="languageOfStudy"  @if (\App\VisitorForm::first()->languageOfStudy == "active") checked @endif>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td>onlineDegreeProgram</td>
                                                @if (\App\VisitorForm::first()->onlineDegreeProgram == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif
                                                <td>
                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="onlineDegreeProgram"  @if (\App\VisitorForm::first()->onlineDegreeProgram == "active") checked @endif>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>interestedScholarShip</td>
                                                @if (\App\VisitorForm::first()->interestedScholarShip == "active")
                                                    <td>active</td>
                                                @else
                                                    <td>DeActive</td>
                                                @endif
                                                <td>
                                                    <input type="checkbox" value="active" style="width: 100px !important;" name="interestedScholarShip"  @if (\App\VisitorForm::first()->interestedScholarShip == "active") checked @endif>
                                                </td>
                                            </tr>
                                        </tbody>

                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <label for="" class="text-dark">education Items</label>
                                        <input type="text" class="form-control" name="educationItems" value="{{\App\VisitorForm::first()->educationItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">interested Degree Items</label>
                                        <input type="text" class="form-control" name="interestedDegreeItems" value="{{\App\VisitorForm::first()->interestedDegreeItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">interested Field Items</label>
                                        <input type="text" class="form-control" name="interestedFieldItems" value="{{\App\VisitorForm::first()->interestedFieldItems}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">profession Items</label>
                                        <input type="text" class="form-control" name="VisitorProfession" value="{{\App\Site::first()->VisitorProfession}}">
                                    </div>

                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            Genders:
                                        </label>
                                        <input type="text" class="form-control" name="VisitorGender" value="{{\App\Site::first()->VisitorGender}}">
                                    </div>

                                    <input type="submit" value="Save Changes" class="btn btn-success w-100">
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
