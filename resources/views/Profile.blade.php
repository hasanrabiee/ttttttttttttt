@extends('layouts.app')

@section('content')

    <form method="POST" action="{{route()}}"></form>

    <form method="post" action="/Profile" enctype="multipart/form-data">
        @csrf
        <input type="file" name="ProfileImage">
        <input type="submit">
    </form>
@endsection
