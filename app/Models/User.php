<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['phone', 'email', 'password', 'first_name', 'last_name', 'middle_name', 'nickname', 'two_factor_code', 'two_factor_expires_at'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements MustVerifyEmail
{
  /** @use HasFactory<UserFactory> */
  use HasFactory, Notifiable, HasApiTokens;

  /**
   * Get the attributes that should be cast.
   *
   * @return array<string, string>
   */
  protected function casts(): array
  {
    return [
      'email_verified_at' => 'datetime',
      'password' => 'hashed',
      'two_factor_expires_at' => 'datetime'
    ];
  }

  /**
   * книги, принадлежащие пользователю
   */
  public function favorite(): BelongsToMany
  {
    return $this->belongsToMany(Book::class, 'favorites', 'user_id', 'book_id');
  }

  public function comments(): BelongsToMany
  {
    return $this->belongsToMany(Book::class, 'comments', 'user_id', 'book_id');
  }

  function generateTwoFactorCode()
  {
    $this->timestamps = false;
    $this->two_factor_code = rand(1000, 9999);
    $this->two_factor_expires_at = now()->addMinutes(10);
    $this->save();
  }

  public function resetTwoFactorCode()
  {
    $this->timestamps = false;
    $this->two_factor_code = null;
    $this->two_factor_expires_at = null;
    $this->save();
  }
}
