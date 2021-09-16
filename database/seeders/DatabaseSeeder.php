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
            'email' => 'user@example.com',
            'password' => 'password',
        ]);
    }
}
