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


route::get('/Register', function(){
    return view('Register');
});
// route::post('/Read','DataInsert@FormSubmit');
// route::get('/ReadData','Datainsert@Checkdata');
// route::get('/Delete','DataInsert@delete');
route::get('/Insert','DataInsert@Insert');
// route::get('/Update','DataInsert@Update');
route::get('/ReadData','Students@GetData');
route::post('/Register','Students@Insert');

route::get('/StudentView',function(){
    return view('StudentView');
});
Route::get('/StudentView', 'Students@View');
route::get('/edit1/{id}','Students@show');
route::get('/delete1/{id}','Students@showDel');
route::post('/edit/{id}','Students@Update');

//AddCourse
route::post('/AddCourse','Courses@AddCourse');
route::get('/AddCourse',function(){
    return view('AddCourses');
});
Route::get('/CourseView', 'Courses@View');
route::get('/CourseEdit/{id}','Courses@show');
route::get('/CourseDelete/{id}','Courses@showDel');
route::post('/CourseEdit/{id}','Courses@Update');

//AddMaterials
route::get('/AddCourseMaterials','CourseMaterials@Add');
route::post('/store','CourseMaterials@update');

// login
Route::get('/', function(){
    return view('Login');
});
Route::post('/Login' ,'Students@Login');



//home
route::post('/SSHome','Students@SSHome');
route::get('/SHome','Students@SHome');

route::get('/CourseView/{C_ID}','CourseMaterials@CourseVIew');
//Course MAterials
route::get('/SAddCourse','Students@Insert');

route::get('/Enroll/{C_ID}','Students@Enroll');

//Admin
route::get('/AHome',function(){
    return view('AHome');
});
Route::get('/{any?}', 'Students@appIndex')->where('any', '^(?!api\/)[\/\w\.-]*');
route::get('/Logout','Students@Logout');




