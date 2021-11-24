<?php
Route::get('/','HomeController@index')->name('index');
Route::get('home/aboutus','HomeController@aboutus')->name('aboutus');
Route::get('home/pricing','HomeController@pricing')->name('pricing');
Route::get('home/contact','HomeController@contact')->name('contact');
Route::get('home/register','HomeController@register')->name('register');
Route::get('home/login','HomeController@login')->name('login');
Route::post('home/signup','HomeController@signup')->name('signup');
Route::get('home/logout','HomeController@logout')->name('logout');
Route::get('home/userprofile','HomeController@userprofile')->name('userprofile');
Route::get('home/quickdemo','HomeController@quickdemo')->name('quickdemo');
Route::get('home/regdusergiventopicwiseexam/{arr}','HomeController@regdusergiventopicwiseexam')->name('regdusergiventopicwiseexam');
Route::get('home/updateprofile','HomeController@updateprofile')->name('updateprofile');
Route::post('home/userUpdateProfile','HomeController@userUpdateProfile')->name('userUpdateProfile');
Route::post('home/validateUserUpdateDetailsData','HomeController@validateUserUpdateDetailsData')->name('validateUserUpdateDetailsData');
Route::get('home/topic_by_question_selected_by_user/{id}','HomeController@topicByQuestionSelectedByUser')->name('topicByQuestionSelectedByUser');
Route::get('home/question_details_by_topic_selection','HomeController@questionDetailsByTopicSelection')->name('questionDetailsByTopicSelection');
Route::post('home/saveselectedtopicanswer','HomeController@saveselectedtopicanswer')->name('saveselectedtopicanswer');
Route::post('home/savesubmittopictest','HomeController@savesubmittopictest')->name('savesubmittopictest');
Route::get('home/resultlistbyselectedtopicbyuser/{id}','HomeController@resultlistbyselectedtopicbyuser')->name('resultlistbyselectedtopicbyuser');
Route::get('home/resultdetailsbytopicselection','HomeController@resultdetailsbytopicselection')->name('resultdetailsbytopicselection');

Route::post('home/validateUserRegdDetailsData','HomeController@validateUserRegdDetailsData')->name('validateUserRegdDetailsData');
Route::post('home/userRegistration','HomeController@userRegistration')->name('userRegistration');
Route::get('home/dashboard','HomeController@dashboard')->name('dashboard');
Route::get('home/topiclist','HomeController@topiclist')->name('topiclist');
Route::get('home/changepassword','HomeController@changepassword')->name('changepassword');
Route::post('home/updatePassword','HomeController@updatePassword')->name('updatePassword');

Route::post('user/signup','UserController@signup')->name('signup');

Route::get('dashboard/dashboard','DashboardController@dashboard')->name('dashboard');

Route::get('master/add_menu','MasterController@addMenu')->name('addMenu');
Route::get('master/add_menu_data','MasterController@addMenuData')->name('addMenuData');
Route::post('master/saveMenu','MasterController@savemenu')->name('saveMenu');
Route::post('master/validateMenuData','MasterController@validateMenuData')->name('validateMenuData');
Route::get('master/add_menu_data/{id}','MasterController@addMenuData')->name('addMenuData');
Route::get('master/menuDeactive/{id}','MasterController@menuDeactive')->name('menuDeactive');
Route::get('master/menuActive/{id}','MasterController@menuActive')->name('menuActive');
Route::get('master/menuDelete/{id}','MasterController@menuDelete')->name('menuDelete');

Route::get('master/add_role','MasterController@addRole')->name('addRole');
Route::get('master/add_role_data','MasterController@addRoleData')->name('addRoleData');
Route::post('master/validateRoleData','MasterController@validateRoleData')->name('validateRoleData');
Route::post('master/saveRole','MasterController@saveRole')->name('saveRole');
Route::get('master/add_role_data/{id}','MasterController@addRoleData')->name('addRoleData');
Route::get('master/roleDeactive/{id}','MasterController@roleDeactive')->name('roleDeactive');
Route::get('master/roleActive/{id}','MasterController@roleActive')->name('roleActive');

