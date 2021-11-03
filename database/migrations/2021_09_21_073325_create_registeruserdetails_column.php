<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegisteruserdetailsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb'; 
    public function up()
    {
        Schema::table('t_regd_user_details', function (Blueprint $collection) {
            $collection->bigInteger('t_board_details_id',100);
            $collection->bigInteger('t_class_details_id',100);
            $collection->string('full_name',100);
            $collection->string('email_id',100);
            $collection->string('mobile_number',100);
            $collection->string('institute_name',200);
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
        Schema::table('t_regd_user_details', function (Blueprint $table) {
            //
        });
    }
}
