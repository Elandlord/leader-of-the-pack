<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\Dogs\DogResource;
use App\Filament\Resources\MetaTags\MetaTagResource;
use App\Filament\Resources\Pages\PageResource;
use App\Filament\Resources\Pages\Pages\ViewPage;
use App\Filament\Resources\Pages\RelationManagers\MetaTagsRelationManager;
use App\Filament\Resources\Pages\RelationManagers\SectionsRelationManager;
use App\Filament\Resources\Prices\PriceResource;
use App\Filament\Resources\Reasons\ReasonResource;
use App\Filament\Resources\Reviews\ReviewResource;
use App\Filament\Resources\Sections\SectionResource;
use App\Filament\Resources\Users\UserResource;
use App\Models\Dog;
use App\Models\MetaTag;
use App\Models\Page;
use App\Models\Price;
use App\Models\Reason;
use App\Models\Review;
use App\Models\Section;
use App\Models\User;
use Closure;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminResourcesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::query()->firstOrCreate(
            ['email' => 'info@leader-of-the-pack.nl'],
            ['name' => 'Test admin', 'password' => Hash::make(Str::random(32))],
        );

        $this->actingAs($admin);
        Filament::setCurrentPanel('admin');
    }

    public static function resources(): array
    {
        return [
            'dog' => [DogResource::class, fn () => self::createDog()],
            'price' => [PriceResource::class, fn () => Price::create([
                'name' => '1 hond',
                'description' => '10 uren naar wens te besteden.',
                'costs' => '25.50',
                'type' => 'Local Walks',
            ])],
            'reason' => [ReasonResource::class, fn () => Reason::create([
                'why' => 'Weinig tijd?',
                'icon' => 'schedule',
                'solution' => 'Ik laat je hond uit.',
            ])],
            'review' => [ReviewResource::class, fn () => Review::create([
                'author' => 'Eric',
                'rating' => 5,
                'text' => 'Top service.',
                'location' => 'Beetsterzwaag',
                'type' => 'wandeling',
                'dog_id' => self::createDog()->id,
            ])],
            'page' => [PageResource::class, fn () => self::createPage()],
            'section' => [SectionResource::class, fn () => self::createSection(self::createPage())],
            'meta tag' => [MetaTagResource::class, fn () => MetaTag::create([
                'meta_taggable_id' => self::createPage()->id,
                'meta_taggable_type' => Page::class,
                'name' => 'keywords',
                'content' => 'hondenuitlaatservice, beetsterzwaag',
            ])],
            'user' => [UserResource::class, fn () => User::factory()->create()],
        ];
    }

    #[DataProvider('resources')]
    public function test_the_list_page_shows_the_record(string $resource, Closure $createRecord): void
    {
        // Arrange
        $record = $createRecord();

        // Act
        $response = $this->get($resource::getUrl('index'));

        // Assert
        $response->assertOk();
        Livewire::test($resource::getPages()['index']->getPage())
            ->assertCanSeeTableRecords([$record]);
    }

    #[DataProvider('resources')]
    public function test_the_view_page_renders(string $resource, Closure $createRecord): void
    {
        // Arrange
        $record = $createRecord();

        // Act
        $response = $this->get($resource::getUrl('view', ['record' => $record]));

        // Assert
        $response->assertOk();
    }

    #[DataProvider('resources')]
    public function test_the_edit_page_renders(string $resource, Closure $createRecord): void
    {
        // Arrange
        $record = $createRecord();

        // Act
        $response = $this->get($resource::getUrl('edit', ['record' => $record]));

        // Assert
        $response->assertOk();
    }

    #[DataProvider('resources')]
    public function test_saving_without_changes_keeps_the_record_as_it_was(string $resource, Closure $createRecord): void
    {
        // Arrange
        $record = $createRecord();
        $before = $this->comparableAttributes($record->fresh());

        // Act
        $component = Livewire::test($resource::getPages()['edit']->getPage(), ['record' => $record->getRouteKey()])
            ->call('save');

        // Assert
        $component->assertHasNoFormErrors();
        $this->assertSame($before, $this->comparableAttributes($record->fresh()));
    }

    public function test_the_section_builder_saves_blocks_in_the_format_the_site_reads(): void
    {
        // Arrange
        $section = self::createSection(self::createPage());

        // Act
        Livewire::test(SectionResource::getPages()['edit']->getPage(), ['record' => $section->getRouteKey()])
            ->call('save')
            ->assertHasNoFormErrors();

        // Assert
        $section->refresh();
        $this->assertSame('Over mij', $section->flexible_title);
        $this->assertSame('Eerste alinea', $section->flexible_text_block);
        $this->assertSame('Neem contact op', $section->flexible_button[0]['button']);
    }

    public function test_the_page_view_lists_its_sections_and_meta_tags(): void
    {
        // Arrange
        $page = self::createPage();
        $section = self::createSection($page);
        $metaTag = MetaTag::create([
            'meta_taggable_id' => $page->id,
            'meta_taggable_type' => Page::class,
            'name' => 'description',
            'content' => 'Hondenuitlaatservice',
        ]);

        // Act
        $sections = Livewire::test(SectionsRelationManager::class, ['ownerRecord' => $page, 'pageClass' => ViewPage::class]);
        $metaTags = Livewire::test(MetaTagsRelationManager::class, ['ownerRecord' => $page, 'pageClass' => ViewPage::class]);

        // Assert
        $sections->assertCanSeeTableRecords([$section]);
        $metaTags->assertCanSeeTableRecords([$metaTag]);
    }

    protected function comparableAttributes(Model $record): array
    {
        $attributes = Arr::except($record->getAttributes(), ['updated_at']);

        foreach (['content', 'links'] as $jsonColumn) {
            if (isset($attributes[$jsonColumn])) {
                $attributes[$jsonColumn] = json_decode($attributes[$jsonColumn], true);
            }
        }

        return $attributes;
    }

    protected static function createDog(): Dog
    {
        return Dog::create([
            'name' => 'Angel',
            'description' => 'Het zorgzame moedertje van de roedel.',
            'breed' => 'Golden Retriever',
            'birthyear' => (int) now()->format('Y') - 4,
        ]);
    }

    protected static function createPage(): Page
    {
        return Page::create([
            'name' => 'Testpagina',
            'title' => 'testpagina',
            'route_name' => 'pages.test',
            'show_in_search_results' => true,
        ]);
    }

    protected static function createSection(Page $page): Section
    {
        return Section::create([
            'sectionable_id' => $page->id,
            'sectionable_type' => Page::class,
            'content' => [
                ['type' => 'title', 'data' => ['title' => 'Over mij']],
                ['type' => 'text_block', 'data' => ['text_block' => 'Eerste alinea']],
                ['type' => 'button', 'data' => ['button' => 'Neem contact op', 'url' => 'contact']],
            ],
        ]);
    }
}
