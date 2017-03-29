<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new \App\Category;
        $category->name = "Conciertos";
        $category->save();

        $category = new \App\Category;
        $category->name = "Transporte";
        $category->save();

        $category = new \App\Category;
        $category->name = "Ocio";
        $category->save();

        $category = new \App\Category;
        $category->name = "Gastronomía";
        $category->save();

        $category = new \App\Category;
        $category->name = "Cultura";
        $category->save();

        $category = new \App\Category;
        $category->name = "Turismo";
        $category->save();

        $category = new \App\Category;
        $category->name = "Tecnología";
        $category->save();

        $category = new \App\Category;
        $category->name = "Salud";
        $category->save();

        $category = new \App\Category;
        $category->name = "Otros";
        $category->save();
    }
}
