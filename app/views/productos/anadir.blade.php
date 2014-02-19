@extends('layouts.main') <!--para usar la estructura indicada en layouts/main.blade.php-->
@section('titulo')<!--Titulo que queremos que aparezca en nuestra página-->
   <title>Añadir Productos</title>
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
         <li class="span3 active">{{ HTML::link('productos/anadir', 'Añadir Nuevo Producto') }}</li>
      </ul>
   </div>
@stop
<!--Contenido-->
@section('content')
	<!--Formulario-->
   {{ Form::open(array('url'=>'productos/anadir', 'files'=>true ,'class'=>'form')) }}
   <h2 class="form-signup-heading">Añadir Productos</h2>
      <div>
      	{{ Form::label('nombre', 'Nombre:') }}
      	{{ Form::text('nombre', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre')) }}
      	<span class="help-block">{{ $errors->first('nombre') }}</span>

      	{{ Form::label('cantidad', 'Cantidad:') }}
      	{{ Form::text('cantidad', null, array('class'=>'input-block-level', 'placeholder'=>'Cantidad de productos')) }}
      	<span class="help-block">{{ $errors->first('cantidad') }}</span>

		{{ Form::label('descripcion', 'Descripción:') }}
      	{{ Form::textarea('descripcion', null, array('class'=>'input-block-level', 'placeholder'=>'Introduzca una breve descripcion del producto')) }}
      	<span class="help-block">{{ $errors->first('descripcion') }}</span>

      	{{ Form::label('imagen', 'Imagen:') }}
      	{{ Form::file('imagen') }}
      	<span class="help-block">{{ $errors->first('imagen') }}</span>

        {{ Form::submit('Añadir', array('class'=>'btn btn-large btn-primary btn-block'))}}
      	{{ Form::close() }}


     </div>
@stop