@extends('layouts.main')

<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
@section('navbar')
         <ul class="nav">  
            <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
            <li>{{ HTML::link('users/dashboard', 'Usuario: '. Session::get('username')) }}</li>
         </ul>
         <ul class="nav">  
            @if(!Auth::check())
               <li>{{ HTML::link('/register', 'Register') }}</li>   
               <li>{{ HTML::link('/login', 'Login') }}</li>   
            @else
               <li>{{ HTML::link('/logout', 'Logout') }}</li>
            @endif
         </ul>
@stop
      </div>
   </div>
</div>

@section('navlateral')
   <div class="span4">
      <div class="span3"><h4><p>Opciones Administración</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('/admin/register', 'Registro usuarios') }}</li>
         <li class="span3">2º opción</li>
      </ul>
   </div>
@stop

@section('content')

   <h1>Administración</h1>
   <p>Welcome to your Dashboard. You rock!</p>

@stop