<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TSubjectDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_subject_details';
    public static $rules = array(
        'subject_name' => 'required',
    );
    public static $messages = array(
        'subject_name.required' => 'Please Add Subject Name',
    );

}
