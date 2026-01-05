<x-layout>
    <x-slot:title>Game Items</x-slot>

    <div class="container py-5">
        <h1 class="text-center mb-5 font-cinzel text-white">GAME ITEMS</h1>
        
        <div class="row g-2 justify-content-center">
            @foreach($items as $item)
                <x-item-card :item="$item" />
            @endforeach
        </div>
    </div>
</x-layout>