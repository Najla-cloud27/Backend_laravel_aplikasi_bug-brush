<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kutipan', function (Blueprint $table) {
            $table->string('penulis')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('kutipan', function (Blueprint $table) {
            $table->string('penulis')->nullable(false)->change();
        });
    }
};
