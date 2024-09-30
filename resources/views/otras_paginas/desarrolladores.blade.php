@extends('layout.master-layout')
@section('content')
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Equipo de Desarrollo</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('verificarLogin') }}">Inicio</a></li>
                            <li class="breadcrumb-item active">Equipo de Desarrollo</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <!-- Tarjeta de un desarrollador -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h3 class="card-title"><strong>William Lopez Rebellon</strong></h3>
                                </div>
                                <div class="card-body text-center">
                                    <!-- Imagen del desarrollador -->
                                    <img src="{{ asset('dist/img/WilliamLopezRebellon.jpg') }}" alt="Foto de "
                                        class="img-fluid rounded-circle mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;">

                                    <!-- Descripción -->
                                    <p class="text-muted">Como el primer desarrollador, he sentado las bases tecnológicas de
                                        este
                                        proyecto, comprometido con soluciones innovadoras que aseguren su crecimiento y
                                        evolución.
                                        Aspiro a que se convierta en un referente de calidad y eficiencia en nuestro sector.
                                    </p>

                                    <!-- Deseo futuro -->
                                    <p><strong>Deseo para el proyecto:</strong> Espero que este proyecto crezca y que la
                                        institución
                                        forme un equipo de desarrollo propio, capaz de ejecutar todas las iniciativas
                                        futuras con
                                        eficacia y pasión.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection
