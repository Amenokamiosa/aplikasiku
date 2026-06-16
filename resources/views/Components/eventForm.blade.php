<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="sidebar">

            <a href="{{ route('events.index') }}" class="menu-btn">
                🌱 DONATE
            </a>

            @if(Auth::user()->role === 'admin')

                <a href="{{ route('events.create') }}"
                    class="menu-btn active">
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
            <div class="new-event-form">
                <label class="window-title">New Event form</label>
                <form
                action="{{ route('events.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="event-form">
                    @csrf <label>Title</label>
                    <input type="text" name="title" id="new-event-title" placeholder="Type here...">

                    <label>Header Image</label>
                    <input type="file" name="header_img">

                    <label>Description</label>
                    <textarea name="description" placeholder="Type here..."></textarea>

                    <label>Start</label>
                    <input type="date" name="start" id="new-event-start">

                    <label>Finish</label>
                    <input type="date" name="finish" id="new-event-finish">

                    <label>Status</label>
                    <div class="status-options">
                        <input type="radio" name="status" value="scheduled" id="scheduled"> <label for="scheduled">Scheduled</label>
                        <input type="radio" name="status" value="ongoing" id="ongoing"> <label for="ongoing">Ongoing</label>
                        <input type="radio" name="status" value="completed" id="completed"> <label for="completed">Completed</label>
                    </div>

                    <button type="submit">Submit Event</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>