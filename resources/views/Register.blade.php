<!DOCTYPE html>
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
<div class="container">
  <h2>Register form</h2>
  <form class="form-horizontal" action="Register" method="Post">
  @csrf
    <div class="form-group">
      <label class="control-label col-sm-2" for="Name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Name" placeholder="Enter Name" name="Name">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="NIC">NIC:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="NIC" placeholder="Enter NIC" name="NIC">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="Pnum">Phone number:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Pnum" placeholder="Enter phone number" name="Pnum">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="remember"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
    </div>
  </form>
</div>

</body>

</html>