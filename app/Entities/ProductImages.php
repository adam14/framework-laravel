<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_images';

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function images()
    {
        return $this->belongsTo(Images::class, 'image_id');
    }
}
