<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds
     *
     * @return void
     */
    public function run(): void
    {
        $homepage = Page::create([
            'name' => 'Homepage',
            'title' => 'Homepage',
            'route_name' => 'pages.home',
        ]);

        $aboutPage = Page::create([
            'name' => 'About',
            'title' => 'About',
            'route_name' => 'pages.about'
        ]);

        $contactPage = Page::create([
            'name' => 'Contact',
            'title' => 'Contact',
            'route_name' => 'pages.contact'
        ]);
    }
}
