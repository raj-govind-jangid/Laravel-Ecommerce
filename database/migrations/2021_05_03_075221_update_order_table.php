<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_first_name')->after('order_size_id');
            $table->string('order_last_name')->after('order_first_name');
            $table->string('order_phoneno')->after('order_last_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('order_first_name');
            $table->dropColumn('order_last_name');
            $table->dropColumn('order_phoneno');
        });
    }
}
