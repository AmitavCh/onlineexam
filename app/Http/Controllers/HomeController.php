<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TMenu;
use App\Models\TRole;
use App\Models\TSubMenu;
use App\Models\TRoleMenu;
use App\Models\TClassDetails;
use App\Models\TRegdUserDetails;
use App\Models\TSubjectDetails;
use App\Models\TTopicDetails;
use App\User;
use DB;
use Hash;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Redirect;
use Validator;
use Session;
use DateTime;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index(Request $request) {
        return View::make('home.index');
    }

    public function dashboard(Request $request) {
        return View::make('home.dashboard');
    }

    public function aboutus(Request $request) {
        return View::make('home.aboutus');
    }

    public function pricing(Request $request) {
        return View::make('home.pricing');
    }

    public function contact(Request $request) {
        return View::make('home.contact');
    }

    public function register(Request $request) {
        $boardArr       = Controller::getBoardListForClass('t_board_details','board_name');
        return View::make('home.register', compact('boardArr'));
    }

    public function login(Request $request) {
        return View::make('home.login');
    }

    public function topiclist(Request $request) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $regdId = Auth::user()->t_regd_user_details_id;
            $dbObj  = TRegdUserDetails::select('t_class_details_id')->where('_id','=',$regdId)->first();
            $responseObjArr     = TSubjectDetails::select('subject_name','_id')
                                ->where('t_class_details_id','=',$dbObj['t_class_details_id'])
                                ->where('is_active','Y')
                                ->orderby('_id','asc')
                                ->get();
        }else{
            return View::make('home.login');
        }
        return View::make('home.topiclist', compact('responseObjArr'));
    }

    public function changepassword(Request $request) {
        return View::make('home.changepassword');
    }

    public function classnamelist(){
        $this->layout														=   View::make('layouts.ajax');
        $sectionArr															=	array();
        $dataArr															=	Input::all();	
        		
        $response               = '';
        $responseArr[0]['id']   = "";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TClassDetails::select('class_name','_id')
                                ->where('t_board_details_id','=',$dataArr['selectedVal'])
                                ->where('is_active','Y')
                                ->orderby('_id','asc')
                                ->get();
        foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->class_name;
        }
        return $responseArr;
    }

    public function validateUserRegdDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formdata'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TRegdUserDetails']) && is_array($formValArr['TRegdUserDetails']) && count($formValArr['TRegdUserDetails']) > 0) {
                $validator = Validator::make($formValArr['TRegdUserDetails'], TRegdUserDetails::$rules, TRegdUserDetails::$messages);
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

    public function userRegistration(Request $request) {
        $formData = Input::all();
        
        $regduser = new TRegdUserDetails();
        $regduser->t_board_details_id = $formData['TRegdUserDetails']['t_board_details_id'];
        $regduser->t_class_details_id = $formData['TRegdUserDetails']['t_class_details_id'];
        $regduser->full_name = $formData['TRegdUserDetails']['full_name'];
        $regduser->email_id = $formData['TRegdUserDetails']['email_id'];
        $regduser->mobile_number = $formData['TRegdUserDetails']['mobile_number'];
        $regduser->institute_name = $formData['TRegdUserDetails']['institute_name'];
        $regduser->is_active = 'Y';
        $regduser->save();

        $uid = $regduser->_id;
        $profile_photo = '';

        $user = new User();
        $user->full_name                = $formData['TRegdUserDetails']['full_name'];
        $user->email_id                 = $formData['TRegdUserDetails']['email_id'];
        $user->mobile_number            = $formData['TRegdUserDetails']['mobile_number'];
        $user->ogr_password             = $formData['TRegdUserDetails']['mobile_number'];
        $user->re_password              = Hash::make($formData['TRegdUserDetails']['mobile_number']);
        $user->password                 = Hash::make($formData['TRegdUserDetails']['mobile_number']);
        $user->remember_token           = $formData['_token'];
        $user->profile_photo            = $profile_photo;
        $user->is_reset_req             = 0;
        $user->role_id                  = '61498bdb52ae6102f00004ba';
        $user->t_regd_user_details_id   = $uid;
        $user->is_active                = 'Y';
        $user->save();


        return Redirect::to('/home/register')->with('msg', 'Registration Done Successfully');
    }

    public function signup(Request $request){
		$userObj         = User::select('is_active','_id','is_reset_req')
                            ->where('mobile_number','=',Input::get('mobile_number'))
                            ->first();    
        //echo "<pre>"; print_r($userObj); echo "<pre>"; exit;
        if (is_object($userObj)) {
            if (isset($userObj->is_active) && $userObj->is_active == 'Y') {
                if (isset($userObj->is_reset_req) && $userObj->is_reset_req == 0) {
                    if (Auth::attempt(array('mobile_number' => Input::get('mobile_number'), 'password' => Input::get('password')))) {
                        $dataObj         = TRole::select('role_name','_id')
                                           ->where('_id','=',Auth::user()->role_id)
                                           ->first(); 
                        if($dataObj->role_name == "Super Admin" || $dataObj->role_name == "Admin"){
                            return Redirect::to('dashboard/dashboard');
                        }else{
                            return Redirect::to('home/dashboard');
                        }                   
                    } else {
                        return Redirect::to('home/login')
                            ->with('error', 'username/password combination was incorrect')
                            ->withInput();
                    }
                } else {
                    return Redirect::to('home/login')
                        ->with('error', 'Your have reset your password.Check your mail for password reset link.')
                        ->withInput();
                }
            } else if (isset($userObj->is_active) && $userObj->is_active == 'P') {
                return Redirect::to('home/login')
                    ->with('error', 'Your account is Pending.')
                    ->withInput();
            } else {
                return Redirect::to('home/login')
                    ->with('error', 'Your account is inactive.')
                    ->withInput();
            }
        } else {
            return Redirect::to('home/login')
                ->with('error', 'Invalid login.')
                ->withInput();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->to('home/login')->with('message', 'Your are logged out!');
    }

    public function updatePassword(){
        $valiationArr = array();
        if (isset(Auth::user()->_id) && Auth::user()->_id != '') {
            $formData = Input::all();
            $formDataArr = array();
            if (isset($formData['formdata']) && $formData['formdata'] != '') {
                parse_str($formData['formdata'], $formDataArr);
                if (isset($formDataArr['formdata']) && is_array($formDataArr['formdata']) && count($formDataArr['formdata']) > 0) {
                    $validator = Validator::make($formDataArr['formdata'], User::$rules['changepassword']);
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
                    }
                    if (is_array($valiationArr) && count($valiationArr) > 0) {
                        echo '****FAILURE****' . json_encode($valiationArr);
                    } else {
                        //echo'<pre>';print_r($formDataArr);echo'</pre>';exit;
                        if (isset(Auth::user()->_id) && Auth::user()->_id != 0) {
                            $menu = User::find(Auth::user()->_id);
                            $menu->ogr_password             = $formDataArr['formdata']['password'];
                            $menu->re_password              = Hash::make($formDataArr['formdata']['password']);
                            $menu->password                 = Hash::make($formDataArr['formdata']['password']);
                            $menu->save();
                            if ($menu) {
                                echo '****SUCCESS****Password Change Done Successfully';
                            } else {
                                echo '****ERROR****Unable to save data.';
                            }
                        }
                    }
                }
            } else {
                echo '****ERROR****Invalid form submission.';
            }
        } else {
            return Redirect::to('/home/login');
        }exit;
    }

    public function topicnamesofselectedsubject(){
        $this->layout														=   View::make('layouts.ajax');
        $sectionArr															=	array();
        $dataArr															=	Input::all();	
        $response                                                           =   '';
        $t_subject_details_id                                               =   $dataArr['id'];
        $responseObjArr         = TTopicDetails::select('topic_name','_id')
                                ->where('t_subject_details_id','=',$dataArr['id'])
                                ->where('is_active','Y')
                                ->orderby('_id','asc')
                                ->get();
        return view::make('home.topicnames_of_selected_subject', compact('t_subject_details_id','responseObjArr'));
    }

    public function userprofile(Request $request) {
        return View::make('home.userprofile');
    }

    public function quickdemo(Request $request) {
        return View::make('home.quickdemo');
    }
}
