<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(storage_path("app/public/category/data.json")), true);
        foreach ($data as $key => $category) {
            Category::create($category);
        }
        echo "Data inserted successfully.\n";
    }
}
