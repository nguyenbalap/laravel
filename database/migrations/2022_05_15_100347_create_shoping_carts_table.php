<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shoping_carts', function (Blueprint $table) {



            // $table->foreignId('customer_id')->constrained();
            // $table->foreignId('product_id')->constrained();

            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("customer_id");
            $table->primary(['product_id', 'customer_id']);

            $table->foreign('product_id')
                ->references('id')
                ->on('products');

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers');

            $table->integer("quantity");
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shoping_carts');
    }
};