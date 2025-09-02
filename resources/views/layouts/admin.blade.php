<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a> |
        <a href="{{ route('admin.leaves.index') }}">Leave Approval</a> |
        <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </nav>
    <hr>
    <div class="container">
        @yield('content')
    </div>
</body>
</html>
