<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Online</th>
            <th>Walk-In</th>
            <th>Government</th>
            <th>Project-Based</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['online'] }}</td>
                <td>{{ $row['walk_in'] }}</td>
                <td>{{ $row['government'] }}</td>
                <td>{{ $row['project_based'] }}</td>
                <td>{{ $row['total'] }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <th>{{ $grandTotal['online'] }}</th>
            <th>{{ $grandTotal['walk_in'] }}</th>
            <th>{{ $grandTotal['government'] }}</th>
            <th>{{ $grandTotal['project_based'] }}</th>
            <th>{{ $grandTotal['total'] }}</th>
        </tr>
    </tfoot>
</table>
