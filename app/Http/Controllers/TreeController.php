<?php

namespace App\Http\Controllers;

use App\Models\Tree;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function index()
    {
        $daftarPohon = Tree::getAvailableTrees();
        return view('pohon', ['trees' => $daftarPohon]); 
    }

    public function create()
    {
        // Pastikan nama file view & foldernya sudah benar (misal: resources/views/components/treeForm.blade.php)
        return view('components.treeForm');
    }

    public function store(Request $request)
    {
        // Catatan: Sesuaikan 'quantity' atau field lain jika form pohonmu menggunakan input jumlah/harga/total donasi
        $validated = $request->validate([
            'title'      => 'required|string',
            'header_img' => 'required|image|mimes:jpg,jpeg,png|max:5120',
            'price'      => 'required|numeric', // Tambahkan 'numeric' jika inputnya harus angka
        ]);

        return response()->json([
            'message' => 'Data Pohon berhasil diterima oleh TreeController!',
            'data'    => $validated
        ]);
    }
}