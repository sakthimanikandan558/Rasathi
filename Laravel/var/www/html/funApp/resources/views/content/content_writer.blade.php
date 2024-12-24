<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Writer Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Welcome and Logout Section -->
    <div class="container">
        <div class="d-flex justify-content-between align-items-center p-4">
            <h2>Welcome {{ auth()->user()->username }} ✍</h2>
            <div>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="btn btn-danger">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#createPostModal">
                    Create New Post
                </button>
            </div>
        </div>
    </div>

    <!-- Create Post Modal -->
    <div class="modal fade p-4" id="createPostModal" tabindex="-1" role="dialog" aria-labelledby="createPostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ route('content_writer.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPostModalLabel">Create New Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Display Posts -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            @foreach ($posts as $post)
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->description }}</p>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    {{-- <span
                                        class="badge badge-warning">{{ $post->is_approved ? 'Approved' : 'Pending' }}
                                    </span> --}}
                                    <div>
                                        @if ($post->is_approved === null)
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($post->is_approved)
                                            <span class="badge badge-success">Approved</span>
                                        @else
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <a href="#" class="card-link" data-toggle="modal"
                                        data-target="#editPostModal{{ $post->id }}">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Post Modal -->
                <div class="modal fade" id="editPostModal{{ $post->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editPostModalLabel{{ $post->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="POST" action="{{ route('content_writer.update', ['post' => $post->id]) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editPostModalLabel{{ $post->id }}">Edit Post</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="edit_title">Title</label>
                                        <input type="text" class="form-control" id="edit_title" name="title"
                                            value="{{ $post->title }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_description">Description</label>
                                        <textarea class="form-control" id="edit_description" name="description" rows="3" required>{{ $post->description }}</textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
