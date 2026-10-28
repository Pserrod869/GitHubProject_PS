@extends('template.base')

@section('before-content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <a class="btn btn-secondary" href="{{ route('profesor.create') }}">Crear profesor</a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Fecha de alta</th>
                        <th>Especialidad</th>
                        <th>Salario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($profesores as $profesor)
                        <tr>
                            <td>{{ $profesor->id }}</td>
                            <td>{{ $profesor->nombre }}</td>
                            <td>{{ $profesor->apellido }}</td>
                            <td>{{ $profesor->fecha_alta?->locale('es')->translatedFormat('d/m/Y') ?? '—' }}</td>
                            <td>{{ $profesor->especialidad }}</td>
                            <td>{{ $profesor->salario !== null ? number_format((float) $profesor->salario, 2, ',', '.') : '—' }}</td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('profesor.show', $profesor) }}" class="btn btn-secondary">Ver</a>
                                <a href="{{ route('profesor.edit', $profesor) }}" class="btn btn-secondary">Editar</a>
                                <form class="confirm-dialog" data-message="{{ $profesor->apellido }}, {{ $profesor->nombre }}" action="{{ route('profesor.destroy', $profesor) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-secondary">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7">No hay profesores registrados.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.querySelectorAll('form.confirm-dialog').forEach(form => {
        form.addEventListener('submit', event => {
            if (!confirm(`¿Seguro que quieres borrar al profesor ${form.dataset.message}?`)) {
                event.preventDefault();
            }
        });
    });
</script>
@endsection