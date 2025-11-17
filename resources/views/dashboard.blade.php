<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Manager Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

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
            cursor: pointer;
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
            cursor: pointer;
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

        .content-section {
            display: none;
        }

        .content-section.active {
            display: block !important;
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
            flex-wrap: wrap;
            gap: 15px;
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

        /* Dashboard Overview Cards */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: all 0.3s ease;
            border-left: 5px solid;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }

        .stat-card.total {
            border-color: #2a5298;
        }

        .stat-card.pending {
            border-color: #ffc107;
        }

        .stat-card.approved {
            border-color: #28a745;
        }

        .stat-card.rejected {
            border-color: #dc3545;
        }

        .stat-icon {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
        }

        .stat-card.total .stat-icon {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #2a5298;
        }

        .stat-card.pending .stat-icon {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            color: #f57c00;
        }

        .stat-card.approved .stat-icon {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #388e3c;
        }

        .stat-card.rejected .stat-icon {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #d32f2f;
        }

        .stat-details h3 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: #212529;
        }

        .stat-details p {
            margin: 0;
            color: #6c757d;
            font-size: 0.95rem;
            font-weight: 500;
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .chart-card h4 {
            color: #1e3c72;
            font-weight: 700;
            margin-bottom: 20px;
            font-size: 1.3rem;
        }

        /* Application Cards */
        .applications-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .application-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid transparent;
            animation: fadeInUp 0.5s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .application-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 8px 30px rgba(30, 60, 114, 0.2);
            border-color: #2a5298;
        }

        .card-header-custom {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 18px 16px;
            position: relative;
            overflow: hidden;
        }

        .card-header-custom::before {
            content: '';
            position: absolute;
            top: -40%;
            right: -15px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
        }

        .applicant-header {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .applicant-image-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .applicant-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .applicant-image:hover {
            transform: scale(1.15);
            box-shadow: 0 5px 20px rgba(255, 255, 255, 0.5);
        }

        .status-badge-overlay {
            position: absolute;
            bottom: -3px;
            right: -3px;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            font-size: 0.65rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        .status-badge-overlay.pending {
            background: #ffc107;
            color: #000;
        }

        .status-badge-overlay.approved {
            background: #28a745;
            color: white;
        }

        .status-badge-overlay.rejected {
            background: #dc3545;
            color: white;
        }

        .applicant-info {
            flex: 1;
            color: white;
            min-width: 0;
        }

        .applicant-name {
            font-size: 1.1rem;
            font-weight: 700;
            margin: 0 0 4px 0;
            color: white;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .applicant-id {
            font-size: 0.75rem;
            opacity: 0.85;
            margin: 0 0 6px 0;
        }

        .applicant-occupation {
            font-size: 0.85rem;
            opacity: 0.9;
            display: flex;
            align-items: center;
            gap: 5px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card-body-custom {
            padding: 16px;
        }

        .info-row {
            display: flex;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .info-icon.email {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            color: #1976d2;
        }

        .info-icon.phone {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #388e3c;
        }

        .info-icon.salary {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            color: #f57c00;
        }

        .info-icon.document {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);
            color: #c2185b;
        }

        .info-icon.date {
            background: linear-gradient(135deg, #f3e5f5 0%, #e1bee7 100%);
            color: #7b1fa2;
        }

        .info-content {
            flex: 1;
            min-width: 0;
        }

        .info-label {
            font-size: 0.7rem;
            color: #6c757d;
            margin: 0 0 2px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .info-value {
            font-size: 0.9rem;
            color: #212529;
            margin: 0;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .info-value.highlight {
            color: #1e3c72;
            font-weight: 700;
            font-size: 1rem;
        }

        .card-actions {
            padding: 14px 16px;
            background: #f8f9fa;
            border-top: 2px solid #e9ecef;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
        }

        .btn {
            padding: 8px 12px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            white-space: nowrap;
            justify-content: center;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #20c997 0%, #28a745 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.4);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
        }

        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #dc3545 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.4);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: #000;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.4);
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
        }

        .btn-info:hover {
            background: linear-gradient(135deg, #138496 0%, #17a2b8 100%);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(23, 162, 184, 0.4);
        }

        .btn-outline-primary {
            border: 2px solid #2a5298;
            color: #2a5298;
            background: white;
            padding: 5px 10px;
            font-size: 0.75rem;
        }

        .btn-outline-primary:hover {
            background: #2a5298;
            color: white;
        }

        .btn-outline-secondary {
            border: 2px solid #6c757d;
            color: #6c757d;
            background: white;
            padding: 5px 10px;
            font-size: 0.75rem;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            color: white;
        }

        .document-links {
            display: flex;
            gap: 6px;
            margin-top: 6px;
        }

        .document-links .btn {
            flex: 1;
        }

        .no-results {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
            display: none;
            background: white;
            border-radius: 16px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .no-results i {
            font-size: 3.5rem;
            opacity: 0.3;
            margin-bottom: 15px;
            color: #2a5298;
        }

        .no-results h5 {
            font-weight: 700;
            color: #1e3c72;
            margin-bottom: 8px;
        }

        /* Recent Activity */
        .activity-list {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
        }

        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: #f8f9fa;
        }

        .activity-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .activity-icon.success {
            background: linear-gradient(135deg, #e8f5e9 0%, #c8e6c9 100%);
            color: #388e3c;
        }

        .activity-icon.warning {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
            color: #f57c00;
        }

        .activity-icon.danger {
            background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
            color: #d32f2f;
        }

        .activity-details {
            flex: 1;
        }

        .activity-details h6 {
            margin: 0 0 5px 0;
            font-weight: 600;
            color: #212529;
        }

        .activity-details p {
            margin: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #adb5bd;
        }

        @media (max-width: 1400px) {
            .applications-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
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

            .applications-grid {
                grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            }

            .charts-section {
                grid-template-columns: 1fr;
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
            }

            .search-container {
                width: 100%;
            }

            .applications-grid {
                grid-template-columns: 1fr;
            }

            .card-actions {
                grid-template-columns: 1fr;
            }

            .dashboard-stats {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Sidebar navigation links
        const navLinks = document.querySelectorAll('.nav-link');
        const sections = {
            dashboard: document.getElementById('dashboardSection'),
            applications: document.getElementById('applicationsSection'),
            approved: document.getElementById('approvedSection'),
            rejected: document.getElementById('rejectedSection'),
            pending: document.getElementById('pendingSection'),
            analytics: document.getElementById('analyticsSection'),
            settings: document.getElementById('settingsSection'),
        };

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                // Remove active class from all links and sections
                navLinks.forEach(l => l.classList.remove('active'));
                Object.values(sections).forEach(section => section.classList.remove('active'));

                // Set active section and sidebar link
                this.classList.add('active');
                const target = this.getAttribute('data-section');
                if (sections[target]) {
                    sections[target].classList.add('active');
                }
            });
        });
    });
</script>
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
                <a href="javascript:void(0)" class="nav-link active" data-section="dashboard">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-section="applications">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>All Applications</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-section="approved">
                    <i class="fas fa-check-circle"></i>
                    <span>Approved</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-section="rejected">
                    <i class="fas fa-times-circle"></i>
                    <span>Rejected</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-section="pending">
                    <i class="fas fa-clock"></i>
                    <span>Pending</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-section="analytics">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
            </div>
            <div class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-section="settings">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </nav>

        <div class="stats-section">
            <h6>Quick Stats</h6>
            <div class="stat-box">
                <p class="number" id="sidebarTotal">{{ count($loans) }}</p>
                <p class="label">Total Applications</p>
            </div>
            <div class="stat-box">
                <p class="number" id="sidebarPending">{{ collect($loans)->where('status', 'pending')->count() }}</p>
                <p class="label">Pending</p>
            </div>
            <div class="stat-box">
                <p class="number" id="sidebarApproved">{{ collect($loans)->where('status', 'approved')->count() }}</p>
                <p class="label">Approved</p>
            </div>
            <div class="stat-box">
                <p class="number" id="sidebarRejected">{{ collect($loans)->where('status', 'rejected')->count() }}</p>
                <p class="label">Rejected</p>
            </div>
        </div>

        <div class="logout-section">
            <a href="{{ url('/manager/logout') }}" class="btn-logout">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Dashboard Section -->
        <div id="dashboardSection" class="content-section active">
            <div class="top-bar">
                <h2><i class="fas fa-home me-2"></i>Dashboard Overview</h2>
            </div>

            <!-- Statistics Cards -->
            <div class="dashboard-stats">
                <div class="stat-card total">
                    <div class="stat-icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="stat-details">
                        <h3>{{ count($loans) }}</h3>
                        <p>Total Applications</p>
                    </div>
                </div>

                <div class="stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-details">
                        <h3>{{ collect($loans)->where('status', 'pending')->count() }}</h3>
                        <p>Pending Review</p>
                    </div>
                </div>

                <div class="stat-card approved">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-details">
                        <h3>{{ collect($loans)->where('status', 'approved')->count() }}</h3>
                        <p>Approved Loans</p>
                    </div>
                </div>

                <div class="stat-card rejected">
                    <div class="stat-icon">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="stat-details">
                        <h3>{{ collect($loans)->where('status', 'rejected')->count() }}</h3>
                        <p>Rejected Applications</p>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <div class="chart-card">
                    <h4><i class="fas fa-chart-pie me-2"></i>Application Status Distribution</h4>
                    <canvas id="statusChart"></canvas>
                </div>

                <div class="chart-card">
                    <h4><i class="fas fa-chart-bar me-2"></i>Monthly Applications Trend</h4>
                    <canvas id="trendChart"></canvas>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="activity-list">
                <h4 style="color: #1e3c72; font-weight: 700; margin-bottom: 20px;">
                    <i class="fas fa-history me-2"></i>Recent Activity
                </h4>
                @foreach($loans->sortByDesc('created_at')->take(5) as $loan)
                <div class="activity-item">
                    <div class="activity-icon {{ $loan->status == 'approved' ? 'success' : ($loan->status == 'rejected' ? 'danger' : 'warning') }}">
                        <i class="fas fa-{{ $loan->status == 'approved' ? 'check-circle' : ($loan->status == 'rejected' ? 'times-circle' : 'clock') }}"></i>
                    </div>
                    <div class="activity-details">
                        <h6>{{ $loan->name }} - Application {{ ucfirst($loan->status) }}</h6>
                        <p>{{ $loan->occupation }} • Rs. {{ number_format($loan->salary, 2) }}</p>
                    </div>
                    <div class="activity-time">{{ $loan->created_at->diffForHumans() }}</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- All Applications Section -->
        <div id="applicationsSection" class="content-section">
            <div class="top-bar">
                <h2><i class="fas fa-file-invoice-dollar me-2"></i>All Applications</h2>
                <div class="search-container">
                    <input type="text" id="searchAll" placeholder="Search applications...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="applications-grid" id="allApplicationsGrid">
                @foreach($loans as $loan)
                @include('partials.loan-card', ['loan' => $loan])
                @endforeach
            </div>
            <div class="no-results" id="noResultsAll">
                <i class="fas fa-search-minus"></i>
                <h5>No applications found</h5>
                <p>Try different search terms</p>
            </div>
        </div>

        <!-- Approved Section -->
        <div id="approvedSection" class="content-section">
            <div class="top-bar">
                <h2><i class="fas fa-check-circle me-2"></i>Approved Applications</h2>
                <div class="search-container">
                    <input type="text" id="searchApproved" placeholder="Search approved applications...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="applications-grid" id="approvedApplicationsGrid">
                @foreach($loans->where('status', 'approved') as $loan)
                @include('partials.loan-card', ['loan' => $loan])
                @endforeach
            </div>
            <div class="no-results" id="noResultsApproved" style="{{ $loans->where('status', 'approved')->count() == 0 ? 'display: block;' : '' }}">
                <i class="fas fa-search-minus"></i>
                <h5>No approved applications found</h5>
                <p>Approved applications will appear here</p>
            </div>
        </div>

        <!-- Rejected Section -->
        <div id="rejectedSection" class="content-section">
            <div class="top-bar">
                <h2><i class="fas fa-times-circle me-2"></i>Rejected Applications</h2>
                <div class="search-container">
                    <input type="text" id="searchRejected" placeholder="Search rejected applications...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="applications-grid" id="rejectedApplicationsGrid">
                @foreach($loans->where('status', 'rejected') as $loan)
                @include('partials.loan-card', ['loan' => $loan])
                @endforeach
            </div>
            <div class="no-results" id="noResultsRejected" style="{{ $loans->where('status', 'rejected')->count() == 0 ? 'display: block;' : '' }}">
                <i class="fas fa-search-minus"></i>
                <h5>No rejected applications found</h5>
                <p>Rejected applications will appear here</p>
            </div>
        </div>

        <!-- Pending Section -->
        <div id="pendingSection" class="content-section">
            <div class="top-bar">
                <h2><i class="fas fa-clock me-2"></i>Pending Applications</h2>
                <div class="search-container">
                    <input type="text" id="searchPending" placeholder="Search pending applications...">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <div class="applications-grid" id="pendingApplicationsGrid">
                @foreach($loans->where('status', 'pending') as $loan)
                @include('partials.loan-card', ['loan' => $loan])
                @endforeach
            </div>
            <div class="no-results" id="noResultsPending" style="{{ $loans->where('status', 'pending')->count() == 0 ? 'display: block;' : '' }}">
                <i class="fas fa-search-minus"></i>
                <h5>No pending applications found</h5>
                <p>Pending applications will appear here</p>
            </div>
        </div>

        <!-- Analytics Section -->
        <div id="analyticsSection" class="content-section">
            <div class="top-bar">
                <h2><i class="fas fa-chart-line me-2"></i>Analytics & Reports</h2>
            </div>

            <div class="dashboard-stats">
                <div class="stat-card total">
                    <div class="stat-icon">
                        <i class="fas fa-percentage"></i>
                    </div>
                    <div class="stat-details">
                        <h3>{{ count($loans) > 0 ? round((collect($loans)->where('status', 'approved')->count() / count($loans)) * 100, 1) : 0 }}%</h3>
                        <p>Approval Rate</p>
                    </div>
                </div>

                <div class="stat-card approved">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-details">
                        <h3>Rs. {{ count($loans) > 0 ? number_format(collect($loans)->avg('salary'), 0) : 0 }}</h3>
                        <p>Average Salary</p>
                    </div>
                </div>

                <div class="stat-card pending">
                    <div class="stat-icon">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="stat-details">
                        <h3>2.5 days</h3>
                        <p>Avg. Process Time</p>
                    </div>
                </div>

                <div class="stat-card rejected">
                    <div class="stat-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <div class="stat-details">
                        <h3>{{ count($loans) > 0 ? round((collect($loans)->where('status', 'rejected')->count() / count($loans)) * 100, 1) : 0 }}%</h3>
                        <p>Rejection Rate</p>
                    </div>
                </div>
            </div>

            <div class="charts-section">
                <div class="chart-card">
                    <h4><i class="fas fa-briefcase me-2"></i>Applications by Occupation</h4>
                    <canvas id="occupationChart"></canvas>
                </div>

                <div class="chart-card">
                    <h4><i class="fas fa-money-bill-wave me-2"></i>Salary Distribution</h4>
                    <canvas id="salaryChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Settings Section -->
        <div id="settingsSection" class="content-section">
            <div class="top-bar">
                <h2><i class="fas fa-cog me-2"></i>Settings & Configuration</h2>
            </div>

            <div class="activity-list">
                <h4 style="color: #1e3c72; font-weight: 700; margin-bottom: 20px;">
                    <i class="fas fa-sliders-h me-2"></i>System Settings
                </h4>

                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="activity-details">
                        <h6>Email Notifications</h6>
                        <p>Manage email alerts for new applications and status changes</p>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" checked style="width: 3rem; height: 1.5rem;">
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="activity-details">
                        <h6>Two-Factor Authentication</h6>
                        <p>Enhance security with 2FA for admin access</p>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" style="width: 3rem; height: 1.5rem;">
                    </div>
                </div>

                <div class="activity-item">
                    <div class="activity-icon danger">
                        <i class="fas fa-file-export"></i>
                    </div>
                    <div class="activity-details">
                        <h6>Export Data</h6>
                        <p>Download all application data in CSV or Excel format</p>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-download"></i> Export
                    </button>
                </div>

                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-database"></i>
                    </div>
                    <div class="activity-details">
                        <h6>Data Backup</h6>
                        <p>Create a backup of all system data</p>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-save"></i> Backup
                    </button>
                </div>

                <div class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-user-cog"></i>
                    </div>
                    <div class="activity-details">
                        <h6>User Management</h6>
                        <p>Manage admin users and permissions</p>
                    </div>
                    <button class="btn btn-outline-primary">
                        <i class="fas fa-users"></i> Manage
                    </button>
                </div>
            </div>
        </div>
    </main>


    <script>
        window.confirmDelete = function (id) {
            if (!id) return;
            Swal.fire({
                title: 'Delete application?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#dc3545'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.getElementById('delete-form-' + id);
                    if (form) form.submit();
                }
            });
        };
    </script>
