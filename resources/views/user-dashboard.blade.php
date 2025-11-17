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

        :root {
            --primary-blue: #2563eb;
            --secondary-blue: #1e40af;
            --light-blue: #3b82f6;
            --extra-light-blue: #dbeafe;
            --dark-blue: #1e3a8a;
            --gradient-start: #1e3c72;
            --gradient-end: #2a5298;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%);
            min-height: 100vh;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
        }

        .navbar-brand {
            color: var(--primary-blue) !important;
            font-weight: 700;
            font-size: 1.5rem;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--secondary-blue) !important;
            transform: scale(1.05);
        }

        .nav-link {
            color: var(--primary-blue) !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: var(--light-blue) !important;
        }

        .dashboard-container {
            padding: 40px 20px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .welcome-card {
            background: white;
            border-radius: 25px;
            padding: 50px 40px;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            margin-bottom: 40px;
            position: relative;
            overflow: hidden;
            animation: fadeInDown 0.6s ease;
        }

        .welcome-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, var(--extra-light-blue), transparent);
            border-radius: 50%;
            z-index: 0;
        }

        .welcome-card-content {
            position: relative;
            z-index: 1;
        }

        .welcome-card h1 {
            color: var(--dark-blue);
            font-size: 2.8rem;
            margin-bottom: 15px;
            font-weight: 800;
        }

        .welcome-card p {
            color: #64748b;
            font-size: 1.3rem;
            margin-bottom: 0;
        }

        .greeting-emoji {
            font-size: 3rem;
            display: inline-block;
            animation: wave 2s infinite;
        }

        @keyframes wave {
            0%, 100% { transform: rotate(0deg); }
            25% { transform: rotate(20deg); }
            75% { transform: rotate(-20deg); }
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .quick-actions {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .action-btn {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            text-decoration: none;
            color: var(--dark-blue);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: block;
            position: relative;
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
        }

        .action-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 0;
        }

        .action-btn:hover::before {
            opacity: 1;
        }

        .action-btn:hover {
            color: white;
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.3);
        }

        .action-btn * {
            position: relative;
            z-index: 1;
        }

        .action-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            display: block;
            transition: all 0.3s ease;
        }

        .action-btn:hover .action-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .action-title {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .action-desc {
            font-size: 0.9rem;
            opacity: 0.8;
        }

        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 30px 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-left: 5px solid var(--primary-blue);
            transition: all 0.3s ease;
            animation: fadeInUp 0.6s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(37, 99, 235, 0.2);
            border-left-color: var(--light-blue);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--extra-light-blue), var(--light-blue));
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: var(--primary-blue);
            margin-bottom: 15px;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }

        .stat-label {
            color: #64748b;
            font-size: 1rem;
            font-weight: 500;
        }

        .user-info {
            background: white;
            border-radius: 25px;
            padding: 40px;
            margin-top: 40px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            display: none;
            animation: fadeInUp 0.6s ease;
        }

        .user-info.show {
            display: block;
        }

        .user-info-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid var(--extra-light-blue);
        }

        .user-info-header h3 {
            color: var(--dark-blue);
            font-weight: 800;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-info-header .icon-circle {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
        }

        .close-profile-btn {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }

        .close-profile-btn:hover {
            transform: rotate(90deg) scale(1.1);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3);
        }

        .profile-avatar-section {
            text-align: center;
            margin-bottom: 40px;
            padding: 30px;
            background: linear-gradient(135deg, var(--extra-light-blue), transparent);
            border-radius: 20px;
        }

        .profile-avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-blue), var(--light-blue));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            font-weight: 700;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(37, 99, 235, 0.3);
            border: 5px solid white;
        }

        .profile-name {
            font-size: 2rem;
            font-weight: 800;
            color: var(--dark-blue);
            margin-bottom: 5px;
        }

        .profile-role {
            color: var(--primary-blue);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
        }

        .info-item {
            background: #f8fafc;
            padding: 25px;
            border-radius: 15px;
            border-left: 4px solid var(--primary-blue);
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: var(--extra-light-blue);
            transform: translateX(5px);
            box-shadow: 0 5px 15px rgba(37, 99, 235, 0.1);
        }

        .info-label {
            font-weight: 700;
            color: var(--primary-blue);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-value {
            color: var(--dark-blue);
            font-size: 1.1rem;
            font-weight: 600;
        }

        .badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .dropdown-menu {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            padding: 10px;
        }

        .dropdown-item {
            border-radius: 10px;
            padding: 12px 20px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .dropdown-item:hover {
            background: var(--extra-light-blue);
            color: var(--primary-blue);
            transform: translateX(5px);
        }

        @media (max-width: 768px) {
            .welcome-card {
                padding: 30px 20px;
            }

            .welcome-card h1 {
                font-size: 2rem;
            }

            .welcome-card p {
                font-size: 1rem;
            }

            .quick-actions {
                grid-template-columns: 1fr;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .user-info {
                padding: 25px 20px;
            }

            .profile-avatar {
                width: 120px;
                height: 120px;
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fas fa-building me-2"></i>Loan Management System
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle me-2"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#" onclick="toggleProfile(); return false;">
                                <i class="fas fa-user me-2"></i>View Profile
                            </a>
                        </li>
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
    </div>
</nav>

<!-- Dashboard Content -->
<div class="dashboard-container">
    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="welcome-card-content">
            <span class="greeting-emoji">👋</span>
            <h1>Welcome back, {{ Auth::user()->name }}!</h1>
            <p>Your Loan Management Dashboard</p>
        </div>
    </div>

    <div class="quick-actions">
        <a href="{{ route('loan.apply') }}" class="action-btn">
            <i class="fas fa-file-invoice-dollar action-icon"></i>
            <div class="action-title">Apply for Loan</div>
            <div class="action-desc">Submit a new loan application</div>
        </a>
        <a href="{{ route('loan.index') }}" class="action-btn">
            <i class="fas fa-list-alt action-icon"></i>
            <div class="action-title">My Applications</div>
            <div class="action-desc">View all your applications</div>
        </a>
        <a href="#" class="action-btn">
            <i class="fas fa-history action-icon"></i>
            <div class="action-title">History</div>
            <div class="action-desc">Check application history</div>
        </a>
        <a href="#" class="action-btn">
            <i class="fas fa-question-circle action-icon"></i>
            <div class="action-title">Help & Support</div>
            <div class="action-desc">Get assistance and support</div>
        </a>
    </div>

    <!-- User Profile Information (Hidden by default) -->
    <div class="user-info" id="userProfile">
        <div class="user-info-header">
            <h3>
                <span class="icon-circle">
                    <i class="fas fa-user"></i>
                </span>
                Profile Information
            </h3>
            <button class="close-profile-btn" onclick="toggleProfile()">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="profile-avatar-section">
            <div class="profile-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
            </div>
            <div class="profile-name">{{ Auth::user()->name }}</div>
            <div class="profile-role">Loan Applicant</div>
        </div>

        <div class="info-grid">
            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-user"></i>
                    Full Name
                </div>
                <div class="info-value">{{ Auth::user()->name }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-envelope"></i>
                    Email Address
                </div>
                <div class="info-value">{{ Auth::user()->email }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-phone"></i>
                    Mobile Number
                </div>
                <div class="info-value">{{ Auth::user()->mobile_number ?? 'Not provided' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-map-marker-alt"></i>
                    Address
                </div>
                <div class="info-value">{{ Auth::user()->address ?? 'Not provided' }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-calendar"></i>
                    Member Since
                </div>
                <div class="info-value">{{ Auth::user()->created_at->format('F d, Y') }}</div>
            </div>

            <div class="info-item">
                <div class="info-label">
                    <i class="fas fa-check-circle"></i>
                    Account Status
                </div>
                <div class="info-value">
                    <span class="badge bg-success">
                        <i class="fas fa-check me-1"></i>Active
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Toggle profile visibility
    function toggleProfile() {
        const profile = document.getElementById('userProfile');
        profile.classList.toggle('show');

        if (profile.classList.contains('show')) {
            profile.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }

    // Login success message
    @if(session('login_success'))
        Swal.fire({
            title: 'Login Successful! 🎉',
            text: 'Welcome to your dashboard, {{ Auth::user()->name }}',
            icon: 'success',
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true,
            background: '#fff',
            customClass: {
                popup: 'animated-popup'
            }
        });
    @endif

    // Add animation to cards
    document.addEventListener('DOMContentLoaded', function() {
        const actionBtns = document.querySelectorAll('.action-btn');
        actionBtns.forEach((btn, index) => {
            btn.style.animationDelay = `${index * 0.1}s`;
        });

        const statCards = document.querySelectorAll('.stat-card');
        statCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
        });
    });
</script>
</body>
</html>
