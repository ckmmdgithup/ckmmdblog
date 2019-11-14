<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryCreateOrderField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('categories', function (Blueprint $table) {

            $table->integer('order')->comment('排序');
            $table->char('path',50)->comment('寻祖路径');
            $table->char('sort',50)->comment('类型');
            $table->char('title',50)->comment('分类标题');
            $table->char('keywords',255)->comment('关键词，用于seo');
            $table->char('description',255)->comment('简述，用于seo');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('categories', function (Blueprint $table) {

            $table->dropColumn('order');
            $table->dropColumn('path');
            $table->dropColumn('sort');
            $table->dropColumn('title');
            $table->dropColumn('keywords');
            $table->dropColumn('description');



        });
    }

}
