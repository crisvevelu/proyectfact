@extends('layouts.main')

@section('titulo')
   <title>Usuarios</title>
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
      <div class="span3"><h4><p>Opciones Administración</p></h4></div>
      <ul class="nav">
        @if(Session::get('user_type') == 2)
            <li class="span3">{{ HTML::link('admin', 'Administración') }}</li>
        @endif
        <li class="span3">{{ HTML::link('/admin/clientes', 'Clientes') }}</li>
         <li class="span3">{{ HTML::link('/admin/usuarios', 'Usuarios') }}</li>
         <li class="span3">{{ HTML::link('/admin/productos', 'Productos') }}</li>
      </ul>

      <div class="span3"><h4><p>Opciones Usuarios</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('admin/usuarios', 'Listar Usuarios') }}</li>
         <li class="span3">{{ HTML::link('admin/usuarios/register', 'Añadir Usuario') }}</li>
      </ul>
   </div>
@stop
@section('content')
  @if(empty($usuarios)) 
    <p>No hay usuarios disponibles</p>
  @else 
     <h1>Listar Usuarios</h1>
   
    <table class="table table-striped">
      <tr>
          <th>Nombre</th>
          <th>Email</th>
          <th>Tipo Usuario</th>
          <th>Acciones</th>
      </tr>
      @foreach ($usuarios as $usuario)
          <tr>
            <td>{{ $usuario->username }}</td>
            <td>{{ $usuario->email }}</td>
            @if( $usuario->tipo_user == 1) 
              <td>Gestión</td>
            @else
              <td>Administración</td>
            @endif
            <td>{{ HTML::link('admin/usuarios/modificar/'.$usuario->id, 'Modificar', array('class' => 'btn btn-primary')) }} 
                {{ HTML::link('admin/usuarios/delete/'.$usuario->id, 'Eliminar', array('class' => 'btn btn-primary')) }}</td>
          </tr>
      @endforeach
    </table>
  @endif
@stop