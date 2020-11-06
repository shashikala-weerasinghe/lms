<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Home</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
            <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                    <!-- Brand/logo -->
                    <a class="navbar-brand" href="">Admin Login</a>
                    
                    <!-- Links -->
                    <ul class="navbar-nav">
                      <li class="nav-item">
                        <a class="nav-link" href="/CourseView">View Courses</a>
                      </li>
                      <li class="nav-item">
                            <a class="nav-link" href="/AddCourse">Add Courses</a>
                          </li>
                      <li class="nav-item">
                        <li class="nav-item">
                        <a class="nav-link" href="/StudentView">View Students</a>
                      </li>
                        <a class="nav-link" href="/AddCourseMaterials">Course Materials</a>
                      </li>
                      
                    </ul>
                  </nav>
                   @yield('Content')
    </div>
</body>
</html>