@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            @error('claveunica')
            <div class="alert alert-danger" role="alert">
                {{$message}}
            </div>
            @enderror
            <form action="{{ route('alumno.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="" id="nombre" name="nombre" required maxlength="100" placeholder="Introduce el nombre del alumno">
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" value="" id="apellido" name="apellido" required maxlength="130" placeholder="Introduce los apellidos del alumno">
                </div>
                <div class="mb-3">
                    <label for="fnac" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" value="" id="fnac" name="fnac">
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Género</label>
                    <select class="form-select" id="genero" name="genero">
                        <option value="">Selecciona una opción</option>
                        <option value="hombre">Masculino</option>
                        <option value="femenino">Femenino</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="notaacceso" class="form-label">Nota de acceso</label>
                    <input type="number" value="" class="form-control" id="notaacceso" name="notaacceso" min="0" max="10" step="0.01" placeholder="Introduce la nota de acceso">
                </div>
                <button type="submit" class="btn btn-secondary">
                    Crear alumno
                </button>
            </form>
        </div>
    </div>
</div>
@endsection