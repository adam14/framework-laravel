<?php

use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product_images = (array) [
            ["id" => "1", "product_id" => "1", "image_id" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "2", "product_id" => "2", "image_id" => "2", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "3", "product_id" => "3", "image_id" => "3", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "4", "product_id" => "4", "image_id" => "4", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "5", "product_id" => "5", "image_id" => "5", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')]
        ];

        foreach ($product_images as $value) {
            DB::table('product_images')->insert($value);
        }
    }
}
