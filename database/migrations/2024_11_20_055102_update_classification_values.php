<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('files', function (Blueprint $table) {
            DB::table('files')->where('classification', 'umum')->update(['classification' => 'terbuka']);
            DB::table('files')->where('classification', 'rahasia')->update(['classification' => 'tertutup']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('files', function (Blueprint $table) {
            DB::table('files')->where('classification', 'terbuka')->update(['classification' => 'umum']);
            DB::table('files')->where('classification', 'tertutup')->update(['classification' => 'rahasia']);
        });
    }
};
