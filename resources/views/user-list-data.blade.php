@if($users_list->count() == 0)

    No new Message Available

@endif

@foreach($users_list as $user_one)

    @if(request()->UserID == $user_one->id)


        <div class="row">
            <div class="col-9">
                <a class="btn btn-primary w-100 text-left mb-2" href="?UserID={{$user_one->id}}">
                    {{\Illuminate\Support\Str::limit($user_one->UserName , 25)}}
                </a>
            </div>
            <div class="col-3">
                <button class=" btn btn-dark text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 10px;height: 28px;padding: 1px;margin-top: 3px;">
                    0
                </button>
            </div>
        </div>
    @else
        <div class="row">

            <div class="col-9">
                <a href="?UserID={{$user_one->id}}" class="text-white btn btn-outline-dark mb-2 w-100 text-left">
                    {{\Illuminate\Support\Str::limit($user_one->UserName , 25)}}
                </a>
            </div>
            <div class="col-3">
                <button class="btn @if (\App\Http\Controllers\AdminController::ChatCount($user_one->id) > 0) btn-success @else btn-dark @endif text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 10px;height: 28px;padding: 1px;margin-top: 3px;">

                    {{\App\Http\Controllers\AdminController::ChatCount($user_one->id) == '' ? '0' : \App\Http\Controllers\AdminController::ChatCount($user_one->id)}}

                </button>
            </div>
        </div>
    @endif
@endforeach
