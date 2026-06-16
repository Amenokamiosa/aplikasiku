<!DOCTYPE html>
<html>
<head>
    <title>Delete Trees</title>
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
</head>
<body>

<div class="container">

    <div class="sidebar">

        <a href="{{ route('events.index') }}" class="menu-btn">
            🌱 DONATE
        </a>

        <a href="{{ route('events.create') }}" class="menu-btn">
            + Create Event
        </a>

        <a href="{{ route('trees.create') }}" class="menu-btn">
            🌳 Create Tree
        </a>
        <a href="{{ route('events.delete.form') }}"
                class="menu-btn">
                    🗑 Delete Event
                </a>

        <a href="{{ route('trees.delete.form') }}" class="menu-btn active">
            🗑 Delete Tree
        </a>

        <a href="{{ route('profil') }}" class="menu-btn">
            👤 ACCOUNT
        </a>

        <a href="{{ route('events.index') }}" class="back-btn-side">
            Back
        </a>

    </div>

    <div class="main-content">

        <div class="tree-select-container">

            <h1>Select Trees to Delete</h1>

            <form action="{{ route('trees.delete.multiple') }}" method="POST">
                @csrf

                <div class="tree-grid">

                    @foreach($trees as $tree)

                        <label class="tree-card selectable-card">

                            <input type="checkbox"
                                   name="trees[]"
                                   value="{{ $tree->id_tree }}"
                                   class="tree-checkbox">

                            <img src="{{ asset('storage/'.$tree->tree_img) }}"
                                 alt="{{ $tree->name }}">

                            <h3>{{ $tree->name }}</h3>

                            <p>Rp {{ number_format($tree->price,0,',','.') }}</p>

                        </label>

                    @endforeach

                </div>

                <button type="submit"
                        class="submit-btn"
                        onclick="return confirm('Delete selected trees?')">
                    🗑 Delete Selected Trees
                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>