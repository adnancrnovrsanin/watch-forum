<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Role::factory()->create([
            'name' => 'ADMIN',
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'MODERATOR',
        ]);
        $adminRoleId = \App\Models\Role::where('name', 'ADMIN')->first()->id;
        $moderatorRoleId = \App\Models\Role::where('name', 'MODERATOR')->first()->id;

        \App\Models\User::factory()->create([
            'name' => 'Adnan Crnovrsanin',
            'email' => 'adnan@gmail.com',
            'approve_status' => 'APPROVED',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => $adminRoleId,
            'approve_status' => 'APPROVED',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Moderator 1',
            'email' => 'moderator@gmail.com',
            'role_id' => $moderatorRoleId,
            'approve_status' => 'APPROVED',
        ]);

        \App\Models\User::factory(5)->create([
            'role_id' => $moderatorRoleId,
        ]);
        $moderators = \App\Models\User::where('role_id', $moderatorRoleId)->get();

        \App\Models\User::factory(30)->create([
            'role_id' => null,
        ]);

        foreach ($moderators as $moderator) {
            \App\Models\Topic::factory(3)->create([
                'user_id' => $moderator->id,
            ]);
        }
        $topics = \App\Models\Topic::all();

        $usersAndModerators = \App\Models\User::where('role_id', $moderatorRoleId)
            ->orWhere('role_id', null)
            ->get();

        foreach ($topics as $topic) {
            for ($i = 0; $i < random_int(2, 5); $i++) {
                \App\Models\Conversation::factory()->create([
                    'user_id' => $usersAndModerators->random()->id,
                    'topic_id' => $topic->id,
                ]);
            }
        }
        $conversations = \App\Models\Conversation::all();

        foreach ($conversations as $conversation) {
            for ($i = 0; $i < random_int(5, 10); $i++) {
                \App\Models\Comment::factory()->create([
                    'user_id' => $usersAndModerators->random()->id,
                    'conversation_id' => $conversation->id,
                ]);
            }
        }
        $comments = \App\Models\Comment::all();

        foreach ($comments as $comment) {
            for ($i = 0; $i < random_int(0, 6); $i++) {
                \App\Models\Reply::factory()->create([
                    'user_id' => $usersAndModerators->random()->id,
                    'comment_id' => $comment->id,
                ]);
            }
        }

        $users = \App\Models\User::whereNotIn('role_id', [$adminRoleId])->get();
        $topics = \App\Models\Topic::all();

        foreach ($users as $user) {
            // Get random topics IDs
            $followedTopics = $topics->random(rand(3, 6))->pluck('id');

            // Sync without detaching existing
            $user->followedTopics()->syncWithoutDetaching($followedTopics);
        }

        foreach ($comments as $comment) {
            $usersVoted = $usersAndModerators->random(rand(0, 20))->pluck('id');
            foreach ($usersVoted as $userVoted) {
                $comment->usersVoted()->attach($userVoted, [
                    'vote' => random_int(-1, 1) !== 0 ? random_int(-1, 1) : (random_int(0, 1) === 0 ? -1 : 1),
                ]);
            }
        }

        // Inserting articles
        foreach ($topics as $topic) {
            \App\Models\Post::factory(random_int(0, 5))->create([
                'topic_id' => $topic->id,
            ]);
        }

        // Inserting polls
        foreach ($topics as $topic) {
            \App\Models\Poll::factory(random_int(0, 5))->create([
                'topic_id' => $topic->id,
            ]);
        }
        $polls = \App\Models\Poll::all();

        // Inserting poll answers
        foreach ($polls as $poll) {
            \App\Models\PollAnswer::factory(random_int(2, 4))->create([
                'poll_id' => $poll->id,
            ]);
            $pollAnswers = \App\Models\PollAnswer::where('poll_id', $poll->id)->get();
            $usersToVote = $usersAndModerators->random(rand(0, 20))->pluck('id')->unique();
            foreach ($usersToVote as $userToVote) {
                $pollAnswers->random()->usersAnswered()->attach($userToVote);
            }
        }
    }
}
