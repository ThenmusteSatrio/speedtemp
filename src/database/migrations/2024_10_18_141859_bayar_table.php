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
        Schema::create("tbl_bayar", function (Blueprint $table) {
            $table->id();
            $table->integer("id_kembali");
            $table->date("tgl_bayar");
            $table->decimal("total_bayar", 10, 2);
            $table->enum("lunas", ["lunas", "belum lunas"]);
            $table->foreign("id_kembali")->references("id")->on("tbl_kembali")->onDelete("cascade");
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
