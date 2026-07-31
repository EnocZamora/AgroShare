@extends('layouts.app')

@section('title', __('home.meta_title'))

@section('content')
<!-- Hero Section con degradado usando verde bosque y verde hoja -->
<section class="py-5" style="background: linear-gradient(135deg, rgba(20, 104, 52, 0.08) 0%, rgba(110, 175, 59, 0.15) 100%);">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge px-3 py-2 rounded-pill fw-semibold mb-3 font-poppins" style="background-color: var(--verde-hoja); color: var(--blanco);">
                    <i class="bi bi-patch-check-fill me-1"></i> {{ __('home.badge_direct') }}
                </span>
                <h1 class="display-5 fw-bold font-poppins text-dark mb-3">
                    {!! __('home.hero_title') !!}
                </h1>
                <p class="lead text-secondary mb-4">
                    {{ __('home.hero_subtitle') }}
                </p>
                
                <form action="{{ route('home') }}" method="GET" class="card border-0 shadow-sm p-2 rounded-4 bg-white">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 ps-3" style="color: var(--verde-hoja);">
                            <i class="bi bi-search fs-5"></i>
                        </span>
                        <input type="text" name="search" class="form-control border-0 shadow-none py-2" placeholder="{{ __('home.search_placeholder') }}" value="{{ request('search') }}">
                        <button class="btn btn-agro-primary px-4 rounded-3" type="submit">{{ __('home.search_btn') }}</button>
                    </div>
                </form>
            </div>
            
            <!-- Bloque lateral usando el tono --beige-tierra para dar contraste -->
            <div class="col-lg-6 text-center">
                <div class="p-4 rounded-4 shadow-sm card-tierra position-relative">
                    <div class="row g-3 text-start">
                        <div class="col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm">
                                <i class="bi bi-shop fs-3 mb-2 d-block" style="color: var(--verde-bosque);"></i>
                                <h6 class="fw-bold mb-1 font-poppins">{{ __('home.producers_card_title') }}</h6>
                                <small class="text-secondary">{{ __('home.producers_card_sub') }}</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-white rounded-3 shadow-sm">
                                <i class="bi bi-shield-check fs-3 mb-2 d-block" style="color: var(--verde-hoja);"></i>
                                <h6 class="fw-bold mb-1 font-poppins">{{ __('home.security_card_title') }}</h6>
                                <small class="text-secondary">{{ __('home.security_card_sub') }}</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 rounded-3 d-flex align-items-center justify-content-between" style="background-color: rgba(20, 104, 52, 0.08);">
                                <div>
                                    <h6 class="fw-bold mb-1 font-poppins" style="color: var(--verde-bosque);">{{ __('home.zone_card_title') }}</h6>
                                    <small class="text-secondary">{{ __('home.zone_card_sub') }}</small>
                                </div>
                                <i class="bi bi-geo-alt-fill fs-2" style="color: var(--verde-hoja);"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection