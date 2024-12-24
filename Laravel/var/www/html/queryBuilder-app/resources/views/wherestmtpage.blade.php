<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employees</title>
    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<h1>Employee List using where clause</h1>
    <div class="col-md-12">
        <div id="students-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($wherestmts as $wherestmt)
                        <tr>
                            <td>{{ $wherestmt->id }}</td>
                            <td>{{ $wherestmt->name }}</td>
                            <td>{{ $wherestmt->age }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>