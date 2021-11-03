<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TTopicWiseQuestionDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_topic_wise_question_details';
    public static $rules = array(
        't_class_details_id' => 'required',
        't_subject_details_id' => 'required',
        't_topic_details_id' => 'required',
        'option1' => 'required',
        'option2' => 'required',
        'option3' => 'required',
        'option4' => 'required',
        'question_details' => 'required',
    );
    public static $messages = array(
        't_class_details_id.required' => 'Please Add Class Name',
        't_subject_details_id.required' => 'Please Add Subject Name',
        't_topic_details_id.required' => 'Please Add Topic Name',
        'option1.required' => 'Please Add Option Data',
        'option2.required' => 'Please Add Option Data',
        'option3.required' => 'Please Add Option Data',
        'option4.required' => 'Please Add Option Data',
        'question_details.required' => 'Please Add Questions Details',
    );

}
