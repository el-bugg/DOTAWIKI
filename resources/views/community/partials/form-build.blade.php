<form action="{{ route('community.store') }}" method="POST" class="space-y-4">
    @csrf
    <input type="hidden" name="category" value="item_build">

    <div class="relative" x-data="{ 
        open: false, 
        search: '', 
        selected: null, 
        heroes: @json($heroes) 
    }">
        <label class="text-xs text-ice font-bold uppercase tracking-widest mb-2 block">1. Pilih Hero Target</label>
        <input type="hidden" name="hero_id" :value="selected ? selected.id : ''">
        
        <button type="button" @click="open = !open" @click.away="open = false"
            class="w-full bg-black/40 border border-white/10 rounded-lg p-2 flex justify-between items-center hover:border-ice/50 transition h-14">
            <template x-if="selected">
                <div class="flex items-center gap-4">
                    <img :src="'/storage/' + selected.image" class="w-10 h-10 rounded border border-ice/50 object-cover shadow-[0_0_10px_#00d2ff]"> 
                    <div class="text-left">
                        <span x-text="selected.name" class="text-white font-bold block"></span>
                        <span class="text-[10px] text-ice">Hero Selected</span>
                    </div>
                </div>
            </template>
            <template x-if="!selected">
                <div class="flex items-center gap-2 text-gray-500 ml-2">
                    <i class="fas fa-user-ninja"></i> <span>Pilih Hero...</span>
                </div>
            </template>
            <i class="fas fa-chevron-down text-gray-500 mr-2"></i>
        </button>

        <div x-show="open" class="absolute z-50 mt-1 w-full bg-[#0b121e] border border-ice/30 rounded-lg shadow-xl max-h-60 overflow-y-auto custom-scrollbar" style="display: none;">
            <div class="sticky top-0 bg-[#0b121e] p-2 border-b border-white/10">
                <input x-model="search" type="text" placeholder="Cari..." class="w-full bg-black/50 border border-white/20 rounded px-2 py-1 text-xs text-white focus:border-ice outline-none">
            </div>
            <template x-for="hero in heroes.filter(h => h.name.toLowerCase().includes(search.toLowerCase()))" :key="hero.id">
                <div @click="selected = hero; open = false" 
                     class="flex items-center gap-3 px-3 py-2 hover:bg-ice/10 cursor-pointer border-b border-white/5 transition">
                    <img :src="'/storage/' + hero.image" class="w-8 h-8 rounded object-cover">
                    <span x-text="hero.name" class="text-gray-300 text-sm"></span>
                </div>
            </template>
        </div>
    </div>

    <div>
        <label class="text-xs text-ice font-bold uppercase tracking-widest mb-2 block">2. Pilih 6 Item Build</label>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
            @for($i=0; $i<6; $i++)
                <div class="relative" x-data="{ 
                    open: false, 
                    search: '', 
                    selected: null, 
                    items: @json($items) 
                }">
                    <input type="hidden" name="items[]" :value="selected ? selected.id : ''">
                    
                    <div @click="open = !open" @click.away="open = false"
                         class="aspect-square bg-black/40 border border-white/10 rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-ice/50 hover:shadow-[0_0_10px_rgba(0,210,255,0.2)] transition group relative overflow-hidden">
                        
                        <template x-if="selected">
                            <img :src="'/storage/' + selected.image" class="w-full h-full object-cover">
                        </template>
                        
                        <template x-if="!selected">
                            <div class="text-center">
                                <i class="fas fa-plus text-gray-600 group-hover:text-ice mb-1"></i>
                                <span class="text-[9px] text-gray-600 block">Slot {{ $i+1 }}</span>
                            </div>
                        </template>
                        
                        <div x-show="selected" class="absolute bottom-0 w-full bg-black/80 text-[8px] text-center text-white py-0.5 truncate" x-text="selected ? selected.name : ''"></div>
                    </div>

                    <div x-show="open" class="absolute z-50 mt-1 w-[200px] -left-10 bg-[#0b121e] border border-ice/30 rounded-lg shadow-xl max-h-48 overflow-y-auto custom-scrollbar" style="display: none;">
                        <div class="sticky top-0 bg-[#0b121e] p-2">
                            <input x-model="search" type="text" placeholder="Cari item..." class="w-full bg-black/50 border border-white/20 rounded px-2 py-1 text-[10px] text-white focus:border-ice outline-none">
                        </div>
                        <template x-for="item in items.filter(i => i.name.toLowerCase().includes(search.toLowerCase()))" :key="item.id">
                            <div @click="selected = item; open = false" 
                                 class="flex items-center gap-2 px-2 py-1.5 hover:bg-ice/10 cursor-pointer border-b border-white/5">
                                <img :src="'/storage/' + item.image" class="w-6 h-6 rounded border border-gray-700 object-cover">
                                <span x-text="item.name" class="text-gray-300 text-xs"></span>
                            </div>
                        </template>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <textarea name="content" rows="2" class="w-full bg-black/40 border border-white/10 rounded-lg p-3 text-white focus:border-ice outline-none resize-none" placeholder="Penjelasan build ini..."></textarea>

    <div class="text-right">
        <button type="submit" class="btn-ice px-6 py-2 text-xs font-bold uppercase tracking-wider rounded">Bagikan Build</button>
    </div>
</form>