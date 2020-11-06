<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @yield('header')

</head>
<body>
    <div class="container"> 
    <div style="height:100px; margin-top: 20px" align="Right">
     @if(session()->has('user'))
      <h3> {{ Session::get('user') }}  </h3>
      <a class="btn btn-warning" href='/Logout'>Logout</a>
@endif
</div>
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <!-- Brand -->
            <a class="navbar-brand" href="#">Logo</a>
          
            <!-- Links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="/SAddCourse">Add Course</a>
              </li>
             
          
              <!-- Dropdown -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown">
                  MY Courses
                </a>
                  @php
                   use App\Http\Controllers\Students;
                      $Courses=Students::SSHome();
                    @endphp
                <div class="dropdown-menu">
              
                    {{-- {{App\Students::SSHome()}} --}}
                 
                 @foreach ($Courses as $courses )
                  <a class="dropdown-item" href="../CourseView/{{$courses->C_ID}}">{{$courses->Name}}</a>
                @endforeach
                
                </div>
              </li>
            </ul> 
          </nav>
          @yield('Content')
         
    </div>
   
</body>
@yield('scripts')

</html>