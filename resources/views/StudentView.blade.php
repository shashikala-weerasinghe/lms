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
    <h1>StudentView</h1>

   {{-- {{ $success}} --}}
    {{-- @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif --}}
    @if (!empty($success))
         <div class="alert alert-success">
            <p>{{ $success }}</p>
           
        </div>
    @endif
    <table class="table table-hover">
       <tr>
            <th>ID</th>
            <th>Name</th>
            <th>NIC</th>
            <th>Contact Number</th>
            <th>E-mail</th>
            <th>Edit</th>  
            <th>Delete</th>         
       </tr>
       @foreach ($students as $student )
           <tr>
                <td>{{$student->ID}}</td>
                <td>{{$student->Name}}</td>
                <td>{{$student->NIC}}</td>
                <td>{{$student->Phone_number}}</td>
                <td>{{$student->Email}}</td>
                <td><a class="btn btn-info" href='../edit1/{{$student->ID}}'>edit</a></td>
                <td><a class="btn btn-danger" href='../delete1/{{$student->ID}}'>delete</a></td>

           </tr>
       @endforeach
    </table>
   @endsection