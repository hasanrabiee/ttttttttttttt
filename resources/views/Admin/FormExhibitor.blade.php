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



                <!-- Main charts-->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card" style="background-color:#006B63;color: white">

                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <h3>{{__("message.ExhibitorsForms")}}</h3>
                                <form action="{{route("Admin.ExhibitorFormPost")}}" class="w-100" method="post">
                                    @csrf

                                    <table class="table table-striped table-hover table-bordered table-light text-center">
                                        <thead>
                                        <th>{{__("message.Name")}}</th>
                                        <th>{{__("message.Status")}}</th>
                                        <th>{{__("message.Action")}}</th>
                                        </thead>

                                        <tbody>

                                        <tr>
                                            <td>{{__("message.Position")}}</td>
                                            @if (\App\ExhibitorForms::first()->position == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="position"  @if (\App\ExhibitorForms::first()->position == "active") checked @endif>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>{{__("message.CompanyAddress")}}</td>

                                            @if (\App\ExhibitorForms::first()->companyAddress == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="companyAddress"  @if (\App\ExhibitorForms::first()->companyAddress == "active") checked @endif>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td>{{__("message.Zipcode")}}</td>
                                            @if (\App\ExhibitorForms::first()->zipCode == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="zipCode"  @if (\App\ExhibitorForms::first()->zipCode == "active") checked @endif>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>{{__("message.WebSite")}}</td>
                                            @if (\App\ExhibitorForms::first()->website == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="website"  @if (\App\ExhibitorForms::first()->website == "active") checked @endif>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__("message.MainCompany")}}</td>
                                            @if (\App\ExhibitorForms::first()->mainCompany == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="mainCompany"  @if (\App\ExhibitorForms::first()->mainCompany == "active") checked @endif>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__("message.InstitutionEmail")}}</td>
                                            @if (\App\ExhibitorForms::first()->institutionEmail == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="institutionEmail"  @if (\App\ExhibitorForms::first()->institutionEmail == "active") checked @endif>
                                            </td>
                                        </tr>



                                        <tr>
                                            <td>{{__("message.Institution")}}</td>
                                            @if (\App\ExhibitorForms::first()->institution == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="institution"  @if (\App\ExhibitorForms::first()->institution == "active") checked @endif>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>{{__("message.Fax")}}</td>
                                            @if (\App\ExhibitorForms::first()->fax == "active")
                                                <td>{{__("message.Active")}}</td>
                                            @else
                                                <td>{{__("message.DeActive")}}</td>
                                            @endif
                                            <td>
                                                <input type="checkbox" value="active" style="width: 100px !important;" name="fax"  @if (\App\ExhibitorForms::first()->fax == "active") checked @endif>
                                            </td>
                                        </tr>
                                        </tbody>

                                    </table>
                                    <br>
                                    <div class="form-group">
                                        <label for="" class="text-dark">
                                            {{__("message.Institution")}}:
                                        </label>
                                        <input type="text" class="form-control" name="institutionItems" value="{{\App\ExhibitorForms::first()->institutionItems}}">
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
