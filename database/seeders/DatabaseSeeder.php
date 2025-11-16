<?php

namespace Database\Seeders;

use App\Models\Collaborator;
use App\Models\EconomicGroup;
use App\Models\Flag;
use App\Models\Unit;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin',
            'role' => 'admin'
        ]);

        $user = User::factory()->create([
            'name' => 'Iago',
            'email' => 'iago@voch',
            'password' => 'iago123',
            'role' => 'user',
        ]);

        Auth::login($user);
        EconomicGroup::factory(3)->create();
        Flag::factory(3)->create();
        Unit::factory(5)->create();
        Collaborator::factory(10)->create();
    }
}
