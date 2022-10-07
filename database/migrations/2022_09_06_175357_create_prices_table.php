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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id'); 
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade'); 
            $table->unsignedBigInteger('laundry_id'); 
            $table->foreign('laundry_id')->references('id')->on('laundries')->onDelete('cascade'); 
            $table->float('price'); 
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
        Schema::dropIfExists('prices');
    }
};
