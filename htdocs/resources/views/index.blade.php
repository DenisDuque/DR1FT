<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Racing+Sans+One&display=swap" rel="stylesheet">
        <title>DR1FT</title>
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])
        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Popper.js (si es necesario) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>

            * {
            box-sizing: border-box;
            user-select: none;
            }
            h2 {
            font-size: clamp(1rem, 5vw, 5rem);
            font-weight: bold;
            text-align: center;
            letter-spacing: 1px;
            margin-right: -0.5em;
            color: #ccc;
            width: 90vw;
            max-width: 1200px;
            white-space: nowrap;
            }
            a {
            color: #ccc;
            text-decoration: none;
            cursor: pointer;
            }
            section {
            height: 100%;
            width: 100%;
            top: 0;
            position: fixed;
            visibility: hidden;
            }
            #video-background {
                position: fixed;
                right: 0;
                bottom: 0;
                min-width: 100%;
                min-height: 100%;
                filter: brightness(0.25);
            }
            
            section .outer,
            section .inner {
            width: 100%;
            height: 100%;
            overflow-y: hidden;
            }
            section .bg {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            height: 100vh;
            width: 100%;
            top: 0;
            
            }
            section .bg h2 {
            z-index: 1;
            }
            section .bg .clip-text {
            overflow: hidden;
            }
            
            .fourth .bg {
                background-image: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.6) 0%,
                rgba(0, 0, 0, 0.3) 100%
                ),
                url(https://i.pinimg.com/564x/8e/2c/f0/8e2cf09031fbc841904e19e3c5283054.jpg);
            }
            .fifth .bg {
                background-image: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.6) 0%,
                rgba(0, 0, 0, 0.3) 100%
                ),
                url("https://64.media.tumblr.com/ecdf0fe067b5ffccbb05a647423eaad2/tumblr_p2nzkxTvQC1vvczb6o1_540.jpg");
                background-position: 50% 45%;
            }

            .section-heading i {
            font-size: 3rem;
            margin: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            }
            .section-heading i.fa-github-alt {
            font-size: 3.2rem;
            }

        </style>
    </head>
    <body>
            

            <div class="container fixed-top z-index-1 mt-3">
                <div class="row">
                    <div class="col-2">
                        <h1 class="drift">DR1FT</h1>
                    </div>
                    <div class="col-10">
                        <ul class="nav justify-content-end user-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">HOME</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('races.all')}}">RACES</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('page.gallery')}}">GALLERY</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " href="{{route('page.membership')}}">MEMBERSHIP</a>
                            </li>
                            <li class="nav-item">
                                @if(session()->has('user_id'))
                                    <a class="nav-link " href="{{route('page.profile', ['driver' => session('user_id')])}}">PROFILE</a>
                                @else
                                    <a class="nav-link " href="{{route('user.login')}}">SIGN IN</a>
                                @endif
                            </li>
                        </ul>

                    </div>
                    <div class="position-fixed bottom-0 end-0 w-25">
                        @include('administrator.layouts.notice')
                    </div>
                </div>
            </div>
           
            <section class="first">
                <div class="outer">
                    <div class="inner">
                        <div class="bg one">
                            <video autoplay muted loop id="video-background">
                                <source src="{{asset('storage/video/race.mp4')}}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <div class="section-heading">
                                <div>
                                    <h2>CHASE <span>VICTORY</span></h2>
                                    <h2>DRIVE THE DREAM</h2>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </section>
    
            <section class="second">
                <div class="outer">
                    <div class="inner">
                    <div class="bg">
                        <div class="container h-75">
                            <div class="row">
                                <h2 class="index-page-headers">COMING SOON</h2>
                            </div>
                            <div class="lg-row mt-5 d-flex responsive-cards">
                                @foreach ($races as $race)
                                
                                    <div class="flip-card col-lg-3" tabIndex="0">
                                        <div class="flip-card-inner">
                                            <div class="flip-card-front ">
                                                
                                                <img src="{{asset('storage/race_banners/'.$race->banner)}}" alt="{{$race->name}}">
                                            </div>
                                            <div class="flip-card-back p-4">
                                                <h4 class="fw-bold">{{$race->name}}</h4>
                                               
                                                <span class=" badge rounded-pill bg-light text-dark"><i class="bi bi-calendar2-week-fill me-1"></i>{{$race->date}}</span>
                                                @if ($race->pro == 1)
                                                    <span class=" badge rounded-pill bg-warning text-dark">PRO</span>
                                                @endif
                                                <span class=" badge rounded-pill bg-info text-dark"><i class="bi bi-people-fill me-1"></i>Max. {{$race->maxParticipants}}</span>
                                                <span class=" badge rounded-pill bg-badge-purple">{{$race->length}} Km</span>

                                                <h5 class="mt-3">Location</h5>
                                                <p><i class="bi bi-geo-alt-fill me-1"></i>{{$race->startingPlace}}</p>

                                                <h5 class="mb-1 mt-3">Main Sponsors</h5>
                                                
                                                @foreach($race->sponsors as $sponsor)
                                                    @if($sponsor->pivot->mainSponsor == 1)
                                                        <img class="img-thumbnail mb-1" src="{{ asset('storage/sponsor_logos/' . $sponsor->logo) }}" alt="{{$sponsor->name}}" title="{{$sponsor->name}}">
                                                    @endif
                                                @endforeach
                                                
                                                <h5 class="mb-1 mt-3">More Information</h5>
                                                <p>{{$race->description}}</p>
                                                <a href="{{route('race.detail', ['race' => $race->id])}}">See More</a>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                               
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <section class="third">
                <div class="outer">
                    <div class="inner">
                        <div class="bg">
                            <div class="container h-75">
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
                                <div class="lg-row pricing-container pricing-container-res gx-5 mt-5">
                                    
                                    <div class="col-lg-4 col col-12">
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
                                    <div class="col-4 col col-12">
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
                                    <div class="col-4 col col-12">
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
                        </div>
                    </div>
                </div>
            </section>
            <section class="fourth">
                <div class="outer">
                    <div class="inner">
                    <div class="bg">
                        <h2 class="section-heading">follow for more</h2>
                    </div>
                    </div>
                </div>
            </section>
            <section class="fifth">
                <div class="outer">
                    <div class="inner">
                    <div class="bg">
                        <h2 class="section-heading">
                        <a href="https://codepen.io/Vishal4225" target="_blank">
                            <i class="fa-brands fa-codepen"></i></a>
                        <a href="https://github.com/vishal-dcode" target="_blank">
                            <i class="fa-brands fa-github-alt"></i></a>
                        <a href="https://vishalzen.netlify.app/" target="_blank">
                            <i class="fa-brands fa-safari"></i></a>
                        </h2>
                    </div>
                    </div>
                </div>
            </section>
        
    </body>
</html>


