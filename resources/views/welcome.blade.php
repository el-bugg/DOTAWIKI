<x-layout>
    <x-slot:title>Welcome to Frozen Wiki</x-slot>

    <div class="position-relative d-flex align-items-center justify-content-center text-center"
        style="height: 100vh; background: #000;">
        <div class="position-absolute top-0 start-0 w-100 h-100 overflow-hidden">
            <video autoplay muted loop playsinline class="w-100 h-100 object-fit-cover" style="opacity: 0.6;">
                <source
                    src="https://cdn.cloudflare.steamstatic.com/apps/dota2/videos/dota_react/homepage/dota_montage_webm.webm"
                    type="video/webm">
            </video>
            <div class="position-absolute top-0 start-0 w-100 h-100"
                style="background: radial-gradient(circle, rgba(0,0,0,0.2) 0%, #050b14 100%);"></div>
        </div>

        <div class="position-relative z-2 container fade-in-anim">
            <h1 class="display-1 frozen-text mb-4" data-text="FROZEN WIKI">FROZEN WIKI</h1>
            <p class="lead text-light mb-5" style="max-width: 700px; margin: 0 auto; text-shadow: 0 2px 4px black;">
                The ultimate database for the Ancient.
            </p>

            @auth
                <a href="/dashboard" class="btn btn-lg btn-outline-info px-5 py-3 font-cinzel fw-bold box-neon">
                    GO TO DASHBOARD
                </a>
            @else
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('login') }}" class="btn btn-lg btn-info px-5 py-3 font-cinzel fw-bold shadow-lg">
                        LOGIN
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light px-5 py-3 font-cinzel fw-bold">
                        REGISTER
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <div class="container py-5">
        <div class="row g-5">

            <div class="col-lg-4">
                <h4 class="frozen-text mb-4" data-text="LATEST NEWS">LATEST NEWS</h4>
                <div class="d-flex flex-column gap-3">
                    <div class="card bg-dark border-secondary p-3">
                        <span class="badge bg-info w-25 mb-2">UPDATE 7.37</span>
                        <h6 class="text-white">Crownfall Act IV Released</h6>
                        <p class="text-secondary small mb-0">New arcana, balance changes, and map adjustments have
                            arrived.</p>
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

                    @foreach ($topWinrate as $h)
                        <div class="row align-items-center mb-3 hero-meta-row p-2 rounded">
                            <div class="col-4 d-flex align-items-center">
                                <img src="{{ $h->icon_url }}" width="32" class="me-2 rounded">
                                <span class="text-white fw-bold small">{{ $h->name_localized }}</span>
                            </div>

                            <div class="col-4">
                                <div class="d-flex align-items-center">
                                    <span class="text-white small me-2" style="width: 40px;">{{ $h->pro_pick }}</span>
                                    <div class="progress flex-grow-1" style="height: 6px; background: #222;">
                                        <div class="progress-bar bg-secondary"
                                            style="width: {{ min($h->pro_pick / 20, 100) }}%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                @php $wr = $h->pro_pick > 0 ? ($h->pro_win / $h->pro_pick)*100 : 0; @endphp
                                <div class="d-flex align-items-center">
                                    <span class="{{ $wr >= 50 ? 'text-success' : 'text-danger' }} small me-2"
                                        style="width: 40px;">{{ number_format($wr, 1) }}%</span>
                                    <div class="progress flex-grow-1" style="height: 6px; background: #222;">
                                        <div class="progress-bar {{ $wr >= 50 ? 'bg-success' : 'bg-danger' }}"
                                            style="width: {{ $wr }}%"></div>
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
        .hero-meta-row:hover {
            background: rgba(255, 255, 255, 0.05);
        }
    </style>

    <div class="container-fluid py-5" style="background: #050b14; border-top: 1px solid var(--ice-border);">
        <div class="container">
            <h2 class="text-center frozen-text mb-4" data-text="TACTICAL MAP">TACTICAL MAP</h2>

            <div class="row justify-content-center">
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="bg-dark p-3 rounded border border-secondary h-100">
                        <input type="text" id="mapSearch"
                            class="form-control bg-black text-white border-secondary mb-3 form-control-sm"
                            placeholder="Search hero...">

                        <div class="d-flex flex-wrap gap-2 justify-content-center overflow-auto"
                            style="max-height: 450px;" id="heroPool">
                            @foreach (\App\Models\Hero::orderBy('name_localized')->get() as $hero)
                                <img src="{{ $hero->icon_url }}"
                                    class="draggable-hero rounded-circle border border-secondary" width="40"
                                    height="40" draggable="true" title="{{ $hero->name_localized }}"
                                    data-name="{{ strtolower($hero->name_localized) }}" style="cursor: grab;">
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-7 order-1 order-lg-2 mb-4 mb-lg-0 position-relative d-flex justify-content-center">
                    <div id="map-container" class="position-relative shadow-lg border border-info"
                        style="width: 100%; aspect-ratio: 1/1; max-width: 600px; background: black;">
                        <img src="https://liquipedia.net/commons/images/thumb/9/90/Minimap_7.33c.png/600px-Minimap_7.33c.png"
                            class="w-100 h-100 object-fit-cover" style="pointer-events: none;">
                        <div class="position-absolute top-0 start-0 w-100 h-100" id="drop-zone"></div>
                    </div>
                </div>

                <div class="col-lg-2 order-3">
                    <div class="text-white-50 small p-3">
                        <h6 class="text-ice font-cinzel">INSTRUCTIONS:</h6>
                        <ul class="ps-3">
                            <li>Search & Drag hero icons.</li>
                            <li>Plan ward spots.</li>
                            <li>(Refresh to reset)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            // JS SEARCH MAP
            document.getElementById('mapSearch').addEventListener('input', (e) => {
                const term = e.target.value.toLowerCase();
                document.querySelectorAll('.draggable-hero').forEach(img => {
                    img.style.display = img.dataset.name.includes(term) ? 'block' : 'none';
                });
            });
            const draggables = document.querySelectorAll('.draggable-hero');
            const dropZone = document.getElementById('drop-zone');
            let draggedItem = null;

            // 1. Saat mulai drag
            draggables.forEach(hero => {
                hero.addEventListener('dragstart', function() {
                    draggedItem = this;
                    setTimeout(() => this.style.opacity = '0.5', 0);
                });
                hero.addEventListener('dragend', function() {
                    setTimeout(() => this.style.opacity = '1', 0);
                    draggedItem = null;
                });
            });

            // 2. Saat berada di atas drop zone
            dropZone.addEventListener('dragover', function(e) {
                e.preventDefault(); // Wajib agar bisa di-drop
            });

            // 3. Saat di-drop
            dropZone.addEventListener('drop', function(e) {
                e.preventDefault();
                if (draggedItem) {
                    // Clone gambar agar list asli tidak hilang
                    const clone = draggedItem.cloneNode(true);

                    // Hitung posisi relative terhadap kotak map
                    const rect = dropZone.getBoundingClientRect();
                    const x = e.clientX - rect.left - 20; // -20 biar pas tengah cursor
                    const y = e.clientY - rect.top - 20;

                    // Style clone agar nempel di map
                    clone.style.position = 'absolute';
                    clone.style.left = x + 'px';
                    clone.style.top = y + 'px';
                    clone.style.cursor = 'move';
                    clone.draggable = false; // Matikan drag bawaan, aktifkan drag custom nanti jika mau

                    // Tambahkan efek klik untuk hapus
                    clone.addEventListener('click', function() {
                        this.remove();
                    });

                    dropZone.appendChild(clone);
                }
            });
        </script>
    </x-slot>
</x-layout>
