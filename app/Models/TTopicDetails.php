<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TTopicDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_topic_details';
    public static $rules = array(
        'topic_name' => 'required',
        't_subject_details_id' => 'required',
    );
    public static $messages = array(
        'topic_name.required' => 'Please Add Topic Name',
        't_subject_details_id.required' => 'Please Add Subject Name',
    );

}
