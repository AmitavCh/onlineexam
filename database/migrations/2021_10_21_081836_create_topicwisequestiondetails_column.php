<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicwisequestiondetailsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb'; 
    public function up()
    {
        Schema::table('t_topic_wise_question_details', function (Blueprint $collection) {
            $collection->bigInteger('t_class_details_id',100);
            $collection->bigInteger('t_subject_details_id',100);
            $collection->bigInteger('t_topic_details_id',100);
            $collection->text('question_details');
            $collection->text('option1');
            $collection->text('option2');
            $collection->text('option3');
            $collection->text('option4');
            $collection->text('image_photo');
            $collection->text('correct_option');
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
        Schema::table('t_topic_wise_question_details', function (Blueprint $table) {
            //
        });
    }
}
