@if ($errors->any())

    <ul>
        {!! implode('',$errors->all('<li>:message</li>')) !!}
    </ul>
    
@endif

<form method="post" action="authenticate">
    @csrf

    <lable>Email : <input type="text" name="email"></lable><br><br>
    <lable>Password : <input type="password" name="password"></lable><br><br>
    <input type="submit" value="Login">

</form>