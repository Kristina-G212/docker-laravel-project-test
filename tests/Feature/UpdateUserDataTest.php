<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserDataTest extends TestCase
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
    $response = $this->actingAs($user)->put('/api/user/profile', [
      'nickname' => '',
      'first_name' => '',
      'last_name' => '',
      'middle_name' => 'test',
      'phone' => '',
    ]);

    $response->assertStatus(200);
  }
}
