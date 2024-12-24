@extends('layouts.app')

@section('content')
    <div class="container">
        <div id="productTable" class="table-responsive">
            <h2>Product List</h2>
            <!-- Products table -->
            <table id="productsTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            {{-- <td><img src="{{ $product->image_url }}" alt="Product Image" style="max-width: 100px;"></td> --}}
                            <td>
                                @foreach ($product->images as $image)
                                    @php
                                        // Split the $image->url to get the path relative to 'public/'
                                        $imagePath = explode('public/', $image->url)[1];
                                    @endphp
                                    <img src="{{ asset('storage/' . $imagePath) }}" alt="Product Image"
                                        style="max-width: 100px;">
                                @endforeach
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_description }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>
                                <a href="{{ route('product.details', ['id' => $product->id]) }}"
                                    class="btn btn-primary">Details</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $products->links() }} <!-- Pagination links -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                fetchProducts(url);
            });

            // Fetch products using Ajax and update the table
            function fetchProducts(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(response) {
                        $('#productTable').html(response); // Update product table content
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    </script>
@endsection
