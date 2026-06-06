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
        Schema::create('movements', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->enum('type',['income','spent']);
            $table->decimal('amount',10,2);
            $table->text('description');
            $table->date('date');
            $table->date('end_date')->nullable();
            $table->boolean('fixed')->default(false);
            $table->enum('frequency', ['one_time', 'weekly', 'monthly', 'yearly'])
                  ->default('one_time');

            $table->foreignUlid('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');
            $table->foreignUlid('account_id')
                  ->constrained('accounts')
                  ->onDelete('cascade');
            $table->foreignUlid('category_id')
                  ->constrained('categories')
                  ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
