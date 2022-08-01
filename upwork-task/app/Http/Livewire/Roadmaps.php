<?php

namespace App\Http\Livewire;

use App\Models\roadmap;
use Livewire\Component;

class Roadmaps extends Component
{

  public $title;
  public $image;
  public $items;

    public function render()
    {
        $roadmaps = roadmap::orderBy('id', 'DESC')->get();
        return view('livewire.roadmaps', ['roadmaps' => $roadmaps]);
    }


    function store()
    {
        $this->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'items' => 'required',
        ]);

        roadmap::create([
            'title' => $this->title,
            'image' => $this->image,
        ]);

        $this->title = '';
        $this->image = '';

        $this->emit('roadmapStored');
    }
}
