<?php

namespace App\View\Components\Shdw\Forms;

use Illuminate\View\Component;

class Search extends Component
{
    /** @var boolean */
    public $lazy;
    /** @var string */
    public $type;
    /** @var string */
    public $name;
    /** @var string */
    public $label;
    /** @var string */
    public $value;
    public function __construct(string $name, string $label,  ?bool $lazy = false, string $type = 'text', ?string $value = '')
    {
        $this->lazy = $lazy ? 'wire:model.lazy' : 'wire:model';
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shdw.forms.search');
    }
}
