@extends('layouts.app')

@section('title', 'Negociaciones | AgroShare')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h1 class="h4 fw-bold font-poppins mb-1">Mis Negociaciones</h1>
        <p class="text-muted small m-0">Gestión de tratos basados en contactos e intereses de compradores.</p>
    </div>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="table-responsive">
            <table class="table align-middle mb-0 font-poppins">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th class="py-3 ps-4">Publicación</th>
                        <th>Comprador</th>
                        <th>Cantidad</th>
                        <th>Mensaje Inicial</th>
                        <th>Estado</th>
                        <th class="text-end pe-4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contactos ?? [] as $contacto)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $contacto->publicacion->titulo }}</td>
                            <td>{{ $contacto->comprador->nombre }}</td>
                            <td>{{ $contacto->cantidad_interesada }}</td>
                            <td class="text-muted small text-truncate" style="max-width: 200px;">{{ $contacto->mensaje_inicial }}</td>
                            <td><span class="badge bg-warning text-dark">{{ $contacto->estado_trato }}</span></td>
                            <td class="text-end pe-4"><a href="#" class="btn btn-sm btn-outline-success">Gestionar</a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center py-4 text-muted">No hay solicitudes de interés registradas.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection