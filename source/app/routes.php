<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


/**
 * This route to redirect user to login page
 */
Route::get('/', function()
{
    return Redirect::to('login');
});


/**
 * Admin panel Route controllers. See each  controller for more details.
 */
Route::controller('/admin-panel/ajax', 'AjaxControllerAdmin');
Route::resource('/admin-panel/admins', 'AdminManagementController');
Route::resource('/admin-panel/employees', 'EmployeeManagementController');
Route::resource('/admin-panel/applicants', 'ApplicantManagementController');
Route::resource('/admin-panel/interview-schedules', 'InterviewScheduleController');
Route::resource('/admin-panel/jobs', 'JobController');
Route::resource('/admin-panel/notices', 'NoticeController');
Route::resource('/admin-panel/groups', 'GroupController');
Route::resource('/admin-panel/departments', 'DepartmentController');
Route::controller('/admin-panel', 'AdminController');

/**
 * Employee panel Route controllers. See each  controller for more details.
 */
Route::controller('/employee-panel/ajax', 'AjaxControllerEmployee');
Route::resource('/employee-panel/equipments', 'EmployeeEquipmentController');
Route::resource('/employee-panel/leave', 'EmployeeLeaveController');
Route::controller('/employee-panel', 'EmployeeController');

/**
 * Main Route controller to maintain login, logout, dashboard.
 */
Route::controller('/', 'MainController');
