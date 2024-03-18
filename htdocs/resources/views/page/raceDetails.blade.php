@extends('page.layouts.master')

@section('title', 'Race Details')

@section('content')
    <div class="row mt-5">
        <div class="col-md-4">
            <img class="img-fluid rounded" src="{{asset('storage/race_banners/'.$race->banner)}}" alt="" srcset="">
        </div>
        <div class="col-md-8 text-white">
            <h1 class="text-white">{{$race->name}}
                @if ($race->pro == 1)
                    <span class="badge rounded-pill bg-warning text-dark">PRO</span>
                @endif
            </h1>
            <p>{{$race->startingPlace}}</p>
            <p>Sponsor Cost: {{$race->sponsorCost}}</p>
            <p>Registration Price: {{$race->registrationPrice}}</p>
            <p>Max. Participants: {{$race->maxParticipants}}</p>
            <p>Date: {{$race->date}}</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Participate
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg text-black">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Registration Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form class="row g-3" action="{{route('admin.drivers.new')}}" method="POST">
                            @csrf
                            <div class="col-md-6">
                                <label for="driverName" class="form-label text-black">Name</label>
                                <input type="text" name="driverName" class="form-control" id="driverName" value="{{old('driverName')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="driverEmail" class="form-label text-black">Email</label>
                                <input type="email" name="driverEmail" class="form-control" id="driverEmail" value="{{old('driverEmail')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="driverPassword" class="form-label text-black">Password</label>
                                <input type="password" name="driverPassword" class="form-control" id="driverPassword" value="{{old('driverPassword')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="driverPasswordConfirm" class="form-label text-black">Confirm Password</label>
                                <input type="password" name="driverPasswordConfirm" class="form-control" id="driverPasswordConfirm" value="{{old('driverPasswordConfirm')}}">
                            </div>
                            <div class="col-12">
                                <label for="driverAddress" class="form-label text-black">Address</label>
                                <input type="text" name="driverAddress" class="form-control" id="driverAddress" placeholder="1234 Main St" value="{{old('driverAddress')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="driveBirthDate" class="form-label text-black">Birth Date</label>
                                <input type="text" name="driveBirthDate" class="form-control" id="driveBirthDate" value="{{old('driveBirthDate')}}">
                            </div>
                            <div class="col-md-2">
                                <label for="driverPro" class="form-label text-black">PRO</label>
                                <select id="driverPro" name="driverPro" class="form-select ">
                                <option selected>Choose...</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="driverGender" class="form-label text-black">Gender</label>
                                <select id="driverGender" name="driverGender" class="form-select">
                                <option selected>Choose...</option>
                                <option value="1">Male</option>
                                <option value="0">Female</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="driverMember" class="form-label text-black">Member</label>
                                <select id="driverMember" name="driverMember" class="form-select">
                                <option selected>Choose...</option>
                                <option value="1">YES</option>
                                <option value="0">NO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="driverFederation" class="form-label text-black">Nº Federation</label>
                                <input type="number" name="driverFederation" class="form-control" id="driverFederation">
                            </div>
                            <div class="col-md-6">
                                <label for="driverPoints" class="form-label text-black">Points</label>
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
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary text-white">Save changes</button>
                    </div>
                </div>
                </div>
            </div>
  
            
        </div>
    </div>
    <!-- Aquí puedes agregar el contenido específico para esta vista -->
    <div class="col-lg-12 col-md-12 preview-container my-5">
        <div class="d-flex justify-content-center">
            <h3 class="text-uppercase breadcrumb-item active fs-5 mx-2 text-white" role="button">gallery</h3>
            <h3 class="text-uppercase breadcrumb-item fs-5 mx-2 text-white" role="button">classification</h3>
        </div>
        
        
    </div>
@endsection
