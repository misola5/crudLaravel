{{-- <H1>Index</H1>

<a href="{{url ("/empleado/create")}}"><input type="submit" value="Nuevo empleado"></a>

<div
    class="table-responsive"
>
    <table
        class="table table-primary"
    >
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Foto</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">DNI</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($empleados as $empleado)           
            <tr class="">
                <td scope="row">{{$empleado->id}}</td>
                <td><img src="{{asset('storage').'/'.$empleado->Foto}}" alt="" width="48" height="48" ><br></td>
                
                <td>{{$empleado->Nombre}}</td>
                <td scope="row">{{$empleado->Apellido}}</td>
                <td>{{$empleado->DNI}}</td>
                <td>
                    <a href="{{url('/empleado/'.$empleado->id.'/edit')}}"><input type="submit" value="Editar"></a>
                   
                    <form action="{{url('/empleado/'.$empleado->id)}}" method="post">
                    @csrf
                    {{method_field ('DELETE')}}
                    <input type="submit" onclick="return confirm('¿Desea borrar?')" value="Borrar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}

<!-- Añade las clases de Bootstrap -->
<!-- Añade las clases de Bootstrap -->

@extends('layouts.app')
@section('content')

<div class="container">
    
   

    <div class="mg-auto justify-content-center">    
        @if(Session::has('messaje'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{Session::get('messaje')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>

    {{-- @if(Session::has('messaje'))
        <br>
        <p class="alert alert-success alert-dis">{{Session::get('messaje')}}</p>
        <br>    
    @endif --}}
    <a href="{{ url("/empleado/create") }}" class="btn btn-success mb-3"><i class="fas fa-plus-circle"></i>Nuevo Empleado</a>

 
    <div class="table-responsive">
        <table id="miTabla" class="display">
        {{-- <table class="table table-striped table-bordered"> --}}
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">DNI</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)           
                <tr>
                    <td>{{ $empleado->id }}</td>
                    <td><img class="img img-thumbnail img-fluid" src="{{ asset('storage').'/'.$empleado->Foto }}" 
                             alt="{{ $empleado->Nombre }}" width="48" height="48"></td>
                    <td>{{ $empleado->Nombre }}</td>
                    <td>{{ $empleado->Apellido }}</td>
                    <td>{{ $empleado->DNI }}</td>
                    <td>
                        
                        <a href="{{ url('/empleado/'.$empleado->id.'/edit') }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>Editar
                        </a>
                    
                        <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Desea borrar?')"><i class="fas fa-trash-alt"></i> Borrar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $empleados->links() !!}
    </div>


<!-- Mostrar datos del clima si están disponibles -->
@if ($clima)
<h2>Clima en {{ $clima['ciudad'] }}</h2>
<p>Temperatura: {{ $clima['temperatura'] }}°C</p>
<p>Descripción: {{ $clima['descripcion'] }}</p>
<hr>
@else
<p>No se pudo obtener información del clima.</p>
@endif
</div>
@endsection
