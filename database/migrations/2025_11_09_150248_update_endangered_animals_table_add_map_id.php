<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('endangered_animals', function (Blueprint $table) {
            // Hapus kolom 'origin' yang lama (jika ada)
            $table->dropColumn('origin'); 
            
            // Tambahkan foreign key ke tabel 'maps'
            $table->foreignId('map_id')->nullable()->after('name')->constrained('maps')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('endangered_animals', function (Blueprint $table) {
            // Kembalikan kolom 'origin' jika rollback
            $table->dropConstrainedForeignId('map_id');
            $table->string('origin')->nullable()->after('name');
        });
    }
};