@extends('layouts.app')
@section('content')


    <div class="container-fluid mt-3">

        <div class="row">
            <div class="col-md-4">
                <h3>Conference Abstract</h3>
                <p>
                    {{$conference->abstract}}
                </p>
            </div>
            <div class="col-md-8 p-2" style="background-color:#d0d0d0;height: 768px !important;">
                <div class="row">
                    <div class="col-md-6">
                        <h3>About Speakers</h3>


                        @foreach(\App\Speaker::where('cid', $conference->crid)->get() as $speaker)

                            <h5>

                                <img src="{{$speaker->avatar}}" alt="" style="width: 40px;height: 40px;border-radius: 50%;margin-right: 10px;">{{$speaker->Name}}

                                <a href="{{$speaker->pdf}}">

                                    <i class="fa fa-file-pdf-o text-danger"></i>

                                </a>

                            </h5>





                            <p>
                                {{$speaker->abstract}}
                            </p>

                            <hr>

                        @endforeach








                    </div>
                    <div class="col-md-6">

                        <div class="row">
                            <div style="position: absolute;bottom: 0px;right: 0px;" class="w-100">


                                @if (\Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($conference->start_time))  )

                                    <a href="{{route('AuditoriumPlay',$conference->id)  }}" class="btn btn-dark btn-block"
                                       role="button" disabled="">Not started yet
                                        <i class="fa fa-hourglass"></i>
                                    </a>

                                @elseif (\Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($conference->start_time)) and \Carbon\Carbon::now()->lt(Carbon\Carbon::parse($conference->end_time)) )



                                    @if ($conference->started)
                                        <a href="{{route('join-webinar',$conference->id)  }}" class="btn btn-success btn-block"
                                           role="button" disabled="">Join Conference
                                            <i class="fa fa-plus"></i>
                                        </a>

                                    @else


                                        <a href="{{route('join-webinar',$conference->id)  }}" class="btn btn-warning btn-block"
                                           role="button" disabled="">host has not started the conference yet...
                                            <i class="fa fa-users"></i>
                                        </a>

                                    @endif



                                @elseif (\Carbon\Carbon::today() > \Carbon\Carbon::parse($conference->start_date) or ( \Carbon\Carbon::today() == \Carbon\Carbon::parse($conference->start_date) and  \Carbon\Carbon::now()->gte(Carbon\Carbon::parse($conference->end_time))  ))


                                    @if($conference->recorded_video)



                                        <a href="{{$conference->recorded_video}}" class="btn btn-danger btn-block"
                                           role="button" disabled="">Recorded video
                                            <i class="fa fa-film"></i>
                                        </a>




                                    @endif

                                    <a href="{{route('AuditoriumPlay',$conference->id)  }}"
                                       class="btn btn-outline-dark btn-block"
                                       role="button" disabled="">Conference is over
                                        <i class="fa fa-cancel"></i>
                                    </a>


                                @else


                                    <a href="{{route('AuditoriumPlay',$conference->id)  }}"
                                       class="btn btn-outline-dark btn-block"
                                       role="button" disabled="">No action
                                        <i class="fa fa-cancel"></i>
                                    </a>



                                @endif




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
