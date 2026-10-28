@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('modulo.update', $modulo) }}" method="post">
                @csrf
                @method('put')
                @include('modulo.form', ['buttonText' => 'Guardar cambios'])
            </form>
        </div>
    </div>
</div>
@endsection
