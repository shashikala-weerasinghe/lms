<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;


class Courses extends Controller
{
    public function AddCourse(Request $req){
        $C_Name=$req->input('C_Name');
        $Fee=$req->input('Fee');

        $data=array('Name'=>$C_Name,'Fee'=>$Fee);
        DB::table('courses')->insert($data);
        echo "<script>alert('Course Added successfully..!');</script>";
        return view('AHome');
       
    }
    public function View(){
        $courses=DB::select('select * from courses');
        return view('ViewCourse',['courses'=>$courses]);
    }
    public function showdel($id){
        DB::delete('delete from courses where C_ID = ? ',[$id]);
        $courses=DB::select('select * from courses');
        $success='Deleted successfully..!';
        return view('ViewCourse',compact('courses','success'));
      
    }
    public function show($id){
        $courses=DB::select('select * from courses where C_ID=?',[$id]);
        return view ('CourseUpdat',['courses'=>$courses]);
    }
    public function Update(Request $req,$ID){
        $C_Name=$req->input('C_Name');
        $Fee=$req->input('Fee');

        $update =DB::update('update courses set Name=?, Fee=? where C_ID = ?', [$C_Name,$Fee,$ID]);
        
        // return redirect($this->View());
        
        //view();
        // $students=DB::select('select * from students');
        //     $success='Updated successfully..!';
        //     return redirect('StudentView',compact('students','success'));
    
        if($update==1){
            echo $update;
            $courses=DB::select('select * from courses');
            $success='Updated successfully..!';
             return view('ViewCourse',compact('courses','success'));
            // return back()->with('success',$success);

        }
        else{
            $courses=DB::select('select * from courses');
            $success='Update failed..!';
            return view('ViewCourse',compact('courses','success'));
        }
    }
}
