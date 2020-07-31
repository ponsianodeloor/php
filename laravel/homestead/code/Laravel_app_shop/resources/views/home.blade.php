@extends('layouts.app')

@section('title', 'Crear Producto')
@section('body-class', 'landing-page sidebar-collapse')

@section('content')
<div class="main main-raised">
  <div class="container">
   <div class="card">
       <div class="card-header">Dashboard</div>

       <div class="card-body">
           @if (session('status'))
               <div class="alert alert-success" role="alert">
                   {{ session('status') }}
               </div>
           @endif

           You are logged in!

           <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
               {{ __('Logout') }}
           </a>
           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
               @csrf
           </form>

       </div>
       <div class="card card-nav-tabs">
          <div class="card-header card-header-primary">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="#profile" data-toggle="tab">
                      <i class="material-icons">face</i>
                      Productos
                    <div class="ripple-container"></div></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#messages" data-toggle="tab">
                      <i class="material-icons">chat</i>
                      Carrito de compras
                    <div class="ripple-container"></div></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active show" href="#settings" data-toggle="tab">
                      <i class="material-icons">build</i>
                      Pedidos
                    <div class="ripple-container"></div></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body ">
            <div class="tab-content text-center">
              <div class="tab-pane" id="profile">
                <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane active show" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>
        </div>
   </div>

          <div class="card-header card-header-primary">
            <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link" href="#profile" data-toggle="tab">
                      <i class="material-icons">face</i>
                      Profile
                    <div class="ripple-container"></div></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#messages" data-toggle="tab">
                      <i class="material-icons">chat</i>
                      Messages
                    <div class="ripple-container"></div></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active show" href="#settings" data-toggle="tab">
                      <i class="material-icons">build</i>
                      Settings
                    <div class="ripple-container"></div></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body ">
            <div class="tab-content text-center">
              <div class="tab-pane" id="profile">
                <p> I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. </p>
              </div>
              <div class="tab-pane" id="messages">
                <p> I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus. I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at.</p>
              </div>
              <div class="tab-pane active show" id="settings">
                <p>I think that’s a responsibility that I have, to push possibilities, to show people, this is the level that things could be at. So when you get something that has the name Kanye West on it, it’s supposed to be pushing the furthest possibilities. I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture. I am the nucleus.</p>
              </div>
            </div>
          </div>


  </div>
</div>
@include('incl.footer')
@endsection
