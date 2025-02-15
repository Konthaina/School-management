<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('documents', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->year('publication_year');
        $table->text('keywords');
        $table->string('file_path');
        $table->foreignId('user_id')->constrained('users'); // Reference to users table
        $table->string('author')->nullable(); // Changed from `author_id`
        $table->string('field')->nullable(); // Changed from `field_id`
        $table->string('genre')->nullable(); // Changed from `genre_id`
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
