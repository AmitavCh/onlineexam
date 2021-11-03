<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateSubmenusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	protected $connection = 'mongodb';  
    public function up()
    {
        Schema::table('t_sub_menus', function (Blueprint $collection) {
            $collection->bigInteger('t_menu_id',100);
            $collection->string('sub_menu_name',100);
            $collection->integer('sub_menu_order',100);
            $collection->string('sub_menu_url',100);
            $collection->string('sub_menu_icon',75);
			$collection->string('action',75);
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
        Schema::table('t_sub_menus', function (Blueprint $table) {
            //
        });
    }
}
