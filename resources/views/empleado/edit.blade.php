{{-- 
<form action="{{ url ('/empleado/'.$empleado->id)}}" method="post" enctype="multipart/form-data">

    @csrf
    {{method_field ('PATCH')}}
    @include('empleado.form', ['modo'=>'Editar']) 

</form>

<button type="submit" onClick="window.history.go(-1)">Cancelar</button> --}}
@extends('layouts.app')
@section('content')
<div class="container">

    <form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('empleado.form', ['modo' => 'Editar'])

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-secondary">Cancelar</a>
    </form>

</div>
@endsection
