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
         <li class="span3 active">{{ HTML::link('clientes/clistado', 'Crear Listado') }}</li>
      </ul>
   </div>
@stop
@section('content')
  <h1>{{$cliente->razonsocial}}</h1>

  {{ Form::open(array('url'=>'/clientes/modificar/'.$cliente->codcliente, 'files'=>true ,'class'=>'form')) }}
    <div class="span5 row">
      CIF / NIF: {{ Form::text('cif', $cliente->cif, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('cif') }}</span>
      Razon Social: {{ Form::text('razonsocial', $cliente->razonsocial, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('razonsocial') }}</span>
      Direccion 1: {{ Form::text('direccion1', $cliente->direccion1, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('direccion1') }}</span>
      Direccion 2: {{ Form::text('direccion2', $cliente->direccion2, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('direccion2') }}</span>
      Localidad: {{ Form::text('localidad', $cliente->localidad, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('localidad') }}</span>
      Provincia: {{ Form::text('provincia', $cliente->provincia, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('provincia') }}</span>
      Pais: {{ Form::text('pais', $cliente->pais, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('pais') }}</span>
    </div>
    <div class="span5 row">
      Codigo Postal: {{ Form::text('cod_postal', $cliente->cpostal, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('cod_postal') }}</span>
      Telefono 1: {{ Form::text('telefono1', $cliente->telefono1, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('telefono1') }}</span>
      Telefono 2: {{ Form::text('telefono2', $cliente->telefono2, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('telefono2') }}</span>
      Email: {{ Form::text('email', $cliente->email, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('email') }}</span>
      Pagina Web: {{ Form::text('p_web', $cliente->web, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('p_web') }}</span>
      Logo: {{ Form::text('logo', $cliente->logo, array('class'=>'input-block-level')) }}
      <span class="help-block">{{ $errors->first('logo') }}</span>
      {{ Form::submit('Actualizar cliente') }}
    </div>
    
  {{ Form::close()}}
@stop