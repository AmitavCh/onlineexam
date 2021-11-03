<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TNoticeDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_notice_details';
    public static $rules = array(
        't_board_details_id' => 'required',
        't_class_details_id' => 'required',
        'notice_details' => 'required',
    );
    public static $messages = array(
        't_board_details_id.required' => 'Please Select Board Name',
        't_class_details_id.required' => 'Please Select Class Name',
        'notice_details.required' => 'Please Add Notice Details',
    );

}
