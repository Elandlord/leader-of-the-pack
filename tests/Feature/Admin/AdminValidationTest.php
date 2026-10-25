<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\Dogs\Pages\CreateDog;
use App\Filament\Resources\MetaTags\Pages\CreateMetaTag;
use App\Filament\Resources\Prices\Pages\CreatePrice;
use App\Filament\Resources\Reasons\Pages\CreateReason;
use App\Filament\Resources\Reviews\Pages\CreateReview;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminValidationTest extends TestCase
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

    public static function createPages(): array
    {
        return [
            'dog' => [CreateDog::class, ['data.name']],
            'price' => [CreatePrice::class, ['data.name', 'data.costs', 'data.type']],
            'reason' => [CreateReason::class, ['data.why', 'data.icon']],
            'review' => [CreateReview::class, ['data.author', 'data.rating']],
            'meta tag' => [CreateMetaTag::class, ['data.meta_taggable_type']],
            'user' => [CreateUser::class, ['data.name', 'data.email', 'data.password']],
        ];
    }

    #[DataProvider('createPages')]
    public function test_an_empty_form_fails_only_on_the_fields_nova_required(string $page, array $expectedErrors): void
    {
        // Act
        $component = Livewire::test($page)->call('create');

        // Assert
        $this->assertSame($expectedErrors, array_keys($component->errors()->toArray()));
    }

    public function test_a_user_password_is_hashed_and_left_alone_when_blank(): void
    {
        // Arrange
        $user = User::factory()->create();
        $originalHash = $user->password;

        // Act
        Livewire::test(EditUser::class, ['record' => $user->getRouteKey()])
            ->fillForm(['password' => ''])
            ->call('save')
            ->assertHasNoFormErrors();
        $hashAfterBlankSave = $user->fresh()->password;

        Livewire::test(EditUser::class, ['record' => $user->getRouteKey()])
            ->fillForm(['password' => 'a-new-password'])
            ->call('save')
            ->assertHasNoFormErrors();

        // Assert
        $this->assertSame($originalHash, $hashAfterBlankSave);
        $this->assertTrue(Hash::check('a-new-password', $user->fresh()->password));
    }

    public function test_a_user_email_must_be_unique(): void
    {
        // Arrange
        $user = User::factory()->create();

        // Act
        $component = Livewire::test(EditUser::class, ['record' => $user->getRouteKey()])
            ->fillForm(['email' => 'info@leader-of-the-pack.nl'])
            ->call('save');

        // Assert
        $component->assertHasFormErrors(['email' => 'unique']);
    }
}
