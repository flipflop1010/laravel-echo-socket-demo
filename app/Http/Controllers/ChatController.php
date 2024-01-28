<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    function sendMessage(Request $request){
        $validatedData=$request->validate([
            'message'=>'required'
        ]);

        // MessageEvent::dispatch($validatedData);
        // broadcast(new MessageEvent($validatedData));
        event(new MessageEvent($validatedData['message']));
        // return($validatedData);

    }
}
