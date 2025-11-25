<table>
    <thead>
        <tr>
            <th>Date</th>
            <th>Monthly Dues</th>
            <th>Employee Salary</th>
            <th>Supplies & Materials</th>
            <th>Miscellaneous</th>
            <th>Other Expenses</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $row)
            <tr>
                <td>{{ $row['date'] }}</td>
                <td>{{ $row['monthly dues'] }}</td>
                <td>{{ $row['employee salary'] }}</td>
                <td>{{ $row['supplies & materials'] }}</td>
                <td>{{ $row['miscellaneous'] }}</td>
                <td>{{ $row['other expenses'] }}</td>
                <td>{{ $row['total'] }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>Total</th>
            <td>{{ $grandTotal['monthly dues'] }}</td>
            <td>{{ $grandTotal['employee salary'] }}</td>
            <td>{{ $grandTotal['supplies & materials'] }}</td>
            <td>{{ $grandTotal['miscellaneous'] }}</td>
            <td>{{ $grandTotal['other expenses'] }}</td>
            <td>{{ $grandTotal['total'] }}</td>
        </tr>
    </tfoot>
</table>
