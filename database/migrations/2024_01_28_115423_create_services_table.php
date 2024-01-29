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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_contract');
            $table->foreign('id_contract')->references('id')->on('contracts');
            $table->unsignedBigInteger('id_quotation');
            $table->foreign('id_quotation')->references('id')->on('quotations');
            $table->unsignedBigInteger('id_project');
            $table->foreign('id_project')->references('id')->on('project_models');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
