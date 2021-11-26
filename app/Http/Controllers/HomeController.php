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
use App\Models\TTopicWiseQuestionDetails;
use App\Models\TExam;
use App\Models\TUserSelectedTopicForExam;
use App\Models\TUserMark;
use App\Models\TUserSelectedTopicQuestionsForExam;
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
    public function topicwiseperfomance(Request $request) {
        return View::make('home.topicwiseperfomance');
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
            return View::make('home.topiclist', compact('responseObjArr'));
        }else{
            return View::make('home.login');
        }
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
        $dbObj  = TTopicWiseQuestionDetails::all()->random(20); 
        return View::make('home.quickdemo',compact('dbObj'));
    }

    public function regdusergiventopicwiseexam(Request $request) {
        global $qusCnt;
        $queries            = array();
		parse_str($_SERVER['QUERY_STRING'], $queries);
		$topicid            = $queries;
        $formDataArr        =   array();
        if(isset(Auth::user()->_id) && Auth::user()->_id != ''){
            $TopicIds           =   implode(",", $topicid);
            $tids               =   explode(",", $TopicIds);
            $topicCnt           =   sizeof($tids);
            foreach($tids as $key=>$val){
                $qusCntArr        = TTopicWiseQuestionDetails::where('t_topic_details_id','=',$val)->count();
                $qusCnt += $qusCntArr;
            }
            $qusCnt = $qusCnt;
            return View::make('home.regdusergiventopicwiseexam',compact('TopicIds','qusCnt','topicCnt'));
        }else{
            return View::make('home.login');
        }
    }

    public function updateprofile() {
        $boardArr       = Controller::getBoardListForClass('t_board_details','board_name');
        return View::make('home.updateprofile', compact('boardArr'));
    }

    public function validateUserUpdateDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formdata'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TRegdUserDetails']) && is_array($formValArr['TRegdUserDetails']) && count($formValArr['TRegdUserDetails']) > 0) {
                $validator = Validator::make($formValArr['TRegdUserDetails'], TRegdUserDetails::$rules['updateprofile'], TRegdUserDetails::$messages);
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

    public function userUpdateProfile(Request $request){
        $formData = Input::all();
        //echo'<pre>';print_r($formData);echo'</pre>';exit;
        if (isset(Auth::user()->_id) && Auth::user()->_id != '') {
            $regduser = TRegdUserDetails::find(Auth::user()->t_regd_user_details_id);
            $regduser->full_name = $formData['TRegdUserDetails']['full_name'];
            $regduser->email_id = $formData['TRegdUserDetails']['email_id'];
            $regduser->mobile_number = $formData['TRegdUserDetails']['mobile_number'];
            $regduser->institute_name = $formData['TRegdUserDetails']['institute_name'];
            $regduser->is_active = 'Y';
            $regduser->save();

            
            $tableObjCnt5 = User::where('profile_photo', '!=', '')->where('_id', '=', Auth::user()->_id);
            $tableObjCnt6 = $tableObjCnt5->count();
            $tableObjCnt7 = $tableObjCnt5->first();
            $image = $request->file('image');
            if ($tableObjCnt6 > 0) {
                $photoName = $tableObjCnt7->profile_photo;
            } else {
                $photoName = '';
            }
            //
            if ($image != '') {
                $image_name = $image->getClientOriginalName();
                $fileExt  = $image->getClientOriginalExtension();
                $fileSize = $image->getSize();
                $photo_download_name= uniqid() . '_' . time() . '.' . $fileExt;
                $orig_file_path = public_path() . "/userphoto/orig";
                if (isset(Auth::user()->_id)) {
                    $photoName = Auth::user()->_id . '_' . uniqid() . '.' . $fileExt;
                } else {
                    $photoName = uniqid() . '.' . $fileExt;
                }
                $upload_success = $image->move($orig_file_path, $photoName, 100, 100);
            }

            $user = User::find(Auth::user()->_id);
            $user->full_name                = $formData['TRegdUserDetails']['full_name'];
            $user->email_id                 = $formData['TRegdUserDetails']['email_id'];
            $user->mobile_number            = $formData['TRegdUserDetails']['mobile_number'];
            $user->ogr_password             = $formData['TRegdUserDetails']['mobile_number'];
            $user->re_password              = Hash::make($formData['TRegdUserDetails']['mobile_number']);
            $user->password                 = Hash::make($formData['TRegdUserDetails']['mobile_number']);
            $user->profile_photo            = $photoName;
            $user->is_active                = 'Y';
            $user->save();


            return Redirect::to('/home/userprofile')->with('msg', 'Registration Done Successfully');
        } else {
            return Redirect::to('/home/login');
        }exit;
    }

    public function topicByQuestionSelectedByUser($id = 0) {
        $queries            = array();
        global              $examid;
		$topicid            = $id;
        if(isset(Auth::user()->_id) && Auth::user()->_id != ''){
            $tids               =   explode(",", $topicid);

            $exam = new TExam();
            $exam->user_id     =  Auth::user()->_id;
            $exam->date        =  date('d-m-Y');
            $exam->exam_type   = "TopicWise-Test";
            $exam->exam_status = "In-Complete";
            $exam->save();
            $examid = $exam->_id;

            foreach($tids as $key=>$val){
                $texam = new TUserSelectedTopicForExam();
                $texam->user_id                = Auth::user()->_id;
                $texam->t_exam_id              = $examid;
                $texam->t_topic_details_id     = $val;
                $texam->t_subject_details_id   =  Controller::getSubjectIdByTopicId($val);
                $texam->date                   =  date('d-m-Y');
                $texam->save();
                $texamid = $texam->_id;

                $questionIdListArr                                  =	array();
                $questionIdListArr                                  =   TTopicWiseQuestionDetails::where('t_topic_details_id','=',$val)
                                                                        ->select(array('_id','question_details','option1','option2','option3','option4','image_photo','correct_option','referral_link'))
                                                                        ->where('is_active','=','Y')
                                                                        ->get();
               // echo'<pre>';print_r($questionIdListArr);echo'</pre>';exit;                                                        
                foreach($questionIdListArr as $key1=>$val1){ 
                    $user_options  = ''; 
                    $answer_status = ''; 
                    $tselectqusexam = new TUserSelectedTopicQuestionsForExam();
                    $tselectqusexam->user_id                               = Auth::user()->_id;
                    $tselectqusexam->t_exam_id                             = $examid;
                    $tselectqusexam->t_topic_details_id                    = $val;
                    $tselectqusexam->t_subject_details_id                  =  Controller::getSubjectIdByTopicId($val);
                    $tselectqusexam->t_user_selected_topic_for_exam_id     =  $texamid;
                    $tselectqusexam->t_topic_wise_question_details_id      =  $val1->_id;
                    $tselectqusexam->question_details                      =  $val1->question_details;
                    $tselectqusexam->option1                               =  $val1->option1;
                    $tselectqusexam->option2                               =  $val1->option2;
                    $tselectqusexam->option3                               =  $val1->option3;
                    $tselectqusexam->option4                               =  $val1->option4;
                    $tselectqusexam->image_photo                           =  $val1->image_photo;
                    $tselectqusexam->correct_option                        =  $val1->correct_option;
                    $tselectqusexam->referral_link                         =  $val1->referral_link;
                    $tselectqusexam->user_options                          =  $user_options;
                    $tselectqusexam->answer_status                         =  $answer_status;
                    $tselectqusexam->questions_status                      =  "Not-Attened";
                    $tselectqusexam->date                                  =  date('d-m-Y');
                    $tselectqusexam->save(); 
                }                                                        
            }
            $topicListArr  = array();
            $topicListArr  = TUserSelectedTopicForExam::where('t_exam_id','=',$examid)->where('user_id','=',Auth::user()->_id)->orderBy('_id','asc')->get();
           // $dbObj         = TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$examid)->get();
        }
        return View::make('home.add_topicwise_questions_details', compact('topicListArr'));
    }
    
    public function questionDetailsByTopicSelection(Request $request){
        $this->layout                   =   View::make('layouts.ajax');
        $inputData                      =   Input::all();
        $t_topic_details_id             =   $inputData['t_topic_details_id'];
        $t_exam_id                      =   $inputData['t_exam_id'];

        $questionListObj  = TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$t_exam_id)
                                                    ->where('t_topic_details_id','=',$t_topic_details_id)
                                                    ->where('user_id','=',Auth::user()->_id)
                                                    ->orderBy('_id','asc')
                                                    ->get();
        $questionListObjs  = TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$t_exam_id)
                            ->where('t_topic_details_id','=',$t_topic_details_id)
                            ->where('user_id','=',Auth::user()->_id)
                            ->select(array(
                                'user_id',
                                't_exam_id',
                                't_subject_details_id',
                                't_topic_details_id',
                                't_topic_wise_question_details_id',
                                't_user_selected_topic_for_exam_id',
                                '_id',
                                'question_details',
                                'option1',
                                'option2',
                                'option3',
                                'option4',
                                'image_photo',
                                'correct_option',
                                'referral_link',
                                'user_options',
                            ))
                            ->orderBy('_id','asc')
							->get();
        return View::make('home.question_details_by_topic_selection', compact('questionListObjs','questionListObj'));
    }

    public function saveselectedtopicanswer(){
        $formData = Input::all();
        parse_str($formData['formdata'], $formDataArr);
        if (isset(Auth::user()->_id) && Auth::user()->_id != '') {

            $correct_options            =  Controller::getCorrectOptions($formDataArr['TUserSelectedTopicQuestionsForExam']['t_topic_wise_question_details_id']);
            $user_options               =  $formDataArr['TUserSelectedTopicQuestionsForExam']['user_options'];
            if($user_options == ''){
                $answer_status = '';
            }elseif($user_options == $correct_options){
                $answer_status = 1;
            }else{
               $answer_status = 0; 
            }

            $regduser = TUserSelectedTopicQuestionsForExam::find($formDataArr['id']);

            $regduser->user_options = $user_options;
            $regduser->answer_status = $answer_status;
            $regduser->questions_status = "Attened";

            $regduser->save();
        }
       
    }

    public function savesubmittopictest(){
        $formData = Input::all();
        parse_str($formData['formdata'], $formDataArr);
        if (isset(Auth::user()->_id) && Auth::user()->_id != '') {
            $resume_tp_id = '';
            $total_qus    =  0;
            $t_exam_id    =  $formDataArr['TUserSelectedTopicQuestionsForExam']['t_exam_id'];
            $correctOptObj = TUserSelectedTopicForExam::where('t_exam_id','=',$formDataArr['TUserSelectedTopicQuestionsForExam']['t_exam_id'])
                    ->select(array(
                        't_topic_details_id',
                        )
                    )
                    ->get();
            foreach($correctOptObj as $term){
            $output[] = $term->t_topic_details_id;
            }
            $resume_tp_id =  implode(',', $output);
            $tids                               =   explode(",", $resume_tp_id);
            foreach($tids  as $key=>$val){
                $total_qus              =  TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$formDataArr['TUserSelectedTopicQuestionsForExam']['t_exam_id'])
                                            ->where('t_topic_details_id','=',$formDataArr['TUserSelectedTopicQuestionsForExam']['t_topic_details_id'])
                                            ->count();
                $topic_name             =  Controller::getTopicName($val);
                $total_secure_marks     =  TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$formDataArr['TUserSelectedTopicQuestionsForExam']['t_exam_id'])
                                            ->where('t_topic_details_id','=',$formDataArr['TUserSelectedTopicQuestionsForExam']['t_topic_details_id'])
                                            ->where('answer_status','=',1)
                                            ->count();  
                
                $tusermark                                                  = new TUserMark();
                $tusermark->user_id                                         = Auth::user()->_id;
                $tusermark->t_exam_id                                       = $formDataArr['TUserSelectedTopicQuestionsForExam']['t_exam_id'];
                $tusermark->t_topic_details_id                              = $val;
                $tusermark->marks                                           = $total_secure_marks;
                $tusermark->total_number_of_marks                           = $total_qus;
                $tusermark->topic_name                                      = $topic_name;
                $tusermark->t_user_selected_topic_questions_for_exam_id     = $formDataArr['id'];
                $tusermark->mark_type                                       = "TopicWise-Test";
                $tusermark->exam_submit_date                                = date('d-m-Y');
                $tusermark->graph_date                                      = date('d-m-Y');
                $tusermark->save();     
                
                $regduserexam = TExam::find($t_exam_id);
                $regduserexam->exam_status = "Complete";
                $regduserexam->save();
            }
            echo "****".'SUCCESS'."****". $t_exam_id;
        } else {
            return Redirect::to('/home/login');
        }exit;    
       // echo'<pre>';print_r($resume_tp_id);echo'</pre>';exit;
    }
    public function resultlistbyselectedtopicbyuser($id = 0){
        $topicListArr  = array();
        $topicListArr  = TUserSelectedTopicForExam::where('t_exam_id','=',$id)->where('user_id','=',Auth::user()->_id)->orderBy('_id','asc')->get();
        return View::make('home.resultlistbyselectedtopicbyuser', compact('topicListArr'));
    }

    public function resultdetailsbytopicselection(){
        $this->layout                   =   View::make('layouts.ajax');
        $inputData                      =   Input::all();
        $t_topic_details_id             =   $inputData['t_topic_details_id'];
        $t_exam_id                      =   $inputData['t_exam_id'];

        $questionListObj  = TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$t_exam_id)
                            ->where('t_topic_details_id','=',$t_topic_details_id)
                            ->where('user_id','=',Auth::user()->_id)
                            ->select(array(
                                'user_id',
                                't_exam_id',
                                't_subject_details_id',
                                't_topic_details_id',
                                't_topic_wise_question_details_id',
                                't_user_selected_topic_for_exam_id',
                                '_id',
                                'question_details',
                                'option1',
                                'option2',
                                'option3',
                                'option4',
                                'image_photo',
                                'correct_option',
                                'referral_link',
                                'user_options',
                            ))
                            ->orderBy('_id','asc')
							->get();
        $total_number_of_questions    =  TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$t_exam_id)
                                      ->where('t_topic_details_id','=',$t_topic_details_id)
                                      ->count(); 
        $correctAnsObj                =  TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$t_exam_id)
                                      ->where('t_topic_details_id','=',$t_topic_details_id)
                                      ->where('answer_status','=',1)
                                      ->count(); 
        $wrongAnsObj                  =  TUserSelectedTopicQuestionsForExam::where('t_exam_id','=',$t_exam_id)
                                      ->where('t_topic_details_id','=',$t_topic_details_id)
                                      ->where('answer_status','=',0)
                                      ->count();                                        
        //echo'<pre>';print_r($questionListObj);echo'</pre>';exit;
        return View::make('home.resultdetailsbytopicselection', compact('questionListObj','total_number_of_questions','correctAnsObj','wrongAnsObj'));
    }
}
