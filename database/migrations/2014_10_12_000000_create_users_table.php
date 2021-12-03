<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('login_id');
            $table->text('password');
            $table->text('name');
            $table->text('name_kana');
            $table->string('birth_year', 4)->nullable()->default(NULL);
            $table->string('birth_month', 2)->nullable()->default(NULL);
            $table->string('birth_day', 2)->nullable()->default(NULL);
            $table->tinyinteger('gender')->unsigned();
            $table->text('mail');
            $table->string('tel1', 5);
            $table->string('tel2', 5);
            $table->string('tel3', 5);
            $table->string('postal_code1', 3);
            $table->string('postal_code2', 4);
            $table->tinyinteger('pref')->unsigned();
            $table->string('city', 15);
            $table->string('address', 100);
            $table->string('other', 100)->nullable()->default(NULL);
            $table->string('memo')->nullable()->default(NULL);
            $table->tinyinteger('status')->unsigned();
            $table->timestamp('last_login_at')->nullable()->default(NULL);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->default(NULL);
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
        Schema::dropIfExists('users');
    }
}
