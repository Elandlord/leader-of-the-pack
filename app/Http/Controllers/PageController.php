<?php

namespace App\Http\Controllers;

use App\Models\Dog;
use App\Models\Page;
use App\Models\Price;
use App\Models\Reason;
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
        $dogs = Dog::inRandomOrder()
            ->get()
            ->append('photo');
        $reviews = Review::all();
        $reasons = Reason::all();
        $page = Page::firstWhere('title', 'homepage');

        return view('pages.homepage.index', [
            'dogs' => $dogs,
            'reviews' => $reviews,
            'reasons' => $reasons,
            'page' => $page
        ]);
    }

    /**
     * Returns the about page.
     * @return View
     */
    public function about(): View
    {
        $page = Page::firstWhere('title', 'about');

        return view('pages.about.index', [
            'page' => $page
        ]);
    }

    /**
     * Returns the contact page.
     * @return View
     */
    public function contact(): View
    {
        $page = Page::firstWhere('title', 'contact');

        return view('pages.contact.index', [
            'page' => $page
        ]);
    }

    public function pricing(): View
    {
        $prices = Price::all();
        $page = Page::firstWhere('title', 'pricing');

        return view('pages.pricing.index', [
            'page' => $page,
            'prices' => $prices,
        ]);
    }
}
