<!-- resources/views/customer_modal.blade.php -->

<div>
    @foreach ($orders as $order)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Customer: {{ $order->customer->name }}</h5>
                <p class="card-text">Customer ID: {{ $order->customer->id }}</p>
                <p class="card-text">Product Quantity: {{ $order->quantity }}</p>
                <p class="card-text">Total Price: {{ $order->quantity * $order->product->product_price }}</p>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customerDetailsModal{{ $order->customer->id }}">
                    View Customer Details
                </button>
            </div>
        </div>

        <!-- Modal for Customer Details -->
        <div class="modal fade" id="customerDetailsModal{{ $order->customer->id }}" tabindex="-1" role="dialog" aria-labelledby="customerDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="customerDetailsModalLabel">Customer Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Name:</strong> {{ $order->customer->name }}</p>
                        <p><strong>Email:</strong> {{ $order->customer->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->customer->phone }}</p>
                        <p><strong>Shipping Address:</strong> {{ $order->customer->shipping_address }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
