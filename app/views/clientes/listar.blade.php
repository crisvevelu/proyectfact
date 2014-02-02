@extends('layouts.main')

@section('titulo')
   <title>Clientes</title>
@stop
@section('navbar')
   <ul class="nav">
      <li>{{ HTML::link('clientes/listar', 'Clientes') }}</li>
      <li>{{ HTML::link('users/dashboard', 'Administración') }}</li>
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
      <div class="span3"><h4><p>Prueba de columna lateral</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('clientes/listar', 'Listar Clientes') }}</li>   
         <li class="span3 active">{{ HTML::link('clientes/anadir', 'Añadir Nuevos Clientes') }}</li>
      </ul>
   </div>
@stop
@section('content')

   <h1>Listar Clientes</h1>
 
   @foreach ($clientes as $cliente)
        {{ $cliente->codcliente }}
        {{ HTML::link('clientes/home/'.$cliente->codcliente, $cliente->razonsocial)  }}
        {{ $cliente->localidad }}
        {{ $cliente->provincia }}
        {{ $cliente->email }}<br />
    @endforeach

@stop