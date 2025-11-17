{{-- resources/views/partials/loan-card.blade.php --}}
<div class="application-card"
     data-email="{{ strtolower($loan->email) }}"
     data-search="{{ strtolower($loan->name . ' ' . $loan->email . ' ' . $loan->occupation) }}">
    <div class="card-header-custom">
        <div class="applicant-header">
            <div class="applicant-image-wrapper">
                <img src="{{ $loan->profile_image ?? 'https://ui-avatars.com/api/?name=' . urlencode($loan->name) . '&background=2a5298&color=fff&size=200' }}"
                     alt="{{ $loan->name }}"
                     class="applicant-image">
                <div class="status-badge-overlay {{ $loan->status }}">
                    @if($loan->status == 'approved')
                    <i class="fas fa-check"></i>
                    @elseif($loan->status == 'rejected')
                    <i class="fas fa-times"></i>
                    @else
                    <i class="fas fa-clock"></i>
                    @endif
                </div>
            </div>
            <div class="applicant-info">
                <h3 class="applicant-name">{{ $loan->name }}</h3>
                <p class="applicant-id"><i class="fas fa-hashtag"></i> ID: {{ $loan->id }}</p>
                <p class="applicant-occupation">
                    <i class="fas fa-briefcase"></i> {{ $loan->occupation }}
                </p>
            </div>
        </div>
    </div>

    <div class="card-body-custom">
        <div class="info-row">
            <div class="info-icon email">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="info-content">
                <p class="info-label">Email Address</p>
                <p class="info-value">{{ $loan->email }}</p>
            </div>
        </div>

        <div class="info-row">
            <div class="info-icon phone">
                <i class="fas fa-phone"></i>
            </div>
            <div class="info-content">
                <p class="info-label">Phone Number</p>
                <p class="info-value">{{ $loan->tel }}</p>
            </div>
        </div>

        <div class="info-row">
            <div class="info-icon salary">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="info-content">
                <p class="info-label">Monthly Salary</p>
                <p class="info-value highlight">Rs. {{ number_format($loan->salary, 2) }}</p>
            </div>
        </div>

        <div class="info-row">
            <div class="info-icon date">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="info-content">
                <p class="info-label">Submitted On</p>
                <p class="info-value">{{ $loan->created_at->timezone('Asia/Colombo')->format('M d, Y - H:i') }}</p>
            </div>
        </div>
    </div>

    <div class="card-actions">
        @if($loan->status == 'pending')
        <a href="{{ url('/loan/approve/'.$loan->id) }}" class="btn btn-success btn-approve" data-id="{{ $loan->id }}" data-url="{{ url('/loan/approve/'.$loan->id) }}">
            <i class="fas fa-check"></i> Approve
        </a>
        <a href="{{ url('/loan/reject/'.$loan->id) }}" class="btn btn-danger btn-reject" data-id="{{ $loan->id }}" data-url="{{ url('/loan/reject/'.$loan->id) }}">
            <i class="fas fa-times"></i> Reject
        </a>
        @endif
        <a href="{{ route('loan.edit', $loan->id) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="javascript:void(0)" onclick="confirmDelete({{ $loan->id }})" class="btn btn-info">
            <i class="fas fa-trash"></i> Delete
        </a>

        <!-- Hidden form for deletion -->
        <form id="delete-form-{{ $loan->id }}" action="{{ route('loan.delete', $loan->id) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
</div>
