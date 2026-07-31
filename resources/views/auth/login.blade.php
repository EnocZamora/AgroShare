@extends('layouts.app')

@section('title', 'Iniciar Sesión | AgroShare')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold font-poppins">Bienvenido</h1>
                    <p class="text-muted small">Ingresa a tu cuenta en AgroShare</p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label font-poppins small fw-semibold">Correo Electrónico</label>
                        <input type="email" class="form-control rounded-3" name="correo" required autofocus>
                    </div>
                    <div class="mb-4">
                        <label class="form-label font-poppins small fw-semibold">Contraseña</label>
                        <input type="password" class="form-control rounded-3" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-agro-accent w-100 py-2 font-poppins fw-semibold">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection