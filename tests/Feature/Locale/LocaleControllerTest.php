<?php

use App\Models\User;

test('guest can update locale via session', function (): void {
    $response = $this->patch(route('locale.update'), ['locale' => 'fr']);

    $response->assertRedirect();
    expect(session('locale'))->toBe('fr');
});

test('authenticated user can update locale', function (): void {
    $user = User::factory()->create(['locale' => 'en']);

    $this->actingAs($user);

    $response = $this->patch(route('locale.update'), ['locale' => 'fr']);

    $response->assertRedirect();
    expect(session('locale'))->toBe('fr');
    expect($user->fresh()->locale->value)->toBe('fr');
});

test('locale update rejects invalid locale', function (): void {
    $response = $this->patch(route('locale.update'), ['locale' => 'de']);

    $response->assertSessionHasErrors('locale');
});

test('locale update requires a locale', function (): void {
    $response = $this->patch(route('locale.update'), []);

    $response->assertSessionHasErrors('locale');
});

test('validation errors are returned in the correct locale', function (): void {
    $this->withSession(['locale' => 'fr']);

    $response = $this->patch(route('locale.update'), []);

    $response->assertSessionHasErrors('locale');
    $errors = session('errors')->get('locale');
    expect($errors[0])->toContain('locale');
});
