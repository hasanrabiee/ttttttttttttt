@extends('layouts.Panel')


@section("Head")


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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

        // Load Charts and the corechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Draw the pie chart for Sarah's pizza when Charts is loaded.
        google.charts.setOnLoadCallback(drawSarahChart);

        // Draw the pie chart for the Anthony's pizza when Charts is loaded.
        google.charts.setOnLoadCallback(drawAnthonyChart);


        google.charts.setOnLoadCallback(donut);


        google.charts.setOnLoadCallback(professionChart);


        // Callback that draws the pie chart for Sarah's pizza.
        function drawSarahChart() {

            // Create the data table for Sarah's pizza.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');







            data.addRows([

                @foreach($Date as $item)

                    ['{{\Carbon\Carbon::parse($item->date)->format('M-d')}}', {{$item->views}}],

                @endforeach
            ]);

            // Set options for Sarah's pie chart.
            var options = {title:'',
                width:750,
                height:500
                };

            // Instantiate and draw the chart for Sarah's pizza.
            var chart = new google.visualization.PieChart(document.getElementById('Sarah_chart_div'));
            chart.draw(data, options);
        }

        // Callback that draws the pie chart for Anthony's pizza.
        function drawAnthonyChart() {

            // Create the data table for Anthony's pizza.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([
                @foreach($Company as $item)
                    ['{{\App\booth::find($item->BoothID)->CompanyName}}', {{$item->views}}],
                @endforeach
            ]);

            // Set options for Anthony's pie chart.
            var options = {title:'',
                width:750,
                height:500
            };

            // Instantiate and draw the chart for Anthony's pizza.
            var chart = new google.visualization.PieChart(document.getElementById('Anthony_chart_div'));
            chart.draw(data, options);
        }


        function donut() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Hours per Day'],
                @foreach($Gender as $gender)
                    ['{{$gender->Gender}}',{{$gender->views}}],
                @endforeach

            ]);

            var options = {
                title: '',
                width:800,
                height:500,
                pieHole: 0.4,
            };
            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }



        function professionChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", { role: "style" } ],


                @foreach($Profession as $pro)
                    ['{{$pro->Profession}}', {{$pro->views}},"#12B0E8"],
                @endforeach




            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                { calc: "stringify",
                    sourceColumn: 1,
                    type: "string",
                    role: "annotation" },
                2]);

            var options = {
                title: "",
                width: 700,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("heyyyy"));
            chart.draw(view, options);
        }




    </script>

@endsection


@section('content')



    {{--    hasan start here !!!!!--}}




    <body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 100%;
        ;">

    <!-- Main navbar -->
    <div class="navbar navbar-expand-md">
        <div class="navbar-brand wmin-200">
            <a href="profile.php" class="d-inline-block">
            </a>
        </div>

        <div class="d-md-none">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">

            </button>
            <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
                <i class="fa fas fa-bars" style="color: white !important;"></i>
            </button>
        </div>
    </div>
    <!-- /main navbar -->

    <!-- Page content -->


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


                        <div class="card card-admin" style="background-color:rgba(54,54,54,0.65);color: white;">
                            <div class="card-header header-elements-inline">

                                <div class="header-elements">
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-hover table-light text-center mb-5">
                                    <thead>
                                    <th>
                                        Total Exhibitors
                                    </th>
                                    <th>
                                        Total Visitors
                                    </th>
                                    <th>
                                        Online Users
                                    </th>
                                    <th>

                                    </th>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>{{\App\User::where('Rule' , 'Exhibitor')->count()}}</td>
                                        <td>{{\App\User::where('Rule' , 'Visitor')->count()}}</td>
                                        <td>{{\App\Site::first()->onlinesCount}}</td>
                                        <td>
                                            <form action="{{route("Admin.ShowOnlines")}}" method="post">
                                                @csrf
                                                @if (\App\Site::first()->onlinesCountStatus == 0)
                                                    <input type="submit" value="Show Onlines To All" class="btn btn-success">
                                                @else
                                                    <input type="submit" value="Disable Onlines Count To All" class="btn btn-danger">
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-12 col-md-3">
                                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                            <a class="nav-link text-white active" id="v-pills-weekly-tab" data-toggle="pill" href="#v-pills-weekly" role="tab" aria-controls="v-pills-weekly" aria-selected="true">{{__("message.Weekly")}}</a>
                                            <a class="nav-link text-white" id="v-pills-top-tab" data-toggle="pill" href="#v-pills-top" role="tab" aria-controls="v-pills-top" aria-selected="false">Top Companies State</a>
                                            <a class="nav-link text-white" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all" role="tab" aria-controls="v-pills-all" aria-selected="false">All Companies State</a>
                                            <a class="nav-link text-white" id="v-pills-gender-tab" data-toggle="pill" href="#v-pills-gender" role="tab" aria-controls="v-pills-settings" aria-selected="false">Gender State</a>
                                            <a class="nav-link text-white" id="v-pills-Profession-tab" data-toggle="pill" href="#v-pills-Profession" role="tab" aria-controls="v-pills-Profession" aria-selected="false">Profession State</a>
                                            <a class="nav-link text-white" id="v-pills-Group-tab" data-toggle="pill" href="#v-pills-Group" role="tab" aria-controls="v-pills-Group" aria-selected="false">Group State</a>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-1"></div>
                                    <div class="col-12 col-md-8">
                                        <div class="tab-content" id="v-pills-tabContent">
                                            <div class="tab-pane fade show active" id="v-pills-weekly" role="tabpanel" aria-labelledby="v-pills-weekly-tab">
                                                <div class="w-100 text-center bg-white" style="height: 600px;">
                                                    <div id="Sarah_chart_div" class="w-100" style="height:100% !important;width: 1000px; !important;overflow: hidden"></div>
                                                </div>
                                            </div>






                                            <div class="tab-pane w-100 fade" id="v-pills-top" role="tabpanel" aria-labelledby="v-pills-top-tab">

