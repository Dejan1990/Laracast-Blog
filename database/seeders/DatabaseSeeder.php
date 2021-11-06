<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();
        /*$user = User::factory()->create([
            'name' => 'John Doe'
        ]);

        Post::factory(10)->create([
            'user_id' => $user->id
        ]);*/

        Post::factory(20)->create();
    }
}
