<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

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
        return view('Components.eventForm');
    }

    // Fungsi untuk memproses data dari form
    public function store(Request $request)
    {
        // 1. Validasi data yang masuk (Opsional tapi disarankan)
        $validated = $request->validate([
            'title' => 'required|string',
            'header_img' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'description' => 'required',
            'start' => 'required',
            'finish' => 'required',
            'status' => 'required',
        ]);

        // 2. Untuk testing sementara: cek apakah data sudah masuk atau belum
        return response()->json([
            'message' => 'Data berhasil diterima oleh Controller!',
            'data' => $validated
        ]);
    }
    public function show($id)
    {
    $event = Event::with('trees')
        ->findOrFail($id);

    return view('event-detail', compact('event'));
    }
}