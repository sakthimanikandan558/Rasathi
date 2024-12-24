<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table-container {
            width: 80%;
            margin: 0 auto;
            /* Center the container */
        }
    </style>
</head>

<body>
    <!-- Welcome and Logout Section -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center p-4">
            <h2>Welcome {{ auth()->user()->username }} 😎</h2>
            <div>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    class="btn btn-danger">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>

    <!-- Display Posts Table -->
    <div class="w-75 m-auto p-5" id="posts-container">
        @include('partials.request_table')
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        $(document).ready(function() {
            function loadPosts(page = 1) {
                $.ajax({
                    url: '{{ route('admin') }}',
                    type: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        $('#posts-container').html(response);
                    }
                });
            }

            // Load initial posts
            loadPosts();

            // Handle pagination click
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                const page = $(this).attr('href').split('page=')[1];
                loadPosts(page);
            });
        });
    </script>
</body>


</html>
