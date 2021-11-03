<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBoardDetailsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb'; 
    public function up()
    {
        Schema::table('t_board_details', function (Blueprint $collection) {
            $collection->string('board_name',100);
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
        Schema::table('t_board_details', function (Blueprint $table) {
            //
        });
    }
}
