<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MainLayout extends Component
{
    public function __construct(public $title , public ?string $class = null)
    {
        $this->title = $title;
    }
    
    public function render(): View|Closure|string
    {
        return view('layouts.main');
    }
}
