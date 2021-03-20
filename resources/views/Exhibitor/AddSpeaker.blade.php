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

    {{--    Hasan start here !!!!--}}



    <body style="background: url('{{\App\Site::ExhibitorBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">
    <div>


    @include("Sidebars.exhibitor-sidebar")

    <!-- Main content -->


        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card card-inbox-ex-h" style="background-color:rgba(54,54,54,0.65);color: white;">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="" class="w-100">
                                     <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">
                                                    Please Write Your Conference Title
                                                </label>
                                                <input type="text" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Please Write Speaker Names Which You Like to ShowUp in Auditorium Agenda
                                                </label>
                                                <input type="text" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="">
                                                    Please Write Abstract Your Conference
                                                </label>
                                                <textarea type="text" class="form-control" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <h4>Speaker Name Table</h4>
                                                <div style="overflow-y: auto;height: 450px;">
                                                    <table class="table table-light table-hover table-bordered text-center" style="">
                                                        <thead>
                                                        <th>id</th>
                                                        <th>SpeakerName</th>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>1</td>
                                                                <td>name1</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>name2</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>name3</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>name4</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>name5</td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>name6</td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td>name7</td>
                                                            </tr>
                                                            <tr>
                                                                <td>8</td>
                                                                <td>name8</td>
                                                            </tr>
                                                            <tr>
                                                                <td>9</td>
                                                                <td>name9</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>




                                            <div class="modal fade" role="dialog" tabindex="-1" id="AddSpeaker">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="text-dark">{{__('message.SelectBoothColor')}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                <span aria-hidden="true">×</span></button>
                                                        </div>
                                                        <div class="modal-body text-dark">
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Username:
                                                                </label>
                                                                <input type="text" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Email:
                                                                </label>
                                                                <input type="email" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                    Password
                                                                </label>
                                                                <input type="password" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="">
                                                                   Password Confirmation
                                                                </label>
                                                                <input type="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">


                                                            <button class="btn btn-success w-100">Save</button>
                                                            <button class="btn btn-light btn-block"
                                                                    data-dismiss="modal" type="button">
                                                                {{__('message.Close')}}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <button type="button" onclick="$('#AddSpeaker').modal('show')" class="btn btn-primary w-100">Add Speaker To List</button>
                                        </div>
                                         <div class="col-md-4">
                                             <h4 class="mt-3 mt-md-0">Please Suggest Three Dates Which You Prefer For Your Conference</h4>
                                             <div class="form-group">
                                                 <label for="">Prefer Date1 :</label>
                                                 <input type="date" class="form-control">
                                             </div>
                                             <div class="form-group">
                                                 <label for="">Prefer Date2 :</label>
                                                 <input type="date" class="form-control">
                                             </div>
                                             <div class="form-group">
                                                 <label for="">Prefer Date3 :</label>
                                                 <input type="date" class="form-control">
                                             </div>
                                         </div>
                                    </div>
                                    <input type="text" class="mt-3 btn btn-success w-100" value="Submit Your Request">
                                </form>




{{--                                Boot strap Modal Start Here !!!--}}



                            <!-- Trigger the modal with a button -->
{{--                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>--}}

                                <!-- Modal -->
                                <div id="myModal" class="modal fade" role="dialog">
                                    <div class="modal-dialog text-dark">

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Please Fill Your Speaker Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Username:</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Email:</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password:</label>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password Confirmation:</label>
                                                    <input type="text" class="form-control">
                                                </div>

                                                <input type="submit" value="Add to List" class="btn btn-success w-100">

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default w-100" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>



{{--                                Bootstrap Modal End Here !!! --}}




                            </div>
                        </div>
                        <!-- /traffic sources -->
                    </div>
                </div>
                <!-- /main charts -->
            </div>
            <!-- /content area -->
        </div>



        <!--/Main Content  -->
    </div>


    </div>
    </body>




@endsection


@section("js")


    <script>

        my_price_var = document.getElementById('price_id').innerText

        if (my_price_var == '' || my_price_var == '0' || my_price_var == 0) {


            document.getElementById('price_id').innerText = 'Free'
            $('#paypal_btn').prop('disabled', true)
            $('#paypal_btn').text('{{__('message.ExFree')}}')

        }

    </script>




@stop
