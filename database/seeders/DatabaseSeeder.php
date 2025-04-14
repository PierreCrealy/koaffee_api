<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Exchange;
use App\Models\History;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
         User::factory()->create([
             'name' => 'guest_cda',
             'email' => 'guest@cda.fr',
             'password' => Hash::make('cda'),
         ]);

        User::factory(15)->create();

        Product::factory(30)->create();
        Order::factory(50)->create();

        OrderProduct::factory(65)->create();

        Exchange::factory(50)->create();
        History::factory(75)->create();
    }
}
