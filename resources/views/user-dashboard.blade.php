<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Loan Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
        }

        .dashboard-container {
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .welcome-card {
            background: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .welcome-card h1 {
            color: #333;
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .welcome-card p {
            color: #666;
            font-size: 1.2rem;
            margin-bottom: 25px;
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .action-btn {
            background: white;
            border: none;
            border-radius: 15px;
            padding: 25px 20px;
            text-align: center;
            text-decoration: none;
            color: #333;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: block;
        }

        .action-btn:hover {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(102, 126, 234, 0.3);
        }

        .action-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            display: block;
        }

        .user-info {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-top: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .user-info h3 {
            color: #333;
            margin-bottom: 20px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        .info-label {
            font-weight: 600;
            color: #555;
        }

        .info-value {
            color: #333;
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#" style="color: #667eea;">
            <i class="fas fa-building me-2"></i>Loan Management System
        </a>
        <div class="navbar-nav ms-auto">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Dashboard Content -->
<div class="dashboard-container">
    <!-- Welcome Card -->
    <div class="welcome-card">
        <h1>Welcome back, {{ Auth::user()->name }}! 👋</h1>
        <p>Your Loan Management Dashboard</p>

        <div class="quick-actions">
            <a href="{{ route('loan.apply') }}" class="action-btn">
                <i class="fas fa-file-invoice-dollar action-icon"></i>
                Apply for New Loan
            </a>
            <a href="{{ route('loan.index') }}" class="action-btn">
                <i class="fas fa-list-alt action-icon"></i>
                View My Applications
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-history action-icon"></i>
                Application History
            </a>
            <a href="#" class="action-btn">
                <i class="fas fa-question-circle action-icon"></i>
                Help & Support
            </a>
        </div>
    </div>

    <!-- User Information -->
    <div class="user-info">
        <h3><i class="fas fa-user me-2"></i>Your Profile Information</h3>
        <div class="info-item">
            <span class="info-label">Full Name:</span>
            <span class="info-value">{{ Auth::user()->name }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Email Address:</span>
            <span class="info-value">{{ Auth::user()->email }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Mobile Number:</span>
            <span class="info-value">{{ Auth::user()->mobile_number ?? 'Not provided' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Address:</span>
            <span class="info-value">{{ Auth::user()->address ?? 'Not provided' }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Account Status:</span>
            <span class="info-value">
                    <span class="badge bg-success">Active</span>
                </span>
        </div>
    </div>
</div>

<!-- SweetAlert Script -->
<script>
    // Login success message
    @if(session('login_success'))
        Swal.fire({
            title: 'Login Successful! 🎉',
            text: 'Welcome to your dashboard',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true
        });
    @endif
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
