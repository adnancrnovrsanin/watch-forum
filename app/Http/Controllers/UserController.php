<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function myTopics()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $user = User::find(auth()->user()->getAuthIdentifier());

        $topics = $user->topics;

        return view('user.topics', ['topics' => $topics]);
    }

    public function myConversations()
    {
        if (!auth()->user()) {
            return redirect()->route('login');
        }

        $user = User::find(auth()->user()->getAuthIdentifier());

        $conversations = $user->conversations;

        return view('user.conversations', ['conversations' => $conversations]);
    }
}
