<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
class Categories extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public function __construct(Category $category)
    {
        $this->categories=Category::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.categories');
    }
}
