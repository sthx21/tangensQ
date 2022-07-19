<?php

namespace App\View\Components\Shdw\Forms;

use Illuminate\View\Component;

class Checkbox extends Component
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
    /** @var string */
    public $key;



    public function __construct(string $name,
                                string $label,
                                ?bool $lazy = false,
                                string $type = 'checkbox',
                                ?string $value = '',
                                ?string $key = '',
    )
    {
        $this->lazy =               $lazy ? 'wire:model.lazy' : 'wire:model';
        $this->type =               $type ?? 'checkbox';
        $this->name =               $name;
        $this->label =              $label;
        $this->value =              $value ?? '';
        $this->key =                $key ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shdw.forms.checkbox');
    }
}
