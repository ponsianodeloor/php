<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Product;
use App\ProductImage;

class ProductsController extends Controller
{
    public function index(){
      //$productos = Product::all();
      $productos = Product::paginate(10);
      return view('admin.products.index', compact("productos"));
    }

    public function create(){
        $category = Category::all('nombre');
        return view('admin.products.create', compact("category"));
    }

    public function formGuardar(){
     $category = Category::all('nombre');
     return view('admin.products.guardar', compact("category"));
    }

    public function guardar(Request $request){
     $entrada = $request->all();
     if ($archivo = $request->file('imagen')) {
      $nombre = $archivo->getClientOriginalName();
      $archivo->move('img', $nombre);
      $entrada['imagen']=$nombre;
     }
     Product::create($entrada);
     return redirect( "/admin/products");
    }

    public function store(Request $request){
     /*
     $entrada = $request->all();
     if ($archivo = $request->file('imagen')) {
      $nombre = $archivo->getClientOriginalName();
      $archivo->move('img', $nombre);
      $entrada['imagen']=$nombre;
     }
     Product::create($entrada);
     return redirect( "/admin/products");
     */

     $producto = new Product;
     $producto->nombre = $request->nombre;
     $producto->descripcion = $request->descripcion;

     if ($archivo = $request->file('imagen')) {
      $nombre_archivo = $archivo->getClientOriginalName();
      $archivo->move('img', $nombre_archivo);
      $producto->imagen = $nombre_archivo;
     }else {
      $producto->imagen = "";
     }

     $producto->descripcion_larga = $request->descripcion_larga;
     $producto->precio = $request->precio;
     $producto->precio_compra = $request->precio_compra;
     $producto->precio_venta_unitario = $request->precio_venta_unitario;
     $producto->precio_venta_al_mayor = $request->precio_venta_al_mayor;
     $producto->category_id = $request->category_id;
     $producto->save();
     return redirect( "/admin/products");
    }

    public function show($id){
     $producto = Product::findOrFail($id);
     return view("admin.products.show", compact("producto"));
    }

    public function edit($id){
      $category = Category::pluck('nombre','id');
      $producto = Product::find($id);
      $productoImagen = ProductImage::where('product_id', $id)->orderBy('id', 'desc')->get();
      return view('admin.products.edit', compact("category", "producto", "productoImagen"));
    }

    public function update(Request $request, $id){
      $producto = Product::findOrFail($id);
      if ($archivo = $request->file('imagen')) {
       $nombre = $archivo->getClientOriginalName();
       $archivo->move('img', $nombre);
       $producto->imagen = $nombre_archivo;
      }
      $producto->update($request->all());
      return redirect( "/admin/products");
    }

    public function destroy($id){
      $producto = Product::findOrFail($id);
      $producto->delete();
      return redirect( "/admin/products");
    }
}
