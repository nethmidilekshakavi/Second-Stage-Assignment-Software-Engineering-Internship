<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Loan Management System</title>
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
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 50%, #7e8ba3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
            z-index: 0;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .register-container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 1100px;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 25px 70px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }

        .register-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            padding: 40px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .register-header::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .logo-icon {
            width: 80px;
            height: 80px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 1;
        }

        .logo-icon i {
            font-size: 2.5rem;
            color: #1e3c72;
        }

        .register-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
        }

        .register-header p {
            font-size: 1rem;
            opacity: 0.95;
            position: relative;
            z-index: 1;
        }

        .register-body {
            padding: 40px 50px;
        }

        .section-title {
            color: #1e3c72;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2a5298;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: #2a5298;
        }

        .form-section {
            margin-bottom: 35px;
            opacity: 0;
            animation: slideIn 0.6s ease forwards;
        }

        .form-section:nth-child(1) { animation-delay: 0.1s; }
        .form-section:nth-child(2) { animation-delay: 0.2s; }
        .form-section:nth-child(3) { animation-delay: 0.3s; }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-label i {
            color: #2a5298;
            font-size: 0.9rem;
        }

        .required-star {
            color: #dc2626;
            margin-left: 3px;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #2a5298;
            font-size: 1rem;
            z-index: 2;
        }

        .form-control, .form-select {
            padding: 14px 15px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.15);
            outline: none;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 20px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border: 2px dashed #2a5298;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            color: #495057;
            font-weight: 600;
        }

        .file-input-label:hover {
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            border-color: #1e3c72;
        }

        .file-input-label i {
            font-size: 1.2rem;
            color: #2a5298;
        }

        .file-preview {
            margin-top: 10px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 8px;
            display: none;
            align-items: center;
            gap: 10px;
        }

        .file-preview.show {
            display: flex;
        }

        .file-preview i {
            color: #28a745;
            font-size: 1.2rem;
        }

        .file-preview .file-name {
            flex: 1;
            font-size: 0.9rem;
            color: #495057;
        }

        .file-preview .remove-file {
            color: #dc2626;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .file-preview .remove-file:hover {
            color: #991b1b;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color: #2a5298;
        }

        .btn-register {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            color: white;
            padding: 15px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(30, 60, 114, 0.3);
            margin-top: 20px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(30, 60, 114, 0.4);
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

        .btn-login {
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

        .btn-login:hover {
            background: #2a5298;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(42, 82, 152, 0.3);
        }

        .btn-login i {
            margin-right: 10px;
        }

        .invalid-feedback {
            display: block;
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 5px;
            margin-left: 5px;
        }

        .is-invalid {
            border-color: #dc2626 !important;
        }

        .security-badge {
            text-align: center;
            margin-top: 25px;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .security-badge i {
            color: #28a745;
            margin-right: 5px;
        }

        @media (max-width: 768px) {
            .register-body {
                padding: 30px 25px;
            }

            .register-header {
                padding: 30px 20px;
            }

            .register-header h1 {
                font-size: 1.5rem;
            }

            body {
                padding: 20px 10px;
            }
        }
    </style>
</head>
<body>
<div class="register-container">
    <div class="register-card">
        <div class="register-header">
            <div class="logo-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h1>Create Your Account</h1>
            <p>Join our loan management system and start your application</p>
        </div>

        <div class="register-body">
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" id="registerForm">
                @csrf

                <!-- Personal Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        Personal Information
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    Full Name<span class="required-star">*</span>
                                </label>
                                <i class="fas fa-user input-icon"></i>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus
                                       placeholder="Enter your full name">
                                @error('name')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Email Address<span class="required-star">*</span>
                                </label>
                                <i class="fas fa-envelope input-icon"></i>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}" required
                                       placeholder="your.email@example.com">
                                @error('email')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label for="mobile_number" class="form-label">
                                    <i class="fas fa-phone"></i>
                                    Mobile Number<span class="required-star">*</span>
                                </label>
                                <i class="fas fa-phone input-icon"></i>
                                <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror"
                                       name="mobile_number" value="{{ old('mobile_number') }}" required
                                       placeholder="07X XXX XXXX">
                                @error('mobile_number')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label for="address" class="form-label">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Address<span class="required-star">*</span>
                                </label>
                                <i class="fas fa-map-marker-alt input-icon"></i>
                                <textarea id="address" class="form-control @error('address') is-invalid @enderror"
                                          name="address" required placeholder="Enter your full address">{{ old('address') }}</textarea>
                                @error('address')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Security Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-lock"></i>
                        Security Credentials
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    Password<span class="required-star">*</span>
                                </label>
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                                       name="password" required placeholder="Minimum 8 characters">
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('password')"></i>
                                @error('password')
                                <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="input-wrapper">
                                <label for="password-confirm" class="form-label">
                                    <i class="fas fa-lock"></i>
                                    Confirm Password<span class="required-star">*</span>
                                </label>
                                <i class="fas fa-lock input-icon"></i>
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" required placeholder="Re-enter password">
                                <i class="fas fa-eye password-toggle" onclick="togglePassword('password-confirm')"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Documents Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-file-upload"></i>
                        Document Verification
                    </h3>

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="fas fa-id-card"></i>
                                NIC Front Image<span class="required-star">*</span>
                            </label>
                            <div class="file-input-wrapper">
                                <input id="nic_front_image" type="file" name="nic_front_image"
                                       accept="image/*" required onchange="handleFileSelect(this, 'nic-front-preview')">
                                <label for="nic_front_image" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Upload Front</span>
                                </label>
                            </div>
                            <div id="nic-front-preview" class="file-preview">
                                <i class="fas fa-check-circle"></i>
                                <span class="file-name"></span>
                                <i class="fas fa-times remove-file" onclick="removeFile('nic_front_image', 'nic-front-preview')"></i>
                            </div>
                            @error('nic_front_image')
                            <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="fas fa-id-card"></i>
                                NIC Back Image<span class="required-star">*</span>
                            </label>
                            <div class="file-input-wrapper">
                                <input id="nic_back_image" type="file" name="nic_back_image"
                                       accept="image/*" required onchange="handleFileSelect(this, 'nic-back-preview')">
                                <label for="nic_back_image" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Upload Back</span>
                                </label>
                            </div>
                            <div id="nic-back-preview" class="file-preview">
                                <i class="fas fa-check-circle"></i>
                                <span class="file-name"></span>
                                <i class="fas fa-times remove-file" onclick="removeFile('nic_back_image', 'nic-back-preview')"></i>
                            </div>
                            @error('nic_back_image')
                            <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">
                                <i class="fas fa-passport"></i>
                                Passport Image<span class="required-star">*</span>
                            </label>
                            <div class="file-input-wrapper">
                                <input id="passport_image" type="file" name="passport_image"
                                       accept="image/*" required onchange="handleFileSelect(this, 'passport-preview')">
                                <label for="passport_image" class="file-input-label">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Upload Passport</span>
                                </label>
                            </div>
                            <div id="passport-preview" class="file-preview">
                                <i class="fas fa-check-circle"></i>
                                <span class="file-name"></span>
                                <i class="fas fa-times remove-file" onclick="removeFile('passport_image', 'passport-preview')"></i>
                            </div>
                            @error('passport_image')
                            <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-register">
                    <i class="fas fa-user-plus"></i> Create Account
                </button>
            </form>

            <div class="divider">
                <span>OR</span>
            </div>

            <a href="{{ url('/login') }}" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Already have an account? Login
            </a>

            <div class="security-badge">
                <i class="fas fa-shield-alt"></i> Your information is encrypted and secure
            </div>
        </div>
    </div>
</div>

<script>
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const toggleIcon = passwordInput.parentElement.querySelector('.password-toggle');

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

    function handleFileSelect(input, previewId) {
        const preview = document.getElementById(previewId);
        const fileName = preview.querySelector('.file-name');

        if (input.files && input.files[0]) {
            fileName.textContent = input.files[0].name;
            preview.classList.add('show');
        }
    }

    function removeFile(inputId, previewId) {
        const input = document.getElementById(inputId);
        const preview = document.getElementById(previewId);

        input.value = '';
        preview.classList.remove('show');
    }

    // Add animation on scroll
    document.addEventListener('DOMContentLoaded', function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        });

        document.querySelectorAll('.form-section').forEach(section => {
            observer.observe(section);
        });
    });

    // Form validation feedback
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const requiredFields = this.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(field => {
            if (!field.value) {
                isValid = false;
                field.classList.add('is-invalid');
            } else {
                field.classList.remove('is-invalid');
            }
        });

        if (!isValid) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Missing Information',
                text: 'Please fill in all required fields',
                confirmButtonColor: '#2a5298',
                backdrop: 'rgba(30, 60, 114, 0.4)'
            });
        }
    });
</script>
</body>
</html>
