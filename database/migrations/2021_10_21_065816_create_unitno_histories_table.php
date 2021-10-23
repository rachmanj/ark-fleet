<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitnoHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unitno_histories', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('equipment_id')->constrained('equipments')->onDelete('cascade');
            $table->string('old_unit_no');
            $table->string('new_unit_no');
            $table->longtext('remarks')->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('unitno_histories');
    }
}
