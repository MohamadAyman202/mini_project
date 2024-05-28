<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(file_get_contents(storage_path("app/public/products/data.json")), true);
        foreach ($data as $key => $product) {
            Product::create($product);
        }
        echo "Data inserted successfully.\n";
    }
}
