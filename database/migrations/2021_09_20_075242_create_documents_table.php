<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('document_type_id'); // BPKB/STNK/POLIS/PO
            $table->string('document_no')->nullable();
            $table->date('document_date');
            $table->unsignedBigInteger('supplier_id')->nullable(); // nama instansi
            $table->bigInteger('amount')->nullable(); //biaya yg dikeluarkan utk pengurusan, incl vat (if any)
            $table->date('due_date')->nullable(); // expire date
            $table->unsignedBigInteger('user_id'); //created by
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
        Schema::dropIfExists('documents');
    }
}
