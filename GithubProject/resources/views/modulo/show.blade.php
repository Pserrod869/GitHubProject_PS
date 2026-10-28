@extends('template.base')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <h2 class="card-title">{{ $modulo->nombre }}</h2>
                    <dl class="row mt-4">
                        <dt class="col-sm-4">ID</dt>
                        <dd class="col-sm-8">{{ $modulo->id }}</dd>
                        <dt class="col-sm-4">Nombre</dt>
                        <dd class="col-sm-8">{{ $modulo->nombre }}</dd>
                        <dt class="col-sm-4">Abreviatura</dt>
                        <dd class="col-sm-8">{{ $modulo->abreviatura }}</dd>
                        <dt class="col-sm-4">Horas</dt>
                        <dd class="col-sm-8">{{ $modulo->horas ?? '—' }}</dd>
                        <dt class="col-sm-4">Créditos</dt>
                        <dd class="col-sm-8">{{ $modulo->creditos !== null ? number_format((float) $modulo->creditos, 2, ',', '.') : '—' }}</dd>
                    </dl>
                    <a href="{{ route('modulo.index') }}" class="btn btn-secondary">Volver</a>
                    <a href="{{ route('modulo.edit', $modulo) }}" class="btn btn-secondary">Editar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
