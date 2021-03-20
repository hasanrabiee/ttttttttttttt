@foreach($booth_list as $booth_one)



    @if(request()->CompanyID == $booth_one->id)



        <div class="bg-primary rounded  " style="height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"><a
                href="?CompanyID={{$booth_one->id}}"><p
                    class="text-left d-inline float-left"
                    style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: rgb(255,255,255);">{{\Illuminate\Support\Str::limit($booth_one->CompanyName , 12)}}</p>
            </a>
            <div style="float: right">
                <button class=" btn btn-dark text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 34px;height: 28px;padding: 1px;margin-top: 3px;">
                    {{\App\Http\Controllers\AdminOperatorController::ChatCount($booth_one->UserID) == '' ? '0' : \App\Http\Controllers\AdminController::ChatCount($booth_one->UserID)}}
                </button>
            </div>
        </div>


    @else




        <div style="height: 40px;width: 193px;margin-left: 4px;margin-top: 5px;"><a
                href="?CompanyID={{$booth_one->id}}"><p
                    class="text-left d-inline float-left"
                    style="margin-top: 4px;margin-left: 6px;margin-right: 7px;color: rgb(255,255,255);">{{\Illuminate\Support\Str::limit($booth_one->CompanyName , 20)}}</p>
            </a>
            <div style="float: right">
                <button class=" btn @if (\App\Http\Controllers\AdminOperatorController::ChatCount($booth_one->UserID) > 0) btn-success @else btn-dark @endif  text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 34px;height: 28px;padding: 1px;margin-top: 3px;">
                    {{\App\Http\Controllers\AdminOperatorController::ChatCount($booth_one->UserID) == '' ? '0' : \App\Http\Controllers\AdminOperatorController::ChatCount($booth_one->UserID)}}
                </button>
            </div>
        </div>

    @endif



@endforeach
