{{-- 
<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" id="" value="{{ isset($empleado->Nombre)?$empleado->Nombre:'' }}">
<br>
<label for="Apellido">Apellido</label>
<input type="text" name="Apellido" id="" value="{{ isset($empleado->Apellido)?$empleado->Apellido:'' }}">
<br>
<label for="DNI">DNI</label>
<input type="number" name="DNI" id="" value="{{ isset($empleado->DNI)?$empleado->DNI:'' }}">
<br>
<label for="Foto">Foto</label>
<input type="file" name="Foto" id="" value="">
@if(isset($empleado->Foto))
<br>
<img src="{{asset('storage').'/'.$empleado->Foto}}" alt="foto" width="48" height="48" ><br>
@endif
<br>
<input type="submit" value="Enviar">
 --}}

{{-- <H1>{{$modo}} empleado</H1>

<label for="Nombre">Nombre</label>
<input type="text" name="Nombre" id="" value="{{ isset($empleado->Nombre)?$empleado->Nombre:'' }}">
<br>
<label for="Apellido">Apellido</label>
<input type="text" name="Apellido" id="" value="{{ isset($empleado->Apellido)?$empleado->Apellido:'' }}">
<br>
<label for="DNI">DNI</label>
<input type="number" name="DNI" id="" value="{{ isset($empleado->DNI)?$empleado->DNI:'' }}">
<br>
<label for="Foto">Foto</label>
<input type="file" name="Foto" id="" value="">
@if(isset($empleado->Foto))
<br>
<img src="{{asset('storage').'/'.$empleado->Foto}}" alt="foto" width="48" height="48" ><br>
@endif
<br> --}}
{{-- <input type="submit" value="Enviar"> --}}

<div class="container">
    <H1>{{ $modo }} empleado</H1>

    @if(count($errors)>0)
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach  ($errors->all() as $error)
                
                <li>{{$error}}</li>
                
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-group">
        <label for="Nombre">Nombre</label>
        <input type="text" class="form-control" name="Nombre" id="Nombre" 
               value="{{ isset($empleado->Nombre) ? $empleado->Nombre : old("Nombre") }}">
    </div>

    <div class="form-group">
        <label for="Apellido">Apellido</label>
        <input type="text" class="form-control" name="Apellido" id="Apellido" 
               value="{{ isset($empleado->Apellido) ? $empleado->Apellido : old("Apellido") }}">
    </div>

    <div class="form-group">
        <label for="DNI">DNI</label>
        <input type="number" class="form-control" name="DNI" id="DNI" 
               value="{{ isset($empleado->DNI) ? $empleado->DNI : old("DNI") }}">
    </div>
    <br>

    <div class="form-group">
        <label for="Foto">Foto</label>
        <input type="file" class="form-control-file" name="Foto" id="Foto">
        
        
        @if(isset($empleado->Foto))
        <br>
        <br>
        <img src="{{ asset('storage').'/'.$empleado->Foto }}" alt="foto" width="48" height="48"><br>
        @endif
        <br>
        <br>
    </div>
</div>

