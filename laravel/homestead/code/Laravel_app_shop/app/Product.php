<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;

class Product extends Model
{
    protected $fillable = [
     "nombre",
     "descripcion",
     "imagen",
     "descripcion_larga",
     "precio",
     "precio_compra",
     "precio_venta_unitario",
     "precio_venta_al_mayor",
     "category_id"
    ];

    public function category(){
      return $this->belongsTo(Category::Class);
    }

    public function productImages(){
      return $this->hasMany('App\ProductImage');
    }
}
