<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Manager Dashboard</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h4>Loan Applications</h4>

        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Tel</th>
                    <th>Occupation</th>
                    <th>Salary</th>
                    <th>Status</th>
                    <th>Submitted At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    @foreach($loans as $loan)
        <tr>
            <td>{{ $loan->id }}</td>
            <td>{{ $loan->name }}</td>
            <td>{{ $loan->email }}</td>
            <td>{{ $loan->tel }}</td>
            <td>{{ $loan->occupation }}</td>
            <td>{{ $loan->salary }}</td>
            <td>{{ $loan->status }}</td>
            <td>{{ $loan->created_at->timezone('Asia/Colombo')->format('Y-m-d H:i:s') }}</td>
            <td>
                <a href="{{ url('/loan/approve/'.$loan->id) }}" class="btn btn-success btn-sm">Approve</a>
                <a href="{{ url('/loan/reject/'.$loan->id) }}" class="btn btn-danger btn-sm">Reject</a>
            </td>
        </tr>
    @endforeach
</tbody>

        </table>

    </div>
</body>
</html>