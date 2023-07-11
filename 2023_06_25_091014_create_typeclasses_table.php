<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeclassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeclasses', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('price');
            $table->string('subtotal')->default('')->nullable();
            $table->string('total')->default('')->nullable();
            $table->string('user_id');
            $table->string('quantity');
            $table->string('receiver_id')->default('')->nullable();
            $table->string('type2')->default('')->nullable();
            $table->unsignedBigInteger('invoices_id');
            $table->foreign('invoices_id')
                ->references('id')->on('invoices')
                ->onDelete('cascade');
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
        Schema::dropIfExists('typeclasses');
    }

    public function invoices(){
        return $this->belongsTo(Invoice::class, 'id');
    }
}
