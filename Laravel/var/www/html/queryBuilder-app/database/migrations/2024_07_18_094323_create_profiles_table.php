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
        Schema::connection('pgsql2')->create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mngmnt_id');
            $table->string('bio')->nullable(false)->default('no bio');
            $table->timestamps();

            $table->foreign('mngmnt_id')->references('id')->on('management')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('pgsql2')->dropIfExists('profiles');
    }
};
