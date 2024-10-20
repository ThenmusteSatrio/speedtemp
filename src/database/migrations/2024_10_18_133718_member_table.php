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
        Schema::create("tbl_member", function (Blueprint $table) {
            $table->integer("nik")->primary();
            $table->string("nama", 100);
            $table->enum("jk", ["L", "P"]);
            $table->string("telp", 15);
            $table->text("alamat");
            $table->string("user", 50);
            $table->string("password", 100);
            $table->rememberToken();
            $table->timestamps();
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
