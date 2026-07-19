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
        Schema::table('payrolls', function (Blueprint $table) {
            $table->enum('status_pembayaran', ['belum_dibayar', 'sudah_dibayar'])
                  ->default('belum_dibayar')
                  ->after('status');
            $table->timestamp('dibayar_at')->nullable()->after('status_pembayaran');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payrolls', function (Blueprint $table) {
            $table->dropColumn(['status_pembayaran', 'dibayar_at']);
        });
    }
};
