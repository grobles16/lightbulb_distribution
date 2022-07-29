@extends('layout.app')

@section('main_content')
    <section>
        <div class="container">
            <div class="col-lg-12 pb-30px">
                <h1>Cargar Habitación</h1>
            </div>
            @if(session('alert'))
                <div class="alert alert-success">
                    <label>{{ session('alert')}}</label>
                </div>
            @endif
            <form method="POST" action="{{ route('room.store') }}" enctype="multipart/form-data" class="card">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-10">
                        <label for="file" class="label">Archivo Txt:</label>
                        <input type="file" class="form-control mb-10px" name="matriz" accept="text/plain" required>
                        @error('matriz')
                            <span>{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group col-lg-10">
                        <button type="submit" class="btn btn-primary">Cargar Habitación</button>
                    </div>
                </div>
            </form>
            <div class="right">
                <a class="btn btn-outline-primary btn-lg" href="{{ route('home') }}">Regresar</a>
            </div>
        </div>
    </section>
@endsection