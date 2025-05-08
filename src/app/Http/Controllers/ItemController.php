<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $items = $query->latest()->paginate(10);

        return view('admin', compact('items'));
    }


    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();

            return redirect()->back()->with('success', '削除しました。');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '削除中にエラーが発生しました。');
        }
    }
}