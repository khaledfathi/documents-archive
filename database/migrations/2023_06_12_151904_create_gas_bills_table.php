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
        Schema::create('gas_bills', function (Blueprint $table) {
            $table->id();
            $table->date('release_date')->nullable(false); 
            $table->bigInteger('consumption')->nullable(false); 
            $table->double('amount')->nullable(false); 
            $table->integer('month')->nullable(false); 
            $table->integer('year')->nullable(false); 
            $table->text('image')->nullable(false); 
            $table->text('notes')->nullable(true); 
            $table->timestamps();
            //FK
            $table->foreignId('user_id')->nullable(false)->references('id')->on('users')->cascadeOnDelete(); 
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gas_bills');
    }
};
