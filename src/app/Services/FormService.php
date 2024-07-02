<?php

namespace App\Services;

use App\Http\Requests\FormController\StoreRequest;
use Illuminate\Support\Facades\Mail;

class FormService
{
    public function form(StoreRequest $request)
    {
        Mail::raw('Имя:'.$request->name.'<br>Телефон:'.$request->phone, function ($message) use ($request){
            $message->to('blockstar2k@gmail.com')
            ->subject('Заявка с сайта');
        });
        return Response()->json([
            'message' => 'true'
        ]);
    }
}
