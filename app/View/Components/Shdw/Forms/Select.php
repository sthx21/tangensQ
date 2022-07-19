<?php

namespace App\View\Components\Shdw\Forms;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $label;
    /**
     * Create a new component instance.
     * @param  string  $name
     * @param  string $label
     * @return void
     */
    public function __construct($name, $label)
    {
        $this->name = $name;
        $this->label = $label;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shdw.forms.select');
    }
}
