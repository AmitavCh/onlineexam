<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TRegdUserDetails extends Eloquent {

    protected $connection = 'mongodb';
    protected $collection = 't_regd_user_details';
    public static $rules = array(
        't_board_details_id' => 'required',
        't_class_details_id' => 'required',
        'full_name' => 'required',
        'email_id' => 'required|email|unique:t_regd_user_details',
        'mobile_number' => 'required|max:10|min:10|unique:t_regd_user_details',
        'institute_name' => 'required',
    );
    public static $messages = array(
        't_board_details_id.required' => 'Please Select Board Name',
        't_class_details_id.required' => 'Please Select Class Name',
        'full_name.required' => 'Please Enter Your Full Name',
        'email_id.required' => 'Enter Your Email Id',
        'email_id.email' => 'Enter valid email id',
        'email_id.unique' => 'This Email Id Is Already Exist',
        'mobile_number.unique' => 'This Mobile Number Is Already Exist',
        'mobile_number.required' => 'Please Add Mobile Number',
        'mobile_number.max' => 'Please Add 10 Digit Mobile Number',
        'mobile_number.min' => 'Please Add 10 Digit Mobile Number',
        'institute_name.required' => 'Please Enter Your Institute Name',
    );

}
