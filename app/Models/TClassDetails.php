<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TClassDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_class_details';
    public static $rules = array(
        'class_name' => 'required',
        't_board_details_id' => 'required',
    );
    public static $messages = array(
        'class_name.required' => 'Please Add Class Name',
        't_board_details_id.required' => 'Please Select Board Name',
    );

}
