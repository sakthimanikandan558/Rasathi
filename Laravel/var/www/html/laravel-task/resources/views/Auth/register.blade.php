@if ($errors->any())
    <ul>
        {!! implode('', $errors->all('<li>:message</li>')) !!}
    </ul>
@endif

<form method="post" action="/store">
    @csrf
    <label>Name : <input type="text" name="name"></label><br><br>
    <label>Email : <input type="text" name="email"></label><br><br>
    <label>Password : <input type="password" name="password"></label><br><br>
    <label>Confirm Password : <input type="password" name="password_confirmation"></label><br><br>
    <label>
        <input type="checkbox" name="isAdmin" value="1">Admin
    </label><br><br>
    <input type="submit" value="Register">
</form>
