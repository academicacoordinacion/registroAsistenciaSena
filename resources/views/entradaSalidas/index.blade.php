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
                        <h1>Listado Asistencia</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('verificarLogin') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Listado Asistencia</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">

            <div class="card">

                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="card card-body">
                                        <p class="card-text">Fecha: {{ now()->todateString() }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="card card-body">
                                        <p class="card-text">Ambiente: {{ $ambiente->title }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-xs-12">
                                    <div class="card card-body">
                                        <p class="card-text">Ficha: {{ $fichaCaracterizacion->ficha }}</p>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <div class="card card-body">
                                        <p class="card-text">Nombre del curso: {{ $fichaCaracterizacion->nombre_curso }}</p>
                                    </div>
                                </div>
                            </div>
                            {{-- boton de qr --}}
                            <div class="row justify-content-center">
                                <form action="{{ route('entradaSalida.cargarDatos') }}">
                                    @csrf
                                    <select name="evento" id="evento" class="form-control">
                                        <option value="1">Entrada</option>
                                        <option value="0">Salida</option>
                                    </select>
                                    <input type="hidden" name="ambienteId" value="{{ $ambiente->id }}">
                                    <input type="hidden" value="{{ $fichaCaracterizacion->id }}"
                                        name="fichaCaracterizacionId">
                                    <br>
                                    <br>
                                    <button type="submit" class="bnt btn-success btn-sm-2">
                                        <i class="fas fa-qrcode"></i>
                                    </button>
                                </form>
                            </div><br>

                        </div>

                        <div class="card-body">
                            <div class="card-body p-0">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th style="width: 1%">
                                                #
                                            </th>
                                            <th style="width: 20%">
                                                Aprendiz
                                            </th>
                                            <th style="width: 30%">
                                                entrada
                                            </th>
                                            <th style="width: 40%">
                                                salida
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        @forelse ($registros as $registro)
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                    {{-- {{ $registro->id }} --}}
                                                </td>
                                                <td>
                                                    {{ $registro->aprendiz }}
                                                </td>

                                                <td>
                                                    {{ $registro->entrada }}
                                                </td>
                                                <td>
                                                    {{ $registro->salida }}
                                                </td>
                                                <td>
                                                    <form class="formulario-eliminar btn"
                                                        action="{{ route('entradaSalida.destroy', ['entradaSalida' => $registro->id]) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger btn-sm">

                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No hay aprendices registrados</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-body text-center">
                            <form
                                action="{{ route('entradaSalida.listarAsistencia', ['fichaCaracterizacionId' => $fichaCaracterizacion->id, 'ambienteId' => $ambiente->id]) }}"
                                method="get">
                                @csrf
                                <input type="submit" value="Listar Asistencia" class="btn btn-lg-3 btn-primary">
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
