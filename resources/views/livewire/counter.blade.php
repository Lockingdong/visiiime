<div>
    <div class="p-6 max-w-sm mx-auto bg-white rounded-xl shadow-md flex items-center space-x-4">
        <button wire:click="decrement">-</button>
        <div>{{ $count }}</div>
        <button wire:click="increment">+</button>
    </div>
</div>
