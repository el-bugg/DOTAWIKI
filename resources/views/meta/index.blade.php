<x-layout>
    <x-slot:title>Frozen Meta - Strategy & Statistics</x-slot>

    <div class="container py-5 mt-5">
        <div class="mb-5 text-center">
            <h1 class="frozen-text display-4" data-text="GAME META">GAME META</h1>
            <p class="text-cyan-400 font-cinzel tracking-widest">Patch 7.37 Analysis & Professional Trends</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-lg-4">
                <div class="glass-panel p-4 h-100">
                    <h5 class="text-cyan-400 font-cinzel mb-3"><i class="fas fa-skull-crossbones me-2"></i>Hero Meta</h5>
                    <p class="text-slate-400 small leading-relaxed">
                        Hero dengan statistik tinggi (Win Rate > 53%) atau skill <strong>Overpowered (OP)</strong>. 
                        Sering menjadi target 1st Pick atau 1st Ban di turnamen Pro.
                    </p>
                    <hr class="border-slate-700">
                    <h6 class="text-white font-cinzel x-small">CURRENT BUFFS:</h6>
                    <ul class="text-success x-small ps-3">
                        <li>Magic Damage Amplification (Global)</li>
                        <li>Zeus & Leshrac Meta (Magic Meta)</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-panel p-4 h-100 border-l-4 border-l-cyan-500">
                    <h5 class="text-cyan-400 font-cinzel mb-3"><i class="fas fa-chess-knight me-2"></i>Strategy Meta</h5>
                    <div class="space-y-3">
                        <div>
                            <span class="badge bg-danger font-cinzel text-[10px]">Fast Push</span>
                            <p class="text-slate-400 x-small mt-1 italic">Strategi menang < 20 menit (Lycan/Broodmother).</p>
                        </div>
                        <div>
                            <span class="badge bg-info font-cinzel text-[10px]">Late Game</span>
                            <p class="text-slate-400 x-small mt-1 italic">Menunggu Hard Carry (Spectre/Medusa) mencapai 6-slot.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-panel p-4 h-100">
                    <h5 class="text-cyan-400 font-cinzel mb-3"><i class="fas fa-shield-alt me-2"></i>Item Meta</h5>
                    <div class="flex items-center gap-3 p-2 bg-slate-900/50 rounded border border-slate-700">
                        <img src="https://cdn.cloudflare.steamstatic.com/apps/dota2/images/dota_react/items/wraith_pact.png" width="40" class="rounded">
                        <div>
                            <div class="text-white x-small font-bold">Wraith Pact (Historical)</div>
                            <div class="text-slate-500 text-[10px]">Efisien untuk teamfight damage reduction.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="glass-panel p-6 mb-5">
            <h4 class="font-cinzel text-white mb-4 flex items-center">
                <i class="fas fa-fire text-orange-500 me-2"></i>OP HEROES (WIN RATE HIGHLIGHT)
            </h4>
            <div class="row g-3">
                @foreach($topWinrate as $h)
                    @php $wr = $h->pro_pick > 0 ? ($h->pro_win / $h->pro_pick) * 100 : 0; @endphp
                    <div class="col-md-2">
                        <a href="{{ route('heroes.show', $h->id) }}" class="text-decoration-none group">
                            <div class="relative overflow-hidden rounded border border-slate-800 bg-slate-900 p-2 text-center group-hover:border-cyan-400 transition-all">
                                <img src="{{ $h->icon_url }}" class="w-full rounded mb-2 grayscale group-hover:grayscale-0 transition-all">
                                <div class="text-white text-xs truncate">{{ $h->name_localized }}</div>
                                <div class="text-success font-bold">{{ number_format($wr, 1) }}%</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="glass-panel overflow-hidden">
            <div class="p-4 border-b border-slate-800 bg-slate-900/50 flex justify-between items-center">
                <h5 class="font-cinzel text-white mb-0">PRO SCENE ANALYTICS</h5>
                <span class="text-slate-500 text-[10px]">Data updated: Today</span>
            </div>
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle">
                  <thead class="bg-slate-900/80">
    <tr class="font-cinzel text-cyan-500 text-[10px] tracking-widest border-b border-slate-800">
        <th class="ps-4 py-4 cursor-pointer hover:text-white" onclick="sortTable('name_localized')">
            HERO <i class="fas fa-sort ms-1"></i>
        </th>
        <th class="cursor-pointer hover:text-white" onclick="sortTable('pro_pick')">
            PICKED <i class="fas fa-sort ms-1"></i>
        </th>
        <th class="cursor-pointer hover:text-white" onclick="sortTable('pro_ban')">
            BANNED <i class="fas fa-sort ms-1"></i>
        </th>
        <th class="cursor-pointer hover:text-white" onclick="sortTable('win_rate')">
            WIN RATE <i class="fas fa-sort ms-1"></i>
        </th>
        <th class="pe-4 text-end">STATUS</th>
    </tr>
