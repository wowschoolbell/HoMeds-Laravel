<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth','role:'.Modules\Superadmin\Entities\Role::ADMIN], 'prefix' => 'admin', 'as' => 'sa.'], function() {
    Route::get('/', 'SuperadminController@index');
    
    
    Route::get('sub_course_categories/course_category', 'SubCourseCategoryController@courseCategory')->name('sub_course_category.course_category');
    Route::get('sub_course_category.course_category', 'SuperadminController@index');
    Route::resource('sub_course_categories', 'SubCourseCategoryController');
    
    Route::resource('course_categories', 'CourseCategoryController');
    
    Route::post('courses/change_status', 'CourseController@changeStatus')->name('courses.change_status');
    Route::get('courses/addparticular', 'CourseController@addparticular')->name('courses.addparticular');
    Route::get('courses/addaccess', 'CourseController@addaccess')->name('courses.addaccess');
    Route::resource('courses', 'CourseController');

    Route::resource('event_categories', 'EventCategoryController');

    Route::post('events/change_status', 'EventController@changeStatus')->name('events.change_status');
    Route::get('events/participants', 'EventController@EventParticipants')->name('events.participants');
    Route::resource('events', 'EventController');

    Route::resource('users', 'UserController');

    Route::resource('backend_users', 'BackendUserController');

    Route::get('quizzes/option', 'QuizController@option')->name('quizzes.option');
    Route::get('quizzes/curriculam', 'QuizController@curriculam')->name('quizzes.curriculam');
    Route::resource('quizzes', 'QuizController');

    Route::resource('notifications', 'NotificationController');

    Route::resource('nudge_notifications', 'NudgeNotificationController');
    Route::resource('petals', 'PetalController');
});