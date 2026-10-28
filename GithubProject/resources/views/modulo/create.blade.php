@extends('template.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <form action="{{ route('modulo.store') }}" method="post">
                @csrf
                @include('modulo.form', ['buttonText' => 'Crear módulo'])
            </form>
        </div>
    </div>
</div>
@endsection
