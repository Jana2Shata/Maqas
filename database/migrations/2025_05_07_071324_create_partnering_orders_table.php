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
        Schema::create('partnering_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained();
            $table->enum('status', ['Waiting','Accepted', 'Rejected'])->default('Waiting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partnering_orders');
    }
};
