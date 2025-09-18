@extends('layouts.app')

@section('content')
<main>
  <div style="min-height:80vh; display:flex; align-items:center; justify-content:center; padding:20px;">
    <div id="dice-grid" 
         style="display:grid; grid-template-columns: repeat(2, 260px); gap:28px; justify-content:center;">

      <!-- Leave Approval -->
      <a href="{{ route('admin.leaves.index') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/leave.png') }}" alt="Leave"
             style="width:156px; height:156px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">Leave Approval</div>
      </a>

      <!-- Attendance Reports -->
      <a href="{{ route('admin.reports.index') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/attendance.png') }}" alt="Attendance"
             style="width:156px; height:px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">Attendance Reports</div>
      </a>
      
      <!-- Task Management -->
      <a href="{{ route('admin.tasks.index') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/taskmanagement.png') }}" alt="Tasks"
             style="width:156px; height:156px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">Task Management</div>
      </a>

    </div>
  </div>
</main>
@endsection



{{-- 
@extends('layouts.app')
@section('content')


<div class="mb-4">
    <a href="{{ route('admin.leaves.index') }}" class="btn btn-primary">
        Leave Approval
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('admin.reports.index') }}" class="btn btn-info">
        Attendance Reports
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('admin.tasks.index') }}" class="btn btn-success">
        Task Management
    </a>
</div>
@endsection --}}
