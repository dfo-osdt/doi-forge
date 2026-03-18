<?php

use App\Models\User;

test('locale defaults to en for guests', function (): void {
    $response = $this->get(route('home'));

    $response->assertSuccessful();
    expect(app()->getLocale())->toBe('en');
});

test('locale is set from session for guests', function (): void {
    $this->withSession(['locale' => 'fr']);

    $response = $this->get(route('home'));

    $response->assertSuccessful();
    expect(app()->getLocale())->toBe('fr');
});

test('locale is set from authenticated user preference', function (): void {
    $user = User::factory()->create(['locale' => 'fr']);

    $this->actingAs($user);

    $response = $this->get(route('dashboard'));

    $response->assertSuccessful();
    expect(app()->getLocale())->toBe('fr');
});

test('user locale takes priority over session locale', function (): void {
    $user = User::factory()->create(['locale' => 'fr']);

    $this->actingAs($user)->withSession(['locale' => 'en']);

    $response = $this->get(route('dashboard'));

    $response->assertSuccessful();
    expect(app()->getLocale())->toBe('fr');
});

test('locale is shared as inertia prop', function (): void {
    $user = User::factory()->create(['locale' => 'fr']);

    $this->actingAs($user);

    $response = $this->get(route('dashboard'));

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->where('locale', 'fr'));
});