Route::get('user/add_user','UserController@addUser')->name('addUser');
Route::get('user/add_user_data','UserController@addUserData')->name('addUserData');
Route::post('user/saveMasterUser','UserController@saveMasterUser')->name('saveMasterUser');
Route::get('user/add_user_data/{id}','UserController@addUserData')->name('addUserData');
Route::get('user/userDeactive/{id}','UserController@userDeactive')->name('userDeactive');
Route::get('user/userActive/{id}','UserController@userActive')->name('userActive');
Route::post('user/validateMasterUser','UserController@validateMasterUser')->name('validateMasterUser');
Route::post('user/validateMasterUsers','UserController@validateMasterUsers')->name('validateMasterUsers');

Route::get('master/add_sub_menu','MasterController@addSubMenu')->name('addSubMenu');
Route::get('master/add_sub_menu_data','MasterController@addSubMenuData')->name('addSubMenuData');
Route::post('master/saveSubMenu','MasterController@savesubmenu')->name('saveSubMenu');
Route::post('master/validateSubMenuData','MasterController@validateSubMenuData')->name('validateSubMenuData');
Route::get('master/add_sub_menu_data/{id}','MasterController@addSubMenuData')->name('addSubMenuData');
Route::get('master/submenuDeactive/{id}','MasterController@submenuDeactive')->name('submenuDeactive');
Route::get('master/submenuActive/{id}','MasterController@submenuActive')->name('submenuActive');

Route::get('master/add_role_menu','MasterController@addRoleMenu')->name('addRoleMenu');
Route::get('master/role-wise-menu','MasterController@roleWiseMenu')->name('rolewisemenu');
Route::post('master/saveRoleMenu','MasterController@saveRoleMenu')->name('saveRoleMenu');

Route::get('setting/add_board_details','SettingController@addBoardDetails')->name('addBoardDetails');
Route::get('setting/add_board_details_data','SettingController@addBoardDetailsData')->name('addBoardDetailsData');
Route::post('setting/saveBoardDetails','SettingController@saveBoardDetails')->name('saveBoardDetails');
Route::post('setting/validateBoardDetailsData','SettingController@validateBoardDetailsData')->name('validateBoardDetailsData');
Route::get('setting/add_board_details_data/{id}','SettingController@addBoardDetailsData')->name('addBoardDetailsData');
Route::get('setting/boardDetailsDeactive/{id}','SettingController@boardDetailsDeactive')->name('boardDetailsDeactive');
Route::get('setting/boardDetailsActive/{id}','SettingController@boardDetailsActive')->name('boardDetailsActive');

Route::get('setting/add_class_details','SettingController@addClassDetails')->name('addClassDetails');
Route::get('setting/add_class_details_data','SettingController@addClassDetailsData')->name('addClassDetailsData');
Route::post('setting/saveClassDetails','SettingController@saveClassDetails')->name('saveClassDetails');
Route::post('setting/validateClassDetailsData','SettingController@validateClassDetailsData')->name('validateClassDetailsData');
Route::get('setting/add_class_details_data/{id}','SettingController@addClassDetailsData')->name('addClassDetailsData');
Route::get('setting/classDetailsDeactive/{id}','SettingController@classDetailsDeactive')->name('classDetailsDeactive');
Route::get('setting/classDetailsActive/{id}','SettingController@classDetailsActive')->name('classDetailsActive');

Route::get('setting/add_subject_details','SettingController@addSubjectDetails')->name('addSubjectDetails');
Route::get('setting/add_subject_details_data','SettingController@addSubjectDetailsData')->name('addSubjectDetailsData');
Route::post('setting/saveSubjectDetails','SettingController@saveSubjectDetails')->name('saveSubjectDetails');
Route::post('setting/validateSubjectDetailsData','SettingController@validateSubjectDetailsData')->name('validateSubjectDetailsData');
Route::get('setting/add_subject_details_data/{id}','SettingController@addSubjectDetailsData')->name('addSubjectDetailsData');
Route::get('setting/subjectDetailsDeactive/{id}','SettingController@subjectDetailsDeactive')->name('subjectDetailsDeactive');
Route::get('setting/subjectDetailsActive/{id}','SettingController@subjectDetailsActive')->name('subjectDetailsActive');

