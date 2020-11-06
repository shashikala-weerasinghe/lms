<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\input;
use Session;

// use App\Student;

class Students extends Controller
{

    public function GetData(){
    // return Student::all();
    }
    public function Insert(Request $req){

       //Student::all();
       $firstname=$req->input('Name');
       $Nic=$req->input('NIC');
       $Pnum=$req->input('Pnum');
       $email=$req->input('email');
       $pwd=$req->input('pwd');
       $hashedPassword = Hash::make($pwd);
    //    echo $req->session()->get('user');

       $data=array('Name'=>$firstname,'NIC'=>$Nic,'Phone_number'=>$Pnum,'Email'=>$email,'pswrd'=>$pwd);
       try{
       $update=DB::table('students')->insertGetId($data);

        echo "<script>alert('signup successfully..!');</script>";
        return view('Login');

     }
       catch(Exception $e){
        echo "<script>alert('signup Failled..!');</script>";
        return view('Register');

       }
    }

    //    return redirect()->route('StudentView')->with('update', 'Content has been updated successfully!');

    // if($update){
    //     echo "<script>alert('signup Failled..!');</script>";
    //     Log::error('Failed to insert row into database.');
    //      return view('Register');
    // }
    // else{
    //     echo "<script>alert('signup successfully..!');</script>";
    // return view('Login');
    // }
    // if(empty($update){
    // echo "<script>alert('signup successfully..!');</script>";
    // return view('Login');}
    // else{
    //     echo "<script>alert('signup Failled..!');</script>";
    // return view('Register');}



    public function View(){
        $student=DB::select('select * from students');
        return view('StudentView',['students'=>$student]);
    }
    public function show($id){
        $Student=DB::select('select * from students where ID=?',[$id]);
        return view ('StudentUpdate',['student'=>$Student]);
    }
    public function showdel($id){
        DB::delete('delete from students where ID = ?',[$id]);
        $students=DB::select('select * from students');
        $success='Deleted successfully..!';
        return view('StudentView',compact('students','success'));

    }
    public function Update(Request $req,$ID){
        $firstname=$req->input('Name');
        $Nic=$req->input('NIC');
        $Pnum=$req->input('Pnum');
        $email=$req->input('email');

        $update =DB::update('update students set Name=?,NIC=?,Phone_number=?,Email=? where ID = ?', [$firstname,$Nic,$Pnum,$email,$ID]);

        // return redirect($this->View());

        //view();
        // $students=DB::select('select * from students');
        //     $success='Updated successfully..!';
        //     return redirect('StudentView',compact('students','success'));

        if($update==1){
            echo $update;
            $students=DB::select('select * from students');
            $success='Updated successfully..!';
            return view('StudentView',compact('students','success'));
        }
        else{
            $students=DB::select('select * from students');
            $success='Update failed..!';
            return view('StudentView',compact('students','success'));
        }
    }
    public function Login(Request $req){
        $email=$req->input('email');
        $pwd=$req->input('pwd');
        $hashedPassword = Hash::make($pwd);


        // echo $email;
        // echo "<br>";

        $student=DB::select('select * from students where Email=?',[$email]);
        $update=DB::update('update current set Name=? where ID=1', [$email]);

        // $student = DB::find($email);


        // dd($Student[0]);
        // echo $student;
        // $string=$student[0]->pswd;
        $string='';

     foreach ($student as $value){
           $string=$value->pswrd;
        }
        // echo '$string';


    // if( !Hash::check( $string ,$pwd) ){
    //     echo "error";
    // }
    //  echo $string;
    // echo "<br>";
    //    echo "<br>";
    // echo $pwd;
    // echo "<br>";
    //  $hashedPassword1= Hash::make($string);
    // echo $hashedPassword1;
    //    echo "<br>";
    //    echo $hashedPassword;
    $user='';
    if(strcasecmp($pwd,$string)==0){

        // echo "Done";
        // echo "<br>";
        // $req->session()->put('user',$email);
        Session::put('user',$email);
        $user= Session::get('user');
        // $user=$req->session()->get('user');
        echo $user;
        $success='Login successfully..!';
        echo "<script>alert('Login successfully..!');</script>";
       return $this->SHome();

    }
    else{
        echo "<script>alert('Login Failled..!');</script>";
        return view('Register');
    }
        // if(Hash::check($pwd, $student->pswrd)){
        //     echo done;
        // }


    }
    public static function SSHome(){

        // $user=DB::select('select * from current where ID=1');

        // $user=$req->session()->get('user');
        // echo $user1;

        // $string='';

        // foreach ($user as $value){
        //       $string=$value->Name;
        //    }
        //    echo $string;
        $user1= Session::get('user');
        $Courses=DB::select('select courses.C_ID , courses.Name from courses inner join follow on courses.C_ID=follow.C_ID where follow.S_Email=?',[$user1]);
        return $Courses;
        // return $string;
    }
    public function SHome(){
        // $user=DB::select('select * from current where ID=1');

        $string=Session::get('user');

        // foreach ($user as $value){
        //       $string=$value->Name;
        //    }
        //    echo $string;
        $Courses=DB::select('select courses.C_ID  from courses inner join follow on courses.C_ID=follow.C_ID where follow.S_Email=?',[$string]);
        // print_r($Courses);
        return view('SHome',compact('Courses'));

    }
    public function AddMaterials(){
        $user1= Session::get('user');

         //$courses=DB::select('select courses.C_ID from courses inner join follow on courses.C_ID=follow.C_ID where follow.S_Email=?',[$user1]);
        $courses2=DB::select('SELECT  *
        FROM    courses
        WHERE   courses.C_ID NOT IN
                (
                    select courses.C_ID from courses inner join follow on courses.C_ID=follow.C_ID where follow.S_Email=?
                )',[$user1]);

        // $courses1=array();
        // for ($i=0;$i<sizeof($courses);$i++) {
        //      $courses1[$i]=$courses[$i]->C_ID;
        // }
        // print_r($courses2);
        // $count=$courses->count();
        // print_r($count);
        // print_r($courses);
        // $courses->all();
        // print_r($courses->all());

        // print_r($courses['C_ID']);
          //$Courses2=DB::table('courses')->whereNotIn('C_ID', $courses1);


        // $Courses=DB::select('select * from courses');
        return view('SAddCourse',compact('courses2'));

    }
    public function Enroll($C_ID){
        $user=DB::select('select * from current where ID=1');

        $string='';

        foreach ($user as $value){
              $string=$value->Name;
           }

           $data=array('S_Email'=>$string,'C_ID'=>$C_ID,);
           $update=DB::table('follow')->insert($data);
           echo "<script>alert('You have enrolled successfully..!');</script>";
           return $this->SHome();
    }
    public function Logout(){

        session()->flush();
        echo "<script>alert('Logout..!');</script>";
           return view('Login');
    }
}
