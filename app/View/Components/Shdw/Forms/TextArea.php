<?php

namespace App\View\Components\Shdw\Forms;

use Illuminate\View\Component;

class TextArea extends Component
{
    /** @var boolean */
    public $lazy;
    /** @var string */
    public $name;
    /** @var string */
    public $label;
    /** @var string */
    public $value;
    /** @var int */
    public $cols;
    /** @var int */
    public $rows;

    public function __construct(string $name, string $label, ?int $rows, ?bool $lazy = false, ?int $cols = 4, ?string $value = '')
    {
        $this->lazy = $lazy ? 'wire:model.lazy' : 'wire:model';
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->rows = $rows;
        $this->cols = $cols;


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.shdw.forms.textarea');
    }
}
