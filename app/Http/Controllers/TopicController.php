<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Topic::class);

        return view('topic.index', ['topics' => Topic::where('approve_status', 'APPROVED')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Topic::class);

        return view('topic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Topic::class);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $topic = Topic::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('topics.show', $topic);
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        $this->authorize('view', $topic);

        return view('topic.show', ['topic' => $topic->load('conversations')]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);

        return view('topic.edit', ['topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $this->authorize('update', $topic);

        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        $topic->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('topics.show', $topic)
            ->with('success', 'Topic updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        $this->authorize('delete', $topic);

        $topic->delete();

        return redirect()->route('topics.index')
            ->with('success', 'Topic deleted successfully!');
    }

    /**
     * Follow the specified topic.
     */
    public function follow(Topic $topic, Request $request)
    {
        $topic->followers()->attach($request->user());

        return redirect()->route('topics.show', $topic);
    }

    /**
     * Unfollow the specified topic.
     */
    public function unfollow(Topic $topic, Request $request)
    {
        $topic->followers()->detach($request->user());

        return redirect()->route('topics.show', $topic);
    }
}
