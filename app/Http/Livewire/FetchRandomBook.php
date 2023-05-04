<?php

namespace App\Http\Livewire;

use App\Models\Book;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class FetchRandomBook extends ModalComponent
{
    public $bookes;
    public $isOpen = false;

    public function getRandomBook()
    {
        $random = rand(1, 19);
        $this->bookes=Book::find($random);
        $this->isOpen = true;
    } 

    public function close()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.fetch-random-book');
    }
}
