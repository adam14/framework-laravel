<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryProducts extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'category_products';

    public function products()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
