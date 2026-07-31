@extends('layouts.app')

@section('title', 'Publicar Cosecha | AgroShare')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <h1 class="h4 fw-bold font-poppins mb-1">Publicar Cosecha</h1>
                <p class="text-muted small mb-4">Registra tu producción para ofertarla en la plataforma.</p>
                <form action="{{ route('publications.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label font-poppins small fw-semibold">Título</label>
                            <input type="text" class="form-control rounded-3" name="titulo" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-poppins small fw-semibold">Producto</label>
                            <select class="form-select rounded-3" name="productos_id" required>
                                @foreach($productos ?? [] as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-poppins small fw-semibold">Ubicación Finca</label>
                            <input type="text" class="form-control rounded-3" name="ubicacion_finca" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-poppins small fw-semibold">Cantidad Disponible</label>
                            <input type="number" step="0.01" class="form-control rounded-3" name="cantidad_disponible" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label font-poppins small fw-semibold">Precio Unitario (C$)</label>
                            <input type="number" step="0.01" class="form-control rounded-3" name="precio_unitario" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label font-poppins small fw-semibold">Descripción</label>
                            <textarea class="form-control rounded-3" name="descripcion" rows="4"></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-agro-accent w-100 py-2 font-poppins fw-semibold">Guardar Publicación</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection