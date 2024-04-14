@extends('page.layouts.master')

@section('title', 'Membership')

@section('content')
<div class="container h-75 mt-5">
    <div class="row">
        <h2 class="index-page-headers">MEMBERSHIP PLANS</h2>
    </div>
    <div class="row my-4">
        <div class="col-12 center">
            <div class="select-left" id="container">
                <div id="item"></div>
                <div class="left">
                    <span class="fw-bold">MONTHLY</span>
                </div>
                <div class="right">
                    <span class="fw-bold">YEARLY</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row pricing-container gx-5 mt-5">
        
        <div class="col-lg-4 col-sm-12 mb-3 col">
            <div class="pricing-card p-3">
                <span class="badge rounded-pill bg-badge-purple">FREE</span>
                <input type="hidden" name="monthly-free-price" value="0">
                <div class="membership-price text-center w-100"><h1>0$</h1><small class="membership-length align-bottom">/monthly</small></div>
                <hr>
                <div class="px-4 py-2">
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i>PRIORITY QUEUE</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i>25% OFF IN MERCHANDISING</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>DISCOUNT OF 15% PER RACE</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>PRIORITY SUPPORT</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>SPECIAL CONTESTS & GIVEAWAYS</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>EXCLUSIVE NEWSLETTER ACCESS</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>VIP EVENT INVITATIONS</p>
                </div>
                <button class="membership-button btn-primary w-100 fw-bold">SUBSCRIBE NOW</button>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3 col">
            <div class="pricing-card p-3">
                <span class="badge rounded-pill bg-badge-blue">PREMIUM</span>
                <input id="monthly-premium-price" type="hidden" name="monthly-premium-price" value="25">
                <div class="membership-price text-center w-100"><h1 id="monthly-premium-price-show">25$</h1><small class="membership-length align-bottom">/monthly</small></div>
                <hr>
                <div class="px-4 py-2">
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i>PRIORITY QUEUE</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i>25% OFF IN MERCHANDISING</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>DISCOUNT OF 15% PER RACE</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>PRIORITY SUPPORT</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>SPECIAL CONTESTS & GIVEAWAYS</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>EXCLUSIVE NEWSLETTER ACCESS</p>
                    <p class="py-2"><i class="bi bi-x-circle-fill me-1"></i></i>VIP EVENT INVITATIONS</p>
                </div>
                <button class="btn-primary w-100 membership-button fw-bold">SUBSCRIBE NOW</button>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mb-3 col">
            <div class="pricing-card p-3">
                <span class="badge rounded-pill bg-badge-gold">VIP</span>
                <input id="monthly-vip-price" type="hidden" name="monthly-vip-price" value="50">
                <div class="membership-price text-center w-100"><h1 id="monthly-vip-price-show">50$</h1><small class="membership-length align-bottom">/monthly</small></div>
                <hr>
                <div class="px-4 py-2">
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i>PRIORITY QUEUE</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i>25% OFF IN MERCHANDISING</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>DISCOUNT OF 15% PER RACE</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>PRIORITY SUPPORT</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>SPECIAL CONTESTS & GIVEAWAYS</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>EXCLUSIVE NEWSLETTER ACCESS</p>
                    <p class="py-2"><i class="bi bi-check-circle-fill me-1"></i></i>VIP EVENT INVITATIONS</p>
                </div>
                <button class="membership-button btn-primary w-100 fw-bold">SUBSCRIBE NOW</button>
            </div>
        </div>
    </div>
</div>
@endsection