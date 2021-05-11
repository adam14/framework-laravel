<?php

use Illuminate\Database\Seeder;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_products = (array) [
            ["id" => "1", "product_id" => "1", "category_id" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "2", "product_id" => "2", "category_id" => "2", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "3", "product_id" => "3", "category_id" => "3", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "4", "product_id" => "4", "category_id" => "4", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "5", "product_id" => "5", "category_id" => "5", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')]
        ];

        foreach ($category_products as $value) {
            DB::table('category_products')->insert($value);
        }
    }
}
