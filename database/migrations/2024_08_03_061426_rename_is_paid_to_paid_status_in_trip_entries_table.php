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
        Schema::table('trip_entries', function (Blueprint $table) {
            $table->renameColumn('isPaid', 'paid_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trip_entries', function (Blueprint $table) {
            $table->renameColumn('paid_status', 'isPaid');
        });
    }
};