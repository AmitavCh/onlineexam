<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class TUserSelectedTopicForExam extends Eloquent{
	protected $connection = 'mongodb';
    protected $collection = 't_user_selected_topic_for_exam';
    public static $rules = array(
        //'role_name' => 'required',
    );
    public static $messages = array(
       // 'role_name.required' => 'Please Add Role Name',
    );

}