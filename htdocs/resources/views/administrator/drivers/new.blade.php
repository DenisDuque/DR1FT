<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>@yield('title')</title>
</head>
<body>
    <h1>Mostrar crear driver</h1>

    <form class="row g-3" action="{{route('/admin/drivers/new')}}" method="POST">
        @csrf
    <div class="col-md-6">
        <label for="driverName" class="form-label">Name</label>
        <input type="text" name="driverName" class="form-control" id="driverName">
    </div>
    <div class="col-md-6">
        <label for="driverEmail" class="form-label">Email</label>
        <input type="email" name="driverEmail" class="form-control" id="driverEmail">
    </div>
    <div class="col-md-6">
        <label for="driverPassword" class="form-label">Password</label>
        <input type="password" name="driverPassword" class="form-control" id="driverPassword">
    </div>
    <div class="col-md-6">
        <label for="driverPasswordConfirm" class="form-label">Confirm Password</label>
        <input type="password" name="driverPasswordConfirm" class="form-control" id="driverPasswordConfirm">
    </div>
    <div class="col-12">
        <label for="driverAddress" class="form-label">Address</label>
        <input type="text" name="driverAddress" class="form-control" id="driverAddress" placeholder="1234 Main St">
    </div>
    <div class="col-md-6">
        <label for="driveBirthDate" class="form-label">Birth Date</label>
        <input type="text" name="driveBirthDate" class="form-control" id="driveBirthDate">
    </div>
    <div class="col-md-2">
        <label for="driverPro" class="form-label">PRO</label>
        <select id="driverPro" name="driverPro" class="form-select">
        <option selected>Choose...</option>
        <option value="1">YES</option>
        <option value="0">NO</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="driverGender" class="form-label">Gender</label>
        <select id="driverGender" name="driverGender" class="form-select">
        <option selected>Choose...</option>
        <option value="1">Male</option>
        <option value="0">Female</option>
        </select>
    </div>
    <div class="col-md-2">
        <label for="driverMember" class="form-label">Member</label>
        <select id="driverMember" name="driverMember" class="form-select">
        <option selected>Choose...</option>
        <option value="1">YES</option>
        <option value="0">NO</option>
        </select>
    </div>
    <div class="col-md-6">
        <label for="driverFederation" class="form-label">Nº Federation</label>
        <input type="number" name="driverFederation" class="form-control" id="driverFederation">
    </div>
    <div class="col-md-6">
        <label for="driverPoints" class="form-label">Points</label>
        <input type="number" name="driverPoints" class="form-control" id="driverPoints">
    </div>
    <div class="col-12">
        <div class="form-check">
        <input class="form-check-input" type="checkbox" id="gridCheck">
        <label class="form-check-label" for="gridCheck">
            Check me out
        </label>
        </div>
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-primary">Sign in</button>
    </div>
    </form>
</body>
</html>




