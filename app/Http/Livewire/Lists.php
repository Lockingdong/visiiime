<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Lists extends Component
{

    public $query;

    public $item = [
        'title' => '',
        'name' => ''
    ];

    public $lists = [
        [
            'title' => 'test',
            'name' => '123',
        ]
    ];

    public function add()
    {
        $this->lists[] = $this->item;
    }

    public function render()
    {
        return view('livewire.lists');
    }

    public function search()
    {
        dd($this->query);
    }
}
