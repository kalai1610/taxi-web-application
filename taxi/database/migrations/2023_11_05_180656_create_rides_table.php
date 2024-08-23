<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')->on('customers')->onDelete('cascade');
            $table->string('pickup_latitude');
            $table->string('pickup_longitude');
            $table->string('destination_latitude');
            $table->string('destination_longitude');
            $table->string('pickup_address');
            $table->string('destination_address');
            $table->float('distance');
            $table->float('amount');
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->foreign('driver_id')
                ->references('id')->on('drivers')->onDelete('cascade');
            $table->dateTime('time');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
