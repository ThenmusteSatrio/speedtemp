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
        Schema::create("tbl_kembali", function (Blueprint $table) {
            $table->id();
            $table->integer("id_transaksi");
            $table->date("tgl_kembali");
            $table->text("kondisi_mobil");
            $table->decimal("denda", 10, 2);
            $table->foreign("id_transaksi")->references("id")->on("tbl_transaksi")->onDelete("cascade");
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
