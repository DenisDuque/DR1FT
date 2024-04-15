<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DR1FT Register</title>
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
    <div class="animated-border-box col-lg-6 col-md-12 bg-admin card h-75">
      <div class="card shadow">
        <div class="card-title text-center mt-4">
          <h1 class="drift">DR1FT</h1>
          <h2 class="p-3">Register</h2>
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
          <form class="row g-3" action="{{route('user.register')}}" method="post">
            @csrf
            <div class="col-md-9">
              <label for="driverName" class="form-label">Name</label>
              <input type="text" name="driverName" class="form-control text-white" id="driverName" value="{{old('driverName')}}">
            </div>
            <div class="col-md-3">
              <label for="driverGender" class="form-label">Gender</label>
              <select id="driverGender" name="driverGender" class="form-select">
                <option value="1">Male</option>
                <option value="0">Female</option>
              </select>
            </div>
            <div class="col-md-8">
                <label for="driverEmail" class="form-label">Email</label>
                <input type="email" name="driverEmail" class="form-control text-white" id="driverEmail" value="{{old('driverEmail')}}">
            </div>
            <div class="col-md-4">
              <label for="driveBirthDate" class="form-label">Birth Date</label>
              <input type="date" name="driverBirthDate" class="form-control text-white" id="driveBirthDate" value="{{old('driverBirthDate')}}">
            </div>
            <div class="col-md-6">
                <label for="driverPassword" class="form-label">Password</label>
                <input type="password" name="driverPassword" class="form-control text-white" id="driverPassword" placeholder="Password" value="{{old('driverPassword')}}">
            </div>
            <div class="col-md-6">
              <label for="driverFederation" class="form-label">Nº Federation</label>
              <input type="text" name="driverFederation" class="form-control text-white" id="driverFederation" value="{{old('driverFederation')}}">
            </div>
            <div class="col-12">
                <label for="driverAddress" class="form-label">Address</label>
                <input type="text" name="driverAddress" class="form-control text-white" id="driverAddress" placeholder="1234 Main St" value="{{old('driverAddress')}}">
            </div>
            <div class="col-md-3">
              <div class="form-check form-switch">
                <input class="form-check-input text-white" type="checkbox" id="driverPro" name="driverPro">
                <label class="form-check-label" for="driverPro" value="{{old('driverPro')}}">PRO</label>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="driverMember" name="driverMember" value="{{old('driverMember')}}">
                  <label class="form-check-label" for="driverMember">Member</label>
              </div>
            </div>
            <div class="mt-2">
              <button type="submit" class="w-100 btn btn-primary">Sign up</button>
              <a href="{{route('user.showLogin')}}">Back to Login</a>
            </div>
          </form>
        </div>
      </div>
    </div>
</body>

</html>