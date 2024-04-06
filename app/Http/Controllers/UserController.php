<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myTopics()
    {
        $topics = auth()->user()->topics;

        return view('user.topics', ['topics' => $topics]);
    }

    public function myConversations()
    {
        $conversations = auth()->user()->conversations;

        return view('user.conversations', ['conversations' => $conversations]);
    }
}
