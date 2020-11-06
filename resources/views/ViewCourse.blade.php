{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/custom.css">
</head>
<body>
        <div class="container"> --}}
        @extends('AHome')
        @section('Content')
                <h1>Course View</h1>
            
               <!-- {{-- {{ $success}} --}}
                {{-- @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif --}} -->
                @if (!empty($success))
                     <div class="alert alert-success">
                        <p>{{ $success }}</p>
                       
                    </div>
                @endif
                <table class="table table-hover">
                   <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Fee</th>
                       
                        <th>Edit</th>  
                        <th>Delete</th>         
                   </tr>
                   @foreach ($courses as $courses )
                       <tr>
                            <td>{{$courses->C_ID}}</td>
                            <td>{{$courses->Name}}</td>
                            <td>{{$courses->Fee}}</td>
                            <td><a class="btn btn-info" href='../CourseEdit/{{$courses->C_ID}}'>edit</a></td>
                            <td><a class="btn btn-danger" href='../CourseDelete/{{$courses->C_ID}}'>delete</a></td>
            
                       </tr>
                   @endforeach
                </table>
                @endsection