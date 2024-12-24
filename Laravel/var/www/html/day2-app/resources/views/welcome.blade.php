<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form for post practice</title>
</head>

<body>
    <h1>{{$title}}</h1>
    <p>{{session('message')}}<p>
    <form method="post" action="{{url('get')}}">
        <lable>Name : <input type="text" name="name"></lable><br><br>
        <lable>age : <input type="text" name="age"></lable><br><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="submit">send</button>
    </form>
</body>

</html>
