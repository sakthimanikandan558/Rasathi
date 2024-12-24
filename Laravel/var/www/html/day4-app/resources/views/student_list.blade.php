<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Student List</title>
</head>

<body>
    <h2>Student List</h2>
    <div class="col-md-12">
        <div id="students-container">
            @include('layout.page', ['students' => $students]) <!-- Include the table here -->
        </div>
    </div>

    <script>
        $(document).on('click', '.pagination a', function(e) {

            e.preventDefault(); // Prevent the default link behavior
            const page1 = $(this).attr('href');
            console.log(page1);

            const page = $(this).attr('href').split('page=')[1];
            console.log(page);
            $.ajax({
                url: `/list?page=${page}`, // Use the correct URL
                type: 'GET',
                success: function(data) {
                    
                    // const studentsHtml = $(data).find('#students-container').html(); // Get new HTML
                    $('#students-container').html(data); // Update the table
                    // history.pushState(null, '', `/list?page=${page}`); // Update the URL without reloading
                },
                error: function() {
                    alert('Error loading students.');
                }
            });
        });
    </script>
</body>

</html>
