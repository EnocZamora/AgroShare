@extends('layouts.app')

@section('title', 'Panel de Administración | AgroShare')

@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h1 class="h4 fw-bold font-poppins mb-1">Panel de Control y Auditoría</h1>
        <p class="text-muted small m-0">Supervisión general del sistema, registros de usuarios y métricas.</p>
    </div>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <span class="text-muted small fw-semibold font-poppins">Usuarios</span>
                <h3 class="fw-bold font-poppins text-success mt-1 mb-0">{{ $totalUsers ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <span class="text-muted small fw-semibold font-poppins">Publicaciones</span>
                <h3 class="fw-bold font-poppins text-success mt-1 mb-0">{{ $totalPublications ?? 0 }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <span class="text-muted small fw-semibold font-poppins">Tratos</span>
                <h3 class="fw-bold font-poppins text-success mt-1 mb-0">{{ $totalDeals ?? 0 }}</h3>
            </div>
        </div>
    </div>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        <div class="card-header bg-white py-3 px-4 border-0">
            <h2 class="h5 fw-bold font-poppins m-0">Control de Usuarios</h2>
        </div>
        <div class="table-responsive">
            <table class="table align-middle mb-0 font-poppins">
                <thead class="table-light text-uppercase fs-7 text-muted">
                    <tr>
                        <th class="py-3 ps-4">Nombre</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Rol del Sistema</th>
                        <th class="text-end pe-4">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users ?? [] as $u)
                        <tr>
                            <td class="ps-4 fw-semibold">{{ $u->nombre }}</td>
                            <td>{{ $u->correo }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $u->tipo_usuario }}</span></td>
                            <td><span class="badge bg-success">{{ $u->rol_sistema }}</span></td>
                            <td class="text-end pe-4"><button class="btn btn-sm btn-outline-danger">Remover</button></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-4 text-muted">Sin registros de usuarios.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection