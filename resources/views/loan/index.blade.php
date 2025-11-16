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
            --bg: #f4f8ff;
            --card: #ffffff;
            --muted: #6b7280;
            --accent: #2563eb;
            --accent-2: #3b82f6;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #f59e0b;
        }

        html,body{
            height:100%;
            margin:0;
            font-family: 'Poppins', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #f6f9ff 0%, var(--bg) 100%);
            color: #0f172a;
        }

        .container-card { max-width: 1200px; margin: 36px auto; padding: 0 18px; }

        .topbar {
            display:flex;
            justify-content:space-between;
            align-items:center;
            gap:12px;
            margin-bottom:20px;
        }
        .title {
            font-weight:800;
            font-size:1.45rem;
            color:var(--accent-2);
        }
        .sub {
            color:var(--muted);
            font-size:0.95rem;
        }

        .btn-new {
            background: linear-gradient(90deg,var(--accent),var(--accent-2));
            color:white;
            border: none;
            padding: 10px 16px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(37,99,235,0.12);
            font-weight:600;
        }
        .btn-new:hover { transform: translateY(-3px); }

        .no-data {
            text-align:center;
            padding:60px 28px;
            background:var(--card);
            border-radius:14px;
            box-shadow:0 8px 24px rgba(15,23,42,0.06);
        }

        .loan-card { border-radius:14px; overflow:hidden; transition:transform .22s ease, box-shadow .22s ease; border: 1px solid rgba(15,23,42,0.04); background:var(--card); }
        .loan-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(2,6,23,0.06); }

        .paysheet-thumb {
            height:150px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:12px;
            font-weight:700;
            color:var(--accent);
            background: linear-gradient(180deg, rgba(59,130,246,0.06), rgba(37,99,235,0.03));
        }
        .paysheet-thumb.no { color:#475569; background: linear-gradient(180deg, rgba(99,102,241,0.02), rgba(15,23,42,0.01)); }

        .card-body { padding:18px; }

        .card-title { font-weight:700; color:#0b1220; margin-bottom:6px; }
        .small-muted { color:var(--muted); font-size:0.9rem; }

        .stat-value { font-size:1.1rem; font-weight:800; color:#07214a; }
        .applied { color:var(--muted); font-size:0.85rem; }

        .badge-status {
            padding:8px 12px;
            border-radius:999px;
            font-weight:700;
            font-size:0.82rem;
        }
        .badge-pending { background: rgba(245,158,11,0.12); color: var(--warning); border: 1px solid rgba(245,158,11,0.18); }
        .badge-approved { background: rgba(16,185,129,0.09); color: var(--success); border: 1px solid rgba(16,185,129,0.12); }
        .badge-rejected { background: rgba(220,38,38,0.08); color: var(--danger); border: 1px solid rgba(220,38,38,0.12); }

        .card-actions .btn {
            border-radius:10px;
            padding:7px 10px;
            font-weight:600;
        }

        /* responsive grid spacing */
        .row.g-4 { --bs-gutter-x: 1.3rem; }

        /* pagination center */
        .pagination { justify-content:center; margin-top:18px; }

        /* subtle helper */
        .muted-sm { color:var(--muted); font-size:0.88rem; }

        /* delete form spacing so buttons don't wrap awkwardly */
        .card-actions { display:flex; gap:8px; align-items:center; flex-wrap:wrap; }

        @media (max-width:576px){
            .paysheet-thumb { height:120px; font-size:0.95rem; }
            .title { font-size:1.2rem; }
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
                <i class="fas fa-file-invoice-dollar me-2"></i> New Application
            </a>
        </div>
    </div>

    @if(session('success'))
    <script>
        // show SweetAlert for success flash
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 2400,
            background: '#fff'
        });
    </script>
    @endif

    @if($loans->count() === 0)
    <div class="no-data">
        <h4 class="mb-2">No applications yet</h4>
        <p class="text-muted mb-3">You haven't submitted any loan applications. Click the button to start your first application.</p>
        <a href="{{ route('loan.apply') }}" class="btn btn-outline-primary">Apply now</a>
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
                    <div class="d-flex justify-content-between align-items-start mb-2">
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
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
</body>
</html>
