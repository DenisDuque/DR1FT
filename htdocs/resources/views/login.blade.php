<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DR1FT Login</title>
  <link rel="stylesheet" href="{{ asset('css/adminLogin.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
</head>

<body class="container background-admin-gradient d-flex justify-content-center align-items-center">
    <!-- START Box -->
    <div class="animated-border-box-glow"></div>
    <div class="animated-border-box">
      <div class="card shadow">
        <div class="card-title text-center mt-4">
          <h1 class="drift">DR1FT</h1>
          <h2 class="p-3">Login</h2>
          <p class="text-md-center">Please enter your details.</p>
          @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: </strong> {{$error}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
              @endif
        </div>
        <div class="card-body">
          <form action="{{route('user.login')}}" method="post">
            @csrf
            <div class="mb-4">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control  text-white" name="email" value="{{old('email')}}" placeholder="Enter your email"/>
            </div>
            <div class="mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control  text-white" name="password" value="{{old('password')}}" placeholder="Password"/>
            </div>
            <div class="mb-4">
              
            </div>
            <div class="">
              <button type="submit" class="w-100 btn btn-primary">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- END -->


    <!--
    <div class="row justify-content-center align-items-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card shadow">
          <div class="card-title text-center">
            <h2 class="p-3">Login</h2>
            <p class="text-md-center">Please enter your details.</p>
          </div>
          <div class="card-body">
            <form action="{{route('admin.login')}}" method="post">
              @csrf
              <div class="mb-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter your email"/>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password"/>
              </div>
              <div class="mb-4">
                <input type="checkbox" class="form-check-input" name="remember" value="{{old('remember')}}"/>
                <label for="remember" class="form-label">Remember Me</label>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Sign in</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  -->
</body>

</html>