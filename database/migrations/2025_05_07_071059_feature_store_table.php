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
        Schema::create('feature_store', function (Blueprint $table) {
        $table->id();
        $table->foreignId('store_id')->constrained();
        $table->foreignId('feature_id')->constrained();
       // $table->unique(['feature_id', 'store_id']);
        $table->timestamps();
        $table->softDeletes();
        });
           
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feature_stores');
    }
};
