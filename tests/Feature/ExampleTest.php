<?php

namespace Tests\Feature;

use App\Models\Dog;
use App\Models\Page;
use App\Models\Price;
use App\Models\Reason;
use App\Models\Review;
use App\Models\Section;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $this->createHomepage();

        $response = $this->get('/');

        $response->assertStatus(200);
    }

    protected function createHomepage(): void
    {
        $homepage = Page::create(['name' => 'Homepage', 'title' => 'homepage', 'route_name' => 'pages.home']);

        $sections = [
            [
                ['type' => 'title', 'data' => ['title' => 'Hondenuitlaatservice']],
                ['type' => 'title', 'data' => ['title' => 'Leader of the Pack']],
                ['type' => 'text_block', 'data' => ['text_block' => 'Hondenuitlaatservice op maat']],
                ['type' => 'button', 'data' => ['button' => 'Neem contact op', 'url' => 'contact']],
                ['type' => 'button', 'data' => ['button' => 'Meer over mij', 'url' => 'over-mij']],
            ],
            [
                ['type' => 'title', 'data' => ['title' => 'Leader of the Pack']],
                ['type' => 'text_block', 'data' => ['text_block' => 'Ik laat honden uit in Beetsterzwaag.']],
            ],
            [['type' => 'title', 'data' => ['title' => 'Wandelhonden']]],
            [['type' => 'title', 'data' => ['title' => 'Reviews']]],
        ];

        foreach ($sections as $content) {
            Section::create([
                'sectionable_id' => $homepage->id,
                'sectionable_type' => Page::class,
                'content' => $content,
            ]);
        }

        $dog = Dog::create(['name' => 'Angel', 'description' => 'Het zorgzame moedertje.', 'breed' => 'Golden Retriever']);
        Review::create(['author' => 'Eric', 'rating' => 5, 'text' => 'Top.', 'location' => 'Beetsterzwaag', 'type' => 'wandeling', 'dog_id' => $dog->id]);
        Reason::create(['why' => 'Weinig tijd?', 'icon' => 'schedule', 'solution' => 'Ik laat je hond uit.']);
        Price::create(['name' => 'Losse wandeling', 'description' => 'Een uur.', 'costs' => '15.00', 'type' => 'Local Walks']);
    }
}
