@extends('layouts.main') <!--para usar la estructura indicada en layouts/main.blade.php-->
@section('titulo')<!--Titulo que queremos que aparezca en nuestra página-->
   <title>Buscar Productos</title>
@stop
<!--menu de navegación (superior)-->
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
<br /><br />
<!--Menu lateral -->
@section('navlateral')
   <div class="span4">
      <div class="span3"><h4><p>Productos</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('productos/listar', 'Listar Productos') }}</li>   
         <li class="span3">{{ HTML::link('productos/anadir', 'Añadir Nuevo Producto') }}</li>
          <li class="span3 active">{{ HTML::link('productos/buscar', 'Buscar') }}</li>
      </ul>
   </div>
@stop
<!--Contenido-->
@section('content')
   <h1>Buscar productos</h1>
   {{ Form::open(array('url'=>'productos/buscar', 'class'=>'form')) }}
      {{ Form::label('criterio', 'Seleccione el criterio de busqueda por el que desea buscar:') }}
      {{ Form::select('criterio', array('Seleccione una opción','Nombre', 'Cantidad', 'Descripcion'),'Seleccione una opcion' ,array(0,1,2,3)) }}
      {{ Form::text('valor', null, array('class'=>'input-block-level', 'placeholder'=>'Buscar ...')) }}
      {{ Form::submit('Buscar', array('class'=>'btn btn-large btn-primary btn-block'))}}
   {{ Form::close() }}

   
@stop