<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string',
            'project_id' => 'required|integer|exists:projects,id'
        ]);

        $message = new Message();
        $message->content = $request->content;
        $message->user_id = auth()->id();
        $message->project_id = $request->project_id;
        $message->save();

        return response()->json(['message' => 'Message sent successfully', 'data' => $message]);
    }
}