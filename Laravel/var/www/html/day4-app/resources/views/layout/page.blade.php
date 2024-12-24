<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>NAME</th>
            <th>DEPARTMENT</th>
            <th>AGE</th>
            <th>ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->department }}</td>
                <td>{{ $student->age }}</td>
                <td><a href="#">Edit | Delete</a></td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="col-md-12">
    {!! $students->links() !!} <!-- Include pagination links here -->
</div>
