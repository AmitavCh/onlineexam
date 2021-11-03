<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateUsersColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	protected $connection = 'mongodb'; 
    public function up()
    {
        Schema::table('users', function (Blueprint $collection) {
            $collection->bigIncrements('role_id',10);
            $collection->string('full_name',100);
            $collection->string('email',75);
			$collection->string('mobile_number',75);
            $collection->string('password',75);
			$collection->string('re_password',75);
			$collection->string('org_password',75);
            $collection->string('remember_token',75)->rememberToken();
			$collection->string('is_reset_req',75);
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
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
