<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTableMenus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name',20)->comment('菜单名称');
            $table->char('icon',20)->comment('字体图标名称');
            $table->char('url',50)->default('#')->comment('参数及路由');
            $table->integer('parent_id')->default(0)->comment('父级id');
            $table->integer('menu_order')->default(0)->comment('菜单排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('menus');
    }
}
