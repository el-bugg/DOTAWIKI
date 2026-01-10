<x-layout>
    <x-slot:title>Artifacts Archive - Frozen Wiki</x-slot>
   <script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

    <div class="container py-5 text-center">
        <h1 class="display-1 mb-3 frozen-text text-uppercase" data-text="ARTIFACTS ARCHIVE">ARTIFACTS ARCHIVE</h1>
        <p class="text-ice mb-5 fs-5">Ancient relics and mystical equipment to enhance your champion.</p>

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="input-group input-group-lg shadow" style="border: 1px solid #444; border-radius: 5px;">
                    <span class="input-group-text bg-dark border-0 text-secondary">🔍</span>
                    <input type="text" id="itemSearch" class="form-control bg-dark text-white border-0"
                        placeholder="Search for an item... (e.g. Blink Dagger)">
                </div>
            </div>
        </div>

        <div id="itemGrid">
            @foreach($itemsByCategory as $category => $items)
                <div class="category-section mb-5">
                    <div class="d-flex align-items-center mb-4">
                        <h3 class="text-ice font-cinzel mb-0 text-uppercase tracking-widest">{{ $category }}</h3>
                        <div class="ms-3 flex-grow-1" style="height: 1px; background: linear-gradient(to right, var(--ice-blue), transparent);"></div>
                    </div>

                    <div class="row g-2 justify-content-start">
                     @foreach($items as $item)
    <div class="col-auto item-card-wrapper" data-name="{{ strtolower($item->dname) }}">
        <div class="item-canvas border border-secondary bg-dark position-relative" 
             style="width: 60px; height: 45px; cursor: pointer;"
             onclick="window.location='{{ route('items.show', $item->id) }}'"
             data-tippy-html="#tooltip-{{ $item->id }}">
            
            <img src="{{ $item->img_url }}" class="img-fluid w-100 h-100 object-fit-cover shadow">
            <div class="holo-sheen"></div>
        </div>

        <div id="tooltip-{{ $item->id }}" style="display: none;">
            <div class="p-3 bg-[#1c242d] text-white border border-[#444]" style="min-width: 300px; box-shadow: 0 10px 30px rgba(0,0,0,0.8);">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div class="d-flex gap-2">
                        <img src="{{ $item->img_url }}" width="45" class="border border-secondary">
                        <div>
                            <h5 class="m-0 fw-bold text-white">{{ $item->dname }}</h5>
                            <span class="text-secondary small uppercase tracking-widest">Basic Item</span>
                        </div>
                    </div>
                    <div class="text-end">
                        <div class="small text-white-50">Total Cost:</div>
                        <div class="fw-bold text-warning">{{ number_format($item->cost) }} <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/gold.png" width="14"></div>
                    </div>
                </div>

                <div class="py-2 border-top border-secondary my-2">
                    <div class="text-[#f59e0b] fw-bold small">+{{ $item->base_str ?? 0 }} Strength</div>
                    <div class="text-[#10b981] fw-bold small">+{{ $item->base_agi ?? 0 }} Agility</div>
                    <div class="text-[#0ea5e9] fw-bold small">+{{ $item->base_int ?? 0 }} Intelligence</div>
                </div>

                <div class="bg-black bg-opacity-30 p-2 rounded">
                    <div class="fw-bold text-white uppercase mb-1" style="font-size: 10px; letter-spacing: 1px;">Passive Effect</div>
                    <div class="small text-slate-300 italic">{!! $item->desc !!}</div>
                </div>

                @if($item->components)
                <div class="mt-3 pt-2 border-top border-secondary text-center">
                    <div class="text-white-50 x-small mb-2">UPGRADES FROM</div>
                    <div class="d-flex justify-content-center gap-2">
                        @foreach($item->components as $comp)
                        <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/items/{{ $comp }}.png" width="30" class="border border-secondary">
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="text-center mt-3 text-info x-small tracking-widest uppercase" style="font-size: 9px; opacity: 0.6;">
                    » Click for detailed guide
                </div>
            </div>
        </div>
    </div>
@endforeach
                    </div>
                </div>
            @endforeach
        </div>

        <div id="noItemResults" class="text-center mt-5 d-none">
            <h3 class="text-muted">No items found matching your search.</h3>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const itemSearch = document.getElementById('itemSearch');
                const itemWrappers = document.querySelectorAll('.item-card-wrapper');
                const noResults = document.getElementById('noItemResults');
                const categories = document.querySelectorAll('.category-section');

                itemSearch.addEventListener('input', function(e) {
                    const term = e.target.value.toLowerCase();
                    let totalVisible = 0;

                    categories.forEach(section => {
                        let sectionHasVisible = 0;
                        const items = section.querySelectorAll('.item-card-wrapper');
                        
                        items.forEach(item => {
                            const name = item.getAttribute('data-name');
                            if (name.includes(term)) {
                                item.style.display = 'block';
                                sectionHasVisible++;
                                totalVisible++;
                            } else {
                                item.style.display = 'none';
                            }
                        });

                        // Sembunyikan judul kategori jika tidak ada item yang cocok
                        section.style.display = sectionHasVisible > 0 ? 'block' : 'none';
                    });

                    noResults.classList.toggle('d-none', totalVisible > 0);
                });
            });
        </script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tippy('.item-canvas', {
            content(reference) {
                const id = reference.getAttribute('data-tippy-html');
                const template = document.querySelector(id);
                return template.innerHTML;
            },
            allowHTML: true,
            theme: 'custom-dota',
            placement: 'right',
            arrow: false,
            offset: [0, 20],
            maxWidth: 'none',
            animation: 'fade',
        });
    });
</script>
    </x-slot:scripts>
</x-layout>