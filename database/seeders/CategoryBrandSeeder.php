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
        Category::create(['name' => 'Income', 'type' => Category::INCOME])
            ->brands()
            ->create(['name' => 'Salary']);

        Category::create(['name' => 'Housing', 'type' => Category::EXPENSES])
            ->brands()
            ->create(['name' => 'House Rent']);

        Category::create(['name' => 'Groceries', 'type' => Category::EXPENSES])
            ->brands()
            ->createMany([
                ['name' => 'LULU'],
                ['name' => 'CARREFOUR'],
            ]);

        Category::create(['name' => 'Utilities', 'type' => Category::EXPENSES])
            ->brands()
            ->createMany([
                ['name' => 'Smart Dubai'],
            ]);

        Category::create(['name' => 'Transportation', 'type' => Category::EXPENSES])
            ->brands()
            ->createMany([
                ['name' => 'ENOC'],
            ]);

        Category::create(['name' => 'Shopping', 'type' => Category::EXPENSES])
            ->brands()
            ->createMany([
                ['name' => 'IKEA'],
                ['name' => 'HOME CENTRE'],
                ['name' => 'MCDONALDS'],
            ]);

        Category::create(['name' => 'Support', 'type' => Category::EXPENSES])
            ->brands()
            ->createMany([
                ['name' => 'Family Support'],
            ]);

        Category::create(['name' => 'Debt', 'type' => Category::EXPENSES])
            ->brands()
            ->createMany([
                ['name' => 'Debt'],
            ]);
    }
}
