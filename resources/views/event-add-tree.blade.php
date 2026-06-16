<!DOCTYPE html>
<html>
<head>
    <title>Add Tree</title>
    <link rel="stylesheet"
          href="{{ asset('css/event.css') }}">
</head>
<body>

<div class="container">

    <div class="main-content">

        <div class="new-event-form">

            <h1>
                Add Tree To
                {{ $event->title }}
            </h1>

            <form
                action="{{ route('events.trees.attach', $event->id_event) }}"
                method="POST">

                @csrf

                <label>Select Tree</label>

                <select name="id_tree">

                    @foreach($trees as $tree)

                        <option
                            value="{{ $tree->id_tree }}">

                            {{ $tree->name }}
                            -
                            Rp {{ number_format($tree->price) }}

                        </option>

                    @endforeach

                </select>

                <button type="submit">

                    Add Tree

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>