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
        <title>@yield('title')</title>
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
/* 
            body {
            margin: 0;
            padding: 0;
            height: 100vh;
            color: #fff;
            background: #141414;
            font-family: "Poppins", sans-serif;
            text-transform: uppercase;
            } */
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
            height: 100%;
            width: 100%;
            top: 0;
            background-size: cover;
            background-position: center;
            }
            section .bg h2 {
            z-index: 2;
            }
            section .bg .clip-text {
            overflow: hidden;
            }
            .first .bg {
            background-image: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.6) 0%,
                rgba(0, 0, 0, 0.3) 100%
                ),
                url("https://64.media.tumblr.com/d7b19889c0b6d3c605f4f34d1343e3ea/tumblr_p4ntm40HMW1wco4ano1_1280.jpg");
            }
            .second .bg {
                background-image: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.6) 0%,
                rgba(0, 0, 0, 0.3) 100%
                ),
                url("https://64.media.tumblr.com/3de2c2eab9cbac5aa7c1f641eb4e7ccc/tumblr_nj8curbq8F1sbh9awo1_500.jpg");
            }
            .third .bg {
                background-image: linear-gradient(
                180deg,
                rgba(0, 0, 0, 0.6) 0%,
                rgba(0, 0, 0, 0.3) 100%
                ),
                url(https://i0.wp.com/oregongirlaroundtheworld.com/wp-content/uploads/2015/07/img_3494.jpg?fit=3754%2C1738);
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

            .section-heading {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
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
        <div>
            <div class="row fixed-top z-index-1">
                <div class="col-2">
                    <p>DR1FT</p>
                </div>
                <div class="col-10">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled">Disabled</a>
                        </li>
                    </ul>
                </div>
            </div>
           
            <section class="first">
                <div class="outer">
                    <div class="inner">
                    <div class="bg one">
                        <h2 class="section-heading">Scroll Down</h2>
                    </div>
                    </div>
                </div>
            </section>
    
            <section class="second">
                <div class="outer">
                    <div class="inner">
                    <div class="bg">
                        <h2 class="section-heading">Infinite Scroll using GSAP</h2>
                    </div>
                    </div>
                </div>
            </section>
            <section class="third">
                <div class="outer">
                    <div class="inner">
                    <div class="bg">
                        <h2 class="section-heading">Keep Scrolling</h2>
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
        </div>
    </body>
</html>


