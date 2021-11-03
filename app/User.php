<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $connection = 'mongodb';
	protected $collection = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
	public static $rules = array(
		'master' => array(

					'role_id'                   => 'required',
					'mobile_number'             => 'required|max:10|min:10',
					'full_name'                 => 'required',
					'email_id'                  => 'required|email|unique:users',
					'ogr_password'              => 'required',
		 ),
		'update' => array(

					'role_id'                   => 'required',
					'mobile_number'             => 'required|max:10|min:10',
					'full_name'                 => 'required',
					'email_id'                  => 'required|email',
					'ogr_password'              => 'required',
		 ),
		
		'changepassword' => array(
					'ogr_password' 	=> 'required',
					'password' => 'required|same:re_password',
				    're_password' => 'required',
		 ),
		 'resetpasswordemail'	=>	array(
						'email_forgot'	=>	'required',
			),
		'resetpassword' => array(
				'new_password' => 'required',
			),	
	);

	public static $messages = array(

					'role_id.required'                                              => 'Please Select Role Name',
					'full_name.required'                                            => 'Enter Your Full Name',
					'email_id.required'                                             => 'Enter Your Email Id',
					'email_id.email'                                                => 'Enter valid email id',
					'ogr_password.required'                                         => 'Enter Your Password',
					're_password.required'                                          => 'Enter Your Password',
					'mobile_number.required'                                        => 'Please Add Mobile Number',
					'mobile_number.max'                                             => 'Please Add 10 Digit Mobile Number',
					'mobile_number.min'                                             => 'Please Add 10 Digit Mobile Number',
					'password.confirmed'                                            => 'Password confirmation does not match.',
					're_password.same'                                              => 'Password Confirmation should match the Password',
					'email_forgot.required' 										=> 'Please Enter The Email Id',
					'email_forgot.email' 											=> 'Please Enter Valid Email Id',
					'new_password.required' 										=> 'This field is required',
	);

}
