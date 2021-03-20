<!DOCTYPE html>
<html lang="{{\Illuminate\Support\Facades\App::getLocale()}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


    <title>{{\App\Site::find(1)->Name}}</title>
    <link rel="stylesheet" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
    <link rel="stylesheet" href="{{asset('assets/fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/fonts/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/styles.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/hasan-custom.css')}}">

    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <style>
        body{
            font-family: "Poppins" !important;
        }
    </style>
</head>
<body id="page-top">
@yield('content')
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="{{asset('assets/js/script.min.js')}}"></script>



<div class="modal fade" id="ErrorModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Site Errors</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div
                class="modal-body">


                @if($errors->any())
                    @foreach ($errors->all() as $error)
                        <div>{{$error}}</div>
                        <br>
                    @endforeach

                @elseif(session('errors'))
                    {{session('errors')->first('msg')}}
                @endif


            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>





@yield('js')


@if(session('errors') || $errors->any())
    @php
    $err = '';
        foreach ($errors->all() as $error) {
            $err .= $error . '<br>';
        }
            \RealRashid\SweetAlert\Facades\Alert::info($err)
    @endphp
    {{--<script type="text/javascript">
        $(window).on('load', function () {
            $('#ErrorModal').modal('show');
        });
    </script>--}}
@endif


</body>
@include('sweetalert::alert')

</html>


