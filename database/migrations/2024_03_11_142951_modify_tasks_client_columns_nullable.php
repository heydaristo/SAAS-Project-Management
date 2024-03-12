<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTasksClientColumnsNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tasks_clients', function (Blueprint $table) {
            // Ubah kolom id_client agar dapat bernilai null
            $table->unsignedBigInteger('id_client')->nullable()->change();

            // Ubah kolom due_date agar dapat bernilai null
            $table->date('tasks_due_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tasks_client', function (Blueprint $table) {
            // Ubah kembali kolom id_client agar tidak dapat bernilai null
            $table->unsignedBigInteger('id_client')->nullable(false)->change();

            // Ubah kembali kolom due_date agar tidak dapat bernilai null
            $table->date('tasks_due_date')->nullable(false)->change();
        });
    }
}

