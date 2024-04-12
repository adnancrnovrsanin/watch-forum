<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use App\Notifications\ReplyNotification;
use Illuminate\Http\Request;

class ReplyController extends Controller
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
    public function store(Comment $comment, Request $request)
    {
        $this->authorize('create', Reply::class);

        $request->validate([
            'content' => 'required|string',
        ]);

        $comment->replies()->create([
            'content' => $request->content,
            'comment_id' => $comment->id,
            'user_id' => $request->user()->id,
        ]);

        $comment->user->notify(new ReplyNotification($comment->replies->last()));

        return redirect()->route('conversations.show', $comment->conversation);
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
}
