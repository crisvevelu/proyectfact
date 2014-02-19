@extends('layouts.main') <!--para usar la estructura  indicada en layouts/main.blade.php-->
@section('titulo')<!--Titulo que queremos que aparezca en nuestra página-->
   <title>Listar Productos</title>
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
      <div class="span3"><h4><p>Opciones Administración</p></h4></div>
      <ul class="nav">
        @if(Session::get('user_type') == 2)
            <li class="span3">{{ HTML::link('admin', 'Administración') }}</li>
        @endif
        <li class="span3">{{ HTML::link('/admin/clientes', 'Clientes') }}</li>
        <li class="span3">{{ HTML::link('/admin/usuarios', 'Usuarios') }}</li> 
        <li class="span3">{{ HTML::link('/admin/productos', 'Productos') }}</li>
      </ul>

      <div class="span3"><h4><p>Opciones Productos</p></h4></div>
      <ul class="nav">
         <li class="span3">{{ HTML::link('admin/productos/listar', 'Listado') }}</li>
      </ul>
   </div>
@stop
<!--Contenido-->
@section('content')
  @if(empty($productos)) 
    <p>No hay productos disponibles</p>
  @else 
    <h1>Listar Productos</h1>
    <table class="table table-striped">
    	<tr>
    		<th>Nombre</th>
    		<th>Cantidad</th>
    		<th>Descripción</th>
    		<th>Imagen</th>
    		<th>Acciones</th>
       	</tr>
       	@foreach ($productos as $producto) 
	       	@if (($producto->cantidad)<=0 )
	       		
	       	@else
		       	<tr>
		       		<td>{{$producto->nombre}}</td>
		       		<td>{{$producto->cantidad}}</td>
		       		<td>{{$producto->descripcion}}</td>
		       		@if ($producto->imagen) 
		       			<td>{{ HTML::link($producto->imagen, 'Imagen') }}</td>
		       		@else
		       			<td>Producto sin imagen</td>
		       		@endif
		       			
  		       		<td>{{ HTML::link('admin/productos/modificar/'. $producto->id, 'Modificar', array('class' => 'btn btn-primary')) }} <br /><br />
                {{HTML::link('admin/productos/eliminar/'.$producto->id, 'Eliminar', array('class'=>'btn btn-danger'))}}</td>
  		       </tr>
		      @endif
       	@endforeach
    </table>
  @endif
@stop