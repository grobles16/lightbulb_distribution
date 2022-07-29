@extends('layout.app')

@section('main_content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="pb-30px center">Test - Distribución de Bombillos</h1>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <div class="center pt-30px">
                        <a class="btn btn-outline-primary btn-lg" href="{{ route('room.index') }}">Cargar Habitación</a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="center pt-30px">
                        <a class="btn btn-outline-primary btn-lg" href="{{ route('lightbulb.index') }}">Mostrar Bombillos</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection