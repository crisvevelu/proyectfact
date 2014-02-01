@extends('layouts.main')

<div class="navbar navbar-fixed-top">
   <div class="navbar-inner">
      <div class="container">
@section('navbar')
         <ul class="nav">  
            <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
         </ul>
         <ul class="nav">  
            @if(!Auth::check())
               <li>{{ HTML::link('users/register', 'Register') }}</li>   
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
         <li class="span3 active">1º opción</li>   
         <li class="span3">2º opción</li>
      </ul>
   </div>
@stop

@section('content')

   <h1>Dashboard</h1>
   <p>Welcome to your Dashboard. You rock!</p>

@stop