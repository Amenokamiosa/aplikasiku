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
                    class="menu-btn">
                    + Create Event
                </a>

                <a href="{{ route('trees.create') }}"
                    class="menu-btn active">
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
            <label class="window-title">
                New Tree Form
            </label>

            <form
                action="{{ route('trees.store') }}"
                method="POST"
                enctype="multipart/form-data"
                class="tree-form">

                @csrf

                <label>Tree Name</label>

                <input
                    type="text"
                    name="name"
                    placeholder="Enter tree name">

                <label>Tree Image</label>

                <input
                    type="file"
                    name="tree_img">

                <label>Price (Rp)</label>

                <input
                    type="number"
                    name="price"
                    min="0"
                    placeholder="Enter price">

                <button type="submit">
                    Submit Tree
                </button>

            </form>
        </div>
        </div>
    </div>
</div>

</body>
</html>