@foreach($Users as $user_one)



{{--        {{dd($user_one)}}--}}


    @if(request()->UserID == $user_one->id)


        <div class="row">
            <div class="col-9 w-100">
                <a href="?UserID={{$user_one->id}}" class="btn btn-primary w-100 mb-2">
                    {{\Illuminate\Support\Str::limit($user_one->UserName , 12)}}
                </a>
            </div>
            <div class="col-3">
                <button class=" btn btn-dark text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 10px;height: 28px;padding: 1px;margin-top: 3px;">
                    {{\App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count()}}
                </button>
            </div>
        </div>

    @else

        <div class="row">
            <div class="col-9">
                <a href="?UserID={{$user_one->id}}" class="text-white btn btn-outline-dark mb-2 w-100">
                    {{\Illuminate\Support\Str::limit($user_one->UserName , 12)}}
                </a>
            </div>

            <div class="col-3">
                <button class=" btn @if (\App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count() > 0) btn-success @else btn-dark @endif text-center border rounded-circle" type="button"
                        style="width: 30px;margin-left: 10px;height: 28px;padding: 1px;margin-top: 3px;">

                                        {{\App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count() == 0 ? '0' : \App\Chat::where([['BoothID' , $Booth->id],['UserID' , $user_one->id],['Sender' , 'Visitor'],['Status' , 'New']])->count()}}

{{--                    {{\App\Http\Controllers\ExhibitorOperatorController::ChatCountEx($user_one->id) == '' ? '0' : \App\Http\Controllers\ExhibitorOperatorController::ChatCountEx($user_one->id)}}--}}


                </button>
            </div>
        </div>


    @endif






@endforeach


