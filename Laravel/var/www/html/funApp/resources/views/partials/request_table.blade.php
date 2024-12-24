<table class="table table-bordered">
    <thead>
        <tr>
            <th>S.No.</th>
            <th>Title</th>
            <th>Description</th>
            <th>Author</th>
            <th>Created At</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @isset($posts)
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->description }}</td>
                    <td>{{ $post->user->username }}</td>
                    <td>{{ $post->created_at->format('Y-m-d H:i:s') }}</td>
                    <td>
                        {{-- @if ($post->is_approved)
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Pending</span>
                        @endif --}}
                        @if ($post->is_approved === null)
                            <span class="badge badge-warning">Pending</span>
                        @elseif ($post->is_approved)
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-danger">Rejected</span>
                        @endif
                    </td>
                    <td>
                        @if (!$post->is_approved)
                            <form action="{{ route('admin.approve', ['post' => $post->id]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-success"
                                    onclick="return confirm('Are you sure to approve this post?');"
                                    {{ $post->is_approved ? 'disabled' : '' }}>Approve</button>
                            </form>
                        @endif

                        @if ($post->is_approved)
                            <form action="{{ route('admin.reject', ['post' => $post->id]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure to reject this post?');"
                                    {{ !$post->is_approved ? 'disabled' : '' }}>Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">No posts found.</td>
            </tr>
        @endisset
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $posts->links() }}
</div>