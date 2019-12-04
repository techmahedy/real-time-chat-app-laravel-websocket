<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\MessageEvent;
use Illuminate\Http\Request;

class ChatController extends Controller
{   
	
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	return view('chats.chat');
    }

    public function fetchAllMessages()
    {
    	return Chat::with('user')->get();
    }

    public function sendMessage(Request $request)
    {
    	$message = auth()->user()->messages()->create([
            'message' => $request->message
        ]);

    	broadcast(new MessageEvent($message->load('user')))->toOthers();

    	return ['status' => 'success'];
    }
}
