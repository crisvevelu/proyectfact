@extends('layouts.main')
@section('navbar')
   @if(Auth::check())
      <ul class="nav">
         <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
         <li>{{ HTML::link('users/dashboard', 'Administración') }}</li>
      </ul>
   @endif
   <ul class="nav">  
      @if(!Auth::check())
         <li>{{ HTML::link('/login', 'Login') }}</li>   
      @else
         <li>{{ HTML::link('/logout', 'Logout') }}</li>
      @endif
   </ul>
@stop
@section('content')
	{{ Form::open(array('url'=>'/login', 'class'=>'form-signin')) }}
	   <h2 class="form-signin-heading">Inicia Sesión</h2>
	 
	   {{ Form::text('email', null, array('class'=>'input-block-level', 'placeholder'=>' Email')) }}
	   {{ Form::password('password', array('class'=>'input-block-level', 'placeholder'=>'Password')) }}
	 
	   {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
	{{ Form::close() }}
@stop