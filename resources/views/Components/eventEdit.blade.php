<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    <title>Update Event</title>
</head>
<body>
    <div class="new-event-form">
        <label class="window-title">Edit Event Form</label>

        @if(session('success'))
            <div class="alert alert-success" style="color: green; margin-bottom: 15px; font-weight: bold;">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('events.update', $event->id_event) }}"
            method="POST"
            enctype="multipart/form-data"
            class="event-form">
            
            @csrf 
            
            @method('PUT') 
            
            <label>Title</label>
            <input type="text" name="title" id="new-event-title" placeholder="Type here..." 
                   value="{{ old('title', $event->title) }}">

            <label>Header Image</label>
            <input type="file" name="header_img" id="new-event-header" placeholder="Type here...">

            <label>Description</label>
            <textarea name="description" id="new-event-description" placeholder="Type here...">{{ old('description', $event->description) }}</textarea>

            <label>Start</label>
            <input type="date" name="start" id="new-event-start" 
                   value="{{ old('start', $event->start) }}">

            <label>Finish</label>
            <input type="date" name="finish" id="new-event-finish" 
                   value="{{ old('finish', $event->finish) }}">

            <label>Status</label>
            <div class="status-options">
                <input type="radio" name="status" value="scheduled" id="scheduled" 
                    {{ old('status', $event->status) == 'scheduled' ? 'checked' : '' }}> 
                <label for="scheduled">Scheduled</label>

                <input type="radio" name="status" value="ongoing" id="ongoing" 
                    {{ old('status', $event->status) == 'ongoing' ? 'checked' : '' }}> 
                <label for="ongoing">Ongoing</label>
                
                <input type="radio" name="status" value="completed" id="completed" 
                    {{ old('status', $event->status) == 'completed' ? 'checked' : '' }}> 
                <label for="completed">Completed</label>
            </div>

            <button type="submit" style="margin-top: 20px;">Save Changes</button>
            
            <a href="{{ url()->previous() }}"
                style="display: block; text-align: center; margin-top: 10px; color: gray; text-decoration: none; font-size: 14px;">
                Cancel
            </a>
        </form>
    </div>
</body>
</html>