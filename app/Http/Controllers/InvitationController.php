<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    public function create()
    {
        return view('invite');
    }

    public function store(Request $request)
    {
        $loggedUser = Auth::user();

        //  Common validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required|in:Admin,Member',
        ]);

        //  SuperAdmin → Create Admin + Company
        if ($loggedUser->hasRole('SuperAdmin')) {

            if ($request->role != 'Admin') {
                return back()->with('error', 'SuperAdmin can only create Admin');
            }

            //  company required for SuperAdmin
            if (!$request->company_name) {
                return back()->with('error', 'Company name is required');
            }

            $company = Company::create([
                'name' => $request->company_name
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $company->id
            ]);

            $user->assignRole('Admin');
        }

        //  Admin → Create Member
        elseif ($loggedUser->hasRole('Admin')) {

            if ($request->role != 'Member') {
                return back()->with('error', 'Admin can only create Member');
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'company_id' => $loggedUser->company_id
            ]);

            $user->assignRole('Member');
        }

        else {
            return back()->with('error', 'Not allowed');
        }

        //  Show password for demo
        return back()->with('success', 'User created successfully. Password: ' . $request->password);
    }
}