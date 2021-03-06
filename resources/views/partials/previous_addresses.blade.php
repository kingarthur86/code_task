<div class="table-responsive">
    <table class="table">
        <h2>Previous addresses</h2>
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Address Line 1</th>
            <th scope="col">Address Line 2</th>
            <th scope="col">Town</th>
            <th scope="col">County</th>
            <th scope="col">Country</th>
            <th scope="col">Postal Code</th>
            <th scope="col">From Date</th>
            <th scope="col">Until date</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($addresses as $address)
        <tr>
            <th scope="row">1</th>
            <td>{{ $address->address_line_1 }}</td>
            <td>{{ $address->address_line_2}}</td>
            <td>{{ $address->town }}</td>
            <td>{{ $address->county }}</td>
            <td>{{ $address->country  }}</td>
            <td>{{ $address->postal_code }}</td>
            <td>{{ $address->from_date }}</td>
            <td>{{ $address->until_date }}</td>
            <td>
                <a href="{{ route('addresses.edit', $address->id) }}"><button type="button" class="btn btn-success">Edit</button></a>
                <a href="{{ route('addresses.remove', $address->id) }}"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
</div>