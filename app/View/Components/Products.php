<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Products extends Component
{
    /**
     * Create a new component instance.
     */
    public $src;
    public $tags;
    public $productName;
    public $productPrice;
    public function __construct($src, $tags, $productName, $productPrice)
    {
        $this->src = $src;
        $this->tags = $tags;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.products');
    }
}
