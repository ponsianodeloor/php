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
           <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label class="bmd-label-floating">Categoria <strong>{{$producto->category->nombre}}</strong> </label>

             </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">

              </div>
            </div>


              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Product Name <strong>{{$producto->nombre}}</strong> </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Descripcion <strong>{{$producto->descripcion}}</strong> </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio {{$producto->precio}} </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio Compra <strong>{{$producto->precio_compra}}</strong> </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio Valor Unitario <strong>{{$producto->precio_venta_unitario}}</strong> </label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio al por mayor <strong>{{$producto->precio_venta_al_mayor}}</strong> </label>
                </div>
              </div>

           </div>
           <div class="form-group">
             <label for="exampleMessage" class="bmd-label-floating">Descripcion completa</label>
             <label for="exampleMessage" class="bmd-label-floating"><strong>{{$producto->descripcion_larga}}</strong> </label>
           </div>
           {!! Form::model($producto, ['method'=>'DELETE', 'action'=>['ProductsController@update', $producto->id]]) !!}
            {{csrf_field()}}
            <input type="hidden" name="_method" value="DELETE">
            <div class="row">
              <div class="col-md-4 ml-auto mr-auto text-center">
                <button class="btn btn-primary btn-raised">
                  Eliminar
                </button>
              </div>
            </div>
           {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="footer footer-default">
  <div class="container">
    <nav class="float-left">
      <ul>
        <li>
          <a href="https://www.creative-tim.com/">
            Creative Tim
          </a>
        </li>
        <li>
          <a href="https://www.creative-tim.com/presentation">
            About Us
          </a>
        </li>
        <li>
          <a href="https://www.creative-tim.com/blog">
            Blog
          </a>
        </li>
        <li>
          <a href="https://www.creative-tim.com/license">
            Licenses
          </a>
        </li>
      </ul>
    </nav>
    <div class="copyright float-right">
      &copy;
      <script>
        document.write(new Date().getFullYear())
      </script>, made with <i class="material-icons">favorite</i> by
      <a href="https://www.creative-tim.com/" target="_blank">Creative Tim</a> for a better web.
    </div>
  </div>
</footer>
@endsection
