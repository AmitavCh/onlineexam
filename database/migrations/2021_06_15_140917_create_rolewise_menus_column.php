<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolewiseMenusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	protected $connection = 'mongodb';
    public function up()
    {
        Schema::table('t_role_menus', function (Blueprint $collection) {
            $collection->bigIncrements('t_role_id',30);
			$collection->bigIncrements('t_menu_id',30);
			$collection->bigIncrements('t_sub_menu_id',30);
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
        Schema::table('t_role_menus', function (Blueprint $table) {
            //
        });
    }
}
