<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $guarded = [];

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

}
