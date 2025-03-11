<?php

namespace App\Livewire;

use App\Models\Author;
use Livewire\Component;
use App\Models\Book;
use App\Models\Collection;
use App\Models\Publisher;
use Livewire\WithPagination;

class LiveSearch extends Component
{
    use WithPagination;

    public bool $isIconOnly = false;
    public $isOpen = false;
    public $query = '';
    public $results = [];


    public function resetSearch()
    {
        $this->query = '';
        $this->results = [
            'books' => [],
            'authors' => [],
            'publishers' => [],
            'collections' => []
        ];
    }

    public function updatedQuery()
    {
        if (strlen($this->query) >= 2) {
            $this->results = [
                'books' => Book::search($this->query)->get(),
                'authors' => Author::search($this->query)->get(),
                'publishers' => Publisher::search($this->query)->get(),
                'collections' => Collection::search($this->query)->get(),
            ];
        } else {
            $this->results = [];
        }
    }

    public function render()
    {
        return view('livewire.live-search');
    }
}
