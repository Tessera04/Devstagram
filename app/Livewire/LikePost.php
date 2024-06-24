<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    //Este atributo se envia con liveware al archivo like-post, sin necesidad de crear un return
    public $post;

    public function render()
    {
        return view('livewire.like-post');
    }
}
