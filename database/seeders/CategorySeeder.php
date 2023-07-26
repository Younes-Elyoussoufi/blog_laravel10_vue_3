<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories=collect(['sciences','cars','sport','technilogy','books','computers']);

        $categories->each(function($category){
         Category::create([
             'name'=>$category
         ]);
        
        });
    }
}
