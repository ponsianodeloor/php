@extends('../../layouts.app')

@section('title', 'Ver Productos')
@section('body-class', 'login-page sidebar-collapse')

@section('content')

<!--
<div class="row mt-5">
 <div class="col-md-12">
   <div class="card card-plain">
     <div class="card-header card-header-primary">
       <h4 class="card-title mt-0"> Table on Plain Background</h4>
       <p class="card-category"> Here is a subtitle for this table</p>
     </div>
     <div class="card-body">
       <div class="table-responsive">
         <table class="table table-hover">
           <thead class="">
             <th>
               ID
             </th>
             <th>
               Name
             </th>
             <th>
               Country
             </th>
             <th>
               City
             </th>
             <th>
               Salary
             </th>
           </thead>
           <tbody>
             <tr>
               <td>
                 1
               </td>
               <td>
                 Dakota Rice
               </td>
               <td>
                 Niger
               </td>
               <td>
                 Oud-Turnhout
               </td>
               <td>
                 $36,738
               </td>
             </tr>
             <tr>
               <td>
                 2
               </td>
               <td>
                 Minerva Hooper
               </td>
               <td>
                 Curaçao
               </td>
               <td>
                 Sinaai-Waas
               </td>
               <td>
                 $23,789
               </td>
             </tr>
             <tr>
               <td>
                 3
               </td>
               <td>
                 Sage Rodriguez
               </td>
               <td>
                 Netherlands
               </td>
               <td>
                 Baileux
               </td>
               <td>
                 $56,142
               </td>
             </tr>
             <tr>
               <td>
                 4
               </td>
               <td>
                 Philip Chaney
               </td>
               <td>
                 Korea, South
               </td>
               <td>
                 Overland Park
               </td>
               <td>
                 $38,735
               </td>
             </tr>
             <tr>
               <td>
                 5
               </td>
               <td>
                 Doris Greene
               </td>
               <td>
                 Malawi
               </td>
               <td>
                 Feldkirchen in Kärnten
               </td>
               <td>
                 $63,542
               </td>
             </tr>
             <tr>
               <td>
                 6
               </td>
               <td>
                 Mason Porter
               </td>
               <td>
                 Chile
               </td>
               <td>
                 Gloucester
               </td>
               <td>
                 $78,615
               </td>
             </tr>
           </tbody>
         </table>
       </div>
     </div>
   </div>
 </div>
</div>
-->
<div class="row">
 <div class="col">
  <div class="card card-plain">
   <div class="card-header card-header-primary">
    <h4 class="card-title mt-0"> Tabla de productos</h4>
    <p class="card-category"> Se describen los precios de compra y venta</p>
   </div>
   <div class="card-body">
    <div class="table-responsive">
     <a href="{{url('admin/products/create')}}" class="btn btn-primary btn-round"> Nuevo Producto</a>
     <table class="table table-hover">
      <thead>
       <th>
        Acciones
       </th>
       <th>
         ID
       </th>
       <th>
         Producto
       </th>
       <th>
         Categoria
       </th>
       <th>
         Precio Compra
       </th>
       <th>
         Precio Venta
       </th>
       <th>
        Acciones
       </th>
      </thead>
      <tbody>
       <?php foreach ($productos as $row_productos): ?>
       <tr>
        <td>
         <a href="{{url('admin/products', $row_productos->id)}}">Ver / Eliminar</a>
         <a href="{{url('admin/products/'.$row_productos->id.'/edit')}}">Actualizar</a>
        </td>
        <td>{{$row_productos['id']}}</td>
        <td>{{$row_productos['nombre']}} </td>
        <td>{{$row_productos->category->nombre}}</td>
        <td>{{$row_productos['descripcion']}}</td>
        <td>{{$row_productos['precio_venta_unitario']}}</td>
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
     {{ $productos->links() }}
    </div>
   </div>
  </div>
 </div>
</div>

<div class="row">
 <?php foreach ($productos as $row_productos): ?>
  <div class="col-md-4">
    <div class="team-player">
      <div class="card card-plain">
        <div class="col-md-6 ml-auto mr-auto">
         <!--
         <img src="{{$row_productos['imagen']}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
          <img src="{{asset('img/faces/avatar.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid"> -->
        </div>
        <h4 class="card-title">{{$row_productos['nombre']}}
          <br>
          <small class="card-description text-muted">{{$row_productos->category->nombre}}</small>
        </h4>
        <div class="card-body">
          <p class="card-description">{{$row_productos['descripcion']}}</p>
        </div>
        <div class="card-footer justify-content-center">
          <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-twitter"></i></a>
          <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-instagram"></i></a>
          <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-facebook-square"></i></a>
        </div>
      </div>
    </div>
  </div>
 <?php endforeach; ?>
</div>

<!--
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
-->
@endsection
