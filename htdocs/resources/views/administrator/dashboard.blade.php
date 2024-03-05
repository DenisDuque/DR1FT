@extends('administrator.layouts.master')

@section('content')
<section class="my-5">
    <h1 class="admin-form-title">Quick Actions</h1>
    <div class="row">
        <div class="col-sm-3">
            <div class="card quick-actions-bg">
                <div class="card-body">
                    <h5 class="card-title">Create a new race</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="/admin/races/new" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card quick-actions-bg">
                <div class="card-body">
                    <h5 class="card-title">Add a new insurance</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="/admin/insurances/new" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add a new sponsor</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="/admin/sponsors/new" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Upload race photos</h5>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <a href="#" class="btn btn-primary">Start</a>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container text-white mt-5">
  <div class="row gx-3 gy-3">
    <div class="col-6">
        <div class="row gy-3">
            <div class="col-12 rounded bg-red-gradient">
                <h1 class="admin-form-title">Coming Soon</h1>
                <div class="row gx-2">
                    <div class="col-4 card text-center">
                        <i class="bi bi-card-image"></i>
                    </div>
                    <div class="col-4 card text-center">
                        <i class="bi bi-card-image"></i>
                    </div>
                    <div class="col-4 card text-center">
                        <i class="bi bi-card-image"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 card">
                <h1 class="admin-form-title">Best Insurances</h1>
            </div>
            <div class="col-6">
                <div class="row gx-2">
                    <div class="col-12 card">
                    <h1 class="admin-form-title">Last Race Winner</h1>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-6 card">
                        <h1 class="admin-form-title">Main Event</h1>
                    </div>
                    <div class="col-6 card">
                        <h1 class="admin-form-title">Last Race</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="row">
            <div class="col-12 card">
                <h1 class="admin-form-title">Best Sponsors</h1>
            </div>
            <div class="col-12 card">
                <h1 class="admin-form-title">Most Paid Races</h1>
            </div>
        </div>
    </div>
    <div class="col-3 card">
        <h1 class="admin-form-title">Top Drivers</h1>
    </div>
  </div>
</div>


@stop