<!DOCTYPE html>
<html>
<head>
    <title>Add Trees</title>
    <link rel="stylesheet"
          href="{{ asset('css/event.css') }}">
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
            @endif
            
            <a href="{{ route('profil') }}" class="menu-btn">
                👤 ACCOUNT
            </a>

            <a href="{{ route('events.index') }}" class="back-btn-side">
                Back
            </a>

        </div>
        <div class="main-content">
<div class="tree-select-container">

    <h1>
        Add Trees to
        "{{ $event->title }}"
    </h1>

    <form
        action="{{ route('events.trees.store', $event->id_event) }}"
        method="POST">

        @csrf

        <div class="tree-grid">

            @foreach($trees as $tree)

                <label class="tree-card">

                    <input
                        type="checkbox"
                        name="trees[]"
                        value="{{ $tree->id_tree }}">

                    <img
                        src="{{ asset('storage/'.$tree->tree_img) }}">

                    <h3>
                        {{ $tree->name }}
                    </h3>

                    <p>
                        Rp {{ number_format($tree->price,0,',','.') }}
                    </p>

                </label>

            @endforeach

        </div>

        <button
            type="submit"
            class="submit-btn">

            Add Selected Trees

        </button>

    </form>

</div>
</div>

</body>
</html>