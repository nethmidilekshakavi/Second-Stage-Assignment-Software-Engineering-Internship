<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.15);
            z-index: 1000;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 10px;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .logo-circle {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        .logo-circle i {
            font-size: 2.5rem;
            color: #1e3c72;
        }

        .sidebar-header h3 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
        }

        .sidebar-header p {
            font-size: 0.9rem;
            opacity: 0.85;
            margin: 5px 0 0 0;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            padding: 0;
            margin: 5px 15px;
        }

        .nav-link {
            color: white;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #ffd700;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover,
        .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .nav-link:hover::before,
        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link i {
            width: 25px;
            font-size: 1.2rem;
            margin-right: 12px;
        }

        .stats-section {
            padding: 20px 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .stats-section h6 {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.8;
            margin-bottom: 15px;
            padding-left: 5px;
        }

        .stat-box {
            background: rgba(255, 255, 255, 0.12);
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            background: rgba(255, 255, 255, 0.18);
            transform: translateY(-2px);
        }

        .stat-box .number {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0;
        }

        .stat-box .label {
            font-size: 0.85rem;
            opacity: 0.9;
            margin: 0;
        }

        .logout-section {
            padding: 20px 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .btn-logout {
            width: 100%;
            padding: 12px;
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid white;
            color: white;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .btn-logout:hover {
            background: white;
            color: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
        }

        .btn-logout i {
            margin-right: 8px;
        }

        /* Main Content */
        .main-content {
            margin-left: 280px;
            flex: 1;
            padding: 30px;
            width: calc(100% - 280px);
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar h2 {
            margin: 0;
            color: #1e3c72;
            font-weight: 700;
            font-size: 1.8rem;
        }

        .search-container {
            position: relative;
            width: 400px;
        }

        .search-container input {
            width: 100%;
            padding: 12px 45px 12px 20px;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-container input:focus {
            outline: none;
            border-color: #2a5298;
            box-shadow: 0 0 0 4px rgba(42, 82, 152, 0.1);
        }

        .search-container i {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #2a5298;
            font-size: 1.1rem;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            margin-bottom: 20px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            border: none;
            overflow: hidden;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            margin: 0;
            white-space: nowrap;
        }

        .table thead {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        }

        .table thead th {
            color: white;
            font-weight: 600;
            padding: 16px 12px;
            border: none;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            font-size: 0.9rem;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .bg-warning {
            background: #ffc107 !important;
            color: #000;
        }

        .bg-success {
            background: #28a745 !important;
        }

        .bg-danger {
            background: #dc3545 !important;
        }

        .btn {
            padding: 7px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.2s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            white-space: nowrap;
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
        }

        .btn-warning {
            background: #ffc107;
            color: #000;
        }

        .btn-warning:hover {
            background: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
        }

        .btn-outline-primary {
            border: 2px solid #2a5298;
            color: #2a5298;
            background: white;
        }

        .btn-outline-primary:hover {
            background: #2a5298;
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            background: white;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }

        .btn-group {
            display: flex;
            gap: 4px;
        }

        .action-btns {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .no-results {
            text-align: center;
            padding: 50px 20px;
            color: #6c757d;
            display: none;
        }

        .no-results i {
            font-size: 3.5rem;
            opacity: 0.3;
            margin-bottom: 15px;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
            }

            .sidebar-header h3,
            .sidebar-header p,
            .nav-link span,
            .stats-section,
            .logout-section {
                display: none;
            }

            .sidebar-header {
                padding: 20px 10px;
            }

            .logo-circle {
                width: 50px;
                height: 50px;
            }

            .logo-circle i {
                font-size: 1.5rem;
            }

            .nav-link {
                justify-content: center;
                padding: 12px;
            }

            .nav-link i {
                margin-right: 0;
            }

            .main-content {
                margin-left: 70px;
                width: calc(100% - 70px);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 20px;
            }

            .top-bar {
                flex-direction: column;
                gap: 15px;
            }

            .search-container {
                width: 100%;
            }

            .action-btns {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <div class="logo-circle">
                    <i class="fas fa-building"></i>
                </div>
                <h3>Loan Manager</h3>
                <p>Admin Portal</p>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="fas fa-home"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-invoice-dollar"></i>
                        <span>Applications</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-check-circle"></i>
                        <span>Approved</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-times-circle"></i>
                        <span>Rejected</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-clock"></i>
                        <span>Pending</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-line"></i>
                        <span>Analytics</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </nav>

            <div class="stats-section">
                <h6>Statistics</h6>
                <div class="stat-box">
                    <p class="number">{{ count($loans) }}</p>
                    <p class="label">Total Applications</p>
                </div>
                <div class="stat-box">
                    <p class="number">{{ collect($loans)->where('status', 'pending')->count() }}</p>
                    <p class="label">Pending</p>
                </div>
                <div class="stat-box">
                    <p class="number">{{ collect($loans)->where('status', 'approved')->count() }}</p>
                    <p class="label">Approved</p>
                </div>
                <div class="stat-box">
                    <p class="number">{{ collect($loans)->where('status', 'rejected')->count() }}</p>
                    <p class="label">Rejected</p>
                </div>
            </div>

            <div class="logout-section">
                <a href="{{ url('/logout') }}" class="btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="top-bar">
                <h2><i class="fas fa-file-invoice-dollar"></i> Loan Applications</h2>
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Search by name, email, occupation...">
                    <i class="fas fa-search"></i>
                </div>
            </div>

            <div class="card">
                <div class="table-responsive">
                    <table class="table" id="loanTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Tel</th>
                                <th>Occupation</th>
                                <th>Salary</th>
                                <th>Paysheet</th>
                                <th>Status</th>
                                <th>Submitted</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loans as $loan)
                                <tr>
                                    <td><strong>#{{ $loan->id }}</strong></td>
                                    <td>{{ $loan->name }}</td>
                                    <td>{{ $loan->email }}</td>
                                    <td>{{ $loan->tel }}</td>
                                    <td>{{ $loan->occupation }}</td>
                                    <td><strong>Rs. {{ number_format($loan->salary, 2) }}</strong></td>
                                    <td>
                                        @if($loan->paysheet_uri)
                                            <div class="btn-group">
                                                <a href="{{ url('/loan/view-pdf/'.$loan->id) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="{{ url('/loan/download-pdf/'.$loan->id) }}" class="btn btn-outline-secondary btn-sm">
                                                    <i class="fas fa-download"></i> Download
                                                </a>
                                            </div>
                                        @else
                                            <span class="text-muted">No File</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge @if($loan->status == 'approved') bg-success @elseif($loan->status == 'rejected') bg-danger @else bg-warning @endif">
                                            @if($loan->status == 'approved')<i class="fas fa-check"></i>@elseif($loan->status == 'rejected')<i class="fas fa-times"></i>@else<i class="fas fa-clock"></i>@endif
                                            {{ ucfirst($loan->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $loan->created_at->timezone('Asia/Colombo')->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="action-btns">
                                            <a href="{{ url('/loan/approve/'.$loan->id) }}" class="btn btn-success btn-sm">
                                                <i class="fas fa-check"></i> Approve
                                            </a>
                                            <a href="{{ url('/loan/reject/'.$loan->id) }}" class="btn btn-danger btn-sm">
                                                <i class="fas fa-times"></i> Reject
                                            </a>
                                           <a href="{{ route('loan.edit', $loan->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)"
                                               onclick="confirmDelete({{ $loan->id }})" class="btn btn-info btn-sm">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>

<!-- Hidden form for deletion -->
<form id="delete-form-{{ $loan->id }}" action="{{ route('loan.delete', $loan->id) }}" method="POST" style="display:none;">
    @csrf
    @method('DELETE')
</form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="no-results" id="noResults">
                    <i class="fas fa-search"></i>
                    <h5>No results found</h5>
                    <p>Try different search terms</p>
                </div>
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase().trim();
            const table = document.getElementById('loanTable');
            const tbody = table.getElementsByTagName('tbody')[0];
            const rows = tbody.getElementsByTagName('tr');
            const noResults = document.getElementById('noResults');
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const text = row.textContent.toLowerCase();

                if (text.includes(searchValue)) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            if (visibleCount === 0 && searchValue !== '') {
                table.style.display = 'none';
                noResults.style.display = 'block';
            } else {
                table.style.display = 'table';
                noResults.style.display = 'none';
            }
        });
    </script>


    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: "Are you sure?",
            text: "This application will be permanently deleted!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>



</body>
</html>
