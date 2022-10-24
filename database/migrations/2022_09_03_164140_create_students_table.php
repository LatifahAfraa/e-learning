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
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            //
            $table->foreignId('parent_id')->nullable();  //parent nama tabel, id tu sesuai nama primary key yang ada pada tabel parent
            $table->string('nisn')->unique()->nullable();
            $table->string('kelas')->nullable();
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
        Schema::dropIfExists('students');
    }
};
