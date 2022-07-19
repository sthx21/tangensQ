<?php

namespace App\View\Components\Shdw\Menues;

use Illuminate\View\Component;
use phpDocumentor\Reflection\Types\Collection;

class MegaMenu extends Component
{
    /** @var boolean */
    public $lazy;
    /** @var array */
    public $results;
    /** @var array */
    public $firstResults;
    /** @var array */
    public $secondResults;
    /** @var array */
    public $thirdResults;
    /** @var string */
    public $firstResultsName;
    /** @var array */
    public $resultTwo;
    /** @var string */
    public $name;
    /** @var string */
    public $label;
    /** @var string */
    public $value;
    public function __construct(string $name, string $label, $results,  ?bool $lazy = false, ?string $value = '')
    {
        $this->lazy = $lazy ? 'wire:model.lazy' : 'wire:model';
        $this->firstResults = $results->products;
        $this->secondResults = $results->categories;
        $this->thirdResults = $results->subCategories;



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
        return view('components.shdw.menues.mega-menu');
    }
}
