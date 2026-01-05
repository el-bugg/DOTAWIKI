<x-layout>
    <x-slot:title>Choose Your Hero</x-slot>

    <div class="container py-5 text-center">
        <h1 class="display-1 mb-3 frozen-text text-uppercase" data-text="CHOOSE YOUR HERO">CHOOSE YOUR HERO</h1>
        <p class="text-ice mb-5 fs-5">From magical tacticians to fierce brutes, find your champion.</p>

        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="input-group input-group-lg mb-4 shadow" style="border: 1px solid #444; border-radius: 5px;">
                    <span class="input-group-text bg-dark border-0 text-secondary">🔍</span>
                    <input type="text" id="heroSearch" class="form-control bg-dark text-white border-0"
                        placeholder="Type name to filter heroes... (e.g. Invoker)">
                </div>

                <div class="d-flex justify-content-center py-4">
                    <ul class="neon-menu" id="attrFilters">
                        <li style="--clr:#ffffff;" data-filter="all" class="filter-btn active">
                            <a href="javascript:void(0)">
                                {{-- <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/global/dota_logo.png" class="filter-icon" alt="All" style="opacity: 0.9;"> --}}
                                <span class="text">ALL</span>
                            </a>
                        </li>
                        
                        <li style="--clr:#ec3d06;" data-filter="str" class="filter-btn">
                            <a href="javascript:void(0)">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_strength.png" class="filter-icon" alt="Str">
                                <span class="text">STR</span>
                            </a>
                        </li>
                        <li style="--clr:#26e030;" data-filter="agi" class="filter-btn">
                            <a href="javascript:void(0)">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_agility.png" class="filter-icon" alt="Agi">
                                <span class="text">AGI</span>
                            </a>
                        </li>
                        <li style="--clr:#00d9ff;" data-filter="int" class="filter-btn">
                            <a href="javascript:void(0)">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_intelligence.png" class="filter-icon" alt="Int">
                                <span class="text">INT</span>
                            </a>
                        </li>
                        <li style="--clr:#ffa600;" data-filter="all" class="filter-btn">
                            <a href="javascript:void(0)">
                                <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/icons/hero_universal.png" class="filter-icon" alt="Uni">
                                <span class="text">UNI</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row g-3" id="heroGrid">
            @foreach ($heroes as $hero)
                <x-hero-card :hero="$hero" />
            @endforeach
        </div>

        <div id="noResults" class="text-center mt-5 d-none">
            <h3 class="text-muted">No heroes found matching your criteria.</h3>
        </div>
    </div>

    <x-slot:scripts>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const searchInput = document.getElementById('heroSearch');
                const heroItems = document.querySelectorAll('.hero-item'); 
                const filterBtns = document.querySelectorAll('.filter-btn'); 
                const noResultsMsg = document.getElementById('noResults');

                let currentAttr = 'all';

                searchInput.addEventListener('input', (e) => {
                    filterHeroes(e.target.value.toLowerCase(), currentAttr);
                });

                filterBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        filterBtns.forEach(b => b.classList.remove('active'));
                        btn.classList.add('active');

                        currentAttr = btn.getAttribute('data-filter');
                        filterHeroes(searchInput.value.toLowerCase(), currentAttr);
                    });
                });

                function filterHeroes(searchTerm, attr) {
                    let visibleCount = 0;

                    heroItems.forEach(item => {
                        const name = item.getAttribute('data-name');
                        const itemAttr = item.getAttribute('data-attr');

                        const matchesName = name.includes(searchTerm);
                        const matchesAttr = (attr === 'all' || itemAttr === attr);

                        if (matchesName && matchesAttr) {
                            item.style.display = 'block';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    if (visibleCount === 0) {
                        noResultsMsg.classList.remove('d-none');
                    } else {
                        noResultsMsg.classList.add('d-none');
                    }
                }
            });
        </script>
    </x-slot>
</x-layout>