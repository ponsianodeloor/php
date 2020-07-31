@extends('layouts.app')

@section('title', 'Bienvenido a App Shop')
@section('body-class', 'landing-page sidebar-collapse')

@section('content')
<div class="page-header header-filter" data-parallax="true" style="background-image: url('{{asset('img/profile_city.jpg')}}')">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1 class="title">Bienvenido a App Shop</h1>
        <h4>Realiza los pedidos en lineay te contactaremos para coordinar la entrega</h4>
        <br>
        <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" class="btn btn-danger btn-raised btn-lg">
          <i class="fa fa-play"></i> Como funciona?
        </a>
      </div>
    </div>
  </div>
</div>
<div class="main main-raised">
  <div class="container">
    <div class="section text-center">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="title">Por Que App Shop </h2>
          <h5 class="description">This is the paragraph where you can write more details about your product. Keep you user engaged by providing meaningful information. Remember that by this time, the user is curious, otherwise he wouldn&apos;t scroll to get here. Add a button if you want the user to see more.</h5>
        </div>
      </div>
      <div class="features">
        <div class="row">
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-info">
                <i class="material-icons">chat</i>
              </div>
              <h4 class="info-title">Atendemos tus dudas</h4>
              <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-success">
                <i class="material-icons">verified_user</i>
              </div>
              <h4 class="info-title">Pago Seguro</h4>
              <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="info">
              <div class="icon icon-danger">
                <i class="material-icons">fingerprint</i>
              </div>
              <h4 class="info-title">Informacion privada</h4>
              <p>Divide details about your product or agency work into parts. Write a few lines about each one. A paragraph describing a feature will be enough.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="section text-center">
      <h2 class="title">Productos disponibles</h2>
      <div class="team">
        <div class="row">
         <?php
          //foreach ($products as $row_products) {
           //echo $row_products['nombre'];
          //}
         ?>
         <?php foreach ($products as $row_products): ?>
          <div class="col-md-4">
            <div class="team-player">
              <div class="card card-plain">
                <div class="col-md-6 ml-auto mr-auto">
                 <img src="{{$row_products['imagen']}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                 <!-- <img src="{{asset('img/faces/avatar.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid"> -->
                </div>
                <h4 class="card-title">{{$row_products['nombre']}}
                  <br>
                  <small class="card-description text-muted">{{$row_products->category->nombre}}</small>
                </h4>
                <div class="card-body">
                  <p class="card-description">{{$row_products['descripcion']}}</p>
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
          <!--
          <div class="col-md-4">
            <div class="team-player">
              <div class="card card-plain">
                <div class="col-md-6 ml-auto mr-auto">
                  <img src="{{asset('img/faces/avatar.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                </div>
                <h4 class="card-title">Gigi Hadid
                  <br>
                  <small class="card-description text-muted">Model</small>
                </h4>
                <div class="card-body">
                  <p class="card-description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
                    <a href="#">links</a> for people to be able to follow them outside the site.</p>
                </div>
                <div class="card-footer justify-content-center">
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-twitter"></i></a>
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-instagram"></i></a>
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-facebook-square"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="team-player">
              <div class="card card-plain">
                <div class="col-md-6 ml-auto mr-auto">
                  <img src="{{asset('img/faces/christian.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                </div>
                <h4 class="card-title">Christian Louboutin
                  <br>
                  <small class="card-description text-muted">Designer</small>
                </h4>
                <div class="card-body">
                  <p class="card-description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
                    <a href="#">links</a> for people to be able to follow them outside the site.</p>
                </div>
                <div class="card-footer justify-content-center">
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-twitter"></i></a>
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="team-player">
              <div class="card card-plain">
                <div class="col-md-6 ml-auto mr-auto">
                  <img src="{{asset('img/faces/kendall.jpg')}}" alt="Thumbnail Image" class="img-raised rounded-circle img-fluid">
                </div>
                <h4 class="card-title">Kendall Jenner
                  <br>
                  <small class="card-description text-muted">Model</small>
                </h4>
                <div class="card-body">
                  <p class="card-description">You can write here details about one of your team members. You can give more details about what they do. Feel free to add some
                    <a href="#">links</a> for people to be able to follow them outside the site.</p>
                </div>
                <div class="card-footer justify-content-center">
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-twitter"></i></a>
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-instagram"></i></a>
                  <a href="#pablo" class="btn btn-link btn-just-icon"><i class="fa fa-facebook-square"></i></a>
                </div>
              </div>
            </div>
          </div>
         -->
        </div>
      </div>
    </div>
    <div class="section section-contacts">
      <div class="row">
        <div class="col-md-8 ml-auto mr-auto">
          <h2 class="text-center title">Aun no te has registrado</h2>
          <h4 class="text-center description">Contactanos.</h4>
          <form class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Your Name</label>
                  <input type="email" class="form-control">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Your Email</label>
                  <input type="email" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="exampleMessage" class="bmd-label-floating">Your Message</label>
              <textarea type="email" class="form-control" rows="4" id="exampleMessage"></textarea>
            </div>
            <div class="row">
              <div class="col-md-4 ml-auto mr-auto text-center">
                <button class="btn btn-primary btn-raised">
                  Send Message
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@include('incl.footer')
@endsection
