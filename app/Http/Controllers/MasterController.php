<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\TMenu;
use App\Models\TRole;
use App\Models\TSubMenu;
use App\Models\TRoleMenu;
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

class MasterController extends Controller {
	
    public function addMenu(Request $request) {
        $dbObj = [];
        $page_limit = 10;
        $dbObj = TMenu::paginate($page_limit);
        if ($request->has('search') && $request->get('search') != '') {
            $keyword = $request->get('search');
            $dbObj = TMenu::where('menu_name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('menu_order', 'LIKE', '%' . $keyword . '%')
                ->paginate($page_limit);
        }
        return View::make('master.add_menu', compact('dbObj'));
    }

    public function addMenuData($id = 0) {
        $viewDataObj = "";
        $id = base64_decode(base64_decode($id));
		if ($id != '') {
             $viewDataObj = TMenu::find($id);
        }
		return View::make('master.add_menu_data',compact('viewDataObj'));
    }
	public function validateMenuData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TMenu']) && is_array($formValArr['TMenu']) && count($formValArr['TMenu']) > 0) {
                $validator = Validator::make($formValArr['TMenu'], TMenu::$rules, TMenu::$messages);
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
	public function saveMenu(Request $request){
		$formData 								= 	Input::all();
		if (isset(Auth::user()->_id) && Auth::user()->_id) {
			parse_str($formData['formdata'], $formDataArr);
			$id = $formDataArr['_id'];
			if (isset($id) && $id != 0) {
				$menu_data 								=    TMenu::where('menu_name','=',$formDataArr['TMenu']['menu_name'])
																	->where('_id','!=',$id)
																	->count();
				if($menu_data == 0){
					$menu        						=    TMenu::find($id);
					$menu->menu_name                    =   $formDataArr['TMenu']['menu_name'];
					$menu->menu_order                   =   $formDataArr['TMenu']['menu_order'];
					$menu->menu_icon                    =   $formDataArr['TMenu']['menu_icon'];
					$menu->menu_url                     =   $formDataArr['TMenu']['menu_url'];
					$menu->controller                   =   $formDataArr['TMenu']['controller'];
					$menu->save();
					if($menu){
						 echo '****SUCCESS****Menu has been update successfully.';
					}else{
						echo '****ERROR****Unable to save data.';
					}
				}else{
					echo '****ERROR****This Menu already Exist.';
				}
			}else{
				$menu_data 								=   TMenu::where('menu_name','=',$formDataArr['TMenu']['menu_name'])
																	->count();
				if($menu_data == 0){
					$menu     							= 	new TMenu();
					$menu->menu_name                    =   $formDataArr['TMenu']['menu_name'];
					$menu->menu_order                   =   $formDataArr['TMenu']['menu_order'];
					$menu->menu_icon                    =   $formDataArr['TMenu']['menu_icon'];
					$menu->menu_url                     =   $formDataArr['TMenu']['menu_url'];
					$menu->controller                   =   $formDataArr['TMenu']['controller'];
					$menu->is_active                    =   'Y';
					$menu->created_at       			=   date('Y-m-d h:i:s');
					$menu->updated_at       			=   date('Y-m-d h:i:s');
					$menu->save();
					if($menu){
						echo '****SUCCESS****Menu has been saved successfully.';
					}else{
						 echo '****ERROR****Unable to save data.';
					}
				}else{
					 echo '****ERROR****This Menu already Exist.';
				}
			}	 
		} else {
            return Redirect::to('home/login');
        }exit;
	}
	public function menuActive($id=0) {
         if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$menu        				=    TMenu::find($id);
			$menu->is_active		    =	 'Y';
			$menu->save();
			if($menu){
				Session::flash('message','menu has been Active successfully.');
				return back();
			}else{
				Session::flash('error','Unable to update record.');
				return back();
			}
        } else {
			return Redirect::to('home/login');
        }exit;
    }
	public function menuDeactive($id=0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$menu        				=    TMenu::find($id);
			$menu->is_active		    =	 'N';
			$menu->save();
			if($menu){
				Session::flash('message','menu has been In-active successfully.');
				return back();
			}else{
				Session::flash('error','Unable to update record.');
				return back();
			}
        } else {
           return Redirect::to('home/login');
        }exit;
    }
	public function menuDelete($id=0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$menu        				=    TMenu::destroy($id);
			if($menu){
				Session::flash('message','menu has been Delete successfully.');
				return back();
			}else{
				Session::flash('error','Unable to delete record.');
				return back();
			}
        } else {
			return Redirect::to('home/login');
        }exit;
    }
	
	public function addRole(Request $request) {
        $dbObj    	   = [];
		$page_limit    = 10;
        $dbObj         = TRole::paginate($page_limit);
		if ($request->has('search') && $request->get('search')!='') {
			$keyword        =	$request->get('search');
			$dbObj          = 	TRole::where('role_name','LIKE','%'.$keyword.'%')
										->paginate($page_limit);
		}
		return View::make('master.add_role',compact('dbObj'));
    }
	public function addRoleData($id = 0) {
        $viewDataObj = "";
        $id = base64_decode(base64_decode($id));
		if ($id != '') {
             $viewDataObj = TRole::find($id);
        }
		return View::make('master.add_role_data',compact('viewDataObj'));
    }
	public function validateRoleData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TRole']) && is_array($formValArr['TRole']) && count($formValArr['TRole']) > 0) {
                $validator = Validator::make($formValArr['TRole'], TRole::$rules, TRole::$messages);
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
	public function saveRole(Request $request){
		$formData 								= 	Input::all();
		if (isset(Auth::user()->_id) && Auth::user()->_id) {
			parse_str($formData['formdata'], $formDataArr);
			$id = $formDataArr['_id'];
			if (isset($id) && $id != 0) {
				$role_data 								=    TRole::where('role_name','=',$formDataArr['TRole']['role_name'])
																	->where('_id','!=',$id)
																	->count();
				if($role_data == 0){
					$role        						=    TRole::find($id);
					$role->role_name                    =    $formDataArr['TRole']['role_name'];
					$role->save();
					if($role){
						 echo '****SUCCESS****Data has been update successfully.';
					}else{
						echo '****ERROR****Unable to save data.';
					}
				}else{
					echo '****ERROR****This Data already Exist.';
				}
			}else{
				$role_data 								=   TRole::where('role_name','=',$formDataArr['TRole']['role_name'])
																	->count();
				if($role_data == 0){
					$role     							= 	new TRole();
					$role->role_name                    =   $formDataArr['TRole']['role_name'];
					$role->is_active                    =   'Y';
					$role->created_at       			=   date('Y-m-d h:i:s');
					$role->updated_at       			=   date('Y-m-d h:i:s');
					$role->save();
					if($role){
						echo '****SUCCESS****Data has been saved successfully.';
					}else{
						 echo '****ERROR****Unable to save data.';
					}
				}else{
					 echo '****ERROR****This Data already Exist.';
				}
			}	 
		} else {
       
            return Redirect::to('home/login');
        }exit;
	}
	public function roleActive($id=0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$role        				=    TRole::find($id);
			$role->is_active		    =	 'Y';
			$role->save();
			if($role){
				Session::flash('message','role has been Active successfully.');
				return back();
			}else{
				Session::flash('error','Unable to update record.');
				return back();
			}
        } else {
       
            return Redirect::to('home/login');
        }exit;
    }
	public function roleDeactive($id=0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$role        				=    TRole::find($id);
			$role->is_active		    =	 'N';
			$role->save();
			if($role){
				Session::flash('message','role has been In-active successfully.');
				return back();
			}else{
				Session::flash('error','Unable to update record.');
				return back();
			}
        } else {
			return Redirect::to('home/login');
        }exit;
    }
	
	public function addSubMenu(Request $request) {
        $dbObj    	   = [];
		$page_limit    = 10;
        $dbObj         = TSubMenu::paginate($page_limit);
		$menuArr       = Controller::getMenuListForSubMenu('t_menus','menu_name');
		if ($request->has('search_sub_menu_name') && $request->get('search_sub_menu_name')!='') {
			$keyword        =	$request->get('search_sub_menu_name');
			$dbObj          = 	TSubMenu::where('sub_menu_name','LIKE','%'.$keyword.'%')
										->paginate($page_limit);
		}
		if ($request->has('search_menu_id') && $request->get('search_menu_id')!='') {
			$keyword        =	$request->get('search_menu_id');
			$dbObj          = 	TSubMenu::where('t_menu_id','LIKE','%'.$keyword.'%')
										->paginate($page_limit);
		}
		return View::make('master.add_sub_menu',compact('dbObj','menuArr'));
    }
	public function addSubMenuData($id = 0) {
        $viewDataObj = "";
        $id = base64_decode(base64_decode($id));
		$menuArr       = Controller::getMenuListForSubMenu();
		if ($id != '') {
             $viewDataObj = TSubMenu::find($id);
        }
		return View::make('master.add_sub_menu_data',compact('viewDataObj','menuArr'));
    }
	public function validateSubMenuData() {
        $valiationArr = array();
        $formValArr = array();
        parse_str(Input::all()['formData'], $formValArr);
        if (is_array($formValArr) && count($formValArr) > 0) {
            if (isset($formValArr['TSubMenu']) && is_array($formValArr['TSubMenu']) && count($formValArr['TSubMenu']) > 0) {
                $validator = Validator::make($formValArr['TSubMenu'], TSubMenu::$rules, TSubMenu::$messages);
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
	public function saveSubMenu(Request $request){
		$formData 								= 	Input::all();
		if (isset(Auth::user()->_id) && Auth::user()->_id) {
			parse_str($formData['formdata'], $formDataArr);
			$id = $formDataArr['_id'];
			if (isset($id) && $id != 0) {
				$sub_menu_data 							=   TSubMenu::where('t_menu_id','=',$formDataArr['TSubMenu']['t_menu_id'])
																		->where('sub_menu_name', '=',$formDataArr['TSubMenu']['sub_menu_name'])
																		->where('sub_menu_url', '=',$formDataArr['TSubMenu']['sub_menu_url'])
																		->where('_id','!=',$id)
																		->count();
				if($sub_menu_data == 0){
					$sub_menu        						=   TSubMenu::find($id);
					$sub_menu->t_menu_id                    =   $formDataArr['TSubMenu']['t_menu_id'];
					$sub_menu->sub_menu_name                =   $formDataArr['TSubMenu']['sub_menu_name'];
					$sub_menu->sub_menu_order               =   $formDataArr['TSubMenu']['sub_menu_order'];
					$sub_menu->sub_menu_url                 =   $formDataArr['TSubMenu']['sub_menu_url'];
					$sub_menu->action                   	=   $formDataArr['TSubMenu']['action'];
					$sub_menu->sub_menu_icon                =   $formDataArr['TSubMenu']['sub_menu_icon'];
					$sub_menu->save();
					if($sub_menu){
						 echo '****SUCCESS****Sub Menu has been update successfully.';
					}else{
						echo '****ERROR****Unable to save data.';
					}
				}else{
					echo '****ERROR****This Sub Menu already Exist.';
				}
			}else{
				//echo'<pre>';print_r($formDataArr);echo'</pre>';exit;
				$sub_menu_data 								=   TSubMenu::where('t_menu_id','=',$formDataArr['TSubMenu']['t_menu_id'])
																		->where('sub_menu_name', '=',$formDataArr['TSubMenu']['sub_menu_name'])
																		->where('sub_menu_url', '=',$formDataArr['TSubMenu']['sub_menu_url'])
																		->count();
				if($sub_menu_data == 0){
					$sub_menu     							= 	new TSubMenu();
					$sub_menu->t_menu_id                    =   $formDataArr['TSubMenu']['t_menu_id'];
					$sub_menu->sub_menu_name                =   $formDataArr['TSubMenu']['sub_menu_name'];
					$sub_menu->sub_menu_order               =   $formDataArr['TSubMenu']['sub_menu_order'];
					$sub_menu->sub_menu_url                 =   $formDataArr['TSubMenu']['sub_menu_url'];
					$sub_menu->action                   	=   $formDataArr['TSubMenu']['action'];
					$sub_menu->sub_menu_icon                =   $formDataArr['TSubMenu']['sub_menu_icon'];
					$sub_menu->is_active                    =   'Y';
					$sub_menu->save();
					if($sub_menu){
						echo '****SUCCESS****Sub Menu has been saved successfully.';
					}else{
						 echo '****ERROR****Unable to save data.';
					}
				}else{
					 echo '****ERROR****This Sub Menu already Exist.';
				}
			}	 
		} else {
            return Redirect::to('home/login');
        }exit;
	}
	public function submenuActive($id=0) {
         if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$menu        				=    TSubMenu::find($id);
			$menu->is_active		    =	 'Y';
			$menu->save();
			if($menu){
				Session::flash('message','sub menu has been Active successfully.');
				return back();
			}else{
				Session::flash('error','Unable to update record.');
				return back();
			}
        } else {
			return Redirect::to('home/login');
        }exit;
    }
	public function submenuDeactive($id=0) {
        if (isset(Auth::user()->_id) && Auth::user()->_id) {
			$id 						= 	 base64_decode(base64_decode($id));
			$menu        				=    TSubMenu::find($id);
			$menu->is_active		    =	 'N';
			$menu->save();
			if($menu){
				Session::flash('message','sub menu has been In-active successfully.');
				return back();
			}else{
				Session::flash('error','Unable to update record.');
				return back();
			}
        } else {
           return Redirect::to('home/login');
        }exit;
    }

	public function addRoleMenu() {
        $layoutArr = [];
        $viewDataObj = [];
        $roleArr       = Controller::getRoleListForAssign();

        $layoutArr = array(
            'roleArr' => $roleArr,
        );
        return view('master.add_role_menu', compact('layoutArr'));
    }
	public function rolewisemenu() {
        $menuSubMenuArr 		= array();
        $editMenuList 			= array();
        $editSubMenuList		= array();
        $menuSubMenuArr 		= [];
        $t_role_id 				= Input::get('t_role_id');
		
        if ($t_role_id != '') {
            $editMenuListFind = TRoleMenu::where('t_role_id','=',$t_role_id)->get();
			if (is_object($editMenuListFind)) {
                foreach ($editMenuListFind as $editMenuListKey => $editMenuListVal) {
                    $editMenuList[] = $editMenuListVal->t_menu_id;
                    $editSubMenuList[] = $editMenuListVal->t_sub_menu_id;
                }
            }
        }
        $menuObj = TMenu::where('is_active','=','Y')->orderBy('menu_order')->get();
		if (is_object($menuObj)) {
            foreach ($menuObj as $menuKey => $menuData) {
                $subMenuObj = TSubMenu::where('t_menu_id', '=', $menuData->_id)
                    ->where('is_active', '=', "Y")
                    ->orderBy('sub_menu_order')
                    ->get();

                $menuSubMenuArr[$menuData->_id] = $subMenuObj;
            }
        }
		$layoutArr = array(
            'menuSubMenuArr' => $menuSubMenuArr,
            'editMenuList' => $editMenuList,
            'editSubMenuList' => $editSubMenuList,
        );
		return view('master.role-wise-menu', compact('layoutArr'));
    }
	public function saveRoleMenu() {
        $valiationArr = array();
        if (isset(Auth::user()->id) && Auth::user()->id) {
            $formData = Input::all();
            $formDataArr = array();
            if (isset($formData['formdata']) && $formData['formdata'] != '') {
                parse_str($formData['formdata'], $formDataArr);
				//echo'<pre>';print_r($formDataArr);echo'</pre>';exit;
                $validator = Validator::make($formDataArr['TRoleMenu'], TRoleMenu::$rules, TRoleMenu::$messages);
                if ($validator->fails()) {
                    $errorArr = $validator->getMessageBag()->toArray();
                    if (isset($errorArr) && is_array($errorArr) && count($errorArr) > 0) {
                        foreach ($errorArr as $errorKey => $errorVal) {
                            $valiationArr[] = array(
                                'modelField' => $errorKey,
                                'modelErrorMsg' => $errorVal[0],
                            );
                        }
                        echo '****FAILURE****' . json_encode($valiationArr);
                        exit;
                    }
                } else {
                    if ((isset($formDataArr['menuIdArr']) && is_array($formDataArr['menuIdArr']) && count($formDataArr['menuIdArr']) > 0) ||
                        (isset($formDataArr['subMenuIdArr']) && is_array($formDataArr['subMenuIdArr']) && count($formDataArr['subMenuIdArr']) > 0)
                    ) {
                        $loopCnt = 0;
                        $saveCnt = 0;
                        $t_role_id = $formDataArr['TRoleMenu']['t_role_id'];
                       

                        if (DB::collection('t_role_menus')->where('t_role_id','=',$t_role_id)->count()) {
                            try {
                                $loopCnt++;
                                TRoleMenu::where('t_role_id', '=', $t_role_id)->delete();
                                $saveCnt++;
                            } catch (ValidationException $e) {
                                
                            } catch (\Exception $e) {
                                
                            }
                        }
                        if (isset($formDataArr['menuIdArr']) && is_array($formDataArr['menuIdArr']) && count($formDataArr['menuIdArr']) > 0) {
                            foreach ($formDataArr['menuIdArr'] as $key => $val) {
                                $loopCnt++;
                                $dataArrInsert = array(
                                    't_role_id'     => $t_role_id,
                                    't_menu_id'     => $val,
                                    't_sub_menu_id' => null,
                                    'is_active'     => 'Y',
									'created_at' 	=> date('Y-m-d h:i:s'),
                                    'updated_at' 	=> date('Y-m-d h:i:s'),
                                );
                                try {
                                    DB::collection('t_role_menus')->insert($dataArrInsert);
                                    $saveCnt++;
                                } catch (ValidationException $e) {
                                    
                                } catch (\Exception $e) {
                                    
                                }
                            }
                        }
                        if (isset($formDataArr['subMenuIdArr']) && is_array($formDataArr['subMenuIdArr']) && count($formDataArr['subMenuIdArr']) > 0) {
                            foreach ($formDataArr['subMenuIdArr'] as $key => $val) {
                                $loopCnt++;
                                $t_menu_id = Controller::getMenuIdBySubMenuId($val);
								$dataArrInsert = array(
                                    't_role_id' 	=> $t_role_id,
                                    't_menu_id' 	=> $t_menu_id,
                                    't_sub_menu_id' => $val,
                                    'is_active' 	=> 'Y',
                                    'created_at' 	=> date('Y-m-d h:i:s'),
                                    'updated_at' 	=> date('Y-m-d h:i:s'),
                                );
                                try {
                                    DB::collection('t_role_menus')->insert($dataArrInsert);
                                    $saveCnt++;
                                } catch (ValidationException $e) {
                                    
                                } catch (\Exception $e) {
                                    
                                }
                            }
                        }
                        // echo "<pre>"; print_r($loopCnt."++".$saveCnt); echo "<pre>";  exit;
                        if ($loopCnt == $saveCnt) {
                            DB::commit();
                            echo '****SUCCESS****Role menu has been saved successfully.';
                        } else {
                            DB::rollback();
                            echo '****ERROR****Unable to save Role menu.';
                        }
                    } else {
                        echo '****ERROR****Please select at least one menu or sub menu.';
                    }exit;
                }
            }
        }
    }
}