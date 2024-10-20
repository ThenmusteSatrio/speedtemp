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
        Schema::create("tbl_transaksi", function (Blueprint $table) {
            $table->id();
            $table->integer("nik");
            $table->string("nopol", 10);
            $table->date("tgl_booking");
            $table->date("tgl_ambil");
            $table->date("tgl_kembali");
            $table->tinyInteger("supir");
            $table->decimal("downpayment", 10, 2);
            $table->decimal("kekurangan", 10, 2);
            $table->enum("status", ["booking", "approve", "ambil", "kembali"]);
            $table->foreign("nik")->references("nik")->on("tbl_member")->onDelete("cascade");
            $table->foreign("nopol")->references("nopol")->on("tbl_mobil")->onDelete("cascade");
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
