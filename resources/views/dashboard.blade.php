@extends('layouts.app')

@section('content')
<main>
  <div style="min-height:80vh; display:flex; align-items:center; justify-content:center; padding:20px;">
    <div id="dice-grid" 
         style="display:grid; grid-template-columns: repeat(2, 260px); gap:28px; justify-content:center;">

      <!-- Mark Attendance -->
      <a href="{{ route('attendance.index') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/attendance.png') }}" alt="Attendance"
             style="width:156px; height:156px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">Mark Attendance</div>
      </a>

      <!-- Create Leave Request -->
      <a href="{{ route('leave.create') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/leave.png') }}" alt="Leave"
             style="width:156px; height:px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">Create Leave Request</div>
      </a>

      <!-- Check Leave Status -->
      <a href="{{ route('leave.status') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/status.png') }}" alt="Status"
             style="width:156px; height:156px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">Check Leave Status</div>
      </a>

      <!-- My Tasks -->
      <a href="{{ route('tasks.index') }}"
         style="display:flex; flex-direction:column; align-items:center; justify-content:center;
                width:260px; height:260px; background:#f4f6f8; border-radius:18px;
                box-shadow:0 8px 28px rgba(16,24,40,0.1); text-decoration:none; color:#111;">
        <img src="{{ asset('icons/tasks.png') }}" alt="Tasks"
             style="width:156px; height:156px; object-fit:contain; margin-bottom:16px;"
             onerror="this.style.display='none'">
        <div style="font-weight:600; font-size:18px; text-align:center;">My Tasks</div>
      </a>

    </div>
  </div>
</main>
@endsection



{{-- @extends('layouts.app')
@section('content')

<div class="mb-4">
    <a href="{{ route('attendance.index') }}" class="btn btn-primary">
        Mark Attendance
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('leave.create') }}" class="btn btn-info">
        Create Leave Request
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('leave.status') }}" class="btn btn-success">
        Check Leave Status
    </a>
</div>

<div class="mb-4">
    <a href="{{ route('tasks.index') }}" class="btn btn-warning">
        My Tasks
    </a>
@endsection --}}

{{--@extends('layouts.app')
@section('content')

    <div style="display: flex; gap: 20px; flex-wrap: wrap;">
        <a href="{{ route('attendance.index') }}">
            <button>Mark Attendance</button>
        </a>
        <a href="{{ route('leave.create') }}">
            <button>Mark Leave</button>
        </a>
        <a href="{{ route('leave.status') }}">
            <button>View Leave Status</button>
    </div>
@endsection --}}
