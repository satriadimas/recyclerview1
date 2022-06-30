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
        Schema::create('supplier_goods', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->index();
            $table->string('code', 50);
            $table->string('name', 100);
            $table->decimal('price', 9, 2);
            $table->enum('unit', ['pcs', 'kg', 'can']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_goods');
    }
};
