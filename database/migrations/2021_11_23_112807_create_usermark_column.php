<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermarkColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb';
    public function up()
    {
        Schema::table('t_user_mark', function (Blueprint $collection) {
            $collection->bigInteger('user_id',100);
            $collection->bigInteger('t_exam_id',100);
            $collection->bigInteger('t_topic_details_id',100);
            $collection->bigInteger('t_user_selected_topic_questions_for_exam_id',100);
            $collection->date('exam_submit_date');
            $collection->date('graph_date');
            $collection->string('marks',10);
            $collection->string('total_number_of_marks',10);
            $collection->string('topic_name',100);
            $collection->string('mark_type',10);
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
        Schema::table('t_user_mark', function (Blueprint $table) {
            //
        });
    }
}
