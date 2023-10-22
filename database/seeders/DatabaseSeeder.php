<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Customer;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::create([
            'first_name' => 'Walid',
            'last_name' => 'Said',
            'email' => 'walid.said@example.org',
            'store_credit' => 300.00
        ]);

        Item::factory()->count(100)->create();
    }
}
