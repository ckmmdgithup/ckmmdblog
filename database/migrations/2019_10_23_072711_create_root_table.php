<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRootTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('root', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->char('name',50)->comment('管理员名称');
            $table->char('password',250)->comment('管理员密码');
            $table->tinyInteger('status')->comment('管理员状态')->default(0);



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('root');
    }
}
