<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dorsal</title>
</head>
<body>
    <div class="flex justify-center align-center">
        <h1>{{$data['name']}}</h1>
        <h1>{{$data['dorsal']}}</h1>
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(300)->generate($data['link'])) !!} ">
    </div> 
</body>
</html>