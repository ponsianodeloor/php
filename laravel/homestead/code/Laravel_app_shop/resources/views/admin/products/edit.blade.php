@extends('../../layouts.app')

@section('title', 'Editar Producto')
@section('body-class', 'landing-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/profile_city.jpg')}}')">

</div>
<div class="main main-raised">
  <div class="container">
    <div class="section section-contacts">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center title">Editar Producto {{$producto->nombre}}</h2>
          <h4 class="text-center description">Contactanos.</h4>
          {!! Form::model($producto, ['method'=>'POST', 'action'=>['ProductsController@update', $producto->id]]) !!}
          <div class="row">
           <div class="col-md-6">
            <div class="form-group">
             <label class="bmd-label-floating">Categoria</label>
             <?php
             echo Form::select('category_id', $category, $producto->category->id, ['class'=>'form-control']);
             ?>
            </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">
              <div class="fileinput fileinput-new text-center" data-provides="fileinput">
               <span class="btn btn-raised btn-round btn-rose btn-file">
                  <span class="fileinput-new">Select image
                   <?php echo Form::file('imagen'); ?>
                  </span>
               </span>
              </div>
             </div>
           </div>


             <div class="col-md-6">
               <div class="form-group">
                 <label class="bmd-label-floating">Product Name</label>
                 <?php echo Form::text('nombre', $producto->nombre, ['class' => 'form-control']); ?>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label class="bmd-label-floating">Descripcion</label>
                 <?php echo Form::text('descripcion', $producto->descripcion, ['class' => 'form-control']); ?>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label class="bmd-label-floating">Precio</label>
                 <?php echo Form::text('precio', $producto->precio, ['class' => 'form-control']); ?>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label class="bmd-label-floating">Precio Compra</label>
                 <?php echo Form::text('precio_compra', $producto->precio_compra, ['class' => 'form-control']); ?>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label class="bmd-label-floating">Precio Valor Unitario</label>
                 <?php echo Form::text('precio_venta_unitario', $producto->precio_venta_unitario, ['class' => 'form-control']); ?>
               </div>
             </div>
             <div class="col-md-6">
               <div class="form-group">
                 <label class="bmd-label-floating">Precio al por mayor</label>
                 <?php echo Form::text('precio_venta_al_mayor', $producto->precio_venta_al_mayor, ['class' => 'form-control']); ?>
               </div>
             </div>

          </div>
          <div class="form-group">
            <label for="exampleMessage" class="bmd-label-floating">Descripcion completa</label>
            {!! Form::textarea('descripcion_larga', $producto->descripcion_larga, ['class'=>'form-control', 'rows'=>'4']) !!}
          </div>
          <div class="row">
            <div class="col-md-4 ml-auto mr-auto text-center">
              <button class="btn btn-primary btn-raised">
                Guardar
              </button>
            </div>
          </div>

           {{csrf_field()}}
           <input type="hidden" name="_method" value="PUT">
          {!! Form::close() !!}


          <?php echo Form::open(['action' => 'ProductImagesController@store', 'method' => 'post', 'files'=>'true']); ?>
          <div class="row">
           <div class="col text-center">
            Guardar nueva imagen para la categoria
           </div>
          </div>
          <div class="row">
           <div class="col-md-6">
            <div class="form-group">
             <?php echo Form::hidden('product_id', $producto->id); ?>
            </div>
           </div>
           <div class="col-md-6">
             <div class="form-group">
              <div class="fileinput fileinput-new text-center" data-provides="fileinput">
               <span class="btn btn-raised btn-round btn-rose btn-file">
                  <span class="fileinput-new">Select image
                   <?php echo Form::file('image'); ?>
                  </span>
               </span>
              </div>
             </div>
           </div>
          </div>
          <div class="row">
            <div class="col-md-4 ml-auto mr-auto text-center">
              <button class="btn btn-primary btn-raised">
                Guardar
              </button>
            </div>
          </div>

          {{csrf_field()}}
         <?php echo Form::close(); ?>

          <div class="row">
           <div class="col">
            <table class="table table-hover">
             <thead>
              <th>
               Acciones
              </th>
              <th>
                ID
              </th>
              <th>
                Image
              </th>
              <th>
                Fecha Registro
              </th>
              <th>
               Acciones
              </th>
             </thead>
             <tbody>
              <?php foreach ($productoImagen as $row_productoImagen): ?>
              <tr>
               <td>
                <a href="{{url('admin/products', $row_productoImagen->id)}}">Ver / Eliminar</a>
                <a href="{{url('admin/products/'.$row_productoImagen->id.'/edit')}}">Actualizar</a>
               </td>
               <td>{{$row_productoImagen['id']}}</td>
               <td>{{$row_productoImagen['image']}} </td>
               <td>{{$row_productoImagen['created_at']}}</td>
               <td>
                <span class="btn btn-success">
                 <i class="fa fa-edit"></i>
                </span>
                <span class="btn btn-warning">
                 <i class="fa fa-image"></i>
                </span>
                <span class="btn btn-success">
                 <i class="fa fa-clock-o"></i>
                </span>
               </td>
              </tr>
              <?php endforeach; ?>
             </tbody>
            </table>
           </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@include('../incl.footer')
@endsection
