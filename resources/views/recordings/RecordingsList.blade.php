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
                        <th>Date</th>
                        <th>Title</th>
                        <th>Speakers</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($List as $item)
                        <tr class="text-center bg-primary">

                            <td style="vertical-align: middle !important">{{$item->updated_at}}</td>
                            <td style="vertical-align: middle !important">{{$item->title}}</td>
                            <td style="vertical-align: middle !important">{{$item->speakers}}</td>
                            <td style="vertical-align: middle !important">{{$item->description}}</td>


                            <td style="vertical-align: middle !important">

                                @if($item->download_url != null)
                                    <a target="_blank" href="{{$item->download_url}}" class="btn btn-danger btn-block"
                                       role="button" disabled="">Download
                                        <i class="fa fa-download"></i>
                                    </a>
                                @endif
                                @if($item->play_url != null)

                                    <a target="_blank" href="{{$item->play_url}}" class="btn btn-success btn-block"
                                       role="button" disabled="">Play

                                        <i class="fa fa-play"></i>

                                    </a>

                                @endif

                                @if ($item->play_url == null && $item->download_url == null)
                                    <a href="#" class="btn btn-dark btn-block"
                                       role="button" disabled="">No Action
                                        <i class="fa fa-play"></i>
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

