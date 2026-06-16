@php
use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html>
<head>
    <title>Delete Events</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>

<div class="container">

    <div class="sidebar">

        <a href="{{ route('events.index') }}"
           class="menu-btn">
            🌱 DONATE
        </a>

        <a href="{{ route('events.create') }}"
           class="menu-btn">
            + Create Event
        </a>
        <a href="{{ route('trees.create') }}"
                    class="menu-btn">
                    🌳 Create Tree
                </a>

        <a href="{{ route('events.delete.form') }}"
           class="menu-btn active">
            🗑 Delete Event
        </a>
        <a href="{{ route('trees.delete.form') }}" class="menu-btn">
                🗑 Delete Tree
                </a>

        <a href="{{ route('profil') }}"
           class="menu-btn">
            👤 ACCOUNT
        </a>

        <a href="{{ route('events.index') }}"
           class="back-btn-side">
            Back
        </a>

    </div>

    <div class="main-content">

        <div class="tree-select-container">

            <h1>
                Select Events to Delete
            </h1>

            <form
                action="{{ route('events.delete.multiple') }}"
                method="POST">

                @csrf

                <div class="tree-grid">

                    @foreach($events as $event)

                        <label class="tree-card selectable-card">

                            <input
                                type="checkbox"
                                name="events[]"
                                value="{{ $event->id_event }}"
                                class="event-checkbox">

                            <img
                                src="{{ asset('storage/'.$event->header_img) }}"
                                alt="{{ $event->title }}">

                            <h3>
                                {{ $event->title }}
                            </h3>

                            <p>
                                {{ $event->start }}
                                -
                                {{ $event->finish }}
                            </p>

                            <div class="tree-price">
                                {{ ucfirst($event->status) }}
                            </div>

                        </label>

                    @endforeach

                </div>

                <button
                    type="submit"
                    class="submit-btn"
                    onclick="return confirm('Delete selected events?')">

                    🗑 Delete Selected Events

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>