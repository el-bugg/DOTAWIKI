<form action="{{ route('community.store') }}" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="category" value="match_result">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div class="relative" x-data="{ 
            open: false, 
            search: '', 
            selected: null, 
            heroes: @json($heroes) 
        }">
            <label class="text-xs text-gray-500 uppercase font-bold mb-1 block">Hero Dimainkan</label>
            <input type="hidden" name="hero_name" :value="selected ? selected.name : ''">
            
            <button type="button" @click="open = !open" @click.away="open = false"
                class="w-full bg-black/40 border border-white/10 rounded-lg p-2 flex justify-between items-center hover:border-ice/50 transition h-12">
                
                <template x-if="selected">
                    <div class="flex items-center gap-3">
                        <img :src="'/storage/' + selected.image" class="w-8 h-8 rounded-full border border-gray-600 object-cover"> 
                        <span x-text="selected.name" class="text-white text-sm font-bold"></span>
                    </div>
                </template>
                <template x-if="!selected">
                    <span class="text-gray-500 text-sm ml-2">Pilih Hero...</span>
                </template>

                <i class="fas fa-chevron-down text-xs text-gray-500 mr-2"></i>
            </button>

            <div x-show="open" class="absolute z-50 mt-1 w-full bg-[#0b121e] border border-ice/30 rounded-lg shadow-xl max-h-60 overflow-y-auto custom-scrollbar" style="display: none;">
                <div class="sticky top-0 bg-[#0b121e] p-2 border-b border-white/10">
                    <input x-model="search" type="text" placeholder="Cari hero..." class="w-full bg-black/50 border border-white/20 rounded px-2 py-1 text-xs text-white focus:border-ice outline-none">
                </div>
                
                <template x-for="hero in heroes.filter(h => h.name.toLowerCase().includes(search.toLowerCase()))" :key="hero.id">
                    <div @click="selected = hero; open = false" 
                         class="flex items-center gap-3 px-3 py-2 hover:bg-ice/10 cursor-pointer border-b border-white/5 transition">
                        <img :src="'/storage/' + hero.image" class="w-8 h-8 rounded border border-gray-700 object-cover">
                        <span x-text="hero.name" class="text-gray-300 text-sm"></span>
                    </div>
                </template>
            </div>
        </div>

        <div>
            <label class="text-xs text-gray-500 uppercase font-bold mb-1 block">K / D / A</label>
            <input type="text" name="kda" placeholder="Ex: 12/2/8" class="w-full bg-black/40 border border-white/10 rounded-lg h-12 px-3 text-white focus:border-ice outline-none">
        </div>

        <div class="col-span-1 md:col-span-2">
            <label class="text-xs text-gray-500 uppercase font-bold mb-1 block">Hasil Pertandingan</label>
            <select name="match_result" class="w-full bg-black/40 border border-white/10 rounded-lg h-12 px-3 text-white focus:border-ice outline-none cursor-pointer">
                <option value="Win" class="text-green-400 font-bold">Victory 🏆</option>
                <option value="Loss" class="text-red-400 font-bold">Defeat ❌</option>
            </select>
        </div>
    </div>

    <textarea name="content" rows="2" class="w-full bg-black/40 border border-white/10 rounded-lg p-3 text-white focus:border-ice outline-none resize-none mt-2" placeholder="Catatan pertandingan..."></textarea>

    <div class="text-right">
        <button type="submit" class="btn-ice px-6 py-2 text-xs font-bold uppercase tracking-wider rounded">Simpan Record</button>
    </div>
</form>