<?php

namespace App\View\Components\Shdw\Forms;

use Illuminate\View\Component;

class Input extends Component
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

    /** @var boolean */
    public $ro;
    /** @var array */
    public $options;

    public function __construct(string $name,
                                string $label,
//                                ?bool $ro = false,
                                ?bool $lazy = false,
                                string $type = 'text',
                                ?string $value = '',
                                ?string $key = '',
//                                ?string $size = 'w-full'
    )
    {
        $this->lazy =               $lazy ? 'wire:model.lazy' : 'wire:model';
        $this->ro =                 false;
        $this->type =               $type ?? 'text';
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
        return view('components.shdw.forms.input');
    }
}
