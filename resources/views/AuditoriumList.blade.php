@extends('layouts.app')
@section('content')
    <header class="d-flex masthead"
            style="background-image: url('{{asset('assets/img/Auditorium.png')}}');padding: 45px;padding-top: 0px;padding-right: 0px;padding-left: 0px;">
        <div class="container my-auto text-center">
            <div class="table-responsive table-bordered text-dark scroll_box"
                 style="background-color: rgba(168,168,168,0.84);height: 567px;">
                <table class="table table-bordered">
                    <thead style="background-color: rgba(168,168,168,0.84);">
                    <tr style="background-color: rgba(168,168,168,0.84);">
                        <th>Hall</th>
                        <th>Date</th>
                        <th>Speaker Name</th>
                        <th>Title</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($List as $item)
                        <tr class="@if($item->hall == 'A') bg-primary @endif">

                            <td style="vertical-align: middle !important">
                                <h3>{{$item->hall}}</h3>
                            </td>
                            <td style="vertical-align: middle !important">{{$item->start_date}}</td>
                            <td style="vertical-align: middle !important">

                                @foreach(\App\Speaker::where('cid', $item->crid)->get() as $sp)

                                    {{$sp->Name}},


                                @endforeach


                            </td>
                            <td style="vertical-align: middle !important">{{$item->title}}</td>
                            <td style="vertical-align: middle !important">{{\Carbon\Carbon::parse($item->start_time)->format('H:i')}}
                                - {{\Carbon\Carbon::parse($item->end_time)->format('H:i')}}</td>


                            <td style="vertical-align: middle !important">


                                @if (\Carbon\Carbon::today() == \Carbon\Carbon::parse($item->start_date) and  \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($item->start_time))  )

                                    <a href="{{route('AuditoriumPlay',$item->id)  }}" class="btn btn-dark btn-block"
                                       role="button" disabled="">Not started yet
                                        <i class="fa fa-hourglass"></i>
                                    </a>

                                    @elseif (\Carbon\Carbon::today() == \Carbon\Carbon::parse($item->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($item->start_time)) and \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($item->end_time)) )

                                    <a href="{{route('AuditoriumPlay',$item->id)  }}" class="btn btn-success btn-block"
                                       role="button" disabled="">Join Conference
                                        <i class="fa fa-plus"></i>
                                    </a>

                                @elseif (\Carbon\Carbon::today() > \Carbon\Carbon::parse($item->start_date) or ( \Carbon\Carbon::today() == \Carbon\Carbon::parse($item->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($item->end_time))  ))


                                    @if($item->recorded_video)



                                        <a href="{{$item->recorded_video}}" class="btn btn-danger btn-block"
                                           role="button" disabled="">Recorded video
                                            <i class="fa fa-film"></i>
                                        </a>




                                        @endif

                                        <a href="{{route('AuditoriumPlay',$item->id)  }}"
                                           class="btn btn-outline-dark btn-block"
                                           role="button" disabled="">Conference is over
                                            <i class="fa fa-cancel"></i>
                                        </a>


                                @else


                                    <a href="{{route('AuditoriumPlay',$item->id)  }}"
                                       class="btn btn-outline-dark btn-block"
                                       role="button" disabled="">No action
                                        <i class="fa fa-cancel"></i>
                                    </a>



                                @endif













                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </header>
@endsection
