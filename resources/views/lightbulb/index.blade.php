@extends('layout.app')

@section('main_content')
    <section>
        <div class="container">
            <div class="col-lg-12 pb-30px">
                <h1>Mostrar Distribución de Bombillos</h1>
                <hr>
            </div>

            <table class="table table-bordered pt-30px">
                <tbody>
                    @for ($a = 0; $a < count($rooms); $a++)
                    <tr>
                        @for ($i = 0; $i < count($rooms[$a]); $i++)
                            @if ($rooms[$a][$i] === "1")
                                <td colspan="1" class="room-backgroud"> {{ $rooms[$a][$i] }} </td>
                            @endif

                            @if ($rooms[$a][$i] === "0-L")
                                <td colspan="1" class="light-backgroud"> {{ $rooms[$a][$i] }} </td>
                            @endif

                            @if ($rooms[$a][$i] === "0")
                                <td colspan="1" class=""> {{ $rooms[$a][$i] }} </td>
                            @endif
                        @endfor
                    </tr>
                    @endfor
                </tbody>
              </table>
            <div class="right">
                <a class="btn btn-outline-primary btn-lg" href="{{ route('home') }}">Regresar</a>
            </div>
        </div>
    </section>
@endsection