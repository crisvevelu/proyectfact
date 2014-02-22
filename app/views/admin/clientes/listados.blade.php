@extends('layouts.main')

@section('titulo')
   <title>Administración Clientes</title>
@stop
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

@section('navlateral')
   <div class="span4">
      <div class="span3"><h4><p>Opciones Administración</p></h4></div>
      <ul class="nav">
        @if(Session::get('user_type') == 2)
            <li class="span3">{{ HTML::link('admin', 'Administración') }}</li>
        @endif
        <li class="span3">{{ HTML::link('/admin/clientes', 'Clientes') }}</li>
        <li class="span3">{{ HTML::link('/admin/usuarios', 'Usuarios') }}</li> 
      </ul>

      <div class="span3"><h4><p>Opciones Clientes</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('admin/clientes', 'Listado') }}</li>
         <li class="span3">{{ HTML::link('admin/clientes/antiguos', 'Clientes Antiguos') }}</li>
         <li class="span3">{{ HTML::link('admin/clientes/gestlistados', 'Gestionar Listados') }}</li>
      </ul>
   </div>
@stop
@section('content')
  <h4>Elige los campos que se van a mostrar en los listados</h4>

   @foreach ($clientes as $cliente)

    {{ $cliente->razonsocial }}

  @endforeach

 <!-- codcliente,
  cif,
  razonsocial,
  direccion1,
  direccion2,
  localidad,
  provincia,
  pais,
  cpostal,
  telefono1,
  telefono2,
  email,
  web,
  logo-->

@stop