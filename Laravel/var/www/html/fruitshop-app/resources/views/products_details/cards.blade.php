@foreach ($orders as $order)
    <div class="card mb-3 view-customer-details" data-customer="{{ json_encode($order->customer) }}">
        <div class="card-body">
            <h5 class="card-title">Customer Name: {{ $order->customer->Name }}</h5>
            <p class="card-text">Quantity: {{ $order->quantity }}</p>
            <p class="card-text">Review: {{ $order->review }}</p>
            <p class="card-text">Total Price: {{ $order->quantity * $order->product->product_price }}</p>
        </div>
    </div>
@endforeach
<div class="d-flex justify-content-center mt-4">
    {{ $orders->links() }} <!-- Renders pagination links -->
</div>
