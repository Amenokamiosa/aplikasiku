<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tree;

class DonationController extends Controller
{
    public function store(Request $request)
    {
        $trees = $request->trees;

        $totalValue = 0;
        $totalQuantity = 0;

        foreach ($trees as $id_tree => $qty)
        {
            if($qty > 0)
            {
                $tree = Tree::find($id_tree);

                if (!$tree) {
                    continue;
                }

                $totalValue += $tree->price * $qty;
                $totalQuantity += $qty;
            }
        }
        
        if ($totalQuantity <= 0) {
            return back()->with(
                'error',
                'Pilih minimal 1 pohon.'
            );
        }

        Donation::create([
            'id_user' => Auth::id(),
            'id_event' => $request->id_event,
            'value' => $totalValue,
            'tree_quantity' => $totalQuantity,
            'date' => now()
        ]);

        return redirect()
            ->back()
            ->with('success','Donation successful!');
    }
}