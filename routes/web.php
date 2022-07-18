<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;
use App\Http\Controllers\employeeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });



// ALL ADMIN ROUTES STARTS...................

// Route::get('age',[adminController::class,'age']);

Route::get('/admin', function () {
    return view('admin.admin_login');
});

Route::post('admin_Login',[adminController::class,'admin_Login']);
Route::get('admin_logout', function(){
    if(session()->has('admin_login_session')){
        // session()->flush('admin_login_session');
        Session::forget('admin_login_session');
    }
    return redirect('admin');
});

Route::get('admin_profile_data',[adminController::class,'admin_profile_data']);
Route::post('admin_profile_update/{id}',[adminController::class,'admin_profile_update']);
Route::post('admin_profile_img/{id}',[adminController::class,'admin_profile_img']);

Route::get('dashboard', [adminController::class,'dashboard']);

// Route::view('add_employee','admin.add_employee');
Route::get('add_employee',function(){
    if(session()->has('admin_login_session')){
        return view('admin.add_employee');
    }
    else{
        return redirect('admin');
    }
    
});

Route::post('add_employee',[adminController::class,'store_employee']);
Route::get('employee_view/{id1}/{id2}',[adminController::class,'fetch_employee']);
Route::get('employee_view_detail/{id}',[adminController::class,'employee_view_detail']);
Route::get('delete_employee/{id}',[adminController::class,'delete_employee']);
Route::get('edit_employee/{id}',[adminController::class,'edit_employee']);
Route::post('update_employee/{id}',[adminController::class,'update_employee']);

Route::get('create_team',[adminController::class,'create_team']);
Route::post('store_create_team',[adminController::class,'store_create_team']);
Route::get('team_view',[adminController::class,'team_view']);
Route::get('add_team_member/{id}',[adminController::class,'add_team_member']);
Route::post('store_team_member/{id}',[adminController::class,'store_team_member']);
Route::get('delete_team/{id}',[adminController::class,'delete_team']);
Route::get('team_view_detail/{id}',[adminController::class,'team_view_detail']);

Route::get('edit_team/{id}',[adminController::class,'edit_team']);
Route::post('edit_delete_team_member/{id}',[adminController::class,'edit_delete_team_member']);
Route::post('edit_add_team_member/{id}',[adminController::class,'edit_add_team_member']);
Route::post('edit_team_manager/{id}',[adminController::class,'edit_team_manager']);
Route::post('edit_team_leader/{id}',[adminController::class,'edit_team_leader']);

Route::get('create_project',[adminController::class,'create_project']);
Route::post('add_project',[adminController::class,'add_project']);
Route::get('project_view',[adminController::class,'project_view']);
Route::get('delete_project/{id}',[adminController::class,'delete_project']);
Route::get('project_view_detail/{id}',[adminController::class,'project_view_detail']);
Route::get('project_issue_view/{id}',[adminController::class,'project_issue_view']);
Route::get('project_assign/{id}',[adminController::class,'project_assign']);
Route::get('already_assign',[adminController::class,'already_assign']);
Route::post('add_project_assign/{id}',[adminController::class,'add_project_assign']);
Route::get('edit_project/{id}',[adminController::class,'edit_project']);
Route::get('update_project/{id}',[adminController::class,'update_project']);
Route::get('not_edit',[adminController::class,'not_edit']);

// ALL ADMIN ROUTES ENDS...................






// ALL EMPLOYEE ROUTES START..................

Route::get('/employee', function () {
    return view('employee.employee_login');
});

// Route::get('employee_logout', function(){
//     if(session()->has('employee_login_session')){
//         // session()->flush('employee_login_session');
//         Session::forget('employee_login_session');
//     }
//     return redirect('employee');
// });
Route::post('employee_Login',[employeeController::class,'employee_Login']);
Route::get('employee_logout', [employeeController::class,'employee_logout']);

Route::get('employee_dashboard', [employeeController::class,'employee_dashboard']);

Route::get('employee_profile_data/{id}',[employeeController::class,'employee_profile_data']);
Route::post('employee_profile_update/{id}',[employeeController::class,'employee_profile_update']);
Route::post('employee_profile_img/{id}',[employeeController::class,'employee_profile_img']);

Route::get('employee_change_password/{id}',[employeeController::class,'employee_change_password']);
Route::get('employee_otp',[employeeController::class,'employee_otp']);
Route::get('employee_otp_submit',[employeeController::class,'employee_otp_submit']);
Route::post('employee_update_password/{id}',[employeeController::class,'employee_update_password']);

Route::get('taskmanager_projects',[employeeController::class,'taskmanager_projects']);
Route::get('projects_view_detail/{id}',[employeeController::class,'projects_view_detail']);
Route::get('edit_project_status/{id}',[employeeController::class,'edit_project_status']);
Route::post('update_project_status/{id}',[employeeController::class,'update_project_status']);
Route::get('create_task/{id}',[employeeController::class,'create_task']);
Route::post('add_task/{id}',[employeeController::class,'add_task']);

Route::get('create_issue_project/{id}',[employeeController::class,'create_issue_project']);
Route::post('add_project_issue/{id}',[employeeController::class,'add_project_issue']);
Route::post('edit_project_issue/{id}',[employeeController::class,'edit_project_issue']);
Route::get('delete_project_issue/{id}',[employeeController::class,'delete_project_issue']);

Route::get('taskmanager_teams',[employeeController::class,'taskmanager_teams']);
Route::get('task',[employeeController::class,'task']);
Route::get('task_filter',[employeeController::class,'task_filter']);
Route::get('delete_task/{id}',[employeeController::class,'delete_task']);
Route::get('task_view_detail/{id}',[employeeController::class,'task_view_detail']);
Route::get('edit_task/{id}',[employeeController::class,'edit_task']);
Route::post('update_task/{id}',[employeeController::class,'update_task']);
Route::get('task_issue_view/{id}',[employeeController::class,'task_issue_view']);



// member_route
Route::get('member_task',[employeeController::class,'member_task']);
Route::get('member_task_view/{id}',[employeeController::class,'member_task_view']);
Route::get('edit_task_status/{id}',[employeeController::class,'edit_task_status']);
Route::post('update_task_status/{id}',[employeeController::class,'update_task_status']);
Route::get('create_issue_task/{id}',[employeeController::class,'create_issue_task']);
Route::post('add_task_issue/{id}',[employeeController::class,'add_task_issue']);
Route::post('edit_task_issue/{id}',[employeeController::class,'edit_task_issue']);
Route::get('delete_task_issue/{id}',[employeeController::class,'delete_task_issue']);
Route::get('view_myteam',[employeeController::class,'view_myteam']);
//  ALL EMPLOYEE ROUTES ENDS.................