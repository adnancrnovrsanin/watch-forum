<?php

namespace App\Http\Controllers;

use App\Models\PollAnswer;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            'answers' => 'required|array|min:2',
        ]);

        $poll = $topic->polls()->create([
            'question' => $request->input('question'),
        ]);

        foreach ($request->input('answers') as $answer) {
            $poll->answers()->create([
                'answer' => $answer,
            ]);
        }

        return redirect()->route('topics.show', $topic)
            ->with('status', 'Poll created successfully!');
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