</thead>
                    <tbody>
                        @foreach($heroes as $h)
                        @php 
                            $wr = $h->pro_pick > 0 ? ($h->pro_win / $h->pro_pick) * 100 : 0; 
                        @endphp
                        <tr class="border-slate-800">
                            <td class="ps-4 py-3">
                                <a href="{{ route('heroes.show', $h->id) }}" class="flex items-center text-decoration-none">
                                    <img src="{{ $h->icon_url }}" width="40" class="rounded me-3 border border-slate-700">
                                    <span class="text-white font-bold text-sm">{{ $h->name_localized }}</span>
                                </a>
                            </td>
                            <td>
                                <div class="text-white text-xs">{{ number_format($h->pro_pick) }}</div>
                                <div class="progress mt-1" style="height: 3px; width: 60px; background: #1e293b;">
                                    <div class="progress-bar bg-slate-500" style="width: {{ min($h->pro_pick/2, 100) }}%"></div>
                                </div>
                            </td>
                            <td>
                                <div class="text-orange-400 text-xs font-bold">{{ number_format($h->pro_ban) }}</div>
                                <div class="progress mt-1" style="height: 3px; width: 60px; background: #1e293b;">
                                    <div class="progress-bar bg-orange-500/50" style="width: {{ min($h->pro_ban/2, 100) }}%"></div>
                                </div>
                            </td>
                            <td>
                                <span class="{{ $wr >= 50 ? 'text-success' : 'text-danger' }} text-xs font-bold">
                                    {{ number_format($wr, 1) }}%
                                </span>
                            </td>
                            <td class="pe-4 text-end">
    @if($wr > 53)
        <span class="status-badge status-nerf">NERF CANDIDATE</span>
    @elseif($wr < 45 && $h->pro_pick > 0)
        <span class="status-badge status-nerf" style="color:#22c55e; border-color:rgba(34,197,94,0.2); background:rgba(34,197,94,0.1)">BUFF NEEDED</span>
    @else
        <span class="status-badge status-stable">STABLE</span>
    @endif
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
<style>
    /* Status Badge Styling agar mirip screenshot */
    .status-badge {
        font-size: 10px;
        padding: 4px 12px;
        border-radius: 4px;
        font-weight: bold;
        display: inline-block;
        min-width: 100px;
        text-align: center;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-stable {
        background: rgba(100, 116, 139, 0.1);
        color: #64748b;
        border: 1px solid rgba(100, 116, 139, 0.2);
    }

    .status-nerf {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }
</style>

<style>
    .x-small { font-size: 11px; }
    .glass-panel {
        background: rgba(11, 20, 30, 0.7);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(0, 217, 255, 0.1);
        border-radius: 8px;
    }
    .badge { border-radius: 2px; padding: 4px 8px; }
</style>

<script>
// Objek untuk menyimpan status arah urutan setiap kolom
let sortDirections = {
    name_localized: false,
    pro_pick: false,
    pro_ban: false,
    win_rate: false
};

function sortTable(column) {
    const table = document.querySelector('table');
    const tbody = table.querySelector('tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    // Toggle arah urutan untuk kolom yang diklik
    sortDirections[column] = !sortDirections[column];
    const direction = sortDirections[column] ? 1 : -1;

    rows.sort((a, b) => {
        let valA, valB;

        if (column === 'name_localized') {
            valA = a.querySelector('.font-bold').innerText.toLowerCase();
            valB = b.querySelector('.font-bold').innerText.toLowerCase();
        } else if (column === 'win_rate') {
            // Ambil teks win rate, hapus simbol '%'
            valA = parseFloat(a.cells[3].innerText.replace('%', '')) || 0;
            valB = parseFloat(b.cells[3].innerText.replace('%', '')) || 0;
        } else {
            // Indeks kolom: pro_pick = 1, pro_ban = 2
            const index = column === 'pro_pick' ? 1 : 2;
            // Ambil teks angka, hapus koma ribuan
            valA = parseInt(a.cells[index].querySelector('div').innerText.replace(/,/g, '')) || 0;
            valB = parseInt(b.cells[index].querySelector('div').innerText.replace(/,/g, '')) || 0;
        }

        if (valA < valB) return -1 * direction;
        if (valA > valB) return 1 * direction;
        return 0;
    });

    // Masukkan kembali baris ke tbody tanpa refresh halaman
    rows.forEach(row => tbody.appendChild(row));
}
</script>