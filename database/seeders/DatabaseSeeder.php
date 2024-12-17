<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user1 = User::factory()->create([
            'name' => 'Admin',
            'email' => 'ardan123@example.com',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Editing',
            'email' => 'edit123@example.com',
        ]);

        $role = Role::create(['name' => 'admin']);
        $user1->assignRole($role);

        $role = Role::create(['name' => 'editing']);
        $user2->assignRole($role);
    }
}
