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
                <h2>Add Courses form</h2>
                <form class="form-horizontal" action="AddCourse" method="Post">
                @csrf
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="Name">Course Name:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="Name" placeholder="Enter Course Name" name="C_Name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="control-label col-sm-2" for="NIC">Fee:</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="Fee" placeholder="Enter Fee " name="Fee">
                    </div>
                  </div>
                <!-- jslakdncl -->
                  <div class="form-group">        
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </div>
                </form>
                     @endsection