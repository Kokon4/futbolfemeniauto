<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Equip extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $nom,
        public string $estadi,
        public int $titols,
        public ?string $escut ) { 
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.equip');
    }
}
