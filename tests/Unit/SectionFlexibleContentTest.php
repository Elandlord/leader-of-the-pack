<?php

namespace Tests\Unit;

use App\Models\Section;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;

class SectionFlexibleContentTest extends TestCase
{
    protected const IMAGE_FALLBACK = '/images/illustrations/illustratie-1.svg';

    public function test_flexible_content_groups_layouts_sharing_an_attribute_key(): void
    {
        $section = $this->makeSection([
            $this->layout('title', ['title' => 'Beetsterzwaag']),
            $this->layout('text_block', ['text_block' => 'Eerste alinea']),
            $this->layout('text_block', ['text_block' => 'Tweede alinea']),
        ]);

        $content = $section->flexible_content;

        $this->assertSame('Beetsterzwaag', $content['title']);
        $this->assertInstanceOf(Collection::class, $content['text_block']);
        $this->assertSame(['Eerste alinea', 'Tweede alinea'], $content['text_block']->all());
    }

    public function test_flexible_content_prefixes_image_attribute_with_storage_path(): void
    {
        $section = $this->makeSection([
            $this->layout('image', ['image' => 'sections/hond.jpg']),
        ]);

        $this->assertSame('/storage/sections/hond.jpg', $section->flexible_content['image']);
    }

    public function test_flexible_content_falls_back_to_illustration_when_image_is_null(): void
    {
        $section = $this->makeSection([
            $this->layout('image', ['image' => null]),
        ]);

        $this->assertSame(self::IMAGE_FALLBACK, $section->flexible_content['image']);
    }

    public function test_flexible_title_returns_the_title_layout_value(): void
    {
        $section = $this->makeSection([
            $this->layout('title', ['title' => 'Over mij']),
        ]);

        $this->assertSame('Over mij', $section->flexible_title);
    }

    public function test_flexible_title_returns_empty_string_without_a_title_layout(): void
    {
        $section = $this->makeSection([
            $this->layout('text_block', ['text_block' => 'Zonder titel']),
        ]);

        $this->assertSame('', $section->flexible_title);
    }

    public function test_flexible_text_block_returns_the_string_for_a_single_layout(): void
    {
        $section = $this->makeSection([
            $this->layout('text_block', ['text_block' => 'Enkele alinea']),
        ]);

        $this->assertSame('Enkele alinea', $section->flexible_text_block);
    }

    public function test_flexible_text_block_unwraps_the_first_entry_of_a_collection(): void
    {
        $section = $this->makeSection([
            $this->layout('text_block', ['text_block' => 'Eerste alinea']),
            $this->layout('text_block', ['text_block' => 'Tweede alinea']),
        ]);

        $this->assertSame('Eerste alinea', $section->flexible_text_block);
    }

    public function test_empty_content_returns_defaults(): void
    {
        $section = $this->makeSection([]);

        $this->assertTrue($section->flexible_content->isEmpty());
        $this->assertSame('', $section->flexible_title);
        $this->assertSame('', $section->flexible_text_block);
    }

    public function test_missing_content_returns_defaults(): void
    {
        $section = new Section();

        $this->assertTrue($section->flexible_content->isEmpty());
        $this->assertSame('', $section->flexible_title);
        $this->assertSame('', $section->flexible_text_block);
    }

    protected function makeSection(array $layouts): Section
    {
        $section = new Section();
        $section->content = json_encode($layouts);

        return $section;
    }

    protected function layout(string $name, array $attributes): array
    {
        return [
            'layout' => $name,
            'key' => str_pad($name, 16, 'x'),
            'attributes' => $attributes,
        ];
    }
}
