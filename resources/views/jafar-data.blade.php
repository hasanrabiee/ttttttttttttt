@foreach($users as $user)
    <div>
        <h3><a href="">{{ $user->UserName }}</a></h3>
{{--        <p>{{ str_limit($user->description, 400) }}</p>--}}


        <div class="text-right">
            <button class="btn btn-success">Read More</button>
        </div>


        <hr style="margin-top:5px;">
    </div>
@endforeach
