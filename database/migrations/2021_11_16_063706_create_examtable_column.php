<?php

use Illuminate\Support\Facades\Schema;
use Jenssegers\Mongodb\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamtableColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    protected $connection = 'mongodb'; 
    public function up()
    {
        Schema::table('t_exam', function (Blueprint $collection) {
            $collection->bigInteger('user_id',100);
            $collection->text('exam_type');
            $collection->date('date');
            $collection->string('exam_status',10);
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
        Schema::table('t_exam', function (Blueprint $table) {
            //
        });
    }
}
