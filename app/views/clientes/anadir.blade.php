@extends('layouts.main')

@section('titulo')
   <title>Añadir Cliente</title>
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
         <li class="span3 active">{{ HTML::link('clientes/anadir', 'Añadir Nuevos Clientes') }}</li>
         <li class="span3">{{ HTML::link('clientes/buscar', 'Buscar') }}</li>
      </ul>
   </div>
@stop
@section('content')
   {{ Form::open(array('url'=>'clientes/anadir', 'files'=>true ,'class'=>'form')) }}
   <h2 class="form-signup-heading">Añadir Clientes</h2>
     <!-- <ul>
         @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>-->
       <div class="span5 row">
      {{ Form::label('cif', '*  CIF/NIF') }}
      {{ Form::text('cif', null, array('class'=>'input-block-level', 'placeholder'=>'CIF / NIF')) }}
      <span class="help-block">{{ $errors->first('cif') }}</span>

      {{ Form::label('razonsocial', '* Razon Social') }}
      {{ Form::text('razonsocial', null, array('class'=>'input-block-level', 'placeholder'=>'Razon Social')) }}
      <span class="help-block">{{ $errors->first('razonsocial') }}</span>

      {{ Form::label('direccion1', '* Dirección 1') }}
      {{ Form::text('direccion1', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección 1')) }}
      <span class="help-block">{{ $errors->first('direccion1') }}</span>

      {{ Form::label('direccion2', 'Dirección 2') }}
      {{ Form::text('direccion2', null, array('class'=>'input-block-level', 'placeholder'=>'Dirección 2')) }}
      <span class="help-block">{{ $errors->first('direccion2') }}</span>

      {{ Form::label('localidad', 'Localidad') }}
      {{ Form::text('localidad', null, array('class'=>'input-block-level', 'placeholder'=>'Localidad')) }}
      <span class="help-block">{{ $errors->first('localidad') }}</span>

      {{ Form::label('provincia', 'Provincia') }}
      {{ Form::text('provincia', null, array('class'=>'input-block-level', 'placeholder'=>'Provincia')) }}
      <span class="help-block">{{ $errors->first('provincia') }}</span>

      {{ Form::label('pais', 'Pais') }}
      {{ Form::text('pais', null, array('class'=>'input-block-level', 'placeholder'=>'Pais')) }}
      <span class="help-block">{{ $errors->first('pais') }}</span>

      </div>
      <div class="span5 row">

      {{ Form::label('cod_postal', 'Código Postal') }}
      {{ Form::text('cod_postal', null, array('class'=>'input-block-level', 'placeholder'=>'Código Postal')) }}
      <span class="help-block">{{ $errors->first('cod_postal') }}</span>

      {{ Form::label('telefono1', '* Telefono 1') }}
      {{ Form::text('telefono1', null, array('class'=>'input-block-level', 'placeholder'=>'Telefono 1')) }}
      <span class="help-block">{{ $errors->first('telefono1') }}</span>

      {{ Form::label('telefono2', 'Telefono 2') }}
      {{ Form::text('telefono2', null, array('class'=>'input-block-level', 'placeholder'=>'Telefono 2')) }}
      <span class="help-block">{{ $errors->first('telefono2') }}</span>

      {{ Form::label('email', '* E-mail') }}
      {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'E-mail')) }}
      <span class="help-block">{{ $errors->first('email') }}</span>

      {{ Form::label('p_web', 'Pagina Web') }}
      {{ Form::text('p_web', null, array('class'=>'input-block-level', 'placeholder'=>'Pagina Web')) }}
      <span class="help-block">{{ $errors->first('p_web') }}</span>

      {{ Form::label('logo', 'Logo') }}
      {{ Form::file('logo') }}
      <span class="help-block">{{ $errors->first('logo') }}</span>

      

      {{ Form::label('estado_cliente', 'Estado Cliente') }}
      {{ Form::select('estado_cliente', array(
         'Estado Cliente' => array(
            '1' => 'Activo', 
            '2' => 'Inactivo'
         )), array('class' => 'form-control')) }}
         <span class="help-block">{{ $errors->first('estado_cliente') }}</span>
    
      {{ Form::submit('Añadir', array('class'=>'btn btn-large btn-primary btn-block'))}}
      </div>
   {{ Form::close() }}

   <div class="span5 row">
      {{ Form::open(array('url'=>'clientes/anadir/anadirmasiva', 'files' => 'true', 'class'=>'form')) }}
         {{ Form::label('smasiva', 'Subida Masiva') }}
         {{ Form::file('smasiva') }}
         <span class="help-block">{{ $errors->first('smasiva') }}</span>
         {{ Form::submit('Añadir', array('class'=>'btn btn-large btn-primary btn-block'))}}
      {{ Form::close() }}
   </div>

@stop