{{--                                                <canvas id="chart-area-Company" class="bg-white chartjs-render-monitor"></canvas>--}}


                                                <div class="w-100 text-center bg-white" style="height: 600px;overflow: hidden">
                                                    <div id="Anthony_chart_div"  style="height: 500px;"></div>
                                                </div>


                                            </div>
                                            <div class="tab-pane fade" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">

                                                <div class="w-100 bg-white" style="height: 600px;overflow-y: auto">
                                                    <table class="table-light table table-hover table-bordered">
                                                        <thead>
                                                        <th>{{__('message.Company')}} {{__('message.Name')}}</th>
                                                        <th>{{__('message.Count')}}</th>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($AllCompany as $ac)
                                                            <tr>
                                                                <td>{{\App\booth::find($ac->BoothID)->CompanyName}}</td>
                                                                <td>{{$ac->views}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="v-pills-gender" role="tabpanel" aria-labelledby="v-pills-gender-tab">


                                                <div class="w-100 text-center bg-white" style="height: 600px;overflow: hidden">
                                                    <div id="donutchart" style="width: 900px; height: 500px;"></div>
                                                </div>




                                            </div>
                                            <div class="tab-pane fade" id="v-pills-Profession" role="tabpanel" aria-labelledby="v-pills-Profession-tab">


                                                <div class="w-100 text-center bg-white" style="height: 600px;overflow: hidden">
                                                    <div id="heyyyy" style="width: 700px; height: 250px;"></div>
                                                </div>




                                            </div>
                                            <div class="tab-pane fade" id="v-pills-Group" role="tabpanel" aria-labelledby="v-pills-Group-tab">

                                                <div class="w-100 bg-white" style="height: 600px;overflow-y: auto">
                                                    <table class="table table-light table-bordered table-hover">
                                                        <thead>
                                                        <th>{{__('message.Group')}} {{__('message.Name')}}</th>
                                                        <th>{{__('message.Member')}} {{__('message.Count')}}</th>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($AllGroups as $ag)
                                                            <tr>
                                                                <td>{{$ag->Name}}</td>
                                                                <td>{{count(json_decode($ag->Members))}}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
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
        var GenderData = {


            labels: [
                @foreach($Gender as $gender)
                    '{{$gender->Gender}}',
                @endforeach
            ],
            datasets: [{
                label: 'Gender' + 's',
                backgroundColor: [
                    '#4dc9f6',
                    '#f67019',
                    '#f53794',
                    '#537bc4',
                    '#acc236',
                    '#166a8f',
                    '#00a950',
                    '#58595b',
                    '#8549ba'],
                borderColor: '#ff0000',
                borderWidth: 1,
                data: [
                    @foreach($Gender as $gender)
                        '{{$gender->views}}',
                    @endforeach
                ]
            },]
        };
        var ProfessionData = {
            labels: [
                @foreach($Profession as $pro)
                    '{{$pro->Profession}}',
                @endforeach
            ],
            datasets: [{
                label: 'Profession',
                backgroundColor: [
                    '#4dc9f6',
                    '#f67019',
                    '#f53794',
                    '#537bc4',
                    '#acc236',
                    '#166a8f',
                    '#00a950',
                    '#58595b',
                    '#8549ba'],
                borderColor: '#ff0000',
                borderWidth: 1,
                data: [
                    @foreach($Profession as $pro)
                        '{{$pro->views}}',
                    @endforeach
                ]
            },]
        };
        var configCompany = {



            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        @foreach($Company as $item)
                        {{$item->views}},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#4dc9f6',
                        '#f67019',
                        '#f53794',
                        '#537bc4',
                        '#acc236',
                        '#166a8f',
                        '#00a950',
                        '#58595b',
                        '#8549ba'
                    ],
                    label: 'CompanyVisits'
                }],
                labels: [
                    @foreach($Company as $item)
                        '{{\App\booth::find($item->BoothID)->CompanyName}}',
                    @endforeach
                ]
            },
            options: {
                responsive: true,
            }
        };
        var configDate = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        @foreach($Date as $item)
                        {{$item->views}},
                        @endforeach
                    ],
                    backgroundColor: [
                        '#4dc9f6',
                        '#f67019',
                        '#f53794',
                        '#537bc4',
                        '#acc236',
                        '#166a8f',
                        '#00a950',
                        '#58595b',
                        '#8549ba'
                    ],
                    label: 'Date'
                }],
                labels: [
                    @foreach($Date as $item)
                        '{{\Carbon\Carbon::parse($item->date)->format('M-d')}}',
                    @endforeach
                ]
            },
            options: {
                responsive: true
            }
        };
        window.onload = function () {
            var CompanyChart = document.getElementById('chart-area-Company').getContext('2d');
            window.myPie = new Chart(CompanyChart, configCompany);
            var DateChart = document.getElementById('chart-area-Date').getContext('2d');
            window.myPie = new Chart(DateChart, configDate);
            var GenderStatistic = document.getElementById('chart-area-Gender').getContext('2d');
            window.myBar = new Chart(GenderStatistic, {
                type: 'bar',
                data: GenderData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    }
                }
            });
            var GenderProfession = document.getElementById('chart-area-Profession').getContext('2d');
            window.myBar = new Chart(GenderProfession, {
                type: 'bar',
                data: ProfessionData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    }
                }
            });
        };
    </script>




<script>

</script>






    {{--    Hasan test statistic!!!!--}}



@endsection
