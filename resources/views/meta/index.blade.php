<div class="container py-5">
    <div class="row g-5">
        
        <div class="col-lg-4">
            <h4 class="frozen-text mb-4" data-text="LATEST NEWS">LATEST NEWS</h4>
            <div class="d-flex flex-column gap-3">
                <div class="card bg-dark border-secondary p-3">
                    <span class="badge bg-info w-25 mb-2">UPDATE 7.37</span>
                    <h6 class="text-white">Crownfall Act IV Released</h6>
                    <p class="text-secondary small mb-0">New arcana, balance changes, and map adjustments have arrived.</p>
                </div>
                <div class="card bg-dark border-secondary p-3">
                    <span class="badge bg-warning w-25 mb-2">ESPORTS</span>
                    <h6 class="text-white">The International 2026</h6>
                    <p class="text-secondary small mb-0">Qualifiers conclude. See which teams made the cut.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h4 class="frozen-text mb-0" data-text="CURRENT META">CURRENT META</h4>
                <a href="/meta" class="text-ice small text-decoration-none fw-bold">VIEW FULL META &rarr;</a>
            </div>

            <div class="card bg-black border border-secondary p-4">
                <div class="row text-secondary small fw-bold mb-3 text-uppercase">
                    <div class="col-4">Hero</div>
                    <div class="col-4">Pro Pick Rate</div>
                    <div class="col-4">Win Rate</div>
                </div>

                @foreach($topWinrate as $h)
                <div class="row align-items-center mb-3 hero-meta-row p-2 rounded">
                    <div class="col-4 d-flex align-items-center">
                        <img src="{{ $h->icon_url }}" width="32" class="me-2 rounded">
                        <span class="text-white fw-bold small">{{ $h->name_localized }}</span>
                    </div>
                    
                    <div class="col-4">
                        <div class="d-flex align-items-center">
                            <span class="text-white small me-2" style="width: 40px;">{{ $h->pro_pick }}</span>
                            <div class="progress flex-grow-1" style="height: 6px; background: #222;">
                                <div class="progress-bar bg-secondary" style="width: {{ min($h->pro_pick / 20, 100) }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-4">
                        @php $wr = $h->pro_pick > 0 ? ($h->pro_win / $h->pro_pick)*100 : 0; @endphp
                        <div class="d-flex align-items-center">
                            <span class="{{ $wr >= 50 ? 'text-success' : 'text-danger' }} small me-2" style="width: 40px;">{{ number_format($wr, 1) }}%</span>
                            <div class="progress flex-grow-1" style="height: 6px; background: #222;">
                                <div class="progress-bar {{ $wr >= 50 ? 'bg-success' : 'bg-danger' }}" style="width: {{ $wr }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

<style>
    .hero-meta-row:hover { background: rgba(255,255,255,0.05); }
</style>