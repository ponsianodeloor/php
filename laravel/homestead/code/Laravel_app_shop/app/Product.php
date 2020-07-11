<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class Product extends Model
{
    public function category(){
     return $this->belongsTo(Category::Class);
     //return $this->belongsTo('App\Category');
    }

    public function productImage(){
     return $this->hasMany('App\ProductImage');
    }
}
