<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TBoardDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_board_details';
    public static $rules = array(
        'board_name' => 'required',
    );
    public static $messages = array(
        'board_name.required' => 'Please Add Board Name',
    );

}
