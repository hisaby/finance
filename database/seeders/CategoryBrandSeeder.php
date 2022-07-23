<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $income = Category::create(['name' => 'Income', 'type' => Category::INCOME]);
        $income->brands()->create(['name' => 'Salary'])->transactions()->createMany([
            [
                'amount' => 15000,
                'created_at' => now()->subDay()
            ],
            [
                'amount' => 14000,
                'created_at' => now()->subMonth()
            ],
            [
                'amount' => 13500,
                'created_at' => now()->subMonths(2)
            ],
            [
                'amount' => 9000,
                'created_at' => now()->subMonths(3)
            ]
        ]);

        $housing = Category::create(['name' => 'Housing', 'type' => Category::EXPENSES]);
        $housing->brands()->create(['name' => 'House Rent'])->transactions()->createMany([
            [
                'amount' => 4000,
                'created_at' => now()->subDay()
            ],
            [
                'amount' => 4000,
                'created_at' => now()->subMonths(3)
            ],
            [
                'amount' => 4000,
                'created_at' => now()->subMonths(5)
            ]
        ]);

        $groceries = Category::create(['name' => 'Groceries', 'type' => Category::EXPENSES]);
        $groceries->brands()->create(['name' => 'CARREFOUR'])->transactions()->createMany([
            [
                'amount' => 200,
                'created_at' => now()->subDay()
            ],
            [
                'amount' => 100,
                'created_at' => now()->subDays(10)
            ],
            [
                'amount' => 532,
                'created_at' => now()->subDays(15)
            ],
            [
                'amount' => 43,
                'created_at' => now()->subDays(30)
            ],
            [
                'amount' => 473,
                'created_at' => now()->subDays(50)
            ],
            [
                'amount' => 233.24,
                'created_at' => now()->subDays(60)
            ],
            [
                'amount' => 548.24,
                'created_at' => now()->subDays(80)
            ],
        ]);

        $utils = Category::create(['name' => 'Utilities', 'type' => Category::EXPENSES]);
        $utils->brands()->create(['name' => 'Water'])->transactions()->createMany([
            [
                'amount' => 125,
                'created_at' => now()->subDays(10)
            ],
            [
                'amount' => 130,
                'created_at' => now()->subDays(40)
            ],
            [
                'amount' => 100,
                'created_at' => now()->subDays(70)
            ],
        ]);



        $shopping = Category::create(['name' => 'Shopping', 'type' => Category::EXPENSES]);
        $shopping->brands()->create(['name' => 'IKEA'])->transactions()->createMany([
            [
                'amount' => 302,
                'created_at' => now()->subDays(35)
            ],
            [
                'amount' => 404,
                'created_at' => now()->subDays(70)
            ],
            [
                'amount' => 603,
                'created_at' => now()->subDays(120)
            ]
        ]);
        $shopping->brands()->create(['name' => 'MCDONALDS'])->transactions()->createMany([
            [
                'amount' => 40,
                'created_at' => now()->subDays(2)
            ],
            [
                'amount' => 20,
                'created_at' => now()->subDays(10)
            ],
            [
                'amount' => 2,
                'created_at' => now()->subDays(30)
            ],
            [
                'amount' => 10,
                'created_at' => now()->subDays(50)
            ],
            [
                'amount' => 46,
                'created_at' => now()->subDays(100)
            ]
        ]);
    }
}
