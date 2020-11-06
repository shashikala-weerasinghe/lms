<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\DB;

class DataInsert extends Controller
{
   public function FormSubmit(Request $re){
    echo'controller';
    print_r($re->input());
   }
   public function Checkdata(){
       $user=DB::select('select * from new');
      $user1=DB::Table('new')->get();

      print_r($user);
      print_r($user1);
   }
   public function delete(){
       echo "hellow";
       $user=DB::table('new')
       ->where('id','1')
       ->delete();
       print_r($user);
   }
   public function Insert(){
       $user=DB::table('students')
       ->Insert([
        'Name'=>'Name',
        'NIC'=>'6412354',
        'Phone_number'=>'asdfdxz',
        'Email'=>'acfdt@gmail.com',
        'pswrd'=>'aftfzht'
       ]);

       print_r($user);
   }
   public function Update(){
       $user=DB::table('new')
       ->where('ID','3')
       ->update([
           'Email'=>'Bye@gmail.com',
           'pswrd'=>'456@123'
          
       ]);
       print_r($user);
   }
}
