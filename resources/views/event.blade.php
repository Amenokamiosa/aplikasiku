@php
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pohon Donasi</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>
    <div class="container">
        <div class="sidebar">

            <a href="{{ route('events.index') }}" class="menu-btn active">
                🌱 DONATE
            </a>

            @if(Auth::user()->role === 'admin')

                <a href="{{ route('events.create') }}"
                    class="menu-btn">
                    + Create Event
                </a>
                <a href="{{ route('trees.create') }}"
                    class="menu-btn">
                    🌳 Create Tree
                </a>
                <a href="{{ route('events.delete.form') }}"
                class="menu-btn">
                    🗑 Delete Event
                </a>
                <a href="{{ route('trees.delete.form') }}" class="menu-btn">
                🗑 Delete Tree
                </a>
            @endif

            <a href="{{ route('profil') }}" class="menu-btn">
                👤 ACCOUNT
            </a>

            <a href="{{ route('events.index') }}" class="back-btn-side">
                Back
            </a>

        </div>
        <div class="main-content">
            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif
            <div class="event-section">

                <div class="section-title">
                    <h1>Activity</h1>
                    <p>Support environmental initiatives through tree donations.</p>
                </div>

                @foreach($events as $event)
                    <a class="event-link"
                        href="{{ route('events.show',$event->id_event) }}">

                        <div class="event-card">

                            <img src="{{ asset('storage/'.$event->header_img) }}">

                            <div class="event-info">

                                <h2>{{ $event->title }}</h2>

                                <p>
                                    {{ Str::limit($event->description,100) }}
                                </p>

                                <div class="event-date">
                                    {{ $event->start }} - {{ $event->finish }}
                                </div>

                            </div>

                        </div>

                    </a>

                @endforeach

            </div>
        </div>
    </div>
</body>
</html>