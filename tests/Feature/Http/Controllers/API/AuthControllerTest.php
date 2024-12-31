<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('logs in with valid credentials', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => $this->password,
    ]);

    $response->assertStatus(200)
        ->assertJsonStructure(['token']);
});

it('fails to log in with invalid credentials', function () {
    $response = $this->postJson('/api/login', [
        'email' => 'test@example.com',
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(401)
        ->assertJson(['message' => 'Invalid login credentials']);
});

it('logs out successfully', function () {
    $token = $this->user->createToken('API token')->plainTextToken;

    $response = $this->withHeader('Authorization', "Bearer $token")
        ->postJson('/api/logout');

    $response->assertStatus(200)
        ->assertJson(['message' => 'Logged out']);
});

beforeEach(function () {
    $this->user = User::factory()->create([
        'email' => 'test@example.com',
        'password' => bcrypt($this->password = 'password'),
    ]);
});
