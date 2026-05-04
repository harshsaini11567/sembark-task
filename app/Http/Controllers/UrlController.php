<?php

namespace App\Http\Controllers;

use App\Models\UrlShortener;
use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UrlController extends Controller
{
    //  LIST
    public function index()
    {
        $user = Auth::user();

        // SuperAdmin → all
        if ($user->hasRole('SuperAdmin')) {
            $urls = UrlShortener::latest()->get();
        }

        // Admin → own company
        elseif ($user->hasRole('Admin')) {
            $urls = UrlShortener::where('company_id', $user->company_id)->latest()->get();
        }

        // Member → own urls
        else {
            $urls = UrlShortener::where('user_id', $user->id)->latest()->get();
        }

        return view('urls', compact('urls'));
    }

    //  CREATE
    public function store(Request $request)
    {
        $user = Auth::user();

        //  SuperAdmin block
        if ($user->hasRole('SuperAdmin')) {
            return back()->with('error', 'SuperAdmin cannot create URLs');
        }

        $request->validate([
            'original_url' => 'required|url'
        ]);

        $code = Str::random(6);

        UrlShortener::create([
            'original_url' => $request->original_url,
            'short_code' => $code,
            'user_id' => $user->id,
            'company_id' => $user->company_id,
        ]);

        return back()->with('success', url('/' . $code));
    }

    //  REDIRECT
    public function redirect($code)
    {
        $url = UrlShortener::where('short_code', $code)->firstOrFail();

        return redirect($url->original_url);
    }
}
