<?php

namespace App\View\Components\Shdw\Forms;

use Illuminate\View\Component;

class File extends Component
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

    public function __construct(string $name, ?string $label = '', ?bool $lazy = false, ?string $value = '')
    {
        $this->lazy = $lazy ? 'wire:model.lazy' : 'wire:model';
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shdw.forms.file');
    }
}
