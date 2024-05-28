<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{
    public $name;
    public $type;
    public $placeholder;
    public $required;
    public $autofocus;
    public $value;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $type = 'text', $placeholder = null, $required = false, $autofocus = false, $value = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->autofocus = $autofocus;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
