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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address_1')->nullable();
            $table->string('address_2')->nullable();
            $table->string('city')->nullable();;
            $table->string('state')->nullable();;
            $table->string('zip_code')->nullable();;
            $table->string('country')->nullable();;
            $table->string('phone')->nullable();;
            $table->string('email')->nullable();;
            $table->text('note')->nullable();;
            $table->string('discount_code')->default(null);
            $table->decimal('discount_amount', 10, 2)->default(0.00);
            $table->unsignedBigInteger('shipping_id')->nullable();
            $table->decimal('shipping_amount', 10, 2)->default(0.00);
            $table->decimal('total_amount', 10, 2)->default(0.00);
            $table->string('payment');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->tinyInteger('is_completed')->default(0);
            $table->date('payment_date')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('shipping_id')->references('id')->on('shipping_charge')->onDelete('set null');
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
