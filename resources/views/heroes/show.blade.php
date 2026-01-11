<x-layout>
    <x-slot:title>{{ $hero->name_localized }} - Frozen Wiki</x-slot>

    {{-- HERO HEADER SECTION (FIXED LAYOUT) --}}
    <div class="hero-header-wrapper">
        
        {{-- 1. VIDEO BACKGROUND LAYER --}}
        <div class="hero-video-container">
            @if ($hero->video_url)
                <video autoplay muted loop playsinline class="hero-video-element">
                    <source src="{{ $hero->video_url }}" type="video/webm">
                </video>
            @else
                {{-- Fallback Image/Color jika tidak ada video --}}
                <div class="hero-fallback-bg"></div>
            @endif
            
            {{-- Gradient Overlay agar teks terbaca --}}
            <div class="hero-overlay-gradient"></div>
        </div>

        {{-- 2. HEADER CONTENT LAYER --}}
        <div class="hero-content-layer container text-center">
            <h1 class="display-1 fw-bold text-uppercase frozen-text mb-0" data-text="{{ $hero->name_localized }}">
                {{ $hero->name_localized }}
            </h1>
            <p class="text-ice lead fw-bold text-uppercase mt-2 tracking-widest text-shadow-strong">
                {{ $hero->attack_type }} &bull; {{ $hero->primary_attr }}
            </p>
        </div>
    </div>

    {{-- MAIN CONTENT SECTION --}}
    <div class="container position-relative z-3 fade-in-anim content-overlap">
        
        {{-- Hero Stats & Info Card --}}
        <div class="mb-4">
            <x-ice-card>
                <div class="row align-items-stretch">
                    {{-- Portrait & Bars --}}
                    <div class="col-lg-3 text-center border-end border-secondary border-opacity-25 pb-3 pb-lg-0">
                        <img src="{{ $hero->img_url }}" class="img-fluid border border-secondary shadow-lg mb-3 rounded hero-portrait">
                        <div class="stats-bars px-3">
                            <div class="progress rounded-0 bg-dark border border-secondary position-relative mb-1" style="height: 20px;">
                                <div class="progress-bar bg-success" style="width: 100%;"></div>
                                <span class="stats-text">{{ $hero->base_health }} <small>+{{ $hero->base_health_regen }}</small></span>
                            </div>
                            <div class="progress rounded-0 bg-dark border border-secondary position-relative" style="height: 20px;">
                                <div class="progress-bar bg-primary" style="width: 100%;"></div>
                                <span class="stats-text">{{ $hero->base_mana }} <small>+{{ $hero->base_mana_regen }}</small></span>
                            </div>
                        </div>
                    </div>

                    {{-- Attributes --}}
                    <div class="col-lg-4 px-4 border-end border-secondary border-opacity-25 py-3 py-lg-0">
                        <div class="row text-center align-items-center mb-4">
                            <div class="col-4">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_strength.png" width="30" class="mb-2">
                                <div class="fs-3 fw-bold text-white">{{ $hero->base_str }}</div>
                                <small class="text-white-50">+{{ $hero->str_gain }}</small>
                            </div>
                            <div class="col-4 border-start border-end border-secondary border-opacity-25">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_agility.png" width="30" class="mb-2">
                                <div class="fs-3 fw-bold text-white">{{ $hero->base_agi }}</div>
                                <small class="text-white-50">+{{ $hero->agi_gain }}</small>
                            </div>
                            <div class="col-4">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_intelligence.png" width="30" class="mb-2">
                                <div class="fs-3 fw-bold text-white">{{ $hero->base_int }}</div>
                                <small class="text-white-50">+{{ $hero->int_gain }}</small>
                            </div>
                        </div>
                        <div class="row g-2 text-white-50 small text-uppercase fw-bold">
                            <div class="col-6 d-flex justify-content-between px-3"><span>DAMAGE</span> <b class="text-white">{{ $hero->base_damage_min }}-{{ $hero->base_damage_max }}</b></div>
                            <div class="col-6 d-flex justify-content-between px-3"><span>ARMOR</span> <b class="text-white">{{ number_format($hero->base_armor, 1) }}</b></div>
                            <div class="col-6 d-flex justify-content-between px-3"><span>SPEED</span> <b class="text-white">{{ $hero->move_speed }}</b></div>
                            <div class="col-6 d-flex justify-content-between px-3"><span>BAT</span> <b class="text-white">{{ $hero->attack_rate }}</b></div>
                        </div>
                    </div>

                    {{-- Popular Items Placeholder --}}
                    <div class="col-lg-5 ps-lg-4 pt-3 pt-lg-0">
                        <h6 class="text-ice font-cinzel mb-3 small d-flex justify-content-between">
                            POPULAR COMMUNITY BUILDS <span class="badge bg-secondary bg-opacity-50 text-light" style="font-size: 8px;">SOON</span>
                        </h6>
                        <div class="popular-items-placeholder">
                            <div class="text-center p-3">
                                <i class="fas fa-scroll text-secondary mb-2" style="font-size: 1.5rem; opacity: 0.3;"></i>
                                <p class="text-white-50 mb-0" style="font-size: 10px; letter-spacing: 1px;">WAITING FOR GUIDES</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ice-card>
        </div>

        {{-- Role & Strategy --}}
        <div class="row">
            <div class="col-md-4 mb-4">
                <x-ice-card :interactive="true">
                    <h5 class="text-ice font-cinzel small mb-3">HERO ROLES</h5>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach ($hero->roles as $role)
                            <div class="w-100 mb-2">
                                <small class="text-white-50 d-block mb-1" style="font-size: 10px;">{{ strtoupper($role) }}</small>
                                <div class="progress rounded-0" style="height: 4px; background: #111;">
                                    <div class="progress-bar bg-info shadow-glow" style="width: {{ rand(40, 95) }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-ice-card>
            </div>
            <div class="col-md-8 mb-4">
                <x-ice-card :interactive="true">
                    <h4 class="text-warning mb-3 font-cinzel border-bottom border-secondary border-opacity-25 pb-2">STRATEGY & PLAYSTYLE</h4>
                    <div class="playstyle-container position-relative">
                        <div class="playstyle-text text-light text-justify small" id="playstyleContent">
                            {{ $hero->playstyle ?? 'Knowledge regarding this hero\'s current strategy is being gathered by the Ancient archives.' }}
                        </div>
                        <button id="readMoreBtn" class="btn btn-link text-ice p-0 mt-2 fw-bold small d-none" onclick="togglePlaystyle()">READ MORE ▼</button>
                    </div>
                </x-ice-card>
            </div>
        </div>

        {{-- ABILITIES SECTION --}}
        <div class="container-fluid py-5 px-0 fade-in-anim" style="animation-delay: 0.6s;">
            <h3 class="text-center text-ice mb-5 font-cinzel" style="letter-spacing: 5px;">ABILITIES OF THE FROZEN</h3>
            
            @if($hero->abilities->count() > 0)
                <div id="abilityCarousel" class="carousel slide" data-bs-ride="false">
                    <div class="carousel-inner">
                        @foreach ($hero->abilities as $index => $ability)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <div class="row justify-content-center align-items-center" style="min-height: 350px;">
                                    @php
                                        $isPassive = str_contains(strtolower($ability->behavior ?? ''), 'passive');
                                        $hasVideo = !empty($ability->video_url) && !$isPassive;
                                    @endphp

                                    @if ($hasVideo)
                                        <div class="col-lg-6 mb-3 mb-lg-0">
                                            <div class="ratio ratio-16x9 border border-ice shadow-lg rounded overflow-hidden bg-dark shadow-glow">
                                                <video autoplay muted loop playsinline class="object-fit-cover no-interaction">
                                                    <source src="{{ $ability->video_url }}" type="video/mp4">
                                                </video>
                                            </div>
                                        </div>
                                        <div class="col-lg-5"><x-ability-card :ability="$ability" :isActive="true" /></div>
                                    @else
                                        <div class="col-lg-7"><x-ability-card :ability="$ability" :isActive="true" /></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#abilityCarousel" data-bs-slide="prev" style="width: 5%;"><span class="carousel-control-prev-icon bg-dark rounded-circle p-3 border border-ice"></span></button>
                    <button class="carousel-control-next" type="button" data-bs-target="#abilityCarousel" data-bs-slide="next" style="width: 5%;"><span class="carousel-control-next-icon bg-dark rounded-circle p-3 border border-ice"></span></button>
                </div>
            @else
                <div class="text-center text-muted py-5 border border-secondary border-dashed rounded">
                    <p>Ability data is currently frozen.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- NAVIGATION ARROWS --}}
    <div class="hero-navigation d-none d-md-block">
        <a href="{{ route('hero.show', $prevHero->id) }}" class="nav-arrow prev-arrow text-decoration-none">
            <div class="nav-content">
                <span class="font-cinzel text-ice small mb-1">PREVIOUS</span>
                <img src="{{ $prevHero->img_url }}" class="nav-img border border-info shadow">
            </div>
        </a>
        <a href="{{ route('hero.show', $nextHero->id) }}" class="nav-arrow next-arrow text-decoration-none">
            <div class="nav-content">
                <span class="font-cinzel text-ice small mb-1">NEXT</span>
                <img src="{{ $nextHero->img_url }}" class="nav-img border border-info shadow">
            </div>
        </a>
    </div>

    <x-slot:scripts>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const text = document.getElementById('playstyleContent');
                const btn = document.getElementById('readMoreBtn');
                if (text && text.scrollHeight > 100) {
                    text.classList.add('collapsed'); 
                    btn.classList.remove('d-none');
                }
            });
            function togglePlaystyle() {
                const text = document.getElementById('playstyleContent');
                const btn = document.getElementById('readMoreBtn');
                text.classList.toggle('collapsed');
                btn.innerText = text.classList.contains('collapsed') ? 'READ MORE ▼' : 'SHOW LESS ▲';
            }
        </script>
        
        <style>
            /* ====================================
               CRITICAL FIX: HERO HEADER STRUCTURE
               ==================================== */
            
            /* 1. Container Utama Header */
            .hero-header-wrapper {
                position: relative;
                width: 100%;
                height: 600px; /* Tinggi fix agar konsisten */
                overflow: hidden; /* Mencegah video bocor */
                display: flex;
                align-items: center;
                justify-content: center;
                padding-top: 100px; /* Jarak dari navbar */
                background: #000;
                z-index: 1; /* Di bawah navbar tapi di atas body */
            }

            /* 2. Container Video (Absolute Full) */
            .hero-video-container {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 0; /* Paling belakang */
            }

            /* 3. Elemen Video (Object Fit Cover) */
            .hero-video-element {
                width: 100%;
                height: 100%;
                object-fit: cover; /* Wajib cover agar tidak gepeng/bocor */
                object-position: center 20%; /* Fokus ke wajah hero */
                opacity: 0.6; /* Supaya teks terlihat */
                display: block;
            }

            /* 4. Fallback jika video gagal load */
            .hero-fallback-bg {
                width: 100%;
                height: 100%;
                background-color: #050b14;
            }

            /* 5. Gradient Overlay (Di atas video, di bawah teks) */
            .hero-overlay-gradient {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: radial-gradient(circle at center, rgba(0,0,0,0) 0%, rgba(5,11,20,0.8) 100%),
                            linear-gradient(to bottom, transparent 80%, #050b14 100%);
                z-index: 1;
            }

            /* 6. Konten Teks Header (Paling Depan) */
            .hero-content-layer {
                position: relative;
                z-index: 10; /* Di atas overlay */
            }

            /* ====================================
               UTILITY STYLES
               ==================================== */
            .content-overlap {
                margin-top: -80px; /* Overlap ke header */
                padding-bottom: 100px;
            }
            .text-shadow-strong { text-shadow: 0 2px 10px #000; }
            .tracking-widest { letter-spacing: 0.2em; }
            .shadow-glow { box-shadow: 0 0 20px rgba(0, 217, 255, 0.2); }
            
            .hero-portrait {
                max-height: 150px; width: 100%; object-fit: cover;
            }
            .stats-text {
                position: absolute; width: 100%; text-align: center; color: white; 
                font-weight: bold; font-size: 11px; line-height: 20px; left: 0;
            }
            .popular-items-placeholder {
                display: flex; align-items: center; justify-content: center;
                background: rgba(0,0,0,0.5); border: 1px dashed var(--ice-border);
                border-radius: var(--bs-border-radius); min-height: 120px;
            }

            /* ====================================
               MOBILE RESPONSIVE FIX
               ==================================== */
            @media (max-width: 768px) {
                .hero-header-wrapper {
                    height: 50vh; /* Tinggi header di HP */
                    padding-top: 80px;
                }
                .content-overlap {
                    margin-top: -40px;
                }
                h1.frozen-text {
                    font-size: 2.5rem !important;
                }
                .hero-video-element {
                    object-position: center 10%; /* Fokus lebih ke atas di HP */
                }
            }

            /* Paksa padding top body 0 agar tidak konflik */
            body { padding-top: 0 !important; }
        </style>
    </x-slot:scripts>
</x-layout>