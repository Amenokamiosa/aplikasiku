<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="main-frame">
        <div class="sidebar-panel">
            <ul class="sidebar-list">
                <li>
                    <a href="{{ url('/') }}" class="sidebar-btn">Home</a>
                </li>
                <li>
                    <a href="{{ url('/journal') }}" class="sidebar-btn">Journal</a>
                </li>
                <li>
                    <a href="{{ url('/donate') }}" class="sidebar-btn">Donate</a>
                </li>
                <li>
                    <a href="{{ url('/schedule') }}" class="sidebar-btn">Schedule</a>
                </li>
                <li>
                    <a href="{{ url('/document') }}" class="sidebar-btn">Document</a>
                </li>
                <li>
                    <a href="{{ url('/account') }}" class="sidebar-btn">Account</a>
                </li>
                <li>
                    <a href="#" class="sidebar-btn">More</a>
                </li>
            </ul>
        </div>
        <div class="maiin-panel"></div>
    </div>
</body>
</html>