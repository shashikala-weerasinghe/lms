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
    <form action="/CourseEdit/{{$courses[0]->C_ID}}" method="post">
        @csrf
        <table class="table table-hover">
           
                <td>Course Name</td>
                <td>
                    <input class="form-control" type='text' name='C_Name' value='{{$courses[0]->Name}}' />
                </td>
            </tr>
            <tr>
                <td>Course Fee</td>
                <td>
                    <input class="form-control"type='text' name='Fee' value='{{$courses[0]->Fee}}' />
                </td>
            </tr>
            {{-- <tr>
                <td>Email</td>
                <td>
                    <input type='text' name='email' value='?php echo$student[0]->Email; ?>' />
                </td>
            </tr> --}}
            <tr>
                <td colspan='2'>
                    <input type='submit' class="btn btn-primary" value="Update Course" />
                </td>
            </tr>
        </table>
    </form>
       @endsection