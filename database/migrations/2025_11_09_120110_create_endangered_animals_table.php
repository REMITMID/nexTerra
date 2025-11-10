<?php

// database/migrations/xxxx_create_endangered_animals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('endangered_animals', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Hewan, cth: Orang Utan (Pongo)
            $table->string('origin'); // Asal Hewan, cth: Indonesia
            $table->text('description'); // Deskripsi Hewan
            $table->string('image_path'); // Path gambar hewan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('endangered_animals');
    }
};