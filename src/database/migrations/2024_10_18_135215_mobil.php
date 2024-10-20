<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("tbl_mobil", function (Blueprint $table) {
            $table->string("nopol", 10)->primary();
            $table->string("brand", 50);
            $table->string("type", 50);
            $table->date("tahun");
            $table->decimal("harga",10,2);
            $table->string("foto", 50);
            $table->enum("status", ["tersedia", "tidak tersedia"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
