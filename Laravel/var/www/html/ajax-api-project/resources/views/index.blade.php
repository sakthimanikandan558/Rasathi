<!DOCTYPE html>
<html>

<head>
    <title>AJAX API Example</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100 text-gray-900 font-sans">
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">AJAX API Example</h1>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Add Item</h2>
            <input type="text" id="itemName" placeholder="Item name" class="border border-gray-300 p-2 rounded mr-2">
            <button id="addItem" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Item</button>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Update Item</h2>
            <input type="number" id="updateItemId" placeholder="Item ID"
                class="border border-gray-300 p-2 rounded mr-2">
            <input type="text" id="updateItemName" placeholder="New item name"
                class="border border-gray-300 p-2 rounded mr-2">
            <button id="updateItem" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update
                Item</button>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Delete Item</h2>
            <input type="number" id="deleteItemId" placeholder="Item ID"
                class="border border-gray-300 p-2 rounded mr-2">
            <button id="deleteItem" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete
                Item</button>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Show Products</h2>
            <button id="showProducts" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Show
                Products</button>
        </div>

        <div class="mb-8">
            <h2 class="text-xl font-semibold mb-2">Product Details</h2>
            <div id="itemDetails" class="hidden p-4 border border-gray-300 rounded bg-white"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function fetchItems() {
                $.ajax({
                    url: '/api/items',
                    method: 'GET',
                    success: function(response) {
                        $('#itemDetails').empty();
                        response.forEach(function(item) {
                            $('#itemDetails').append(
                                '<div class="border-b border-gray-200 mb-4 pb-4">' +
                                '<p><strong>ID:</strong> ' + item.id + '</p>' +
                                '<p><strong>Name:</strong> ' + item.name + '</p>' +
                                '<p><strong>Created At:</strong> ' + item.created_at +
                                '</p>' +
                                '<p><strong>Updated At:</strong> ' + item.updated_at +
                                '</p>' +
                                '</div>'
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }

            $('#addItem').click(function() {
                $.ajax({
                    url: '/api/items',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        name: $('#itemName').val()
                    }),
                    success: function(response) {
                        fetchItems(); // Reload items after adding
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#updateItem').click(function() {
                const id = $('#updateItemId').val();
                const name = $('#updateItemName').val();
                $.ajax({
                    url: '/api/items/' + id,
                    method: 'PUT',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        name: name
                    }),
                    success: function(response) {
                        fetchItems(); // Reload items after updating
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#deleteItem').click(function() {
                const id = $('#deleteItemId').val();
                $.ajax({
                    url: '/api/items/' + id,
                    method: 'DELETE',
                    success: function(response) {
                        fetchItems(); // Reload items after deleting
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });

            $('#showProducts').click(function() {
                fetchItems();
                $('#itemDetails').removeClass('hidden'); // Show the itemDetails div
            });
        });
    </script>
</body>

</html>
