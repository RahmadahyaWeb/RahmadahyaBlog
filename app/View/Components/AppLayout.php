<?php

namespace App\View\Components;

use Closure;
use DB;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View|Closure|string
    {
        $categories = \App\Models\Category::query()
            ->join('category_post', 'categories.id', '=', 'category_post.category_id')
            ->select('categories.name', 'categories.slug', DB::raw('count(*) as total'))
            ->groupBy('categories.id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();
        return view('layouts.app', compact('categories'));
    }
}