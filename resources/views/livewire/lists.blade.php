<div>

{{--    {{ $item['title'] }}--}}

    <div>
        <form action="" wire:submit.prevent="search">
            <input type="text" wire:model.defer="query">
            <button>search</button>
        </form>
        <input type="text" wire:model="item.title.debounce.500ms">
        <input type="text" wire:model="item.name.lazy">
        <button wire:click="add">add</button>

        <ul>
            @foreach($lists as $item)
                <li>
                    {{$item['title']}} {{$item['name']}}
                </li>
            @endforeach
        </ul>
    </div>

</div>
