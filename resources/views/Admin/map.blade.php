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

    <style type="text/css">
        #mynetwork {
            width: 100% !important;

            height: 700px !important;
            border: 1px solid lightgray;
        }
    </style>
    <!-- Theme JS files -->
    <script src="{{asset("js/d3.min.js")}}"></script>
    <script src="{{asset("js/d3tooltip.js")}}"></script>
    <script src="{{asset("js/switchery.min.js")}}"></script>
    <script src="{{asset("js/momment.min.js")}}"></script>
    <script src="{{asset("js/app2.js")}}"></script>
    <script src="{{asset("js/dashboard.js")}}"></script>
    <script src="https://use.fontawesome.com/fd423b8d2f.js"></script>
    <!-- /theme JS files -->
    <script
        type="text/javascript"
        src="https://unpkg.com/vis-network/standalone/umd/vis-network.min.js"
    ></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

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


                                <div id="mynetwork"></div>


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


    var nodes = [

        {
            id: "hall_A",
            label: "Hall-A",
            shape: "diamond",
            group: "diamonds"



        },


        {
            id: "hall_B",
            label: "Hall-B",
            shape: "diamond",
            group: "diamonds"


        },
        {
            id: "hall_C",
            label: "Hall-C",
            shape: "diamond",
            group: "diamonds"


        },

        {
            id: "hall_D",
            label: "Hall-D",
            shape: "diamond",
            group: "diamonds"



        },


        @foreach (\App\booth::all() as $item)

        {
            id: "company_{{$item->id}}",
            label: "{{$item->CompanyName}}({{$item->Representative}})",
            shape: "circularImage",
            image: "{{$item->Logo}}"




        },


        @endforeach





    ];
    var edges = [

            @foreach (\App\booth::all() as $item)

        {

            from: "hall_{{$item->Type}}", to: "company_{{$item->id}}"
        },


            @endforeach




    ];

    // create a network
    var container = document.getElementById("mynetwork");
    var data = {
        nodes: nodes,
        edges: edges,
    };
    var options = {
        nodes: {
            shape: "dot",
            size: 20,
            font: {
                size: 15,
                color: "#ffffff",
            },
            borderWidth: 2,
        },
        edges: {
            width: 2,
        },
        groups: {
            diamonds: {
                color: { background: "red", border: "white" },
                shape: "diamond",
            },
            dotsWithLabel: {
                label: "I'm a dot!",
                shape: "dot",
                color: "cyan",
            },
            mints: { color: "rgb(0,255,140)" },
            icons: {
                shape: "icon",
                icon: {
                    face: "FontAwesome",
                    code: "\uf0c0",
                    size: 50,
                    color: "orange",
                },
            },
            source: {
                color: { border: "white" },
            },
        },
    };
    var network = new vis.Network(container, data, options);

</script>




@endsection
