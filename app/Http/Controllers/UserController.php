<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Hash;
use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Redirect;
use Validator;
use Session;
	class UserController extends Controller {
		public function login() {
			return view('user.login');
		}
		public function logout() {
			Auth::logout();
			return redirect()->to('/')->with('message', 'Your are logged out!');
		}
		public function signup(Request $request) {
			$userObj = User::where('email_id','=',Input::get('email'))->orWhere('mobile_number','=',Input::get('email'))->first();
			if (is_object($userObj)) {
				if (isset($userObj->status) && $userObj->status == 'Y') {
					if (isset($userObj->status)) {
						if ($userObj->status == 'Y') {
							if (Auth::attempt(array('email_id' => Input::get('email'), 'password' => Input::get('password')))) {
								return Redirect::to('dashboard/dashboard');
							} else {
								return Redirect::to('/')
										->with('error', 'username/password combination was incorrect')
										->withInput();
							}
						} else {
							return Redirect::to('/')
									->with('error', 'Your account is expired.')
									->withInput();
						}
					}
					
				} else if (isset($userObj->status) && $userObj->status == 'P') {
					return Redirect::to('/')
							->with('error', 'Your account is Pending.')
							->withInput();
				} else {
					return Redirect::to('/')
							->with('error', 'Your account is inactive.')
							->withInput();
				}
			} else {
				return Redirect::to('/')
						->with('error', 'Invalid login.')
						->withInput();
			}
		}
		public function addUser(Request $request) {
			$dbObj    	   = [];
			$page_limit    = 10;
			$dbObj         = User::paginate($page_limit);
			$roleArr       = Controller::getRoleListForUser('t_roles','role_name');
			if ($request->has('search') && $request->get('search')!='') {
				$keyword        =	$request->get('search');
				$dbObj          = 	User::where('full_name','LIKE','%'.$keyword.'%')
											->orWhere('mobile_number','LIKE','%'.$keyword.'%')
											->paginate($page_limit);
			}
			return View::make('user.add_user',compact('dbObj','roleArr'));
		}
		public function addUserData($_id = 0) {
			$viewDataObj = "";
			$id = base64_decode(base64_decode($_id));
			$roleArr       = Controller::getRoleListForUser('t_roles','role_name');
			if ($id != '') {
				 $viewDataObj = User::find($id);
			}
			return View::make('user.add_user_data',compact('viewDataObj','roleArr'));
		}
		public function validateMasterUser() {
			$valiationArr = array();
			$formValArr = array();
			parse_str(Input::all()['formData'], $formValArr);
			if (is_array($formValArr) && count($formValArr) > 0) {
				if (isset($formValArr['User']) && is_array($formValArr['User']) && count($formValArr['User']) > 0) {
					$validator = Validator::make($formValArr['User'], User::$rules['master'], User::$messages);
					if ($validator->fails()) {
						$errorArr = $validator->getMessageBag()->toArray();
						if (isset($errorArr) && is_array($errorArr) && count($errorArr) > 0) {
							foreach ($errorArr as $errorKey => $errorVal) {
								$valiationArr[] = array(
									'modelField' => $errorKey,
									'modelErrorMsg' => $errorVal[0],
								);
							}
						}
						echo '****FAILURE****' . json_encode($valiationArr);
						exit;
					} else {
						echo '****SUCCESS****Successfully Validated.';
					}
				}
			}exit;
		}
    
		public function validateMasterUsers() {
			$valiationArr = array();
			$formValArr = array();
			parse_str(Input::all()['formData'], $formValArr);
			if (is_array($formValArr) && count($formValArr) > 0) {
				if (isset($formValArr['User']) && is_array($formValArr['User']) && count($formValArr['User']) > 0) {
					$validator = Validator::make($formValArr['User'], User::$rules['update'], User::$messages);
					if ($validator->fails()) {
						$errorArr = $validator->getMessageBag()->toArray();
						if (isset($errorArr) && is_array($errorArr) && count($errorArr) > 0) {
							foreach ($errorArr as $errorKey => $errorVal) {
								$valiationArr[] = array(
									'modelField' => $errorKey,
									'modelErrorMsg' => $errorVal[0],
								);
							}
						}
						echo '****FAILURE****' . json_encode($valiationArr);
						exit;
					} else {
						echo '****SUCCESS****Successfully Validated.';
					}
				}
			}exit;
		}
		public function saveMasterUser(Request $request){
			$formData 								= 	Input::all();
			if (isset(Auth::user()->_id) && Auth::user()->_id) {
				//echo'<pre>';print_r($formData);echo'</pre>';exit;
				$id = $formData['_id'];
				if (isset($id) && $id != 0) {
					$user_data 								=    User::where('full_name','=',$formData['User']['full_name'])
																		->where('mobile_number','=',$formData['User']['mobile_number'])
																		->where('_id','!=',$id)
																		->count();
					if($user_data == 0){
						$tableObjCnt2 		= 	User::where('profile_photo', '!=', '')->where('_id','=',$id);
                        $tableObjCnt3 		= 	$tableObjCnt2->count();
                        $tableObjCnt4		= 	$tableObjCnt2->first();
                        $image = $request->file('image');
                        if ($tableObjCnt3 > 0) {
                            $photoName 		= 	$tableObjCnt4->profile_photo;
                        } else {
                            $photoName 		= 	'';
                        }
                        if ($image != '') {
                            $image_name = $image->getClientOriginalName();
                            $fileExt = $image->getClientOriginalExtension();
                            $fileSize = $image->getSize();
                            $photo_download_name = uniqid() . '_' . time() . '.' . $fileExt;
                            $orig_file_path = public_path() . "/user/orig";
                            if (isset(Auth::user()->_id)) {
                                $photoName = Auth::user()->_id . '_' . uniqid() . '.' . $fileExt;
                            } else {
                                $photoName = uniqid() . '.' . $fileExt;
                            }
                            $upload_success = $image->move($orig_file_path, $photoName, 100, 100);
                        }
						
						$user        						=   User::find($id);
						$user->full_name                    =   $formData['User']['full_name'];
						$user->email_id                   	=   $formData['User']['email_id'];
						$user->mobile_number                =   $formData['User']['mobile_number'];
						$user->role_id                      =   $formData['User']['role_id'];
						$user->ogr_password                 =   $formData['User']['ogr_password'];
						$user->re_password                  =   Hash::make($formData['User']['ogr_password']);
						$user->password                     =   Hash::make($formData['User']['ogr_password']);
						$user->remember_token               =   $formData['_token'];
						$user->profile_photo                =   $photoName;
						$user->status                       =   'Y';
						$user->save();
						if($user){
							Session::flash('message','User has been update successfully.');
							return back();
						}else{
							Session::flash('error','Unable to save data.');
							return back();
						}
					}else{
						Session::flash('error','This User already Exist');
						return back();
					}
				}else{
					$image = $request->file('image');
                    $photoName = '';
                    if ($image != '') {
                        $image_name = $image->getClientOriginalName();
                        $fileExt = $image->getClientOriginalExtension();
                        $fileSize = $image->getSize();
                        $photo_download_name = uniqid() . '_' . time() . '.' . $fileExt;
                        $orig_file_path = public_path() . "/user/orig";
                        if (isset(Auth::user()->_id)) {
                            $photoName = Auth::user()->_id . '_' . uniqid() . '.' . $fileExt;
                        } else {
                            $photoName = uniqid() . '.' . $fileExt;
                        }
                        $upload_success = $image->move($orig_file_path, $photoName, 100, 100);
                    }
					
					$user_data 								=   User::where('full_name','=',$formData['User']['full_name'])
																	->where('mobile_number','=',$formData['User']['mobile_number'])
																	->where('status','=','Y')
																	->count();
					if($user_data == 0){
						$user     							= 	new User();
						$user->full_name                    =   $formData['User']['full_name'];
						$user->email_id                   	=   $formData['User']['email_id'];
						$user->mobile_number                =   $formData['User']['mobile_number'];
						$user->role_id                      =   $formData['User']['role_id'];
						$user->ogr_password                 =   $formData['User']['ogr_password'];
						$user->re_password                  =   Hash::make($formData['User']['ogr_password']);
						$user->password                     =   Hash::make($formData['User']['ogr_password']);
						$user->remember_token               =   $formData['_token'];
						$user->profile_photo                =   $photoName;
						$user->status                       =   'Y';
						$user->save();
						if($user){
							Session::flash('message','User has been saved successfully.');
							return back();
						}else{
							Session::flash('error','Unable to save data.');
							return back();
						}
					}else{
						Session::flash('error','This User already Exist');
						return back();
					}
				}	 
			 } else {
		   
		        return Redirect::to('user/login');
		    }exit;
		}
		public function userActive($_id=0) {
			if (isset(Auth::user()->_id) && Auth::user()->_id) {
				$id 						= 	 base64_decode(base64_decode($_id));
				$user        				=    User::find($id);
				$user->status		        =	 'Y';
				$user->save();
				if($user){
					Session::flash('message','user has been Active successfully.');
					return back();
				}else{
					Session::flash('error','Unable to update record.');
					return back();
				}
		    } else {
				return Redirect::to('user/login');
		    }exit;
		}

		public function userDeactive($_id=0) {
			if (isset(Auth::user()->_id) && Auth::user()->_id) {
				$id 						= 	 base64_decode(base64_decode($_id));
				$user        				=    User::find($id);
				$user->status		        =	 'N';
				$user->save();
				if($user){
					Session::flash('message','user has been In-active successfully.');
					return back();
				}else{
					Session::flash('error','Unable to update record.');
					return back();
				}
		    } else {
				return Redirect::to('user/login');
		    }exit;
		}
	}