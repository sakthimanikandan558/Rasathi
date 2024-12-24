<h1>Student Information Form</h1>
<form action="store" method="POST">

    <lable>Name : <input type="text" name="name"></lable><br>
    <lable>Department : <input type="text" name="department"></lable><br>
    <lable>Age : <input type="text" name="age"></lable><br>
    <input type="submit" value="insert">
    @csrf
</form>
