<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = (array) [
            ["id" => "1", "name" => "image-1", "file" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Frentofashion.com%2Fproduct%2Ftest-product%2F&psig=AOvVaw03jdNs9CMgCOedOuibn2Hq&ust=1620832393937000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICLrqr1wfACFQAAAAAdAAAAABAD", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "2", "name" => "image-2", "file" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Frentofashion.com%2Fproduct%2Ftest-product%2F&psig=AOvVaw03jdNs9CMgCOedOuibn2Hq&ust=1620832393937000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICLrqr1wfACFQAAAAAdAAAAABAD", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "3", "name" => "image-3", "file" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Frentofashion.com%2Fproduct%2Ftest-product%2F&psig=AOvVaw03jdNs9CMgCOedOuibn2Hq&ust=1620832393937000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICLrqr1wfACFQAAAAAdAAAAABAD", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "4", "name" => "image-4", "file" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Frentofashion.com%2Fproduct%2Ftest-product%2F&psig=AOvVaw03jdNs9CMgCOedOuibn2Hq&ust=1620832393937000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICLrqr1wfACFQAAAAAdAAAAABAD", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')],
            ["id" => "5", "name" => "image-5", "file" => "https://www.google.com/url?sa=i&url=https%3A%2F%2Frentofashion.com%2Fproduct%2Ftest-product%2F&psig=AOvVaw03jdNs9CMgCOedOuibn2Hq&ust=1620832393937000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCICLrqr1wfACFQAAAAAdAAAAABAD", "enable" => "1", "created_at" => date('Y-m-d H:i:s'), "updated_at" => date('Y-m-d H:i:s')]
        ];

        foreach ($images as $value) {
            DB::table('images')->insert($value);
        }
    }
}
