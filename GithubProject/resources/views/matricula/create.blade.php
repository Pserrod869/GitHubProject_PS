@extends('template.base')

@section('title', 'Matrícula')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <h2>Curso: {{ $curso_escolar }}</h2>
            @if (session('success'))
                <div class="alert alert-success" role="alert">{{ session('success') }}</div>
            @endif
            @error('matricula')
                <div class="alert alert-danger" role="alert">{{ $message }}</div>
            @enderror
            <form action="{{ route('matricula.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="alumno_id" class="form-label">Alumno</label>
                    <select name="alumno_id" id="alumno_id" class="form-select" required>
                        <option value="">Selecciona un alumno</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" @selected(old('alumno_id') == $alumno->id)>
                                {{ $alumno->apellido }}, {{ $alumno->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('alumno_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="modulo_id" class="form-label">Módulo</label>
                    <select name="modulo_id" id="modulo_id" class="form-select" required>
                        <option value="">Selecciona un módulo</option>
                        @foreach ($modulos as $modulo)
                            <option value="{{ $modulo->id }}" @selected(old('modulo_id') == $modulo->id)>
                                {{ $modulo->nombre }} ({{ $modulo->abreviatura }})
                            </option>
                        @endforeach
                    </select>
                    @error('modulo_id')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <button class="btn btn-secondary" type="submit">Crear matrícula</button>
            </form>
        </div>
    </div>
</div>
@endsection
