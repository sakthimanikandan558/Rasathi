@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card-columns" id="orderContainer">
                    @include('products_details.cards', ['orders' => $orders])
                </div>
                
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Customer Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> <span id="customerName"></span></p>
                    <p><strong>Email:</strong> <span id="customerEmail"></span></p>
                    <p><strong>Shipping Address:</strong> <span id="customerAddress"></span></p>
                    <p><strong>Phone:</strong> <span id="customerPhone"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                var url = $(this).attr('href');
                console.log(url);
                loadMoreOrders(url);
                // window.history.pushState("", "", url);
            });

            // Function to load more orders using Ajax
            function loadMoreOrders(url) {
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#orderContainer').html(data);
                    }
                });
            }

       
            // Modal handler
            $(document).on('click', '.view-customer-details', function(e) {
                var customer = $(this).data('customer');
                $('#customerName').text(customer.Name);
                $('#customerEmail').text(customer.email);
                $('#customerAddress').text(customer.shipping_address);
                $('#customerPhone').text(customer.phone);
                $('#customerModal').modal('show');
            });
        });
    </script>
@endsection
