<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Login - Loan Management System</title>
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e8ba3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .login-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1000px;
        }

        .login-card {
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 550px;
        }

        .left-side {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 50px 40px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .left-side::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .left-side::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
            position: relative;
            z-index: 1;
        }

        .logo-icon {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .logo-icon i {
            font-size: 3rem;
            color: #1e3c72;
        }

        .left-side h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .left-side p {
            font-size: 1.1rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .features {
            margin-top: 40px;
            position: relative;
            z-index: 1;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .feature-item i {
            font-size: 1.5rem;
            margin-right: 15px;
            color: #ffd700;
        }

        .right-side {
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h2 {
            color: #1e3c72;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #6c757d;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }

        .form-label i {
            margin-right: 8px;
            color: #2a5298;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #2a5298;
            font-size: 1.1rem;
        }

        .form-control {
            padding: 14px 15px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.15);
            outline: none;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: #2a5298;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
            margin-bottom: 20px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.4);
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        }

        .divider {
            text-align: center;
            margin: 25px 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #dee2e6;
        }

        .divider::after {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            width: 45%;
            height: 1px;
            background: #dee2e6;
        }

        .divider span {
            background: white;
            padding: 0 15px;
            color: #6c757d;
            font-size: 0.9rem;
        }

        .btn-apply {
            background: white;
            border: 2px solid #2a5298;
            color: #2a5298;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.05rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }

        .btn-apply:hover {
            background: #2a5298;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 82, 152, 0.3);
        }

        .btn-apply i {
            margin-right: 10px;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .form-check-input:checked {
            background-color: #2a5298;
            border-color: #2a5298;
        }

        .forgot-link {
            color: #2a5298;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: #1e3c72;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .login-card {
                grid-template-columns: 1fr;
            }

            .left-side {
                padding: 40px 30px;
                min-height: 300px;
            }

            .right-side {
                padding: 40px 30px;
            }

            .left-side h1 {
                font-size: 1.5rem;
            }

            .features {
                display: none;
            }
        }

        .security-badge {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .security-badge i {
            color: #28a745;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Left Side - Branding -->
            <div class="left-side">
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h1>Loan Management</h1>
                    <p>Secure Manager Portal</p>
                </div>

                <div class="features">
                    <div class="feature-item">
                        <i class="fas fa-shield-alt"></i>
                        <div>
                            <strong>Secure Access</strong>
                            <p style="margin: 0; font-size: 0.9rem; opacity: 0.8;">Bank-level encryption</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-tasks"></i>
                        <div>
                            <strong>Manage Applications</strong>
                            <p style="margin: 0; font-size: 0.9rem; opacity: 0.8;">Review & approve loans</p>
                        </div>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-chart-line"></i>
                        <div>
                            <strong>Track Performance</strong>
                            <p style="margin: 0; font-size: 0.9rem; opacity: 0.8;">Real-time analytics</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="right-side">
                <div class="login-header">
                    <h2>Login to LoanApp</h2>
                    <p>Enter your credentials to access the dashboard</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Email Address
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            <!-- Use email instead of username -->
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                placeholder="Enter your email"
                                required
                                autocomplete="email"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock input-icon"></i>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                placeholder="Enter your password"
                                required
                                autocomplete="current-password"
                            >
                            <i class="fas fa-eye password-toggle" onclick="togglePassword()"></i>
                        </div>
                    </div>
                    <div class="remember-forgot">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div>
                        <a href="#" class="forgot-link">Forgot Password?</a>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-sign-in-alt"></i> Login to Dashboard
                    </button>
                </form>

                <div class="divider">
                    <span>OR</span>
                </div>

                <a href="{{ route('register') }}" class="btn-apply"">
                    <i class="fas fa-user-plus"></i>
                    Create New Account
                </a>
                <div class="security-badge">
                    <i class="fas fa-lock"></i> Secured with 256-bit SSL encryption
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add animation to form elements on page load
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                setTimeout(() => {
                    group.style.opacity = '0';
                    group.style.transform = 'translateY(20px)';
                    group.style.transition = 'all 0.5s ease';

                    setTimeout(() => {
                        group.style.opacity = '1';
                        group.style.transform = 'translateY(0)';
                    }, 50);
                }, index * 100);
            });
        });
    </script>
</body>
</html>
