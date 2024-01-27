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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_name', 100);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('status', 100);
            $table->string('quotation_pdf');
            $table->unsignedBigInteger('id_client');
            $table->foreign('id_client')->references('id')->on('clients');
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
        /**
         * Drop the 'quotations' table if it exists.
         */
        Schema::dropIfExists('quotations');
    }
};
