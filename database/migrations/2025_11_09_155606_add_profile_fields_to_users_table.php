<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile_photo_path')->nullable()->after('password');
            $table->string('social_media')->nullable()->after('profile_photo_path');
            $table->text('description')->nullable()->after('social_media');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo_path');
            $table->dropColumn('social_media');
            $table->dropColumn('description');
        });
    }
};