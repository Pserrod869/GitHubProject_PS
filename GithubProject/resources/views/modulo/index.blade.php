@extends('template.base')

@section('before-content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <a class="btn btn-secondary" href="{{ route('modulo.create') }}">Crear módulo</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Abreviatura</th>
                        <th>Horas</th>
                        <th>Créditos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($modulos as $modulo)
                        <tr>
                            <td>{{ $modulo->id }}</td>
                            <td>{{ $modulo->nombre }}</td>
                            <td>{{ $modulo->abreviatura }}</td>
                            <td>{{ $modulo->horas ?? '—' }}</td>
                            <td>{{ $modulo->creditos !== null ? number_format((float) $modulo->creditos, 2, ',', '.') : '—' }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('modulo.show', $modulo) }}" class="btn btn-secondary">Ver</a>
                                <a href="{{ route('modulo.edit', $modulo) }}" class="btn btn-secondary">Editar</a>
                                <form class="confirm-dialog" data-message="{{ $modulo->nombre }}" action="{{ route('modulo.destroy', $modulo) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-secondary">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6">No hay módulos registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('form.confirm-dialog').forEach(
        form => {
            form.addEventListener('submit', e => {
                const message = '¿Seguro que quieres borrar el módulo '+ form.dataset.message +'?' ;
                if(!confirm(message)){
                    e.preventDefault();
                }
            });
        }
    );
    </script>
@endsection