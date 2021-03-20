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

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

        google.charts.load('current', {'packages':['corechart']});

        google.charts.setOnLoadCallback(drawSarahChart);



        google.charts.setOnLoadCallback(professionChart);







        function drawSarahChart() {

            // Create the data table for Sarah's pizza.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data.addRows([

                @foreach($Statistic as $item)

                ['{{\Carbon\Carbon::parse($item->date)->format('M-d')}}', {{$item->views}}],

                @endforeach
            ]);

            // Set options for Sarah's pie chart.
            var options = {title:'',
                width:375,
                height:250
            };

            // Instantiate and draw the chart for Sarah's pizza.
            var chart = new google.visualization.PieChart(document.getElementById('Sarah_chart_div'));
            chart.draw(data, options);
        }

        // Callback that draws the pie chart for Anthony's pizza.


        function professionChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", { role: "style" } ],


                @foreach($Profession as $profession)
                    ['{{$profession->Profession}}', {{$profession->views}},"#12B0E8"],
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
                width: 350,
                height: 200,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.ColumnChart(document.getElementById("heyyyy"));
            chart.draw(view, options);
        }









    </script>




@endsection


@section('content')





{{--    Hasan start here !!!!--}}


        @include("Sidebars.exhibitorOperator-sidebar")


        <!-- Main content -->







        <!-- Main content -->
        <div class="content-wrapper" style="overflow-x: hidden">

            <!-- Content area -->
            <div class="content">

                <!-- Main charts -->
                <div class="row">
                    <div class="col-xl-12">
                        <!-- Traffic sources -->
                        <div class="card p-3" style="background-color:#006B63;color: white">
                            <div class="card-body py-0">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered table-hover table-light text-center">
                                            <thead>
                                            <th>
                                                Number of Booth Visits
                                            </th>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>{{\App\Statistics::where('BoothID' , $Booth->id)->count()}}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 mt-2 mt-md-5">


                                        <p>{{__('message.NumberofBoothVisitsByProfession')}}</p>
                                            <div class="bg-white" style="height: 250px;">
                                                <div class="w-100 text-center bg-white" style="overflow: hidden">
                                                    <div id="heyyyy"></div>
                                                </div>
                                            </div>

                                    </div>
                                    <div class="col-md-6 mt-2 mt-md-5">
                                        <p>{{__('message.NumberofBoothVisitsPerDay')}}</p>
                                            <div class="container w-100">
                                                <div class="w-100 text-center bg-white" style="overflow: hidden">
                                                    <div id="Sarah_chart_div" class="w-100"></div>
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


        var barChartData = {
            labels: [
                @foreach($Profession as $profession)
                    '{{$profession->Profession}}',
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
                    @foreach($Profession as $profession)
                        '{{$profession->views}}',
                    @endforeach
                ]
            }]
        };


        var config = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [
                        @foreach($Statistic as $item)
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
                    label: 'Visit Per Day'
                }],
                labels: [
                    @foreach($Statistic as $item)
                        '{{\Carbon\Carbon::parse($item->date)->format('M-d')}}',
                    @endforeach
                ]
            },
            options: {
                responsive: true
            }
        };
        window.onload = function () {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
            var ctxx = document.getElementById('chart-area-Profession').getContext('2d');
            window.myBar = new Chart(ctxx, {
                type: 'bar',
                data: barChartData,
                options: {
                    responsive: true,
                    legend: {
                        position: 'top',
                    }
                }
            });
        };


    </script>
@endsection
