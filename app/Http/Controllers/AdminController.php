<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role->name !== 'ADMIN') {
            return redirect('/');
        }

        // Retrieve the users. This is just an example - modify this line to suit your needs.
        $users = User::where('approve_status', 'PENDING')->get();

        // Pass the users to the view.
        return view('admin.dashboard', ['users' => $users]);
    }

    public function topicRequests() {
        if (auth()->user()->role->name !== 'ADMIN') {
            return redirect('/');
        }

        // Retrieve the topics. This is just an example - modify this line to suit your needs.
        $topics = Topic::where('approve_status', 'PENDING')->get();

        // Pass the topics to the view.
        return view('admin.topic-requests', ['topics' => $topics]);
    }

    public function approve(Request $request)
    {
        // Retrieve the user.
        $user = User::findOrFail($request->user_id);

        // Update the user's approve_status.
        $user->update(['approve_status' => 'APPROVED']);

        // Redirect back to the dashboard.
        return redirect()->route('admin.dashboard');
    }

    public function reject(Request $request)
    {
        // Retrieve the user.
        $user = User::findOrFail($request->user_id);

        // Update the user's approve_status.
        $user->update(['approve_status' => 'REJECTED']);

        // Redirect back to the dashboard.
        return redirect()->route('admin.dashboard');
    }

    public function approveTopic(Request $request)
    {
        // Retrieve the topic.
        $topic = Topic::findOrFail($request->topic_id);

        // Update the topic's approve_status.
        $topic->update(['approve_status' => 'APPROVED']);

        // Redirect back to the topic requests page.
        return redirect()->route('admin.topic-requests');
    }

    public function rejectTopic(Request $request)
    {
        // Retrieve the topic.
        $topic = Topic::findOrFail($request->topic_id);

        // Update the topic's approve_status.
        $topic->update(['approve_status' => 'REJECTED']);

        // Redirect back to the topic requests page.
        return redirect()->route('admin.topic-requests');
    }
}
