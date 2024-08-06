
{{-- <form action="{{ url ('/empleado')}}" method="post" enctype="multipart/form-data">
    @csrf

@include('empleado.form',['modo'=>'Nuevo'])


</form>

<button type="submit" onClick="window.history.go(-1)">Cancelar</button> --}}
@extends('layouts.app')
@section('content')
    <div class="container">

        <form action="{{ url('/empleado') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('empleado.form', ['modo' => 'Nuevo'])

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="#" onclick="window.history.go(-1); return false;" class="btn btn-secondary">Cancelar</a>
        </form>

    </div>
@endsection
