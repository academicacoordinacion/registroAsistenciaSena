@extends('layout.master-layout')
@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/dual-listbox/css/bootstrap-duallistbox.min.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Asistencia</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('verificarLogin') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Asistencia</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="card">

                <div class="card-body">

                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('entradaSalida.registros')}}" method="get">
                                @csrf
                                <label for="fichaCaracterizacion">Ficha de caracterización</label>
                                <select class="fichaCaracterizacion form-control" name="fichaCaracterizacionId"
                                    id="">
                                    <option value="" disabled selected>Seleccione una ficha</option>
                                    @forelse (Auth::user()->persona->instructor->fichas as $ficha)
                                        <option value="{{ $ficha->id }}">{{ $ficha->ficha }} {{ $ficha->nombre_curso }}
                                        </option>
                                    @empty
                                        <option value="" disabled>No hay ficha de caracterización disponibles</option>
                                    @endforelse
                                </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">

                            <label for="ambienteId">Ambiente</label>
                            <select name="ambienteId" class="ambientes form-control" id="">
                                <option value="" disabled selected>Seleccione un ambiente</option>
                                @forelse (Auth::user()->persona->instructor->regional->sedes as $sede)
                                    @foreach ($sede->bloques as $bloque)
                                        @foreach ($bloque->piso as $pisos)
                                            @forelse($pisos->ambientes as $ambiente)
                                                <option value="{{$ambiente->id}}" >{{ $ambiente->title }} </option>
                                            @empty
                                                <option value="">No hay ambientes disponibles</option>
                                            @endforelse
                                        @endforeach
                                    @endforeach
                                @endforeach
                            </select>
                            <div class="card-body text-center">
                                <input type="submit" value="Tomar Asistencia" class="btn btn-success bnt-sm-3">
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.fichaCaracterizacion').select2();
            $('.ambientes').select2();
        });
    </script>
@endsection
