<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Price;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Returns the homepage view
     * @return View
     */
    public function homepage(): View
    {
        $dogs = Dog::all();
        $prices = Price::all();
        $reviews = Review::all();

        return view('pages.homepage.index', [
            'dogs' => $dogs,
            'prices' => $prices,
            'reviews' => $reviews
        ]);
    }

    /**
     * Returns the about page.
     * @return View
     */
    public function about(): View
    {
        return view('pages.about.index');
    }
}
