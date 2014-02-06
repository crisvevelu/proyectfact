@extends('layouts.main')

@section('navbar')
   @if(Auth::check())
      <ul class="nav">
         <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
         <li>{{ HTML::link('users/dashboard', 'Usuario: '. Session::get('username')) }}</li>
      </ul>
   @endif
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
         <li class="span3 active">{{ HTML::link('/admin/register', 'Registro usuarios') }}</li>   
         @if(Session::get('user_type') == 2)
            <li class="span3">{{ HTML::link('admin', 'Administración') }}</li>
         @endif
      </ul>
   </div>
@stop

@section('content')

   {{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
      <h2 class="form-signup-heading">Por Favor Registrate</h2>
    
      <ul>
         @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
         @endforeach
      </ul>
    
      {{ Form::text('username', null, array('class'=>'input-block-level', 'placeholder'=>'Nombre Usuario')) }}
      <span class="help-block">{{ $errors->first('username') }}</span>
      {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>'Correo Electronico')) }}
      <span class="help-block">{{ $errors->first('email') }}</span>
      {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Contraseña')) }}
      <span class="help-block">{{ $errors->first('password') }}</span>
      {{ Form::password('password_confirmation', array('class'=>'input-block-level', 'placeholder'=>'Repite Contraseña')) }}
      <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
      {{ Form::select('tipo_user', array(
         'Tipo de Usuario' => array(
            '1' => 'Gestíon', 
            '2' => 'Administración'
         )), array(1), array('class' => 'form-control')) }}
         <span class="help-block">{{ $errors->first('tipo_user') }}</span>
    
      {{ Form::submit('Registro', array('class'=>'btn btn-large btn-primary btn-block'))}}
   {{ Form::close() }}

@stop