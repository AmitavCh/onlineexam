<?php
namespace App\Http\Controllers;
use App\Models\TMenu;
use App\Models\TSubMenu;
use App\Models\TRole;
use App\Models\TRoleMenu;
use App\Models\TBoardDetails;
use App\Models\TClassDetails;
use App\Models\TTopicDetails;
use App\Models\TSubjectDetails;
use App\Models\TTopicWiseQuestionDetails;
use App\Models\TRegdUserDetails;
use DB;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	public static function getRoleListForUser() {
        $responseArr               = [];
        $responseObjArr         = TRole::select('role_name', '_id')->where('is_active','Y')->orderby('_id','asc')->get();
		foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->role_name;

        }
        return $responseArr;
    }
	public static function getRoleListForAssign() {
        $responseArr               = [];
		$responseArr[0]['id']   = "";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TRole::select('role_name', '_id')->where('is_active','Y')->orderby('_id','asc')->get();
		foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->role_name;

        }
        return $responseArr;
    }
	public static function getMenuListForSubMenu() {
        $responseArr               = [];
		$responseArr[0]['id']   = "";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TMenu::select('menu_name', '_id')->where('is_active','Y')->orderby('_id','asc')->get();
		foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->menu_name;

        }
        return $responseArr;
    }
	public static function getRoleName($id) {
        $response = '';
        $roleObj = TRole::select('role_name')->where('_id','=',$id)->first();
        if (isset($roleObj->role_name) && $roleObj->role_name != '') {
            $response = $roleObj->role_name;
        }
        return $response;
    }
	public static function getMenuName($id) {
        $response = '';
        $roleObj = TMenu::select('menu_name')->where('_id','=',$id)->first();
        if (isset($roleObj->menu_name) && $roleObj->menu_name != '') {
            $response = $roleObj->menu_name;
        }
        return $response;
    }
    public static function getBoardName($id) {
        $response = '';
        $roleObj = TBoardDetails::select('board_name')->where('_id','=',$id)->first();
        if (isset($roleObj->board_name) && $roleObj->board_name != '') {
            $response = $roleObj->board_name;
        }
        return $response;
    }
    public static function getClassName($id) {
        $response = '';
        $roleObj = TClassDetails::select('class_name')->where('_id','=',$id)->first();
        if (isset($roleObj->class_name) && $roleObj->class_name != '') {
            $response = $roleObj->class_name;
        }
        return $response;
    }
    public static function getSubjectName($id) {
        $response = '';
        $roleObj = TSubjectDetails::select('subject_name')->where('_id','=',$id)->first();
        if (isset($roleObj->subject_name) && $roleObj->subject_name != '') {
            $response = $roleObj->subject_name;
        }
        return $response;
    }
    public static function getBoardNameByClassId($id) {
        $response = '';
        $roleObj = TClassDetails::select('t_board_details_id')->where('_id','=',$id)->first();
        if (isset($roleObj->t_board_details_id) && $roleObj->t_board_details_id != '') {
            $response = self::getBoardName($roleObj->t_board_details_id);
        }
        return $response;
    }
    public static function getTotalNumerOfQuestionsByTopicId($id) {
        $response = '';
        $roleObj = TTopicWiseQuestionDetails::where('t_topic_details_id','=',$id)->count();
        return $roleObj;
    }
	public static function getDisplayFieldName($id = 0, $table_name = '', $fieldArr = array()){
        $response      = '';
        $dbResponseObj = '';
        if ($id != '') {
            $responseObj = DB::collection("$table_name")
                ->where("_id",'=',"$id");
            if (is_array($fieldArr) && count($fieldArr) > 0) {
                foreach ($fieldArr as $colKey => $cloName) {
                    $selectArr[] = "$table_name.$cloName";
                }
                $responseObj->select($selectArr);
            }
			echo'<pre>';print_r($responseObj->first());echo'</pre>';exit;
            $dbResponseObj = $responseObj->first();
        }
		
		
        if (is_array($fieldArr) && count($fieldArr) > 0) {
            foreach ($fieldArr as $colKey => $cloName) {
                if (isset($dbResponseObj->$cloName) && $dbResponseObj->$cloName != '') {
                    $response .= $dbResponseObj->$cloName;
                }
            }
        }
        return $response;
    }
	public static function getMenuIdBySubMenuId($id) {
        $response = '';
        $roleObj = TSubMenu::select('t_menu_id')->where('_id','=',$id)->first();
        if (isset($roleObj->t_menu_id) && $roleObj->t_menu_id != '') {
            $response = $roleObj->t_menu_id;
        }
        return $response;
    }
	public static function getMenuSubmenu() {
		$menuSubmenuArr = array();
		$menuSubMenuObj = TMenu::with(array('submenus' => function($query) {

                        $query->where('is_active', '=', 'Y')
                        ->orderBy('sub_menu_order');
                    }))
                ->where('is_active', '=', 'Y')
                ->orderBy('menu_order')
                ->get();
		//$menuSubMenuObj = TMenu::where('is_active','=','Y')->orderBy('menu_order','ASC')->get();
		//$menuSubMenuObjs = $menuSubMenuObj->hasMany('App\Models\TSubMenu');
		
		if ($menuSubMenuObj) {
			$menuSubmenuArr = $menuSubMenuObj->toArray();
        }
		//echo'<pre>';print_r( $menuSubmenuArr);echo'</pre>';exit;
		return $menuSubmenuArr;
		
    }
    public static function getRoleMenuAdminLeftPane($editMenuListFind = array()) {
		$roleMenuArr = array();
		//$editMenuListFind = array();
		
			if (isset(Auth::user()->role_id) && Auth::user()->role_id != '') {
				$editMenuListFind = TRoleMenu::where('t_role_id','=',Auth::user()->role_id)
                    ->select(array('t_menu_id','t_sub_menu_id'))
                    ->get();
					
			//if (is_array($editMenuListFind) && count($editMenuListFind) > 0) {
				foreach ($editMenuListFind as $editMenuListKey => $editMenuListVal) {
					
					$editMenuList[] = $editMenuListVal->t_menu_id;
					$editSubMenuList[] = $editMenuListVal->t_sub_menu_id;
                }
				$roleMenuArr['editMenuList'] = $editMenuList;
				$roleMenuArr['editSubMenuList'] = $editSubMenuList;
            //}
        }
		
		return $roleMenuArr;
    }
    public static function getBoardListForClass() {
        $responseArr               = [];
		$responseArr[0]['id']   = "";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TBoardDetails::select('board_name', '_id')->where('is_active','Y')->orderby('_id','asc')->get();
		foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->board_name;

        }
        return $responseArr;
    }
    public static function getClassListForSubject() {
        $responseArr               = [];
		$responseArr[0]['id']   = "";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TClassDetails::select('class_name', '_id')->where('is_active','Y')->orderby('_id','asc')->get();
		foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->class_name;

        }
        return $responseArr;
    }
    public static function getSubjectListForTopic() {
        $responseArr               = [];
		$responseArr[0]['id']   = "";
        $responseArr[0]['name'] = "Select";
        $responseObjArr         = TSubjectDetails::select('subject_name', '_id')->where('is_active','Y')->orderby('_id','asc')->get();
		foreach ($responseObjArr as $resKey => $resVal) {
            $responseArr[$resKey + 1]['id']   = $resVal->_id;
            $responseArr[$resKey + 1]['name'] = $resVal->subject_name;

        }
        return $responseArr;
    }
     
    public static function getClassNameByRegdUserId($id){
        $response = '';
        $roleObj = TRegdUserDetails::select('t_class_details_id')->where('_id','=',$id)->first();
        if (isset($roleObj->t_class_details_id) && $roleObj->t_class_details_id != '') {
            $response = self::getClassName($roleObj->t_class_details_id);
        }
        return $response;
    }

    public static function getBoardNameByRegdUserId($id){
        $response = '';
        $roleObj = TRegdUserDetails::select('t_board_details_id')->where('_id','=',$id)->first();
        if (isset($roleObj->t_board_details_id) && $roleObj->t_board_details_id != '') {
            $response = self::getBoardName($roleObj->t_board_details_id);
        }
        return $response;
    }

    public static function getInstituteNameByRegdUserId($id){
        $response = '';
        $roleObj = TRegdUserDetails::select('institute_name')->where('_id','=',$id)->first();
        if (isset($roleObj->institute_name) && $roleObj->institute_name != '') {
            $response = $roleObj->institute_name;
        }
        return $response;
    }
}
