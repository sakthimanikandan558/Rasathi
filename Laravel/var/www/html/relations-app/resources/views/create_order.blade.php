<form action="{{ route('orders.store') }}" method="POST">
    @csrf
    <label for="customer_id">Customer:</label>
    <select name="customer_id" id="customer_id">
        @foreach($customer as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>

    <label for="employee_id">Employee:</label>
    <select name="employee_id" id="employee_id">
        @foreach($employee as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
    </select>

    <label for="product">Product:</label>
    <input type="text" name="product" id="product" required>

    <button type="submit">Create Order</button>
</form>
