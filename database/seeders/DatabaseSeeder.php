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
            'email' => 'adnan@gmail.com'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role_id' => $adminRoleId,
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Moderator 1',
            'email' => 'moderator@gmail.com',
            'role_id' => $moderatorRoleId,
        ]);

        \App\Models\User::factory(5)->create([
            'role_id' => $moderatorRoleId,
        ]);
        $moderators = \App\Models\User::where('role_id', $moderatorRoleId)->get();

        foreach ($moderators as $moderator) {
            \App\Models\Topic::factory()->create([
                'user_id' => $moderator->id,
            ]);
        }
        $topics = \App\Models\Topic::all();

        $usersAndModerators = \App\Models\User::where('role_id', $moderatorRoleId)
            ->orWhere('role_id', null)
            ->get();

        foreach ($topics as $topic) {
            for ($i = 0; $i < random_int(3, 7); $i++) {
                \App\Models\Conversation::factory()->create([
                    'user_id' => $usersAndModerators->random()->id,
                    'topic_id' => $topic->id,
                ]);
            }
        }
        $conversations = \App\Models\Conversation::all();

        foreach ($conversations as $conversation) {
            for($i = 0; $i < random_int(10, 15); $i++) {
                \App\Models\Comment::factory()->create([
                    'user_id' => $usersAndModerators->random()->id,
                    'conversation_id' => $conversation->id,
                ]);
            }
        }
        $comments = \App\Models\Comment::all();

        foreach ($comments as $comment) {
            for ($i = 0; $i < random_int(0, 7); $i++) {
                \App\Models\Reply::factory()->create([
                    'user_id' => $usersAndModerators->random()->id,
                    'comment_id' => $comment->id,
                ]);
            }
        }
    }
}
