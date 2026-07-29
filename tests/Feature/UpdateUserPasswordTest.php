<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserPasswordTest extends TestCase
{
  use RefreshDatabase;
  /**
   * A basic feature test example.
   */
  public function test_example(): void
  {
    // create fake user
    $user = User::factory()->create();
    // update fake user data
    $response = $this->actingAs($user)->put('/api/user/profile/password', [
      'current_password' => 'password123',
      'password' => 'qweasd123',
      'password_confirmation' => 'qweasd123',
    ]);

    $response->assertStatus(200);
  }
}
