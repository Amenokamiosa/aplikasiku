<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tree;

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
            'start' => 'required',
            'finish' => 'required',
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

    public function showAddTreeForm($id)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $event = Event::findOrFail($id);

    $trees = Tree::all();

    return view(
        'event-add-tree',
        compact('event', 'trees')
    );
}
    public function attachTree(Request $request, $id)
{
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'id_tree' => 'required|exists:trees,id_tree'
    ]);

    $event = Event::findOrFail($id);

    $event->trees()->syncWithoutDetaching([
        $request->id_tree
    ]);

    return redirect()
        ->route('events.show', $id)
        ->with('success', 'Tree berhasil ditambahkan!');
}
}