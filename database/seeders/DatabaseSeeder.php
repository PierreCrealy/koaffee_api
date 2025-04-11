<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Exchange;
use App\Models\History;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         User::factory()->create([
             'name' => 'guest_cda',
             'email' => 'guest@cda.fr',
             'password' => Hash::make('cda'),
         ]);


         Exchange::factory(50)->create();
         History::factory(75)->create();
    }
}
