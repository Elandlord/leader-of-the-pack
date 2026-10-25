<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Filament\Auth\Pages\Login;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use DatabaseTransactions;

    protected const WHITELISTED_EMAIL = 'info@leader-of-the-pack.nl';

    protected const PASSWORD = 'local-test-password';

    public function test_a_guest_is_redirected_to_the_login_page(): void
    {
        // Act
        $response = $this->get('/cms');

        // Assert
        $response->assertRedirect('/cms/login');
    }

    public function test_the_login_page_renders(): void
    {
        // Act
        $response = $this->get('/cms/login');

        // Assert
        $response->assertOk();
    }

    public function test_a_whitelisted_user_logs_in_with_the_users_table_credentials(): void
    {
        // Arrange
        $user = $this->whitelistedUser();

        // Act
        $component = Livewire::test(Login::class)
            ->fillForm([
                'email' => $user->email,
                'password' => self::PASSWORD,
            ])
            ->call('authenticate');

        // Assert
        $component->assertHasNoFormErrors();
        $this->assertAuthenticatedAs($user);
    }

    public function test_a_whitelisted_user_opens_the_dashboard(): void
    {
        // Arrange
        $user = $this->whitelistedUser();

        // Act
        $response = $this->actingAs($user)->get('/cms');

        // Assert
        $response->assertOk();
    }

    public function test_a_user_outside_the_whitelist_is_forbidden_outside_the_local_environment(): void
    {
        // Arrange
        $user = User::factory()->create(['email' => 'someone-else@example.com']);

        // Act
        $response = $this->actingAs($user)->get('/cms');

        // Assert
        $response->assertForbidden();
    }

    public function test_any_user_may_open_the_panel_in_the_local_environment(): void
    {
        // Arrange
        $user = User::factory()->create(['email' => 'someone-else@example.com']);
        $this->app['env'] = 'local';

        // Act
        $response = $this->actingAs($user)->get('/cms');

        // Assert
        $response->assertOk();
    }

    protected function whitelistedUser(): User
    {
        $user = User::query()->firstOrNew(['email' => self::WHITELISTED_EMAIL]);
        $user->forceFill([
            'name' => $user->name ?? 'Test admin',
            'password' => Hash::make(self::PASSWORD),
        ])->save();

        return $user;
    }
}
