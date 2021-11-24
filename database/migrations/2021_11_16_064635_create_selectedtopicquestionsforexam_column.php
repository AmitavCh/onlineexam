<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSelectedtopicquestionsforexamColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb';
    public function up()
    {
        Schema::table('t_user_selected_topic_questions_for_exam', function (Blueprint $collection) {
            $collection->bigInteger('user_id',100);
            $collection->bigInteger('t_exam_id',100);
            $collection->bigInteger('t_topic_details_id',100);
            $collection->bigInteger('t_subject_details_id',100);
            $collection->bigInteger('t_user_selected_topic_for_exam_id',100);
            $collection->bigInteger('t_topic_wise_question_details_id',100);
            $collection->date('date');
            $collection->string('questions_status',10);
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
        Schema::table('t_user_selected_topic_questions_for_exam', function (Blueprint $table) {
            //
        });
    }
}
