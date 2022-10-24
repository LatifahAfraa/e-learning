<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            //
            $table->string('nip')->unique();
            $table->string('mapel')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('status_kepegawaian')->nullable();
            $table->string('ttd')->nullable();
            $table->string('foto')->nullable();

            $table->timestamps();
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
};
