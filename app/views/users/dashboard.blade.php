@extends('layouts.main')

<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
@section('navbar')
         <ul class="nav">  
            <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
         </ul>
         <ul class="nav">
               <li>{{ HTML::link('users/dashboard', 'Usuario: '. Session::get('username')) }}</li>
               <li>{{ HTML::link('/logout', 'Logout') }}</li>
         </ul>
@stop
      </div>
   </div>
</div>

@section('navlateral')
   <div class="span4">
      <div class="span3"><h4><p>Opciones</p></h4></div>
      <ul class="nav">
         <li class="span3">1º opcion</li>   
         <li class="span3">2º opción</li>
         @if(User::isAdmin())
            <li class="span3"> {{ HTML::link('admin', 'Administración')}}</li>
         @endif
      </ul>

      
   </div>
@stop

@section('content')

   <h1>Dashboard</h1>
   <p>Welcome to your Dashboard. You rock!</p>

   {{ Session::get('id')}}
   {{ Session::get('username')}}
   {{ Session::get('user_type')}}

@stop