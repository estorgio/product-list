<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create([
            'username' => 'admin',
            'email' => 'admin@test.local',
            'password' => Hash::make('local123test'),
        ]);

        Product::factory()
            ->for($user)
            ->create([
                'name' => 'Century Tuna Flakes in Oil',
                'price' => 24.50,
                'quantity' => 104,
                'barcode' => '0123456789',
                'image' => 'product-images/sample-1.jpg',
            ]);
    }
}
