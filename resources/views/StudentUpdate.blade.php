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
    <form action="/edit/<?php echo $student[0]->ID; ?>" method="post">
        @csrf
        <table class="table table-hover">
            <tr>
                <td>Name</td>
                <td>
                    <input type='text' name='Name' value='<?php echo$student[0]->Name; ?>' /> </td>
            </tr>
            <tr>
                <td>NIC</td>
                <td>
                    <input type='text' name='NIC' value='<?php echo$student[0]->NIC; ?>' />
                </td>
            </tr>
            <tr>
                <td>Contact Number</td>
                <td>
                    <input type='text' name='Pnum' value='<?php echo$student[0]->Phone_number; ?>' />
                </td>
            </tr>
            <tr>
                <td>Email</td>
                <td>
                    <input type='text' name='email' value='<?php echo$student[0]->Email; ?>' />
                </td>
            </tr>
            <tr>
                <td colspan='2'>
                    <input type='submit' class="btn btn-primary" value="Update student" />
                </td>
            </tr>
        </table>
    </form>
       @endsection
