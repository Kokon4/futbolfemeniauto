<?php


namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Date;
use Illuminate\View\Component;

class Partit extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $local,
        public string $visitant,
        public string $date,
        public ? string $resultat,
        public ? int $gol_local,
        public ? int $gol_visitant,) { 
            
        }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.partit');
    }
}

?>