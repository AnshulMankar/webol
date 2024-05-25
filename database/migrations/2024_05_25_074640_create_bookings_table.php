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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('supplier');
            $table->string('name');
            $table->string('gender', 10);
            $table->integer('age');
            $table->string('aadhar_card_number', 20);
            $table->string('identity_proof');
            $table->string('address');
            $table->string('state');
            $table->string('status')->default('processing');
            $table->string('city');
            $table->string('phone_number', 15);
            $table->string('covid_status');
            $table->date('date_of_positive')->nullable();
            $table->string('cylinder_option');
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
        Schema::dropIfExists('bookings');
    }
};
