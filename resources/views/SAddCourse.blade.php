{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add to Courses</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
    <div class="container">
        <div style="height:100px; margin-top: 20px" align="Right">
     @if(session()->has('user'))
      <h3> {{ Session::get('user') }}  </h3>
      <a href='/Logout'>Logout</a>
@endif
</div> --}}
@extends('SHome')
@section('Content')
           <table class="table table-hover">
       <tr>
            <th>Course Name</th>
            <th>Course Fee</th>
            <th>Add Course</th>
                  
       </tr>
       @foreach ($courses2 as $Courses )
           <tr>
                <td>{{$Courses->Name}}</td>
                <td>{{$Courses->Fee}}</td>
              
                <td><a class="btn btn-primary" href='../Enroll/{{$Courses->C_ID}}'>Add</a></td>
              
           </tr>
       @endforeach
    </table>
   
@endsection
    {{-- </div>
</body>
</html> --}}