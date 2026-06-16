<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
    $events = Event::all();

    return view('event', compact('events'));
    }
    
    /*public function index()
    {
        // 1. Ambil data dari model
        $daftarEvent = Event::getAvailableEvent();
        // 2. Kirim data ke View bernama 'pohon'
        return view ('pohon',['events' => $daftarEvent]); 
    }*/

    // Fungsi untuk menampilkan form
    public function create()
    {
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    return view('Components.eventForm');
    }

    // Fungsi untuk memproses data dari form
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
        abort(403);
        }

        // 1. Validasi data yang masuk (Opsional tapi disarankan)
        $validated = $request->validate([
            'title' => 'required|string',
            'header_img' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'description' => 'required',
            'start' => 'required|date',
            'finish' => 'required|date|after_or_equal:start',
            'status' => 'required',
        ]);
        
        $headerPath = $request->file('header_img')
        ->store('event_headers', 'public');

        // 2. Untuk testing sementara: cek apakah data sudah masuk atau belum
        Event::create([
            'title' => $request->title,
            'header_img' => $headerPath,
            'description' => $request->description,
            'start' => $request->start,
            'finish' => $request->finish,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event berhasil dibuat!');
    }
    public function show($id)
    {
    $event = Event::with('trees')
        ->findOrFail($id);

    return view('event-detail', compact('event'));
    }
    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $event = Event::findOrFail($id);

        return view('Components.eventEdit', compact('event'));
    }
    public function update(Request $request, $id)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $event = Event::findOrFail($id);

    $request->validate([
        'title' => 'required|string',
        'header_img' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
        'description' => 'required',
        'start' => 'required',
        'finish' => 'required',
        'status' => 'required',
    ]);

    $data = [
        'title' => $request->title,
        'description' => $request->description,
        'start' => $request->start,
        'finish' => $request->finish,
        'status' => $request->status,
    ];

    if ($request->hasFile('header_img')) {

        $headerPath = $request->file('header_img')
            ->store('event_headers', 'public');

        $data['header_img'] = $headerPath;
    }

    $event->update($data);

    return redirect()
    ->route('events.index')
    ->with('success', 'Event berhasil diperbarui!');
}
public function deleteForm()
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $events = Event::all();

    return view('Components.eventDelete', compact('events'));
}

public function deleteMultiple(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'events' => 'required|array'
    ]);

    $events = Event::whereIn(
        'id_event',
        $request->events
    )->get();

    foreach ($events as $event) {

        // hapus relasi di pivot event_tree
        $event->trees()->detach();

        // hapus event
        $event->delete();
    }

    return redirect()
        ->route('events.index')
        ->with('success', 'Event berhasil dihapus.');
}
}