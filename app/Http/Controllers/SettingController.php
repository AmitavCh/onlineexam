<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TBoardDetails;
use App\Models\TClassDetails;
use App\Models\TSubjectDetails;
use App\Models\TTopicDetails;
use App\Models\TTopicWiseQuestionDetails;
use App\Models\TNoticeDetails;
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

class SettingController extends Controller {

    public function addBoardDetails(Request $request) {
        $dbObj = [];
        $page_limit = 10;
        $dbObj = TBoardDetails::paginate($page_limit);
        if ($request->has('search') && $request->get('search') != '') {
            $keyword = $request->get('search');
            $dbObj = TBoardDetails::where('board_name', 'LIKE', '%' . $keyword . '%')
               ->paginate($page_limit);
        }
        return View::make('setting.add_board_details', compact('dbObj'));
    }

    public function addBoardDetailsData($id = 0) {
        $viewDataObj = "";
        $id = base64_decode(base64_decode($id));
        if ($id != '') {
            $viewDataObj = TBoardDetails::find($id);
        }
        return View::make('setting.add_board_details_data', compact('viewDataObj'));
    }

    public function validateBoardDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TBoardDetails']) && is_array($formValArr['TBoardDetails']) && count($formValArr['TBoardDetails']) > 0) {
                $validator = Validator::make($formValArr['TBoardDetails'], TBoardDetails::$rules, TBoardDetails::$messages);
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

