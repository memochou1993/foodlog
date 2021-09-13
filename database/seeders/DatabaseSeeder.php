<?php

namespace Database\Seeders;

use App\Constants\Role;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'name' => 'user',
            'email' => 'user@email.com',
            'password' => 'password',
        ]);

        $users = User::factory()->count(5)->create();

        $users->each(function ($user) {
            Post::factory()
                ->count(10)
                ->state(new Sequence(
                    ['is_archived' => true],
                    ['is_archived' => false],
                ))
                ->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
