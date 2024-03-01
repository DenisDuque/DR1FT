@extends('administrator.layouts.master')

@section('content')
<section class="my-4">
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
<div class="container text-white">
  <div class="row">
    <div class="col-9 div1">Div 1</div>
    <div class="col-3 div2">Div 2</div>
    <div class="col-3 div3">Div 3</div>
    <div class="col-3 div4">Div 4</div>
    <div class="col-3 div5">Div 5</div>
    <div class="col-6 div6">Div 6</div>
    <div class="col-6 div7">Div 7</div>
    <div class="col-3 div8">Div 8</div>
  </div>
</div>


@stop