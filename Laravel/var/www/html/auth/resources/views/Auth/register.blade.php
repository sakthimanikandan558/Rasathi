@if ($errors->any())

    <ul>
        {!! implode('',$errors->all('<li>:message</li>')) !!}
    </ul>
    
@endif


<form method="post" action="/store">
    @csrf
    <lable>Name : <input type="text" name="name"></lable><br><br>
    <lable>Email : <input type="text" name="email"></lable><br><br>
    <lable>Password : <input type="password" name="password"></lable><br><br>
    <lable>Confirm Password : <input type="password" name="password_confirmation"></lable><br><br>
    <input type="submit" value="Register">
</form>
