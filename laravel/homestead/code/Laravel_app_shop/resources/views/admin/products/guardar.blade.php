@extends('../../layouts.app')

@section('title', 'Crear Producto')
@section('body-class', 'landing-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/profile_city.jpg')}}')">

</div>
<div class="main main-raised">
  <div class="container">
    <div class="section section-contacts">
      <div class="row">

       <div class="form-group form-file-upload form-file-simple">


        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center title">Crear Producto</h2>
          <h4 class="text-center description">Contactanos.</h4>

          <?php echo Form::open(['action' => 'ProductsController@guardar', 'method' => 'post', 'files'=>'true']); ?>
           <div class="row">
            <div class="col-md-6">
             <div class="form-group">
              <label class="bmd-label-floating">Categoria</label>
              <?php
              foreach ($category as $row_category) {
               $category_select[] = $row_category['nombre'];
              }
              echo Form::select('category_id', $category_select, '2', ['class'=>'form-control']);
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
                  <?php echo Form::text('nombre', '', ['class' => 'form-control']); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Descripcion</label>
                  <?php echo Form::text('descripcion', '', ['class' => 'form-control']); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio</label>
                  <?php echo Form::text('precio', '', ['class' => 'form-control']); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio Compra</label>
                  <?php echo Form::text('precio_compra', '', ['class' => 'form-control']); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio Valor Unitario</label>
                  <?php echo Form::text('precio_venta_unitario', '', ['class' => 'form-control']); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Precio al por mayor</label>
                  <?php echo Form::text('precio_venta_al_mayor', '', ['class' => 'form-control']); ?>
                </div>
              </div>

           </div>
           <div class="form-group">
             <label for="exampleMessage" class="bmd-label-floating">Descripcion completa</label>
             {!! Form::textarea('descripcion_larga', null, ['class'=>'form-control', 'rows'=>'4']) !!}
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
          <form class="contact-form">
            <div class="row">
            </div>

          </form>
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
