<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class TreeController extends Controller
{
    public function index()
    {
        $daftarPohon = Tree::all();
        return view('pohon', ['trees' => $daftarPohon]); 
    }

    public function create()
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    return view('Components.treeForm');
}

    public function store(Request $request)
{
if (auth()->user()->role !== 'admin') {
abort(403);
}

$request->validate([
    'name' => 'required|string|max:100',
    'tree_img' => 'required|image|mimes:jpg,jpeg,png|max:5120',
    'price' => 'required|numeric|min:0',
]);

$treePath = $request->file('tree_img')
    ->store('tree_img', 'public');

Tree::create([
    'name' => $request->name,
    'tree_img' => $treePath,
    'price' => $request->price,
]);

return redirect()
    ->route('events.index')
    ->with('success', 'Tree berhasil dibuat!');

}
public function createForEvent($id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $event = Event::findOrFail($id);

    $trees = Tree::all();

    return view(
        'Components.eventTreeForm',
        compact('event', 'trees')
    );
}

public function storeForEvent(Request $request, $id)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $event = Event::findOrFail($id);

    $request->validate([
        'trees' => 'required|array',
    ]);

    $event->trees()->syncWithoutDetaching(
        $request->trees
    );

    return redirect()
        ->route('events.show', $event->id_event)
        ->with('success', 'Trees berhasil ditambahkan!');
}
public function removeFromEvent($eventId, $treeId)
{
    $event = Event::findOrFail($eventId);

    $event->trees()->detach($treeId);

    return redirect()
        ->route('events.show', $eventId)
        ->with('success', 'Tree removed from event.');
}
public function deleteForm()
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $trees = Tree::all();

    return view('Components.treeDelete', compact('trees'));
}

public function deleteMultiple(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        abort(403);
    }

    $request->validate([
        'trees' => 'required|array'
    ]);

    $trees = Tree::whereIn('id_tree', $request->trees)->get();

    foreach ($trees as $tree) {
        // hapus file gambar kalau ada
        if ($tree->tree_img) {
            Storage::disk('public')->delete($tree->tree_img);
        }

        // detach dari event_tree dulu (pivot)
        $tree->events()->detach();

        // hapus tree
        $tree->delete();
    }

    return redirect()
        ->route('events.index')
        ->with('success', 'Tree berhasil dihapus.');
}
}