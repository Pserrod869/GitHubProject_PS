@extends('template.base')

@section('title', 'Profesor')

@section('css')
    <link href="{{ asset('assets/style/show.css') }}" rel="stylesheet" />
@endsection

@section('content')
    <div class="profesor-show-page">
        <div class="profesor-card profesor-card-profile">
            <img src="{{ asset('assets/img/avataaars.svg') }}" class="profesor-avatar" alt="Foto de perfil">
            <h1>{{ $profesor->nombre }} {{ $profesor->apellido }}</h1>
        </div>

        <div class="profesor-card profesor-card-details">
            <p><strong>Especialidad:</strong> {{ $profesor->especialidad }}</p>
            <p><strong>Fecha de alta:</strong> {{ $profesor->fecha_alta?->format('d/m/Y') ?? '—' }}</p>
            <p><strong>Salario:</strong>
                {{ $profesor->salario !== null ? number_format((float) $profesor->salario, 2, ',', '.') . ' €' : '—' }}
            </p>
            <a href="{{ route('profesor.index') }}" class="btn btn-secondary">Volver al listado</a>
        </div>
    </div>
@endsection
