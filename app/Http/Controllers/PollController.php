<?php

namespace App\Http\Controllers;

use App\Models\PollAnswer;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class PollController extends Controller
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
    public function create(Topic $topic)
    {
        return view('poll.create', ['topic' => $topic]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Topic $topic)
    {
        $this->authorize('create', Poll::class);

        $request->validate([
            'question' => 'required|string',
        ]);

        $topic->polls()->create($request->only('question'));

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Poll $poll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poll $poll)
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

    public function vote(PollAnswer $pollAnswer)
    {
        $user = User::findOrFail(auth()->user()->getAuthIdentifier());

        $pollAnswer->vote($user);

        return back();
    }
}
