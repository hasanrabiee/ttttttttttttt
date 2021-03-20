@if($booth_list->count() == 0)

    No new Message Available

@endif


@foreach($booth_list as $booth_one)


    @if(request()->CompanyID == $booth_one->id)



        <div class="row">
            <div class="col-9">
                <a
                    href="?CompanyID={{$booth_one->id}}"><p
                        class="text-white btn btn-primary mb-2 w-100 text-left"
                    >{{\Illuminate\Support\Str::limit($booth_one->CompanyName , 25)}}</p>
                </a>
            </div>
            <div class="col-3">
                <button class=" btn btn-dark text-center border rounded-circle" type="button"  style="width: 30px;margin-left: 10px;height: 30px;padding: 1px;margin-top: 3px;">
                    0
                </button>
            </div>
        </div>

    @else
        <div class="row">
            <div class="col-9">
                <a
                    href="?CompanyID={{$booth_one->id}}" class="text-white btn btn-outline-dark mb-2 w-100 text-left">
                    {{\Illuminate\Support\Str::limit($booth_one->CompanyName , 25)}}
                </a>
            </div>
            <div class="col-3">
                <button class=" btn @if (\App\Http\Controllers\AdminController::ChatCount($booth_one->UserID) > 0) btn-success @else btn-dark @endif  text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 10px;height: 30px;padding: 1px;margin-top: 3px;">
                    {{\App\Http\Controllers\AdminController::ChatCount($booth_one->UserID) == '' ? '0' : \App\Http\Controllers\AdminController::ChatCount($booth_one->UserID)}}
                </button>
            </div>
        </div>

    @endif



@endforeach
