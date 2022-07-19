<?php

namespace App\View\Components\Shdw\Forum;

use Illuminate\View\Component;

class ForumLayout extends Component
{


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shdw.forms.input');
    }
}
