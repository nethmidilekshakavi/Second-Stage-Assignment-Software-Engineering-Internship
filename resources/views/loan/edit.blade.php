<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Loan Application</title>
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
            padding: 20px;
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

        .navbar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 15px 0;
            margin-bottom: 30px;
            border-radius: 15px;
            position: relative;
            z-index: 1;
        }

        .navbar-brand {
            color: white !important;
            font-weight: 700;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            margin-right: 10px;
            font-size: 1.8rem;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid white;
            padding: 8px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-back:hover {
            background: white;
            color: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .form-container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 25px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
            animation: slideUp 0.5s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-header {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .form-header::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .form-header::after {
            content: '';
            position: absolute;
            bottom: -80px;
            left: -80px;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .form-header-content {
            position: relative;
            z-index: 1;
        }

        .form-icon {
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

        .form-icon i {
            font-size: 3rem;
            color: #1e3c72;
        }

        .form-header h2 {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
        }

        .form-header p {
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .form-body {
            padding: 40px;
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

        .alert-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
        }

        .form-section {
            margin-bottom: 35px;
        }

        .section-title {
            color: #1e3c72;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid #2a5298;
            display: flex;
            align-items: center;
        }

        .section-title i {
            margin-right: 12px;
            font-size: 1.5rem;
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
            width: 20px;
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
            font-size: 1.1rem;
        }

        .form-control,
        .form-select {
            padding: 14px 15px 14px 45px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #2a5298;
            box-shadow: 0 0 0 0.2rem rgba(42, 82, 152, 0.15);
            outline: none;
        }

        .file-upload-wrapper {
            position: relative;
            overflow: hidden;
            border: 2px dashed #2a5298;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: #f8f9fa;
        }

        .file-upload-wrapper:hover {
            background: #e9ecef;
            border-color: #1e3c72;
        }

        .file-upload-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-upload-content {
            pointer-events: none;
        }

        .file-upload-content i {
            font-size: 3rem;
            color: #2a5298;
            margin-bottom: 15px;
        }

        .file-upload-content h5 {
            color: #1e3c72;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .file-upload-content p {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .current-file {
            background: #e7f3ff;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .current-file-info {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .current-file-info i {
            font-size: 2rem;
            color: #2a5298;
        }

        .current-file-details h6 {
            margin: 0;
            color: #1e3c72;
            font-weight: 600;
        }

        .current-file-details p {
            margin: 0;
            color: #6c757d;
            font-size: 0.85rem;
        }

        .btn-view-file {
            padding: 8px 16px;
            background: #2a5298;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-view-file:hover {
            background: #1e3c72;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(42, 82, 152, 0.3);
        }

        .row {
            margin: 0 -10px;
        }

        .col-md-6 {
            padding: 0 10px;
        }

        .form-footer {
            display: flex;
            gap: 15px;
            justify-content: flex-end;
            padding-top: 30px;
            border-top: 2px solid #e9ecef;
        }

        .btn {
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.05rem;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            color: white;
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(30, 60, 114, 0.4);
            background: linear-gradient(135deg, #2a5298 0%, #1e3c72 100%);
        }

        .btn-secondary {
            background: white;
            color: #6c757d;
            border: 2px solid #6c757d;
        }

        .btn-secondary:hover {
            background: #6c757d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .form-help-text {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .form-body {
                padding: 25px;
            }

            .form-header {
                padding: 30px 25px;
            }

            .form-footer {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            body {
                padding: 10px;
            }
        }

        .loading {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }

        .loading.active {
            display: flex;
        }

        .spinner {
            width: 60px;
            height: 60px;
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <i class="fas fa-building"></i>
                Loan Management System
            </a>

            <a href="{{ url('/dashboard') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Back to Dashboard
            </a>
        </div>
    </nav>

    <!-- Form Container -->
    <div class="form-container">
        <!-- Form Header -->
        <div class="form-header">
            <div class="form-header-content">
                <div class="form-icon">
                    <i class="fas fa-edit"></i>
                </div>
                <h2>Update Loan Application</h2>
                <p>Modify loan application details</p>
            </div>
        </div>

        <!-- Form Body -->
        <div class="form-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-circle"></i> 
                    <strong>Validation Error!</strong> Please check the form fields.
                    <ul style="margin: 10px 0 0 0; padding-left: 20px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <form action="{{ url('/loan/'.$loan->id.'/update') }}" method="POST" enctype="multipart/form-data" id="updateForm">
            @csrf
            @method('PUT')

                <!-- Personal Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-user"></i>
                        Personal Information
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="form-label">
                                    <i class="fas fa-user"></i>
                                    Full Name <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-user input-icon"></i>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control" 
                                        value="{{ old('name', $loan->name) }}"
                                        placeholder="Enter full name"
                                        required
                                    >
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">
                                    <i class="fas fa-envelope"></i>
                                    Email Address <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope input-icon"></i>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        class="form-control" 
                                        value="{{ old('email', $loan->email) }}"
                                        placeholder="example@email.com"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel" class="form-label">
                                    <i class="fas fa-phone"></i>
                                    Telephone Number <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-phone input-icon"></i>
                                    <input 
                                        type="tel" 
                                        name="tel" 
                                        id="tel" 
                                        class="form-control" 
                                        value="{{ old('tel', $loan->tel) }}"
                                        placeholder="0771234567"
                                        required
                                    >
                                </div>
                                <small class="form-help-text">Format: 07XXXXXXXX or 01XXXXXXXX</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="occupation" class="form-label">
                                    <i class="fas fa-briefcase"></i>
                                    Occupation <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-briefcase input-icon"></i>
                                    <input 
                                        type="text" 
                                        name="occupation" 
                                        id="occupation" 
                                        class="form-control" 
                                        value="{{ old('occupation', $loan->occupation) }}"
                                        placeholder="e.g., Software Engineer"
                                        required
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Information Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-money-bill-wave"></i>
                        Financial Information
                    </h3>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="salary" class="form-label">
                                    <i class="fas fa-rupee-sign"></i>
                                    Monthly Salary (Rs.) <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-rupee-sign input-icon"></i>
                                    <input 
                                        type="number" 
                                        name="salary" 
                                        id="salary" 
                                        class="form-control" 
                                        value="{{ old('salary', $loan->salary) }}"
                                        placeholder="50000"
                                        min="0"
                                        step="0.01"
                                        required
                                    >
                                </div>
                                <small class="form-help-text">Enter your gross monthly income</small>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="form-label">
                                    <i class="fas fa-flag"></i>
                                    Application Status <span class="required">*</span>
                                </label>
                                <div class="input-wrapper">
                                    <i class="fas fa-flag input-icon"></i>
                                    <select name="status" id="status" class="form-select" required>
                                        <option value="pending" {{ old('status', $loan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="approved" {{ old('status', $loan->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                                        <option value="rejected" {{ old('status', $loan->status) == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Document Section -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-file-upload"></i>
                        Paysheet Document
                    </h3>

                    @if($loan->paysheet_uri)
                        <div class="current-file">
                            <div class="current-file-info">
                                <i class="fas fa-file-pdf"></i>
                                <div class="current-file-details">
                                    <h6>Current Paysheet</h6>
                                    <p>PDF document uploaded</p>
                                </div>
                            </div>
                            <a href="{{ url('/loan/view-pdf/'.$loan->id) }}" target="_blank" class="btn-view-file">
                                <i class="fas fa-eye"></i> View File
                            </a>
                        </div>
                    @endif

                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-cloud-upload-alt"></i>
                            Upload New Paysheet (Optional)
                        </label>
                        <div class="file-upload-wrapper">
                            <input 
                                type="file" 
                                name="paysheet" 
                                id="paysheet" 
                                accept=".pdf"
                                onchange="updateFileName(this)"
                            >
                            <div class="file-upload-content">
                                <i class="fas fa-cloud-upload-alt"></i>
                                <h5>Click to upload or drag and drop</h5>
                                <p>PDF files only (Max 5MB)</p>
                                <p id="fileName" style="color: #28a745; font-weight: 600; margin-top: 10px;"></p>
                            </div>
                        </div>
                        <small class="form-help-text">Leave empty to keep the current file</small>
                    </div>
                </div>

                <!-- Form Footer -->
                <div class="form-footer">
                    <a href="{{ url('/dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Application
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update file name display
        function updateFileName(input) {
            const fileName = document.getElementById('fileName');
            if (input.files && input.files[0]) {
                fileName.textContent = '✓ ' + input.files[0].name + ' selected';
            } else {
                fileName.textContent = '';
            }
        }

        // Form validation
        document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Normal submit එක stop කරනවා
    
    // Validation
    const salary = document.getElementById('salary').value;
    if (salary < 0) {
        Swal.fire({
            icon: 'error',
            title: 'Invalid Salary!',
            text: 'Salary cannot be negative.',
        });
        return false;
    }

    // Show success SweetAlert
    Swal.fire({
        title: 'Updated Successfully!',
        text: 'Loan application has been updated.',
        icon: 'success',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('loadingOverlay').classList.add('active');

            // Submit the form manually
            document.getElementById('updateForm').submit();
        }
    });
});

        // Add animation to form fields on load
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.opacity = '0';
                group.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    group.style.transition = 'all 0.5s ease';
                    group.style.opacity = '1';
                    group.style.transform = 'translateY(0)';
                }, index * 50);
            });
        });

        // Phone number validation
        document.getElementById('tel').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) {
                value = value.slice(0, 10);
            }
            e.target.value = value;
        });

        // Salary formatting
        document.getElementById('salary').addEventListener('blur', function(e) {
            if (e.target.value) {
                const value = parseFloat(e.target.value);
                e.target.value = value.toFixed(2);
            }
        });
    </script>
    
</body>
</html>