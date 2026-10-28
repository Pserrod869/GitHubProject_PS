@extends('template.base')

@section('content')
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="alumno_id" class="form-label">Alumno</label>
                        <select class="form-select" id="alumno_id" name="alumno_id">
                        </select>
                    </div>
                    @include('matricula.form', ['buttonText' => 'Crear matrícula'])
                </form>
            </div>
        </div>
    </div>
@endsection
