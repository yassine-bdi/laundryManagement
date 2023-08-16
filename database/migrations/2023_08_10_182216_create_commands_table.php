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
        Schema::create('commands', function (Blueprint $table) {
            $table->id();
            $table->json('items'); 
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); 
            $table->unsignedBigInteger('service_id'); 
            $table->foreign('by')->references('id')->on('workers')->onDelete('cascade'); 
            $table->unsignedBigInteger('by'); 
            $table->unsignedDecimal('total_price'); 
            $table->string('client')->nullable(); 
            $table->string('delivery_address')->nullable(); 
            $table->string('note')->nullable(); 
            $table->date('wanted_at')->nullable(); 
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
        Schema::dropIfExists('commands');
    }
};
