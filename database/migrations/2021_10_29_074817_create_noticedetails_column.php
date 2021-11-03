<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticedetailsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb'; 
    public function up()
    {
        Schema::table('t_notice_details', function (Blueprint $collection) {
            $collection->bigInteger('t_board_details_id',100);
            $collection->bigInteger('t_class_details_id',100);
            $collection->text('notice_details');
            $collection->date('date');
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
        Schema::table('t_notice_details', function (Blueprint $table) {
            //
        });
    }
}
