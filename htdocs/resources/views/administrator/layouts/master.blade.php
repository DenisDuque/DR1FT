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
    @section('header')
        <header>
            <nav>
                <h2>DASHBOARD</h2>
                <h2>RACES</h2>
                <h2>SPONSORS</h2>
                <h2>INSURANCES</h2>
                <h2>DRIVERS</h2>
            </nav>
            <section>
                <i class="bi bi-person"></i>
                <h3>Administrator</h3>
                <i class="bi bi-box-arrow-left"></i>
            </section>
        </header>
    @show
    <main class="container">
        @yield('content')
    </main>
</body>
</html>


