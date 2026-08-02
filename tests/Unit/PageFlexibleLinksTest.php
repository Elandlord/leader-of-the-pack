<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\Models\Page;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class PageFlexibleLinksTest extends TestCase
{
    protected const LAYOUT_NAME = 'link';

    protected const LAYOUT_ATTRIBUTES = [
        'label' => 'Home',
        'url' => '/',
    ];

    protected Page $page;

    protected function setUp(): void
    {
        parent::setUp();

        $this->page = new Page();
    }

    public function test_it_maps_every_stored_layout_to_a_collection_entry(): void
    {
        // Arrange
        $this->page->links = json_encode([
            [
                'layout' => self::LAYOUT_NAME,
                'key' => 'k1',
                'attributes' => self::LAYOUT_ATTRIBUTES,
            ],
        ]);

        // Act
        $links = $this->page->getFlexibleLinksAttribute();

        // Assert
        $this->assertInstanceOf(Collection::class, $links);
        $this->assertCount(1, $links);
        $this->assertSame(self::LAYOUT_NAME, $links->first()->name());
        $this->assertSame(self::LAYOUT_ATTRIBUTES, $links->first()->getAttributes());
    }

    public function test_it_returns_an_empty_collection_for_an_empty_layout_list(): void
    {
        // Arrange
        $this->page->links = '[]';

        // Act
        $links = $this->page->getFlexibleLinksAttribute();

        // Assert
        $this->assertInstanceOf(Collection::class, $links);
        $this->assertCount(0, $links);
    }

    public function test_it_returns_an_empty_collection_when_no_links_are_stored(): void
    {
        // Arrange
        $this->page->links = null;

        // Act
        $links = $this->page->getFlexibleLinksAttribute();

        // Assert
        $this->assertInstanceOf(Collection::class, $links);
        $this->assertCount(0, $links);
    }
}
