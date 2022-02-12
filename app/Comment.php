<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];

    public function ratting(){
        return $this->hasOne(Rating::class);
    }
    public function products(){
        return $this->belongsTo(Product::class, 'product_id');
    }

}
