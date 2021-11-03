<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	protected $connection = 'mongodb';  
    public function up()
    {
        Schema::table('t_menus', function (Blueprint $collection) {
            $collection->bigIncrements('pid',10);
            $collection->string('menu_name',100);
            $collection->integer('menu_order',100);
            $collection->string('menu_url',100);
            $collection->string('menu_icon',75);
			$collection->string('controller',75);
			$collection->string('is_active',10);
			$collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('t_menus', function (Blueprint $table) {
            //
        });
    }
}
