<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class CourseMaterials extends Controller
{
    public function Add()
    {
        $courses = DB::select('select * from courses');
        return view('AddCourseMaterials', ['courses' => $courses]);
    }

    public function update(Request $req)
    {
        $C_ID = $req->input('C_ID');
        $Week = $req->input('Week');
        //get the name
        $fileNameWithExt = $req->file('pdf')->getClientOriginalName();
        //file name
        $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

        //extension
        $extension = $req->file('pdf')->getClientOriginalExtension();
        //file name
        $fileNameTOStore = $filename . '.' . $extension;
        //upload the image
        $path = $req->file('pdf')->storeAs('public/PDF', $fileNameTOStore);

        $data = array('C_ID' => $C_ID, 'Name' => $fileNameTOStore, 'WEEK' => $Week);

        DB::table('coursematerials')->insert($data);
        echo "<script>alert('Course Materials was added successfully..!');</script>";
        return view('AHome');

    }

    public function CourseVIew($C_ID)
    {
        $CourseMaterials = DB::select('select * from coursematerials where C_ID=?', [$C_ID]);
        $CourseNAme = DB::select('select * from courses where C_ID=?', [$C_ID]);
        return view('CourseView', compact('CourseMaterials', 'CourseNAme'));


    }

    public function saveQuestions(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $savedData = [];

        foreach ($data as $d) {
            $isExistQuestion = DB::table('selected_questions')->where(['question' => $d['question'], 'type' => $d['type']])->first();

            if (!$isExistQuestion) {
                $savedData = DB::insert('Insert into selected_questions (question, answer, type) values (?, ?, ? )', [$d['question'], $d['answer'], $d['type']]);
            }

//                CourseMaterials::create([
//                'question' => $d['question'],
//                'answer' => $d['answer']
//            ]);
        }

        return response(['data' => $savedData, 'status' => true, 'msg' => '$msg'], 200)->header('Content-Type', 'application/json');
    }

    public function getQuestions(Request $request)
    {
        $data = DB::select('select * from selected_questions');
        return response(['data' => $data, 'status' => true, 'msg' => '$msg'], 200)->header('Content-Type', 'application/json');
    }

    public function getFinalResult(Request $request) {
        $requestData = $request->all();
        //dd($requestData);
        $url = $requestData['url'];

        $param = [
            'headers' => [
                'content-type' => 'application/json'
            ]
        ];

        $response = $this->guzzleRequest($url, 'get');
        return $response;
    }


    function guzzleRequest($endpoint, $request_type = 'get', $params = null, $return_full_response = false)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->{$request_type}($endpoint);

            $statusCode = $response->getStatusCode();

            if ($statusCode == 200 && $return_full_response == false) {
                return ['status' => 200,'body' => json_decode($response->getBody()->getContents(), true), 'error' => false];
            }elseif($statusCode == 200 && $return_full_response == true){
                return $response;
            } else {
                return false;
            }
        } catch (\Exception $exception) {
            return ['error' => true, 'status' => 200, 'body' => json_decode($exception->getResponse())];
        }
    }

}
