<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  public function up(): void
  {
    Schema::table('comments', function (Blueprint $table) {
      $table->text('description')->nullable()->change();
      $table->text('plus')->nullable()->change();
      $table->text('minus')->nullable()->change();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('comments', function (Blueprint $table) {
      $table->text('description')->nullable(false)->change();
      $table->text('plus')->nullable(false)->change();
      $table->text('minus')->nullable(false)->change();
    });
  }
};
