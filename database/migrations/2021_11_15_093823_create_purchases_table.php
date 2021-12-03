<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('name');
            $table->text('name_kana');
            $table->string('tel1', 5);
            $table->string('tel2', 5);
            $table->string('tel3', 5);
            $table->string('postal_code1', 3);
            $table->string('postal_code2', 4);
            $table->tinyinteger('pref')->unsigned();
            $table->string('city', 15);
            $table->string('address', 100);
            $table->string('other', 100)->nullable()->default(NULL);
            $table->text('billing_name');
            $table->text('billing_name_kana');
            $table->text('billing_mail');
            $table->string('billing_tel1', 5);
            $table->string('billing_tel2', 5);
            $table->string('billing_tel3', 5);
            $table->tinyinteger('payment_id')->unsigned();
            $table->mediuminteger('sub_price')->unsigned();
            $table->smallinteger('shipping_price')->unsigned();
            $table->mediuminteger('total_price')->unsigned();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at', 6)->nullable()->default(NULL);
            $table->boolean('delete_flg')->default(FALSE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchases');
    }
}
