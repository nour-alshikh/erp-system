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
        Schema::create('treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name', '255');
            $table->boolean('is_master');
            $table->boolean('is_active');
            $table->integer('last_receipt_exchange');
            $table->integer('last_receipt_collect');
            $table->integer('main_treasury_id')->nullable();
            $table->integer('added_by');
            $table->integer('updated_by');
            $table->integer('company_code');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('treasuries');
    }
};
