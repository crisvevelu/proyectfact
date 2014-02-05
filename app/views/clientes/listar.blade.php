@extends('layouts.main')

@section('titulo')
   <title>Clientes</title>
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
      <div class="span3"><h4><p>Prueba de columna lateral</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('clientes/listar', 'Listar Clientes') }}</li>   
         <li class="span3">{{ HTML::link('clientes/anadir', 'Añadir Nuevos Clientes') }}</li>
         <li class="span3 active">{{ HTML::link('clientes/clistado', 'Crear Listado') }}</li>
      </ul>
   </div>
@stop
@section('content')
  @if(empty($clientes)) 
    <p>No hay clientes disponibles</p>
  @else 
     <h1>Listar Clientes</h1>
   
    <table class="table table-striped">
      <tr>
          <th>Cod Cliente</th>
          <th>CIF/NIF</th>
          <th>Razon Social</th>
          <th>Localidad</th>
          <th>Provincia</th>
          <th>Telefono 1</th>
          <th>Email</th>
          <th>Acciones</th>
      </tr>
      @foreach ($clientes as $cliente)
        @if($cliente->estado == 1)
          <tr>
            <td>{{ $cliente->codcliente }}</td>
            <td>{{ $cliente->cif }}</td>
            <td>{{ HTML::link('clientes/home/'.$cliente->codcliente, $cliente->razonsocial) }}</td>
            <td>{{ $cliente->localidad }}</td>
            <td>{{ $cliente->provincia }}</td>
            <td>{{ $cliente->telefono1 }}</td>
            <td>{{ $cliente->email }}</td>
            <td>{{ HTML::link('#', 'Modificar', array('class' => 'btn btn-primary')) }} {{ HTML::link('ocultar/'.$cliente->codcliente, 'Ocultar', array('class' => 'btn btn-primary')) }}</td>
          </tr>
        @endif
      @endforeach
    </table>
  @endif
@stop