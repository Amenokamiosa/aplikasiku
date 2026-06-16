<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

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

    return view('components.treeForm');
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

}