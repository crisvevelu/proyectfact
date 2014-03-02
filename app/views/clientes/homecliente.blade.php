@extends('layouts.main')

@section('titulo')
   <title>{{ $clientes->razonsocial }}</title>
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
      </ul>
   </div>
@stop
@section('content')

   <h1>{{ $clientes->razonsocial }}</h1>
   <table>
      <tr>
         <th>Cif:</th>
         <td>{{$clientes->cif}}</td>
      </tr>
      <tr>
         <th>Dirección:</th>
         <td>{{$clientes->direccion1}}</td>
      </tr>

      @if ($clientes->direccion2 != "" && $clientes->direccion2 !=" " && $clientes->direccion2<>null )
      <tr>
         <th>Dirección secundaria:</th>
         <td>{{$clientes->direccion2}}</td>
      </tr>
      @endif
      @if ($clientes->localidad != "" && $clientes->localidad !=" " && $clientes->localidad<>null)
      <tr>
         <th>Localidad:</th>
         <td>{{$clientes->localidad}}</td>
      </tr>
      @endif
      @if ($clientes->cpostal<>null && $clientes->cpostal<>0)
      <tr>
         <th>CP:</th>
         <td>{{$clientes->cpostal}}</td>
      </tr>
      @endif
      @if ($clientes->provincia != "" && $clientes->provincia !=" " && $clientes->provincia<>null && $clientes->provincia<>0)
      <tr>
         <th>Provincia:</th>
         <td>{{$clientes->provincia}}</td>
      </tr>
      @endif
      @if ($clientes->pais != "" && $clientes->pais !=" " && $clientes->pais<>null)
      <tr>
         <th>Pais:</th>
         <td>{{$clientes->pais}}</td>
      </tr>
      @endif
      <tr>
         <th>Telefono:</th>
         <td>{{$clientes->telefono1}}</td>
      </tr>
      @if ($clientes->telefono2 != "" && $clientes->telefono2 !=" " && $clientes->telefono2<>null && $clientes->telefono2<>0)
      <tr>
         <th>Telefono secundario:</th>
         <td>{{$clientes->telefono2}}</td>
      </tr>
      @endif
      <tr>
         <th>Email:</th>
         <td>{{ $clientes->email }}</td>
      </tr>
      @if ($clientes->web != "" && $clientes->web !=" " && $clientes->web<>null )
         <th>Página web:</th>
         <td>{{$clientes->web}}</td>
      </tr>
      @endif
      @if ($clientes->logo != "" || $clientes->logo !=" " && $clientes->logo<>null)
      <tr>
         <th>Logo del cliente:</th>
         <td><img src= "../../{{$clientes->logo}}"></td>
      </tr>
      @endif

   </table>



@stop