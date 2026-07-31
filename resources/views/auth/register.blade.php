@extends('layouts.app')

@section('title', 'Registro | AgroShare')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold font-poppins">Crear Cuenta</h1>
                    <p class="text-muted small">Regístrate para conectar con el mercado agrícola</p>
                </div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label font-poppins small fw-semibold">Nombre Completo</label>
                        <input type="text" class="form-control rounded-3" name="nombre" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-poppins small fw-semibold">Correo Electrónico</label>
                            <input type="email" class="form-control rounded-3" name="correo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-poppins small fw-semibold">Teléfono</label>
                            <input type="text" class="form-control rounded-3" name="telefono" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-poppins small fw-semibold">Tipo de Usuario</label>
                            <select class="form-select rounded-3" name="tipo_usuario" required>
                                <option value="productor">Productor</option>
                                <option value="comprador">Comprador</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label font-poppins small fw-semibold">Ciudad / Municipio</label>
                            <input type="text" class="form-control rounded-3" name="ubicacion_ciudad" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-poppins small fw-semibold">Contraseña</label>
                        <input type="password" class="form-control rounded-3" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-agro-accent w-100 py-2 font-poppins fw-semibold">Registrarse</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection