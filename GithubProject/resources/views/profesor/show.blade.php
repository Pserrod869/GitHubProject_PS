@extends('template.base')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $profesor->nombre }} {{ $profesor->apellido }}</h2>
                    <dl class="row mt-4">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $profesor->id }}</dd>
                        <dt class="col-sm-4">Nombre</dt>
                        <dd class="col-sm-8">{{ $profesor->nombre }}</dd>
                        <dt class="col-sm-4">Apellidos</dt>
                        <dd class="col-sm-8">{{ $profesor->apellido }}</dd>
                        <dt class="col-sm-4">Fecha de alta</dt>
                        <dd class="col-sm-8">{{ $profesor->fecha_alta?->locale('es')->translatedFormat('d/m/Y') ?? '—' }}</dd>
                        <dt class="col-sm-4">Especialidad</dt>
                        <dd class="col-sm-8">{{ $profesor->especialidad }}</dd>
                        <dt class="col-sm-4">Salario</dt>
                        <dd class="col-sm-8">{{ $profesor->salario !== null ? number_format((float) $profesor->salario, 2, ',', '.') : '—' }}</dd>
                    </dl>
                    <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection