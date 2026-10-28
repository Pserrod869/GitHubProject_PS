@extends('template.base')

@section('before-content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
<a class="btn btn-secondary" href="{{ route('alumno.create') }}">Crear Alumno</a>
</div>
</div>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Nota</th>
                        <th>Género</th>
                        <th>Fecha Nac.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->id }}</td>
                            <td>{{ $alumno->nombre }}</td>
                            <td>{{ $alumno->apellido }}</td>
                            <td>{{ $alumno->notaacceso }}</td>
                            <td>{{ $alumno->genero }}</td>
                            <td>{{ \Carbon\Carbon::parse($alumno->fnac)->locale('es')->translatedFormat('d/m/Y') }}</td>

                            <td> <a href="{{route('alumno.show', $alumno->id)}}"class="btn btn-secondary">View</a></td>
                             <td> <a href="{{route('alumno.edit', $alumno->id )}}"class="btn btn-secondary">Edit</a></td>
                              <!--<td> <a href="{{route('index')}}"class="btn btn-secondary">Delete</a></td>-->
                              <td><form class="confirm-dialog" data-message="{{$alumno->apellido .' , ' . $alumno->nombre}}" action="{{route('alumno.destroy', $alumno)}}"method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" class="btn btn-secondary"></input>
                                </form>
</td>
                        </tr>
                    @endforeach
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
                const message = '¿Seguro que quieres borrar al alumno '+ form.dataset.message +'?' ;
                if(!confirm(message)){
                    e.preventDefault();
                }
            });
        }
    );
    </script>
@endsection