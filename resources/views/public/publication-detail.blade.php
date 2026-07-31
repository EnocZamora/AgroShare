@extends('layouts.app')

@section('title', $publication->titulo . ' | AgroShare')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-semibold font-poppins mb-3 w-auto">
                    {{ $publication->producto->nombre ?? 'Agrícola' }}
                </span>
                <h1 class="h3 fw-bold font-poppins mb-2">{{ $publication->titulo }}</h1>
                <h2 class="h4 text-success fw-bold font-poppins mb-4">C$ {{ number_format($publication->precio_unitario, 2) }} <span class="fs-6 text-muted fw-normal">/ unidad</span></h2>
                <p class="text-secondary mb-4" style="line-height: 1.7;">{{ $publication->descripcion }}</p>
                <div class="p-3 bg-light rounded-3 d-flex justify-content-between font-poppins">
                    <div><span class="text-muted small d-block">Disponible</span><strong>{{ $publication->cantidad_disponible }} un.</strong></div>
                    <div><span class="text-muted small d-block">Ubicación</span><strong>{{ $publication->ubicacion_finca }}</strong></div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 90px;">
                <h3 class="h5 fw-bold font-poppins mb-3">Iniciar Negociación</h3>
                <form action="{{ route('contacts.store', $publication->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label font-poppins small fw-semibold">Cantidad Requerida</label>
                        <input type="number" step="0.01" class="form-control rounded-3" name="cantidad_interesada" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-poppins small fw-semibold">Mensaje o Propuesta</label>
                        <textarea class="form-control rounded-3" name="mensaje_inicial" rows="4" required placeholder="Hola, me interesa tu producto..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-agro-accent w-100 py-2 font-poppins fw-semibold">Enviar Propuesta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection