<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('unit_no');
            $table->string('remarks')->nullable();
            $table->foreignId('model_id')->nullable();
            $table->foreignId('category_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('current_project_id')->nullable(); //lokasi alat saat inu
            $table->string('unit_pic')->nullable();
            $table->string('cart_move_flag')->nullable(); // cart pada saat transaksi perpindahan alat (IPA)
            $table->integer('active')->default(0); // 1 = active, 0 = in-active
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment');
    }
}
