<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Banner;

class BannerView extends Component
{
    /**
     * Create a new component instance.
     */

    public $carousel;
    public $non_carousel;

    public function __construct()
    {
        $banner = Banner::class();
        $this->carousel = $banner->where('is_carousel', true)->get();
        $this->non_carousel = $banner->where('is_carousel', false)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.banner');
    }
}
