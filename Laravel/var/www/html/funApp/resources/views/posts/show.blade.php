<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom styles -->
   
</head>

<body>
    <div class="container mt-4">

        <div class="mb-3 d-flex justify-content-between">
            <a href="{{ route('user') }}" class="btn btn-secondary">Back</a>

            @auth
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            @endauth
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><strong>{{ $post->title }}</strong></h5>
                <p class="card-text">{{ $post->description }}</p>
                <p class="card-text"><strong>Author:</strong> {{ $post->user->username }}</p>
                <p class="card-text"><strong>Created At:</strong> {{ $post->created_at->format('Y-m-d H:i:s') }}</p>

                <form action="{{ route('post.like', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    @if ($post->likes()->where('user_id', Auth::id())->exists())
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-heart text-danger"></i>
                            Liked</button>
                    @else
                        <button type="submit" class="btn btn-outline-danger"><i class="fa fa-heart"></i> Like</button>
                    @endif
                </form>
                <p>{{ $post->likes->count() }} Likes</p>
            </div>
        </div>

        <div class="mt-3">
            <h5>Comments</h5>

            @auth
                <form action="{{ route('post.comment', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <textarea name="comment" class="form-control" placeholder="Write a comment..."></textarea>
                    <button type="submit" class="btn btn-primary mt-2">Post Comment</button>
                </form>
            @else
                <p>You need to <a href="{{ route('login') }}">login</a> to post comments.</p>
            @endauth

            @foreach ($post->comments as $comment)
                <div class="card mt-2">
                    <div class="card-body">
                        <p><strong>{{ $comment->user->username }}</strong></p>
                        <p>{{ $comment->comment }}</p>
                        @if ($comment->user_id == Auth::id())
                            <div class="d-flex justify-content-end">
                                <!-- Delete Link -->
                                <a href="{{ route('comment.delete', ['post' => $post->id, 'comment' => $comment->id]) }}"
                                    onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this comment?')) document.getElementById('delete-comment-form-{{ $comment->id }}').submit();">
                                    Delete
                                </a>
                                <form id="delete-comment-form-{{ $comment->id }}"
                                    action="{{ route('comment.delete', ['post' => $post->id, 'comment' => $comment->id]) }}"
                                    method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                <!-- Edit Link -->
                                <a href="#" class="ml-2" data-toggle="modal" data-target="#editCommentModal"
                                    data-id="{{ $comment->id }}" data-content="{{ $comment->comment }}">
                                    Edit
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editCommentForm" action="" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="commentId" name="comment_id">
                        <textarea name="content" id="commentContent" class="form-control" rows="4" required></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Update Comment</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#editCommentModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var commentId = button.data('id'); // Extract info from data-* attributes
            var commentContent = button.data('content'); // Extract info from data-* attributes

            var modal = $(this);
            modal.find('#commentId').val(commentId);
            modal.find('#commentContent').val(commentContent);

            // Construct the URL dynamically
            var postId = '{{ $post->id }}'; // Pass post ID from Blade template
            var url = '{{ route('comment.update', ['post' => ':post', 'comment' => ':comment']) }}';
            url = url.replace(':post', postId).replace(':comment', commentId);
            modal.find('#editCommentForm').attr('action', url);
        });
    </script>
</body>

</html>
