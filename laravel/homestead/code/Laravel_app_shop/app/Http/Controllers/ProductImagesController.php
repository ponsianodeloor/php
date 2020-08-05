<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ProductImage;

class ProductImagesController extends Controller
{
    public function index(){
        //
    }

    public function create(){
        //
    }

    public function store(Request $request){
     $productoImagen = new ProductImage;
     $productoImagen->product_id = $request->product_id;
     $productoImagen->featured = 0;

     if ($archivo = $request->file('image')) {
      $nombre_archivo = $archivo->getClientOriginalName();
      $archivo->move('img', $nombre_archivo);
      $productoImagen->image = $nombre_archivo;
     }else {
      $productoImagen->image = "";
     }
     $productoImagen->save();

     return redirect( "/admin/products/".$productoImagen->product_id."/edit");

    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(Request $request, $id){
        //
    }

    public function destroy($id){
        //
    }
}
