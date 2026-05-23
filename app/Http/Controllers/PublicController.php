<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function index()
    {
        $properties = Property::available()->latest()->take(6)->get();
        return view('welcome', compact('properties'));
    }

    public function explore(Request $request)
    {
        $query = Property::available();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('city', 'like', '%' . $request->search . '%')
                  ->orWhere('district', 'like', '%' . $request->search . '%');
        }

        $properties = $query->latest()->paginate(12);
        return view('public.explore', compact('properties'));
    }

    public function agents()
    {
        // Fetch users with the role 'sale-agent'
        $agents = User::role('sale-agent')->withCount('properties')->get();
        return view('public.agents', compact('agents'));
    }

    public function faqs()
    {
        return view('public.faqs');
    }

    public function about()
    {
        return view('public.about');
    }
}
