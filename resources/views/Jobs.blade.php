@extends('layouts.app')
@section('content')

    <div class="h-100 w-100 overflow" style="width:100% !important ; height:100% !important;background-size: cover;background-repeat:no-repeat;background-image: url(@if(\App\Site::find(1)->SigninBackground != null) {{asset(\App\Site::find(1)->SigninBackground)}}   @else {{asset('assets/img/poster.jpg')}}@endif">



        {{--        <div class="container mt-5">--}}
        {{--            <h3 class="text-center">Company Name : {{\App\booth::find(request()->segment(2))->CompanyName}}</h3>--}}
        {{--            <h5 class="text-center">Website : <a class="remove_underline" href="https://{{\App\booth::find(request()->segment(2))->WebSite}}">{{\App\booth::find(request()->segment(2))->WebSite}}</a></h5>--}}
        {{--            <table class="table table-hover table-bordered text-center">--}}
        {{--                <thead class="thead-light">--}}
        {{--                <tr>--}}
        {{--                    <th scope="col">Title</th>--}}
        {{--                    <th scope="col">Description</th>--}}
        {{--                    <th scope="col">Number</th>--}}
        {{--                    <th scope="col">Salary €</th>--}}
        {{--                </tr>--}}
        {{--                </thead>--}}
        {{--                <tbody>--}}
        {{--                @foreach($Jobs as $job)--}}

        {{--                    <tr>--}}
        {{--                        <th>{{$job->Title}}</th>--}}
        {{--                        <td>{{$job->Description}}</td>--}}
        {{--                        <td>{{$job->Number}}</td>--}}
        {{--                        <td>{{$job->Salary}} €</td>--}}
        {{--                    </tr>--}}

        {{--                @endforeach--}}
        {{--                </tbody>--}}
        {{--            </table>--}}
        {{--        </div>--}}


        {{--        Hasan start new here !!!! --}}


        <div class="container mt-5">
            <h2>Job Vacancies</h2>
            <h3 class="text-center">{{\App\booth::find(request()->segment(2))->CompanyName}}</h3>
            <h5 class="text-center"><a class="remove_underline" href="https://{{\App\booth::find(request()->segment(2))->WebSite}}">{{\App\booth::find(request()->segment(2))->WebSite}}</a></h5>


            @foreach($Jobs as $job)

                <div class="main-modal m-2 p-2" style="position:relative;border: 2px solid white;border-radius: 5px;">
                    <div style="background-color:#b2caeb;" class="p-3">
                        <h4 style="font-weight: bolder;">
                            {{$job->Title}}
                        </h4>



                    </div>

                    <div>
                        <p>
                            {{$job->Description}}
                        </p>
                    </div>

                    <div>
                        <h6 style="font-weight: bolder">Number Of Vacencies :</h6>
                        <p>
                            {{$job->Number}}
                        </p>
                    </div>

                    <div>
                        <h6 style="font-weight: bolder">Salary :</h6>
                        <Salary0p>
                            {{$job->Salary}}
                        </Salary0p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

@endsection


