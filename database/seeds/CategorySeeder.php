<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = (array) [
            ["id" => "1", "name" => "CategorySeeder-1", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "2", "name" => "CategorySeeder-2", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "3", "name" => "CategorySeeder-3", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "4", "name" => "CategorySeeder-4", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "5", "name" => "CategorySeeder-5", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')]
        ];

        foreach ($categories as $value) {
            DB::table('categories')->insert($value);
        }
    }
}
