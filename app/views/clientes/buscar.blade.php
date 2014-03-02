@extends('layouts.main')

@section('titulo')
   <title>Clientes</title>
@stop
@section('navbar')
   <ul class="nav">
      <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
      <li>{{ HTML::link('productos/listar', 'Productos') }}</li>
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
      <div class="span3"><h4><p>Opciones clientes</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('clientes/listar', 'Listar Clientes') }}</li>   
         <li class="span3">{{ HTML::link('clientes/anadir', 'Añadir Nuevos Clientes') }}</li>
         <li class="span3">{{ HTML::link('clientes/buscar', 'Buscar') }}</li>
         <li class="span3 active">{{ HTML::link('clientes/clistado', 'Crear Listado') }}</li>
      </ul>
   </div>
@stop
@section('content')
   <h1>Buscar clientes</h1>
   {{ Form::open(array('url'=>'clientes/buscar', 'class'=>'form')) }}
      {{ Form::label('criterio', 'Seleccione el criterio de busqueda por el que desea buscar:') }}
      {{ Form::select('criterio', array('Seleccione una opción','CIF', 'Razon social', 'Localidad', 'Provincia'),'Seleccione una opcion' ,array(0,1,2,3,4)) }}
      {{ Form::text('valor', null, array('class'=>'input-block-level', 'placeholder'=>'Buscar ...')) }}
      {{ Form::submit('Buscar', array('class'=>'btn btn-large btn-primary btn-block'))}}
   {{ Form::close() }}

@stop