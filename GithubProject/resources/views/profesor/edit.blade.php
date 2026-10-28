@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('profesor.update', $profesor) }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" value="{{ old('nombre', $profesor->nombre) }}" id="nombre" name="nombre" required minlength="2" maxlength="100">
                    @error('nombre')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" value="{{ old('apellido', $profesor->apellido) }}" id="apellido" name="apellido" required minlength="3" maxlength="130">
                    @error('apellido')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="fecha_alta" class="form-label">Fecha de alta</label>
                    <input type="date" class="form-control" value="{{ old('fecha_alta', $profesor->fecha_alta?->toDateString()) }}" id="fecha_alta" name="fecha_alta" required>
                    @error('fecha_alta')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="especialidad" class="form-label">Especialidad</label>
                    <input type="text" class="form-control" value="{{ old('especialidad', $profesor->especialidad) }}" id="especialidad" name="especialidad" required maxlength="150">
                    @error('especialidad')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="salario" class="form-label">Salario</label>
                    <input type="number" class="form-control" value="{{ old('salario', $profesor->salario) }}" id="salario" name="salario" required min="0" step="0.01">
                    @error('salario')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <button type="submit" class="btn btn-secondary">Editar profesor</button>
            </form>
        </div>
    </div>
</div>
@endsection