    public function saveBoardDetails(Request $request) {
        $formData = Input::all();
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            parse_str($formData['formdata'], $formDataArr);
            $id = $formDataArr['_id'];
            if (isset($id) && $id != 0) {
                $menu_data = TBoardDetails::where('board_name', '=', $formDataArr['TBoardDetails']['board_name'])
                    ->where('_id', '!=', $id)
                    ->count();
                if ($menu_data == 0) {
                    $menu = TBoardDetails::find($id);
                    $menu->board_name = $formDataArr['TBoardDetails']['board_name'];
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been update successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            } else {
                $menu_data = TBoardDetails::where('board_name', '=', $formDataArr['TBoardDetails']['board_name'])
                    ->count();
                if ($menu_data == 0) {
                    $menu = new TBoardDetails();
                    $menu->board_name = $formDataArr['TBoardDetails']['board_name'];
                    $menu->is_active = 'Y';
                    $menu->created_at = date('Y-m-d h:i:s');
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been saved successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function boardDetailsActive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TBoardDetails::find($id);
            $menu->is_active = 'Y';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been Active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function boardDetailsDeactive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TBoardDetails::find($id);
            $menu->is_active = 'N';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been In-active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function addClassDetails(Request $request) {
        $dbObj = [];
        $page_limit = 10;
        $dbObj = TClassDetails::paginate($page_limit);
        if ($request->has('search') && $request->get('search') != '') {
            $keyword = $request->get('search');
            $dbObj = TClassDetails::where('class_name', 'LIKE', '%' . $keyword . '%')
               ->paginate($page_limit);
        }
        return View::make('setting.add_class_details', compact('dbObj'));
    }

    public function addClassDetailsData($id = 0) {
        $viewDataObj = "";
        $boardArr       = Controller::getBoardListForClass('t_board_details','board_name');
        $id = base64_decode(base64_decode($id));
        if ($id != '') {
            $viewDataObj = TClassDetails::find($id);
        }
        return View::make('setting.add_class_details_data', compact('viewDataObj','boardArr'));
    }

    public function validateClassDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TClassDetails']) && is_array($formValArr['TClassDetails']) && count($formValArr['TClassDetails']) > 0) {
                $validator = Validator::make($formValArr['TClassDetails'], TClassDetails::$rules, TClassDetails::$messages);
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

    public function saveClassDetails(Request $request) {
        $formData = Input::all();
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            parse_str($formData['formdata'], $formDataArr);
            $id = $formDataArr['_id'];
            if (isset($id) && $id != 0) {
                $menu_data = TClassDetails::where('class_name', '=', $formDataArr['TClassDetails']['class_name'])
                            ->where('t_board_details_id', '=', $formDataArr['TClassDetails']['t_board_details_id']) 
                            ->where('_id', '!=', $id)
                            ->count();
                if ($menu_data == 0) {
                    $menu = TClassDetails::find($id);
                    $menu->class_name = $formDataArr['TClassDetails']['class_name'];
                    $menu->t_board_details_id = $formDataArr['TClassDetails']['t_board_details_id'];
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been update successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            } else {
                $menu_data = TClassDetails::where('class_name', '=', $formDataArr['TClassDetails']['class_name'])
                                        ->where('t_board_details_id', '=', $formDataArr['TClassDetails']['t_board_details_id'])
                                        ->count();
                if ($menu_data == 0) {
                    $menu = new TClassDetails();
                    $menu->class_name = $formDataArr['TClassDetails']['class_name'];
                    $menu->t_board_details_id = $formDataArr['TClassDetails']['t_board_details_id'];
                    $menu->is_active = 'Y';
                    $menu->created_at = date('Y-m-d h:i:s');
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been saved successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function classDetailsActive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TClassDetails::find($id);
            $menu->is_active = 'Y';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been Active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function classDetailsDeactive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TClassDetails::find($id);
            $menu->is_active = 'N';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been In-active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function addSubjectDetails(Request $request) {
        $dbObj = [];
        $page_limit = 10;
        $dbObj = TSubjectDetails::paginate($page_limit);
        if ($request->has('search') && $request->get('search') != '') {
            $keyword = $request->get('search');
            $dbObj = TSubjectDetails::where('subject_name', 'LIKE', '%' . $keyword . '%')
               ->paginate($page_limit);
        }
        return View::make('setting.add_subject_details', compact('dbObj'));
    }

    public function addSubjectDetailsData($id = 0) {
        $viewDataObj = "";
        $classArr    = Controller::getClassListForSubject('t_class_details','class_name');
        $id = base64_decode(base64_decode($id));
        if ($id != '') {
            $viewDataObj = TSubjectDetails::find($id);
        }
        return View::make('setting.add_subject_details_data', compact('viewDataObj','classArr'));
    }

    public function validateSubjectDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TSubjectDetails']) && is_array($formValArr['TSubjectDetails']) && count($formValArr['TSubjectDetails']) > 0) {
                $validator = Validator::make($formValArr['TSubjectDetails'], TSubjectDetails::$rules, TSubjectDetails::$messages);
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

    public function subjectDetailsActive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TSubjectDetails::find($id);
            $menu->is_active = 'Y';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been Active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function subjectDetailsDeactive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TSubjectDetails::find($id);
            $menu->is_active = 'N';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been In-active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function saveSubjectDetails(Request $request) {
        $formData = Input::all();
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            parse_str($formData['formdata'], $formDataArr);
            $id = $formDataArr['_id'];
            if (isset($id) && $id != 0) {
                $menu_data = TSubjectDetails::where('subject_name', '=', $formDataArr['TSubjectDetails']['subject_name'])
                            ->where('t_class_details_id', '=', $formDataArr['TSubjectDetails']['t_class_details_id']) 
                            ->where('_id', '!=', $id)
                            ->count();
                if ($menu_data == 0) {
                    $menu = TSubjectDetails::find($id);
                    $menu->subject_name = $formDataArr['TSubjectDetails']['subject_name'];
                    $menu->t_class_details_id = $formDataArr['TSubjectDetails']['t_class_details_id'];
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been update successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            } else {
                $menu_data = TSubjectDetails::where('subject_name', '=', $formDataArr['TSubjectDetails']['subject_name'])
                                        ->where('t_class_details_id', '=', $formDataArr['TSubjectDetails']['t_class_details_id'])
                                        ->count();
                if ($menu_data == 0) {
                    $menu = new TSubjectDetails();
                    $menu->subject_name = $formDataArr['TSubjectDetails']['subject_name'];
                    $menu->t_class_details_id = $formDataArr['TSubjectDetails']['t_class_details_id'];
                    $menu->is_active = 'Y';
                    $menu->created_at = date('Y-m-d h:i:s');
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been saved successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function addTopicDetails(Request $request) {
        $dbObj = [];
        $page_limit = 10;
        $dbObj = TTopicDetails::paginate($page_limit);
        if ($request->has('search') && $request->get('search') != '') {
            $keyword = $request->get('search');
            $dbObj = TTopicDetails::where('topic_name', 'LIKE', '%' . $keyword . '%')
               ->paginate($page_limit);
        }
        return View::make('setting.add_topic_details', compact('dbObj'));
    }

    public function addTopicDetailsData($id = 0) {
        $viewDataObj = "";
        $classArr    = Controller::getClassListForSubject('t_class_details','class_name');
        $id = base64_decode(base64_decode($id));
        if ($id != '') {
            $viewDataObj = TTopicDetails::find($id);
            if(isset($viewDataObj->t_class_details_id) ){
                $t_class_details_id       =	$viewDataObj->t_class_details_id;
            }
        }
        return View::make('setting.add_topic_details_data', compact('viewDataObj','classArr','t_class_details_id','id'));
    }

    public function validateTopicDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TTopicDetails']) && is_array($formValArr['TTopicDetails']) && count($formValArr['TTopicDetails']) > 0) {
                $validator = Validator::make($formValArr['TTopicDetails'], TTopicDetails::$rules, TTopicDetails::$messages);
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

    public function topicDetailsActive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TTopicDetails::find($id);
            $menu->is_active = 'Y';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been Active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function topicDetailsDeactive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TTopicDetails::find($id);
            $menu->is_active = 'N';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been In-active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function saveTopicDetails(Request $request) {
        $formData = Input::all();
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            parse_str($formData['formdata'], $formDataArr);
            $id = $formDataArr['_id'];
            if (isset($id) && $id != 0) {
                $menu_data = TTopicDetails::where('topic_name', '=', $formDataArr['TTopicDetails']['topic_name'])
                            ->where('t_subject_details_id', '=', $formDataArr['TTopicDetails']['t_subject_details_id']) 
                            ->where('t_class_details_id', '=', $formDataArr['TTopicDetails']['t_class_details_id'])
                            ->where('_id', '!=', $id)
                            ->count();
                if ($menu_data == 0) {
                    $menu = TTopicDetails::find($id);
                    $menu->topic_name = $formDataArr['TTopicDetails']['topic_name'];
                    $menu->t_class_details_id = $formDataArr['TTopicDetails']['t_class_details_id'];
                    $menu->t_subject_details_id = $formDataArr['TTopicDetails']['t_subject_details_id'];
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been update successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            } else {
                $menu_data = TTopicDetails::where('topic_name', '=', $formDataArr['TTopicDetails']['topic_name'])
                                        ->where('t_subject_details_id', '=', $formDataArr['TTopicDetails']['t_subject_details_id'])
                                        ->where('t_class_details_id', '=', $formDataArr['TTopicDetails']['t_class_details_id'])
                                        ->count();
                if ($menu_data == 0) {
                    $menu = new TTopicDetails();
                    $menu->topic_name = $formDataArr['TTopicDetails']['topic_name'];
                    $menu->t_subject_details_id = $formDataArr['TTopicDetails']['t_subject_details_id'];
                    $menu->t_class_details_id = $formDataArr['TTopicDetails']['t_class_details_id'];
                    $menu->is_active = 'Y';
                    $menu->created_at = date('Y-m-d h:i:s');
                    $menu->updated_at = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        echo '****SUCCESS****Data has been saved successfully.';
                    } else {
                        echo '****ERROR****Unable to save data.';
                    }
                } else {
                    echo '****ERROR****This Data already Exist.';
                }
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function subjectnamelist(){
        $this->layout														=   View::make('layouts.ajax');
        $sectionArr															=	array();
        $dataArr															=	Input::all();	
        		
        $response               = '';
        $responseArr[0]['id']   = " ";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TSubjectDetails::select('subject_name','_id')
                                ->where('t_class_details_id','=',$dataArr['selectedVal'])
                                ->where('is_active','Y')
                                ->orderby('_id','asc')
                                ->get();
        foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->subject_name;
        }
        return $responseArr;
    }

    public function addTopicwiseQuestionDetails(Request $request){
        $dbObj = [];
        $page_limit = 10;
        $dbObj = TTopicDetails::paginate($page_limit);
        //echo'<pre>';print_r($request->t_subject_details_id);echo'</pre>';exit;
        if (isset($request->t_class_details_id) && $request->t_class_details_id != '' &&  $request->t_subject_details_id != '') {
            $dbObj = TTopicDetails::where('t_class_details_id','=',$request->t_class_details_id)
                                    ->where('t_subject_details_id','=',$request->t_subject_details_id)
                                    ->paginate($page_limit);
        }else if(isset($request->t_class_details_id) && $request->t_class_details_id != '' &&  $request->t_subject_details_id == ''){
            $dbObj = TTopicDetails::where('t_class_details_id','=',$request->t_class_details_id)
                                    ->paginate($page_limit);
        }else{
            $dbObj = TTopicDetails::paginate($page_limit);
        }
        $classArr    = Controller::getClassListForSubject('t_class_details','class_name');
        return view::make('setting.add_topicwise_question_details', compact('dbObj','classArr'));
    }

    public function addTopicwiseQuestionDetailsData($id = 0){
        $viewDataObj = "";
        $classArr    = Controller::getClassListForSubject('t_class_details','class_name');
        $id = base64_decode(base64_decode($id));
        if ($id != '') {
            $viewDataObj = TTopicWiseQuestionDetails::find($id);
            if(isset($viewDataObj->t_class_details_id) ){
                $t_class_details_id       =	$viewDataObj->t_class_details_id;
            }
            if(isset($viewDataObj->t_subject_details_id) ){
                $t_subject_details_id       =	$viewDataObj->t_subject_details_id;
            }
        }
        return View::make('setting.add_topicwise_question_details_data', compact('viewDataObj','classArr','t_class_details_id','id','t_subject_details_id'));
    }

    public function topicnamelist(){
        $this->layout														=   View::make('layouts.ajax');
        $sectionArr															=	array();
        $dataArr															=	Input::all();	
        		
        $response               = '';
        $responseArr[0]['id']   = " ";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TTopicDetails::select('topic_name','_id')
                                ->where('t_subject_details_id','=',$dataArr['selectedVal'])
                                ->where('is_active','Y')
                                ->orderby('_id','asc')
                                ->get();
        foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->topic_name;
        }
        return $responseArr;
    }

    public function validateTopicWiseQuestionDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TTopicWiseQuestionDetails']) && is_array($formValArr['TTopicWiseQuestionDetails']) && count($formValArr['TTopicWiseQuestionDetails']) > 0) {
                $validator = Validator::make($formValArr['TTopicWiseQuestionDetails'], TTopicWiseQuestionDetails::$rules, TTopicWiseQuestionDetails::$messages);
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

    public function saveTopicWiseQuestionsDetails(Request $request) {
        $formData = Input::all();
       //echo'<pre>';print_r($formData);echo'</pre>';exit;
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = $formData['_id'];
            if(isset($formData['TTopicWiseQuestionDetails']['reference_link']) && $formData['TTopicWiseQuestionDetails']['reference_link'] != ''){
                $reference_link   =  $formData['TTopicWiseQuestionDetails']['reference_link'];
            }else{
                $reference_link   =   '';
            }
            if (isset($id) && $id != 0) {
                $menu_data = TTopicWiseQuestionDetails::where('question_details', '=', $formData['TTopicWiseQuestionDetails']['question_details'])
                            ->where('t_subject_details_id', '=', $formData['TTopicWiseQuestionDetails']['t_subject_details_id']) 
                            ->where('t_class_details_id', '=', $formData['TTopicWiseQuestionDetails']['t_class_details_id'])
                            ->where('t_topic_details_id', '=', $formData['TTopicWiseQuestionDetails']['t_topic_details_id'])
                            ->where('_id', '!=', $id)
                            ->count();

                //for fetch image exist or not
                $tableObjCnt5 = TTopicWiseQuestionDetails::where('image_photo', '!=', '')->where('_id', '=', $id);
                $tableObjCnt6 = $tableObjCnt5->count();
                $tableObjCnt7 = $tableObjCnt5->first();
                $image = $request->file('image');
                if ($tableObjCnt6 > 0) {
                    $photoName = $tableObjCnt7->image_photo;
                } else {
                    $photoName = '';
                }
                //
                if ($image != '') {
                    $image_name = $image->getClientOriginalName();
                    $fileExt  = $image->getClientOriginalExtension();
                    $fileSize = $image->getSize();
                    $photo_download_name= uniqid() . '_' . time() . '.' . $fileExt;
                    $orig_file_path = public_path() . "/questionimage/orig";
                    if (isset(Auth::user()->_id)) {
                        $photoName = Auth::user()->_id . '_' . uniqid() . '.' . $fileExt;
                    } else {
                        $photoName = uniqid() . '.' . $fileExt;
                    }
                    $upload_success = $image->move($orig_file_path, $photoName, 100, 100);
                }

                if ($menu_data == 0) {
                    $menu = TTopicWiseQuestionDetails::find($id);
                    $menu->t_subject_details_id     = $formData['TTopicWiseQuestionDetails']['t_subject_details_id'];
                    $menu->t_class_details_id       = $formData['TTopicWiseQuestionDetails']['t_class_details_id'];
                    $menu->t_topic_details_id       = $formData['TTopicWiseQuestionDetails']['t_topic_details_id'];
                    $menu->option1                  = $formData['TTopicWiseQuestionDetails']['option1'];
                    $menu->question_details         = $formData['TTopicWiseQuestionDetails']['question_details'];
                    $menu->option2                  = $formData['TTopicWiseQuestionDetails']['option2'];
                    $menu->option3                  = $formData['TTopicWiseQuestionDetails']['option3'];
                    $menu->option4                  = $formData['TTopicWiseQuestionDetails']['option4'];
                    $menu->correct_option           = $formData['TTopicWiseQuestionDetails']['correct_option'];
                    $menu->reference_link           = $reference_link;
                    $menu->image_photo              = $photoName;
                    $menu->updated_at               = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        return Redirect::to('/setting/add_topicwise_question_details_data')->with('message', 'Data has been update successfully');
                    } else {
                        return Redirect::to('/setting/add_topicwise_question_details_data')->with('message', 'Unable to save data');
                    }
                } else {
                    return Redirect::to('/setting/add_topicwise_question_details_data')->with('message', 'This Data already Exist');
                }
            } else {
                $menu_data = TTopicWiseQuestionDetails::where('question_details', '=', $formData['TTopicWiseQuestionDetails']['question_details'])
                            ->where('t_subject_details_id', '=', $formData['TTopicWiseQuestionDetails']['t_subject_details_id']) 
                            ->where('t_class_details_id', '=', $formData['TTopicWiseQuestionDetails']['t_class_details_id'])
                            ->where('t_topic_details_id', '=', $formData['TTopicWiseQuestionDetails']['t_topic_details_id'])
                            ->count();
                $image = $request->file('image');
                $photoName = '';
                if ($image != '') {
                    $image_name = $image->getClientOriginalName();
                    $fileExt = $image->getClientOriginalExtension();
                    $fileSize = $image->getSize();
                    $photo_download_name = uniqid() . '_' . time() . '.' . $fileExt;
                    $orig_file_path = public_path() . "/questionimage/orig";
                    if (isset(Auth::user()->_id)) {
                        $photoName = Auth::user()->_id . '_' . uniqid() . '.' . $fileExt;
                    } else {
                        $photoName = uniqid() . '.' . $fileExt;
                    }
                    $upload_success = $image->move($orig_file_path, $photoName, 100, 100);
                }            
                if ($menu_data == 0) {
                    $menu = new TTopicWiseQuestionDetails();
                    $menu->t_subject_details_id     = $formData['TTopicWiseQuestionDetails']['t_subject_details_id'];
                    $menu->t_class_details_id       = $formData['TTopicWiseQuestionDetails']['t_class_details_id'];
                    $menu->t_topic_details_id       = $formData['TTopicWiseQuestionDetails']['t_topic_details_id'];
                    $menu->option1                  = $formData['TTopicWiseQuestionDetails']['option1'];
                    $menu->question_details         = $formData['TTopicWiseQuestionDetails']['question_details'];
                    $menu->option2                  = $formData['TTopicWiseQuestionDetails']['option2'];
                    $menu->option3                  = $formData['TTopicWiseQuestionDetails']['option3'];
                    $menu->option4                  = $formData['TTopicWiseQuestionDetails']['option4'];
                    $menu->correct_option           = $formData['TTopicWiseQuestionDetails']['correct_option'];
                    $menu->reference_link           = $reference_link;
                    $menu->image_name               = $photoName;
                    $menu->is_active                = 'Y';
                    $menu->created_at               = date('Y-m-d h:i:s');
                    $menu->updated_at               = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        return Redirect::to('/setting/add_topicwise_question_details_data')->with('message', 'Data has been saved successfully');
                    } else {
                        return Redirect::to('/setting/add_topicwise_question_details_data')->with('message', 'Unable to save data');
                    }
                } else {
                    return Redirect::to('/setting/add_topicwise_question_details_data')->with('message', 'This Data already Exist');
                }
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function addTopicwiseQuestionsList($id =0,Request $request){
        $viewDataObj = "";
        $classArr    = Controller::getClassListForSubject('t_class_details','class_name');
        $id = base64_decode(base64_decode($id));
        $dbObj = [];
        $page_limit = 20;
        $dbObj = TTopicWiseQuestionDetails::where('t_topic_details_id','=',$id)->paginate($page_limit);
        if ($request->has('search') && $request->get('search') != '') {
            $keyword = $request->get('search');
            $dbObj = TTopicWiseQuestionDetails::where('question_details', 'LIKE', '%' . $keyword . '%')
               ->paginate($page_limit);
        }
        return View::make('setting.add_topicwise_questions_list', compact('dbObj','classArr','id'));
    }
    
    public function topicWiseQuestionsActive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TTopicWiseQuestionDetails::find($id);
            $menu->is_active = 'Y';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been Active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function topicWiseQuestionsDeactive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TTopicWiseQuestionDetails::find($id);
            $menu->is_active = 'N';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been In-active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function addNoticeDetails(Request $request) {
        $dbObj = [];
        $page_limit = 10;
        $boardExtArr[1]['id']   = "ALL";
        $boardExtArr[1]['name'] = "ALL";
        $boardArr       = Controller::getBoardListForClass('t_board_details','board_name');
        $responseArr    = array_merge($boardArr,$boardExtArr);
        $dbObj          = TNoticeDetails::paginate($page_limit);
        if ($request->has('t_board_details_id') && $request->get('t_board_details_id') != '') {
            $keyword = $request->get('t_board_details_id');
            $keyword1 = $request->get('t_class_details_id');
            $dbObj = TNoticeDetails::where('t_board_details_id','=', $keyword)
                                    ->orWhere('t_class_details_id','=',$keyword1)
                                    ->paginate($page_limit);
        }
        return View::make('setting.add_notice_details', compact('dbObj','responseArr'));
    }

    public function addNoticeDetailsData($id = 0) {
        $viewDataObj            = "";
        $boardExtArr[1]['id']   = "ALL";
        $boardExtArr[1]['name'] = "ALL";
        $boardArr       = Controller::getBoardListForClass('t_board_details','board_name');
        $responseArr = array_merge($boardArr,$boardExtArr);
        $id = base64_decode(base64_decode($id));
        if ($id != '') {
            $viewDataObj = TNoticeDetails::find($id);
            if(isset($viewDataObj->t_board_details_id) ){
                $t_board_details_id       =	$viewDataObj->t_board_details_id;
            }
            if(isset($viewDataObj->t_class_details_id) ){
                $t_class_details_id       =	$viewDataObj->t_class_details_id;
            }
        }
        return View::make('setting.add_notice_details_data', compact('viewDataObj','responseArr','t_board_details_id','t_class_details_id','id'));
    }

    public function classnamelistsbyboardid(){
        $this->layout														=   View::make('layouts.ajax');
        $sectionArr															=	array();
        $dataArr															=	Input::all();	
        		
        $response               = '';
        if($dataArr['selectedVal'] != "ALL"){
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
        }else{
            $responseArr[0]['id']   = "ALL";
            $responseArr[0]['name'] = "ALL";
        }
        
        return $responseArr;
    }

    public function noticeDetailsActive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TNoticeDetails::find($id);
            $menu->is_active = 'Y';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been Active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function noticeDetailsDeactive($id = 0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = base64_decode(base64_decode($id));
            $menu = TNoticeDetails::find($id);
            $menu->is_active = 'N';
            $menu->save();
            if ($menu) {
                Session::flash('message', 'Data has been In-active successfully.');
                return back();
            } else {
                Session::flash('error', 'Unable to update record.');
                return back();
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }

    public function validateNoticeDetailsData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TNoticeDetails']) && is_array($formValArr['TNoticeDetails']) && count($formValArr['TNoticeDetails']) > 0) {
                $validator = Validator::make($formValArr['TNoticeDetails'], TNoticeDetails::$rules, TNoticeDetails::$messages);
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

    public function saveNoticeDetails(Request $request){
        $formData = Input::all();
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
            $id = $formData['_id'];
            if (isset($id) && $id != 0) {
                $date              = date('d-m-Y');
                $menu_data = TNoticeDetails::where('notice_details', '=', $formData['TNoticeDetails']['notice_details'])
                            ->where('date', '=', $date) 
                            ->where('_id', '!=', $id)
                            ->count();
                if ($menu_data == 0) {
                    $menu = TNoticeDetails::find($id);
                    $menu->t_board_details_id     = $formData['TNoticeDetails']['t_board_details_id'];
                    $menu->t_class_details_id     = $formData['TNoticeDetails']['t_class_details_id'];
                    $menu->notice_details         = $formData['TNoticeDetails']['notice_details'];
                    $menu->date                   = $date;
                    $menu->updated_at             = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        return Redirect::to('/setting/add_notice_details_data')->with('message', 'Data has been update successfully');
                    } else {
                        return Redirect::to('/setting/add_notice_details_data')->with('message', 'Unable to save data');
                    }
                } else {
                    return Redirect::to('/setting/add_notice_details_data')->with('message', 'This Data already Exist');
                }
            } else {
                $date              = date('d-m-Y');
                $menu_data = TNoticeDetails::where('question_details', '=', $formData['TNoticeDetails']['notice_details'])
                            ->where('date', '=', $date) 
                            ->count();
                if ($menu_data == 0) {
                    $menu = new TNoticeDetails();
                    $menu->t_board_details_id     = $formData['TNoticeDetails']['t_board_details_id'];
                    $menu->t_class_details_id     = $formData['TNoticeDetails']['t_class_details_id'];
                    $menu->notice_details         = $formData['TNoticeDetails']['notice_details'];
                    $menu->date                   = $date;
                    $menu->is_active                = 'Y';
                    $menu->created_at               = date('Y-m-d h:i:s');
                    $menu->updated_at               = date('Y-m-d h:i:s');
                    $menu->save();
                    if ($menu) {
                        return Redirect::to('/setting/add_notice_details_data')->with('message', 'Data has been saved successfully');
                    } else {
                        return Redirect::to('/setting/add_notice_details_data')->with('message', 'Unable to save data');
                    }
                } else {
                    return Redirect::to('/setting/add_notice_details_data')->with('message', 'This Data already Exist');
                }
            }
        } else {
            return Redirect::to('home/login');
        }exit;
    }
}
