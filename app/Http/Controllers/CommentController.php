<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Conversation;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Conversation $conversation, Request $request)
    {
        $this->authorize('create', Comment::class);

        $request->validate([
            'content' => 'required|string',
        ]);

        $conversation->comments()->create([
            'content' => $request->content,
            'conversation_id' => $conversation->id,
            'user_id' => $request->user()->id,
        ]);

        foreach ($conversation->topic->followers as $follower) {
            $follower->notify(new CommentNotification($conversation->comments->last()));
        }

        return redirect()->route('conversations.show', $conversation)
            ->with('success', 'Comment submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function vote(Comment $comment, Request $request)
    {
        if (auth()->user() === null) {
            return redirect()->route('login');
        }

        $request->validate([
            'vote' => 'required|in:-1,1',
        ]);

        $comment->usersVoted()->detach($request->user());
        
        $comment->usersVoted()->syncWithoutDetaching([
            $request->user()->id => ['vote' => $request->vote],
        ]);

        return back()->with('success', 'Vote submitted successfully!');
    }
}
