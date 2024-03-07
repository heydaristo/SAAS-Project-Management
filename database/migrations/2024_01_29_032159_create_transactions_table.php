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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_project');
            $table->foreign('id_project')->references('id')->on('project_models');
            $table->unsignedBigInteger('id_invoice')->nullable();
            $table->foreign('id_invoice')->references('id')->on('invoices');
            $table->unsignedBigInteger('id_payment')->nullable();
            $table->foreign('id_payment')->references('id')->on('payments');
            $table->boolean('is_income');
            $table->string('source');
            $table->string('description');
            $table->string('category');
            $table->bigInteger('amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
