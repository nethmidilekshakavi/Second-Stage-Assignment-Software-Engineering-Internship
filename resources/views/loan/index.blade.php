<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>My Loan Applications</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

    <!-- Bootstrap & Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        :root{
            --bg-primary: #1e3c72;
            --bg-secondary: #2a5298;
            --bg-light: #f6f9ff;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #2563eb;
            --accent-2: #3b82f6;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
            --gold: #ffd700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,body{
            min-height:100vh;
            margin:0;
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 50%, #7e8ba3 100%);
            color: #0f172a;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated background pattern */
        body::before {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.05) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: moveBackground 20s linear infinite;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .container-card {
            max-width: 1200px;
            margin: 36px auto;
            padding: 0 18px;
            position: relative;
            z-index: 1;
        }

        /* Topbar with glassmorphism */
        .topbar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:12px;
            margin-bottom:30px;
            background: rgba(255, 255, 255, 0.95);
            padding: 24px 28px;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            animation: slideDown 0.6s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            font-weight:800;
            font-size:1.8rem;
            background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .sub {
            color:var(--muted);
            font-size:0.95rem;
            margin-top: 4px;
        }

        .btn-new {
            background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
            color:white;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(30, 60, 114, 0.3);
            font-weight:600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-new:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(30, 60, 114, 0.4);
        }

        .no-data {
            text-align:center;
            padding:80px 28px;
            background: rgba(255, 255, 255, 0.95);
            border-radius:20px;
            box-shadow:0 20px 60px rgba(0, 0, 0, 0.15);
            backdrop-filter: blur(10px);
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        .no-data h4 {
            color: var(--bg-primary);
            font-weight: 700;
            font-size: 1.5rem;
        }

        /* Enhanced loan cards */
        .loan-card {
            border-radius:20px;
            overflow:hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            opacity: 0;
            transform: translateY(20px);
            animation: cardAppear 0.6s ease forwards;
        }

        @keyframes cardAppear {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .loan-card:nth-child(1) { animation-delay: 0.1s; }
        .loan-card:nth-child(2) { animation-delay: 0.2s; }
        .loan-card:nth-child(3) { animation-delay: 0.3s; }
        .loan-card:nth-child(4) { animation-delay: 0.4s; }
        .loan-card:nth-child(5) { animation-delay: 0.5s; }
        .loan-card:nth-child(6) { animation-delay: 0.6s; }

        .loan-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
        }

        .paysheet-thumb {
            height:160px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:12px;
            font-weight:700;
            color: white;
            background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
            position: relative;
            overflow: hidden;
        }

        .paysheet-thumb::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 10s linear infinite;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .paysheet-thumb > * {
            position: relative;
            z-index: 1;
        }

        .paysheet-thumb.no {
            color:#475569;
            background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        }

        .paysheet-thumb i {
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }

        .card-body {
            padding:24px;
        }

        .card-title {
            font-weight:700;
            color: var(--bg-primary);
            margin-bottom:8px;
            font-size: 1.1rem;
        }
        .small-muted {
            color:var(--muted);
            font-size:0.9rem;
        }

        .stat-value {
            font-size:1.3rem;
            font-weight:800;
            background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .applied {
            color:var(--muted);
            font-size:0.85rem;
        }

        .badge-status {
            padding:8px 16px;
            border-radius:999px;
            font-weight:700;
            font-size:0.82rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .badge-pending {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border: 1px solid rgba(245,158,11,0.3);
        }
        .badge-approved {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border: 1px solid rgba(16,185,129,0.3);
        }
        .badge-rejected {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            color: #991b1b;
            border: 1px solid rgba(220,38,38,0.3);
        }

        .card-actions .btn {
            border-radius:10px;
            padding:8px 14px;
            font-weight:600;
            transition: all 0.3s ease;
            font-size: 0.85rem;
        }

        .card-actions .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .btn-outline-primary {
            border-color: var(--bg-secondary);
            color: var(--bg-secondary);
        }

        .btn-outline-primary:hover {
            background: var(--bg-secondary);
            border-color: var(--bg-secondary);
            color: white;
        }

        .btn-outline-secondary:hover {
            background: #6c757d;
            border-color: #6c757d;
        }

        .btn-outline-success:hover {
            background: var(--success);
            border-color: var(--success);
        }

        .btn-outline-danger:hover {
            background: var(--danger);
            border-color: var(--danger);
        }

        /* responsive grid spacing */
        .row.g-4 { --bs-gutter-x: 1.3rem; }

        /* pagination styling */
        .pagination {
            justify-content:center;
            margin-top:30px;
        }

        .pagination .page-link {
            border-radius: 8px;
            margin: 0 4px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            background: rgba(255, 255, 255, 0.9);
            color: var(--bg-primary);
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--bg-secondary);
            border-color: var(--bg-secondary);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, var(--bg-primary), var(--bg-secondary));
            border-color: var(--bg-primary);
        }

        /* subtle helper */
        .muted-sm { color:var(--muted); font-size:0.88rem; }

        /* delete form spacing so buttons don't wrap awkwardly */
        .card-actions {
            display:flex;
            gap:8px;
            align-items:center;
            flex-wrap:wrap;
        }

        /* Floating particles decoration */
        .particle {
            position: fixed;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
        }

        @media (max-width:576px){
            .paysheet-thumb { height:120px; font-size:0.95rem; }
            .title { font-size:1.4rem; }
            .topbar {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
<div class="container container-card">
    <div class="topbar">
        <div>
            <div class="title">My Applications</div>
            <div class="sub">All loan requests you submitted — organized and easy to manage</div>
        </div>

        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('loan.apply') }}" class="btn btn-new">
                <i class="fas fa-file-invoice-dollar"></i> New Application
            </a>
        </div>
    </div>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2400,
            background: '#fff',
            backdrop: 'rgba(30, 60, 114, 0.4)'
        });
    </script>
    @endif

    @if($loans->count() === 0)
    <div class="no-data">
        <div style="font-size: 4rem; margin-bottom: 20px; color: var(--bg-secondary);">
            <i class="fas fa-inbox"></i>
        </div>
        <h4 class="mb-3">No applications yet</h4>
        <p class="text-muted mb-4">You haven't submitted any loan applications. Click the button to start your first application.</p>
        <a href="{{ route('loan.apply') }}" class="btn btn-new" style="display: inline-flex;">
            <i class="fas fa-plus-circle"></i> Apply now
        </a>
    </div>
    @else
    <div class="row g-4">
        @foreach($loans as $loan)
        <div class="col-md-6 col-lg-4">
            <div class="card loan-card">
                @if($loan->paysheet_uri)
                <div class="paysheet-thumb">
                    <i class="fas fa-file-pdf fa-2x"></i>
                    <div class="text-start">
                        <div style="font-size:0.98rem; font-weight:700;">Paysheet</div>
                        <div class="muted-sm">Uploaded</div>
                    </div>
                </div>
                @else
                <div class="paysheet-thumb no">
                    <i class="fas fa-file-circle-exclamation fa-2x"></i>
                    <div class="text-start">
                        <div style="font-size:0.98rem; font-weight:700;">No Document</div>
                        <div class="muted-sm">Optional</div>
                    </div>
                </div>
                @endif

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <div class="card-title">{{ $loan->occupation }}</div>
                            <div class="small-muted">{{ \Illuminate\Support\Str::limit($loan->name, 30) }} • {{ $loan->tel }}</div>
                        </div>
                        <div class="text-end">
                            @if($loan->status === 'pending')
                            <span class="badge-status badge-pending">Pending</span>
                            @elseif($loan->status === 'approved')
                            <span class="badge-status badge-approved">Approved</span>
                            @else
                            <span class="badge-status badge-rejected">Rejected</span>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="stat-value">LKR {{ number_format($loan->salary, 2) }}</div>
                            <div class="applied">Applied {{ $loan->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="text-end muted-sm">Ref: #{{ $loan->id }}</div>
                    </div>

                    <div class="card-actions">
                        @if($loan->paysheet_uri)
                        <a href="{{ route('loan.view', $loan->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-eye me-1"></i> View
                        </a>
                        <a href="{{ route('loan.download', $loan->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-download me-1"></i> Download
                        </a>
                        @endif

                        <a href="{{ route('loan.edit', $loan->id) }}" class="btn btn-sm btn-outline-success">
                            <i class="fas fa-edit me-1"></i> Edit
                        </a>

                        <form class="delete-form" action="{{ route('loan.destroy', $loan->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" type="submit" data-loan="{{ $loan->id }}">
                                <i class="fas fa-trash me-1"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4 d-flex justify-content-center">
        {{ $loans->onEachSide(1)->links() }}
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Intercept delete forms and show SweetAlert confirmation
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-form').forEach(function(form){
            form.addEventListener('submit', function(e){
                e.preventDefault();
                const btn = form.querySelector('button[type="submit"]');
                const loanId = btn?.getAttribute('data-loan') ?? '';
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This will permanently delete the application #' + loanId,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc2626',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Yes, delete it',
                    reverseButtons: true,
                    background: '#fff',
                    backdrop: 'rgba(30, 60, 114, 0.4)'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });

        // Create floating particles
        function createParticles() {
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.top = Math.random() * 100 + '%';
                particle.style.animation = `float ${5 + Math.random() * 10}s linear infinite`;
                particle.style.animationDelay = Math.random() * 5 + 's';
                document.body.appendChild(particle);
            }
        }

        createParticles();

        // Add float animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes float {
                0%, 100% { transform: translateY(0) translateX(0); opacity: 0; }
                10% { opacity: 0.5; }
                90% { opacity: 0.5; }
                50% { transform: translateY(-100vh) translateX(50px); }
            }
        `;
        document.head.appendChild(style);
    });
</script>
</body>
</html>
