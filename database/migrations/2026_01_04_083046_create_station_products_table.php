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
        Schema::create('station_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('station_id');;
            $table->decimal('price', 10, 2);
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->boolean('is_active')->default(true);
            $table->integer('quantity')->default(0);
            $table->boolean('has_stock_limit')->default(false);
            $table->softDeletes();
            $table->timestamps();

            $table->unique(['station_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('station_products', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::dropIfExists('station_products');
    }
};
