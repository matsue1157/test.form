<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class AdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('admin', compact('contacts'));
    }

    public function search(Request $request)
    {
        $query = Contact::query();

        if ($request->filled('name')) {
            $query->where('family_name', 'like', '%' . $request->name . '%')
                ->orWhere('given_name', 'like', '%' . $request->name . '%');
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

        if ($request->filled('date_from') && $request->filled('date_to')) {
            $query->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }

        $contacts = $query->paginate(10);
        return view('admin', compact('contacts'));
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('success', '削除しました');
    }
}