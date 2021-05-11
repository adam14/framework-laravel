<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = (array) [
            ["id" => "1", "name" => "ProductSeeder-1", "description" => "Description-1", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "2", "name" => "ProductSeeder-2", "description" => "Description-2", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "3", "name" => "ProductSeeder-3", "description" => "Description-3", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "4", "name" => "ProductSeeder-4", "description" => "Description-4", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "5", "name" => "ProductSeeder-5", "description" => "Description-5", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')]
        ];

        foreach ($products as $value) {
            DB::table('products')->insert($value);
        }
    }
}
