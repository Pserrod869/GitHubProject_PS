@extends('template.base')

@section('css')
<link href="{{asset('assets/style/show.css')}}" rel="stylesheet"/>
@endsection

@section('content')
<div class="container my-5">
    <div class="row g-4">

        <div class="col-12 col-md-6">
            <div class="card text-center">
                <img src="{{ asset('assets/img/arthurMorgan.jpg/') }}" class="card-img-top" alt="Juan">
                <div class="card-body">
                    <h5 class="card-title">{{$alumno->nombre . ' ' . $alumno->apellido}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container my-5">
    <div class="row g-4">

        <div class="col-12 col-md-6">
            <div class="card text-center">
                <div class="card-body">
                    <h6 class="card-title">{{\Carbon\Carbon::parse($alumno->fnac)->locale('es')->translatedFormat('d/m/Y')}}</h6>
                    <h6 class="card-title">{{$alumno->genero}}</h6>
                    <h6 class="card-title">{{$alumno->notaacceso}}</h6>
                    <a href="{{route('alumno.index')}}"class="btn btn-secondary">BACK</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
