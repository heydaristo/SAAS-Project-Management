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
        Schema::table('contracts', function (Blueprint $table) {
            $table->boolean('require_deposit')->default(false);
            $table->decimal('deposit_amount', 10, 2)->nullable(); 
            $table->decimal('deposit_percentage', 10, 2)->nullable();
            $table->boolean('client_agrees_deposit')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contracts', function (Blueprint $table) {
            $table->dropColumn('require_deposit');
            $table->dropColumn('deposit_amount');
            $table->dropColumn('deposit_percentage');
            $table->dropColumn('client_agrees_deposit');
        });
    }
};
