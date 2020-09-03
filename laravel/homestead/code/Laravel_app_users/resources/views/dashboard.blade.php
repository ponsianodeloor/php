@extends('app')

@section('content')

<div id="crud" class="row">

 <div class="col-12">
  <h1 class="page-header">Laravel VIEW</h1>
 </div>
 <div class="w-100">

 </div>
 <div class="col-sm-7">
  <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#create">Nuevo Usuario</a>
  <table class="table table-hover table-sprite">
   <thead>
    <tr>
     <th>id</th>
     <th>Status</th>
     <th>Nombre</th>
     <th>Email</th>
     <th colspan="2">acciones</th>
    </tr>
   </thead>
   <!--
   <tr>
    <td>Ponsiano</td>
    <td>pdeloor@gmail.com</td>
    <td width="10px">
     <a href="#" class="btn btn-warning btn-sm">Editar</a>
    </td>
    <td width="10px">
     <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
    </td>
   </tr>
   <tr>
    <td>1</td>
    <td>2</td>
    <td width="10px">
     <a href="#" class="btn btn-warning btn-sm">Editar</a>
    </td>
    <td width="10px">
     <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
    </td>
   </tr>
  -->
   <tr v-for="user in users">
    <td>@{{user.id}}</td>
    <td>@{{user.status}}</td>
    <td>@{{user.name}}</td>
    <td>@{{user.email}}</td>
    <td width="10px">
     <a href="#" class="btn btn-warning btn-sm" v-on:click.prevent="editUser(user)">Editar</a>
    </td>
    <td width="10px">
     <a class="btn btn-danger btn-sm" v-on:click.prevent="deleteUser(user)">Eliminar</a>
    </td>
   </tr>
  </table>


  <nav>
    <ul class="pagination">
      <li v-if="pagination.current_page > 1" class="page-item"><a class="page-link" @click.prevent="changePage(pagination.current_page - 1)"><span>Atras</span></a></li>
      <li class="page-item"><a class="page-link" href="#"><span>1</span> </a></li>
      <li class="page-item"><a class="page-link" href="#"><span>2</span> </a></li>
      <li class="page-item"><a class="page-link" href="#"><span>3</span> </a></li>
      <li v-if="pagination.current_page < pagination.last_page" class="page-item"><a class="page-link" @click.prevent="changePage(pagination.current_page - 1)"><span>Siguiente</span> </a></li>
    </ul>
  </nav>

  <nav>
			<ul class="pagination">
				<li class="page-item" v-if="pagination.current_page > 1">
					<a href="#" class="page-link" @click.prevent="changePage(pagination.current_page - 1)">
						<span>Atras</span>
					</a>
				</li>

				<li class="page-item" v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
					<a href="#" class="page-link" @click.prevent="changePage(page)">
						@{{ page }}
					</a>
				</li>

				<li class="page-item" v-if="pagination.current_page < pagination.last_page">
					<a href="#" class="page-link" @click.prevent="changePage(pagination.current_page + 1)">
						<span>Siguiente</span>
					</a>
				</li>
			</ul>
		</nav>


  @include('create')
  @include('edit')
 </div>

 <div class="col-sm-5">
  <pre>
   @{{ $data }}
  </pre>
 </div>
</div>
@endsection
