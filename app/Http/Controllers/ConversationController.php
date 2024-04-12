<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Topic;
use App\Notifications\NewConversationNotification;
use Illuminate\Http\Request;

class ConversationController extends Controller
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
    public function store(Topic $topic, Request $request)
    {
        $this->authorize('create', Conversation::class);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $topic->conversations()->create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);
        $newConversation = $topic->conversations()->latest()->first();

        $conversationTopicFollowers = $topic->followers()->get();

        foreach ($conversationTopicFollowers as $follower) {
            $follower->notify(new NewConversationNotification($topic, $newConversation));
        }

        return redirect()->route('topics.show', $topic)
            ->with('success', 'Conversation created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversation $conversation)
    {
        $this->authorize('viewAny', $conversation);

        return view('conversation.show', [
            'conversation' => $conversation->load('user', 'comments.user', 'comments.replies.user'),
            'topic' => $conversation->topic,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversation $conversation)
    {
        $this->authorize('update', $conversation);

        return view('conversation.edit', compact('conversation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversation $conversation)
    {
        $this->authorize('update', $conversation);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $conversation->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('conversations.show', $conversation)
            ->with('success', 'Conversation updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversation $conversation)
    {
        $this->authorize('delete', $conversation);

        $conversation->delete();

        return redirect()->route('topics.show', $conversation->topic)
            ->with('success', 'Conversation deleted successfully!');
    }
}
