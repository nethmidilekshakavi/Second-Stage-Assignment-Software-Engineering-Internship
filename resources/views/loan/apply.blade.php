<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Form</title>
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
            padding: 40px 20px;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 100%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
            z-index: 0;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .main-container {
            position: relative;
            z-index: 1;
            max-width: 1200px;
            margin: 0 auto;
        }

        .header-section {
            text-align: center;
            color: white;
            margin-bottom: 40px;
            animation: fadeInDown 0.8s ease;
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

        .logo-icon {
            width: 100px;
            height: 100px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .logo-icon i {
            font-size: 3.5rem;
            color: #1e3c72;
        }

        .header-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        }

        .header-section p {
            font-size: 1.2rem;
            opacity: 0.95;
        }

        .feature-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
            animation: fadeInUp 0.8s ease;
            animation-delay: 0.2s;
            opacity: 0;
            animation-fill-mode: forwards;
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

        .feature-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 25px;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }

        .feature-card i {
            font-size: 2.5rem;
            color: #2a5298;
            margin-bottom: 15px;
        }

        .feature-card h4 {
            color: #1e3c72;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #6c757d;
            margin: 0;
            font-size: 0.95rem;
        }

        .form-card {
            background: white;
            border-radius: 25px;
            padding: 50px 40px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.8s ease;
            animation-delay: 0.4s;
            opacity: 0;
            animation-fill-mode: forwards;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            color: #1e3c72;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #6c757d;
            font-size: 1rem;
        }

        .progress-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            padding: 0 20px;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step-circle {
            width: 50px;
            height: 50px;
            background: #e9ecef;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
            font-weight: 600;
            color: #6c757d;
            transition: all 0.3s ease;
        }

        .step.active .step-circle {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.4);
        }

        .step::after {
            content: '';
            position: absolute;
            top: 25px;
            left: 50%;
            width: 100%;
            height: 3px;
            background: #e9ecef;
            z-index: -1;
        }

        .step:last-child::after {
            display: none;
        }

        .step-label {
            font-size: 0.85rem;
            color: #6c757d;
            font-weight: 500;
        }

        .step.active .step-label {
            color: #1e3c72;
            font-weight: 600;
        }

        .form-section {
            margin-bottom: 35px;
        }

        .section-title {
            color: #1e3c72;
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e9ecef;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 10px;
            color: #2a5298;
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
            font-size: 0.9rem;
        }

        .form-label .required {
            color: #dc3545;
            margin-left: 3px;
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
            font-size: 1rem;
        }

        .form-control, .form-select {
            padding: 14px 15px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.15);
            outline: none;
        }

        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }

        .file-upload-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-upload-label {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            border: 2px dashed #2a5298;
            border-radius: 12px;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .file-upload-label:hover {
            background: #e9ecef;
            border-color: #1e3c72;
        }

        .file-upload-label i {
            font-size: 2rem;
            color: #2a5298;
            margin-right: 15px;
        }

        .file-info {
            text-align: center;
        }

        .file-info strong {
            display: block;
            color: #1e3c72;
            margin-bottom: 5px;
        }

        .file-info small {
            color: #6c757d;
        }

        .file-name {
            margin-top: 10px;
            padding: 10px;
            background: #e3f2fd;
            border-radius: 8px;
            color: #1e3c72;
            font-size: 0.9rem;
            display: none;
        }

        .file-name i {
            color: #28a745;
            margin-right: 8px;
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 25px;
            animation: slideInDown 0.5s ease;
        }

        @keyframes slideInDown {
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
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        .alert ul {
            margin: 0;
            padding-left: 20px;
        }

        .btn-submit {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            color: white;
            padding: 15px 50px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
            margin-right: 15px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.5);
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        }

        .btn-back {
            background: white;
            border: 2px solid #2a5298;
            color: #2a5298;
            padding: 15px 40px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .btn-back:hover {
            background: #2a5298;
            color: white;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            justify-content: space-between; /* buttons left & right */
            gap: 10px; /* optional spacing */
            align-items: center;
            margin-top: 40px;
        }

        .info-box {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            padding: 20px;
            border-radius: 12px;
            margin-bottom: 30px;
            border-left: 4px solid #2a5298;
        }

        .info-box h5 {
            color: #1e3c72;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .info-box h5 i {
            margin-right: 10px;
            font-size: 1.3rem;
        }

        .info-box ul {
            margin: 0;
            padding-left: 25px;
            color: #495057;
        }

        .info-box li {
            margin-bottom: 8px;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 30px 25px;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .progress-steps {
                padding: 0 5px;
            }

            .step-circle {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }

            .step-label {
                font-size: 0.75rem;
            }

            .button-group {
                flex-direction: column;
                gap: 15px;
            }

            .btn-submit, .btn-back {
                width: 100%;
                margin: 0;
            }

            .feature-cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
<div class="main-container">
    <!-- Header Section -->
    <div class="header-section">
        <div class="logo-icon"><i class="fas fa-file-invoice-dollar"></i></div>
        <h1>Loan Application</h1>
        <p>Complete your application in just a few minutes</p>
    </div>

    <!-- Feature Cards -->
    <div class="feature-cards">
        <div class="feature-card"><i class="fas fa-clock"></i><h4>Quick Process</h4><p>Complete in 5 minutes</p></div>
        <div class="feature-card"><i class="fas fa-shield-alt"></i><h4>Secure & Safe</h4><p>Your data is protected</p></div>
        <div class="feature-card"><i class="fas fa-check-circle"></i><h4>Fast Approval</h4><p>Get response in 24 hours</p></div>
        <div class="feature-card"><i class="fas fa-headset"></i><h4>24/7 Support</h4><p>We're here to help</p></div>
    </div>

    <!-- Form Card -->
    <div class="form-card">
        <div class="form-header">
            <h2>Loan Application Form</h2>
            <p>Please fill in all required information accurately</p>
        </div>

        <!-- Progress Steps -->
        <div class="progress-steps">
            <div class="step active"><div class="step-circle">1</div><div class="step-label">Application</div></div>
            <div class="step"><div class="step-circle">2</div><div class="step-label">Verification</div></div>
            <div class="step"><div class="step-circle">3</div><div class="step-label">Approval</div></div>
            <div class="step"><div class="step-circle">4</div><div class="step-label">Disbursement</div></div>
        </div>

        <!-- Alerts -->
        @if(session('success'))
        <div class="alert alert-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> <strong>Please fix the following errors:</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Info Box -->
        <div class="info-box">
            <h5><i class="fas fa-info-circle"></i>Required Documents</h5>
            <ul>
                <li>Valid email address for communication</li>
                <li>Current employment details</li>
                <li>Latest salary information</li>
                <li>Recent paysheet (PDF format)</li>
            </ul>
        </div>

        <!-- Application Form -->
        <form action="{{ route('loan.store') }}" method="POST" enctype="multipart/form-data" id="loanForm">
            @csrf

            <!-- Personal Information -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-user"></i>Personal Information</div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="name" class="form-label"><i class="fas fa-id-card"></i> Full Name <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-user input-icon"></i>
                            @auth
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" value="{{ old('name', auth()->user()->name) }}" required readonly>
                            @else
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter your full name" value="{{ old('name') }}" required>
                            @endauth
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email Address <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope input-icon"></i>
                            @auth
                            <input type="email" name="email" id="email" class="form-control" placeholder="your.email@example.com" value="{{ old('email', auth()->user()->email) }}" required readonly>
                            @else
                            <input type="email" name="email" id="email" class="form-control" placeholder="your.email@example.com" value="{{ old('email') }}" required>
                            @endauth
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="tel" class="form-label"><i class="fas fa-phone"></i> Telephone <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone input-icon"></i>
                            <input type="text" name="tel" id="tel" class="form-control" placeholder="+94 XX XXX XXXX" value="{{ old('tel') }}" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Employment Information -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-briefcase"></i>Employment Details</div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="occupation" class="form-label"><i class="fas fa-building"></i> Occupation <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-briefcase input-icon"></i>
                            <input type="text" name="occupation" id="occupation" class="form-control" placeholder="e.g. Software Engineer" value="{{ old('occupation') }}" required>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="salary" class="form-label"><i class="fas fa-money-bill-wave"></i> Monthly Salary (LKR) <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-rupee-sign input-icon"></i>
                            <input type="number" name="salary" id="salary" class="form-control" placeholder="e.g. 50000" value="{{ old('salary') }}" min="0" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Document Upload -->
            <div class="form-section">
                <div class="section-title"><i class="fas fa-file-upload"></i>Document Upload</div>

                <div class="mb-3">
                    <label for="paysheet_uri" class="form-label"><i class="fas fa-file-pdf"></i> Paysheet Document (PDF)</label>
                    <div class="file-upload-wrapper">
                        <input type="file" name="paysheet_uri" id="paysheet_uri" accept="application/pdf,image/*" onchange="updateFileName(this)">
                        <label for="paysheet_uri" class="file-upload-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <div class="file-info">
                                <strong>Click to upload or drag and drop</strong>
                                <small>PDF or image (Max 5MB)</small>
                            </div>
                        </label>
                    </div>
                    <div class="file-name" id="fileName"></div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="button-group">
                <a href="{{ url('/') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Back to Home</a>
                <button type="submit" class="btn-submit"><i class="fas fa-paper-plane"></i> Submit Application</button>
            </div>
        </form>
    </div>
</div>

<script>
    function updateFileName(input) {
        const fileNameDiv = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            fileNameDiv.innerHTML = `<i class="fas fa-check-circle"></i> ${fileName}`;
            fileNameDiv.style.display = 'block';
        } else {
            fileNameDiv.style.display = 'none';
        }
    }

    // Form animation on load
    document.addEventListener('DOMContentLoaded', function() {
        const formSections = document.querySelectorAll('.form-section');
        formSections.forEach((section, index) => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'all 0.5s ease';
            setTimeout(() => {
                section.style.opacity = '1';
                section.style.transform = 'translateY(0)';
            }, 600 + (index * 150));
        });
    });
</script>

<script>
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6',
        });
    @endif

    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Oops!', text: "{{ session('error') }}" });
    @endif
</script>
</body>
</html>
