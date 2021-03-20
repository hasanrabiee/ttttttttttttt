@extends('layouts.Panel')
@section("Head")

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{asset("css/style-icon.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap.min.css")}}" rel="stylesheet" type="text/css">
    <link href="{{asset("css/bootstrap-limitless.css")}}" rel="stylesheet" type="text/css">
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

    <script src="https://cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>


@endsection
<!-- Page content -->


<body style="background: url('{{\App\Site::AdminBackground()}}') no-repeat center center fixed;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    height: 100%;
    ;">


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
                    <div class="card card-admin" style="background-color:#006B63;color: white;">
                        <div class="card-header header-elements-inline">

                            <div class="header-elements">
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="text-center w-100 p-1" style="border-radius: 5px;background-color:#2B3D4A;">
                                        <h3 style="margin-top: 10px;">{{__("message.CreateGroup")}}</h3>
                                    </div>
                                </div>
                            </div>
                            <form action="{{route('Admin.CreateLounge')}}" method="post" class="w-100 mt-2">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group mt-2 mb-2">
                                            <input type="text" class="form-control" placeholder="Group Name" name="Name">
                                            <div class="input-group-append">
                                                <button class="btn btn-success" type="submit" style="background-color: #01B5A8 !important;">Create</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        @if (\App\Site::first()->onlinesCountStatus == 1)
                                            <div class="alert alert-info">

                                                    <span>
                                                        {{\App\Site::first()->onlinesCount}} Users is Online Now
                                                    </span>

                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </form>
                            <div class="row mt-3">
                                <div class="col-md-4 text-center">
                                    <div class="text-center w-100 p-1" style="border-radius: 5px;background-color:#2B3D4A;">
                                        <h3 style="margin-top: 10px;" >{{__('message.ManageGroups')}}</h3>
                                    </div>

                                    <div class="text-left p-2 mt-2" style="border: 2px solid white;height: 550px;border-radius: 5px;">
                                        <form action="" class="w-100">
                                            <div class="input-group mt-2 mb-2">
                                                <input type="text" name="SearchTerm" class="form-control" placeholder="Search...">
                                                <div class="input-group-append">
                                                    <button class="btn btn-success" type="submit" style="background-color: #01B5A8 !important;">Search</button>
                                                </div>
                                            </div>
                                        </form>

                                        @foreach($Lounges as $loung)
                                            <a href="?LoungID={{$loung->id}}" @if(request()->LoungID == $loung->id) class="text-white text-left btn btn-dark w-100 mb-2" @else class="text-white text-left btn btn-outline-dark w-100 mb-2" @endif >
                                                {{$loung->Name}}
                                            </a>
                                        @endforeach
                                    </div>

                                </div>


                                @if(request()->LoungID)
                                    <div class="col-md-8" style="margin-top: 70px;">
                                        <div class="w-100 p-2" style="border-radius: 5px;border: 2px solid white;">
                                            <h3>
                                                {{__('message.Group')}} {{__('message.Name')}} : {{$Lounge->Name}}
                                            </h3>

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="scroll_box"
                                                         style="background-color: rgba(255,255,255,0.3);height: 480px;border-radius: 5px;overflow-y: auto">
                                                        @foreach(json_decode($Lounge->Members) as $Member)
                                                            <div class="row p-1">
                                                                <div class="col-9">
                                                                    <p class="text-left d-inline float-left" style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: black;">
                                                                        {{\App\User::find($Member)->UserName}}
                                                                    </p>
                                                                </div>
                                                                <div class="col-3">
                                                                    <a href="?RemoveUser={{$Member}}&LoungeID={{$Lounge->id}}">
                                                                        <i class="fa fa-minus-circle float-right" style="color: rgb(209,28,28);width: 40px;height: 38px;font-size: 34px;"></i>
                                                                    </a>
                                                                </div>
                                                            </div>







                                                        @endforeach
                                                    </div>
                                                </div>
                                                {{--                                                    <div class="col-md-7">--}}
                                                {{--                                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque maiores, molestiae necessitatibus possimus tempore temporibus tenetur veritatis voluptas. Architecto consequuntur debitis deserunt dolores error id nulla omnis quam, tempore voluptas.--}}
                                                {{--                                                    </div>--}}
                                                <div class="col-md-7 mt-md-0 mt-5">
                                                    <div class="scroll_box p-2" id="ChatsDiv" style="height: 440px;overflow-y: auto">
                                                        @foreach($Chats as $chat)

                                                            <div class="row">
                                                                @if($chat->UserID == \Illuminate\Support\Facades\Auth::id())
                                                                    <div class="col-3">
                                                                    </div>
                                                                    <div class="col-9 bg-primary p-1 mt-1 w-100" style="border-radius: 5px;">
                                                                        <p>{{$chat->Text}}</p>
                                                                        <small>{{__("message.Sender")}}: {{\App\User::find($chat->UserID)->UserName}}</small>
                                                                    </div>

                                                                @else
                                                                    <div class="col-9 bg-success p-1 mt-1" style="border-radius: 5px;">
                                                                        <p class="nonoverflow">{{$chat->Text}}</p>
                                                                        <small>{{__("message.Sender")}}: {{\App\User::find($chat->UserID)->UserName}}</small>
                                                                    </div>
                                                                    <div class="col-3">
                                                                    </div>
                                                                @endif
                                                            </div>



                                                        @endforeach

                                                    </div>
                                                    <form class="w-100" method="post" action="{{route('Admin.SendMessagetoLounge' , $Lounge->id)}}" id="chat">
                                                        @csrf
                                                        {{--                                                                <input--}}
                                                        {{--                                                                    class="border rounded border-dark form-control d-inline" type="text"--}}
                                                        {{--                                                                    style="margin-right: 17px;width: 208px;" onblur="is_typing = false" onfocus="is_typing = true" name="Text" value="{{old('Text')}}">--}}
                                                        {{--                                                                <button class="btn btn-success d-inline" type="submit"--}}
                                                        {{--                                                                        style="height: 36px;width: 103px;">{{__('message.Send')}}--}}
                                                        {{--                                                                </button>--}}



                                                        <div class="input-group mt-1">
                                                            <input type="text" class="form-control" aria-describedby="basic-addon2" id="myInput" rows="1"
                                                                   name="Text" value="{{old('Text')}}" onblur="is_typing = false" onfocus="is_typing = true">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-success" type="submit" onclick="sendMessage()" style="background-color: #01B5A8 !important"> {{__('message.Send')}}</button>
                                                            </div>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>




                                        </div>
                                    </div>
                                @endif



                            </div>

                            <div style="height: 200px;overflow-y: auto" class="mt-3 col-12">
                                <table class="table table-bordered table-hover table-light text-center mb-5">
                                    <thead>
                                    <th>
                                        {{__('message.Name')}}
                                    </th>
                                    <th>
                                        {{__('message.Member')}} {{__('message.Count')}}
                                    </th>
                                    <th>
                                        {{__('message.Create')}} {{__('message.Date')}}
                                    </th>
                                    <th>
                                        {{__('message.Action')}}
                                    </th>
                                    </thead>
                                    <tbody>
                                    @foreach(\App\Lounge::all() as $lounge)
                                        <tr>
                                            <td>{{$lounge->Name}}</td>
                                            <td>{{count(json_decode($lounge->Members))}}</td>
                                            <td>{{\Carbon\Carbon::instance($lounge->created_at)->format('Y-m-d')}}</td>
                                            <td>

                                                <form action="{{route('Admin.RemoveLounge' ,$lounge->id )}}" id="{{$lounge->id}}">

                                                </form>

                                                <a onclick="event.preventDefault() ; return areyousure({{$lounge->id}})" id="{{$lounge->id}}"
                                                   href="{{route('Admin.RemoveLounge' ,$lounge->id )}}">
                                                    <button class="btn btn-danger" type="button">Delete</button>
                                                </a>

                                            </td>
                                        </tr>





                                    @endforeach
                                    </tbody>
                                </table>
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

@section("js")

    {{--    <script>--}}
    {{--        $(document).ready(function() {--}}
    {{--            $('#myInput').keyup(function(event) {--}}
    {{--                if (event.which === 13) {--}}
    {{--                    event.preventDefault();--}}
    {{--                    $('chat').submit();--}}
    {{--                }--}}
    {{--            });--}}
    {{--        });--}}
    {{--    </script>--}}



    <script>
        function areyousure(id) {
            Swal.fire({
                title: 'By Deleting the Group All Chats And Information Of The Group Will Be Removed, Do You Want To Continue',
                showDenyButton: true,
                showCancelButton: false,
                confirmButtonText: `Delete`,
                denyButtonText: `Cancel`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Swal.fire('Deleted!', '', 'success')
                    confirmed_sinsin = true;
                    $("#"+id).submit();
                    return true;
                } else if (result.isDenied) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Oops...',
                        text: 'Group Not Deleted',
                    })
                    confirmed_sinsin = false
                    return false
                }
            })
        };
    </script>




@endsection

