<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Role;
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
        //\App\Models\User::factory(5)->create();

        $role = Role::factory()->create();
        Role::factory()->create([
            'role' => 'editor'
        ]);

        $user = User::factory()->create([
            'role_id' => $role->id,
            'name' => 'Ivan M',
            'email' => 'ivan@gmail.com'

        ]);

        Post::factory(6)->create([
            'user_id' => $user->id
        ]);
    }
}
