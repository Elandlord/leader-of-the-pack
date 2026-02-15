<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ServiceAreaContentTest extends TestCase
{
    public function test_packages_only_include_local_walks_type(): void
    {
        $template = file_get_contents(resource_path('views/pages/homepage/partials/packages.blade.php'));

        $this->assertStringContainsString("$types = ['Local Walks'];", $template);
        $this->assertStringNotContainsString('Travel Walks', $template);
        $this->assertStringContainsString('Alle tarieven zijn voor wandelingen in Beetsterzwaag.', $template);
    }

    public function test_homepage_banner_mentions_beetsterzwaag_service_area(): void
    {
        $template = file_get_contents(resource_path('views/pages/homepage/partials/banner.blade.php'));

        $this->assertStringContainsString('Ik ben alleen beschikbaar voor honden in Beetsterzwaag.', $template);
    }

    public function test_contact_page_mentions_beetsterzwaag_service_area(): void
    {
        $template = file_get_contents(resource_path('views/pages/contact/index.blade.php'));

        $this->assertStringContainsString('Werkgebied: alleen Beetsterzwaag.', $template);
    }
}