Route::get('setting/add_topic_details','SettingController@addTopicDetails')->name('addTopicDetails');
Route::get('setting/add_topic_details_data','SettingController@addTopicDetailsData')->name('addTopicDetailsData');
Route::post('setting/saveTopicDetails','SettingController@saveTopicDetails')->name('saveTopicDetails');
Route::post('setting/validateTopicDetailsData','SettingController@validateTopicDetailsData')->name('validateTopicDetailsData');
Route::get('setting/add_topic_details_data/{id}','SettingController@addTopicDetailsData')->name('addTopicDetailsData');
Route::get('setting/topicDetailsDeactive/{id}','SettingController@topicDetailsDeactive')->name('topicDetailsDeactive');
Route::get('setting/topicDetailsActive/{id}','SettingController@topicDetailsActive')->name('topicDetailsActive');

Route::post('setting/subjectnamelist','SettingController@subjectnamelist')->name('subjectnamelist');
Route::post('setting/topicnamelist','SettingController@topicnamelist')->name('topicnamelist');
Route::post('setting/classnamelistsbyboardid','SettingController@classnamelistsbyboardid')->name('classnamelistsbyboardid');
Route::post('home/classnamelist','HomeController@classnamelist')->name('classnamelist');
Route::post('home/topicnamesofselectedsubject','HomeController@topicnamesofselectedsubject')->name('topicnamesofselectedsubject');

Route::get('setting/add_topicwise_question_details','SettingController@addTopicwiseQuestionDetails')->name('addTopicwiseQuestionDetails');
Route::get('setting/add_topicwise_question_details_data','SettingController@addTopicwiseQuestionDetailsData')->name('addTopicwiseQuestionDetailsData');
Route::post('setting/saveTopicWiseQuestionsDetails','SettingController@saveTopicWiseQuestionsDetails')->name('saveTopicWiseQuestionsDetails');
Route::post('setting/validateTopicWiseQuestionDetailsData','SettingController@validateTopicWiseQuestionDetailsData')->name('validateTopicWiseQuestionDetailsData');
Route::get('setting/add_topicwise_questions_list/{id}','SettingController@addTopicwiseQuestionsList')->name('addTopicwiseQuestionsList');
Route::get('setting/topicWiseQuestionsActive/{id}','SettingController@topicWiseQuestionsActive')->name('topicWiseQuestionsActive');
Route::get('setting/topicWiseQuestionsDeactive/{id}','SettingController@topicWiseQuestionsDeactive')->name('topicWiseQuestionsDeactive');
Route::get('setting/add_topicwise_question_details_data/{id}','SettingController@addTopicwiseQuestionDetailsData')->name('addTopicwiseQuestionDetailsData');

Route::get('setting/add_notice_details','SettingController@addNoticeDetails')->name('addNoticeDetails');
Route::get('setting/add_notice_details_data','SettingController@addNoticeDetailsData')->name('addNoticeDetailsData');
Route::get('setting/add_notice_details_data/{id}','SettingController@addNoticeDetailsData')->name('addNoticeDetailsData');
Route::get('setting/noticeDetailsDeactive/{id}','SettingController@noticeDetailsDeactive')->name('noticeDetailsDeactive');
Route::get('setting/noticeDetailsActive/{id}','SettingController@noticeDetailsActive')->name('noticeDetailsActive');
Route::post('setting/validateNoticeDetailsData','SettingController@validateNoticeDetailsData')->name('validateNoticeDetailsData');
Route::post('setting/saveNoticeDetails','SettingController@saveNoticeDetails')->name('saveNoticeDetails');


