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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->enum('status', ['pending', 'processing', 'shipped', 'delivered', 'cancelled', 'on hold', 'returned', 'refunded'])->default('pending');
            $table->string('billing_address_line_1');
            $table->string('billing_address_line_2')->nullable();
            $table->string('billing_city');
            $table->string('billing_state');
            $table->string('billing_post_code');
            $table->string('billing_country');
            $table->string('shipping_address_line_1');
            $table->string('shipping_address_line_2')->nullable();
            $table->string('shipping_city');
            $table->string('shipping_state');
            $table->string('shipping_post_code');
            $table->string('shipping_country');
            $table->string('credit_card_type');
            $table->smallInteger('credit_card_last_four');
            $table->string('customer_note', 500)->nullable();
            $table->timestampsTz();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
