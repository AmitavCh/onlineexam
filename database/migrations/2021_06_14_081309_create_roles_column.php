<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	protected $connection = 'mongodb';  
    public function up()
    {
        Schema::table('t_roles', function (Blueprint $collection) {
            $collection->increments('pid',10);
            $collection->string('role_name',100);
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
        Schema::table('t_roles', function (Blueprint $collection) {
            //
        });
    }
}
