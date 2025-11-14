<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Models\Admin;
use App\Models\Complaint;

class AdminController extends Controller
{
    public function showLogin()
    {
        return view('inloggen');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $admin = Admin::where('username', $validated['username'])->first();

        if (!$admin || !Hash::check($validated['password'], $admin->password_hash)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'ok' => false,
                    'error' => 'Ongeldige inloggegevens.',
                    'input' => [
                        'username' => $validated['username'],
                    ],
                ], 422);
            }
            return Redirect::back()->withInput(['username' => $validated['username']])->with('error', 'Ongeldige inloggegevens.');
        }

        $request->session()->put('admin_id', $admin->id);

        if ($request->wantsJson()) {
            return response()->json([
                'ok' => true,
                'input' => [
                    'username' => $validated['username'],
                ],
                'admin' => [
                    'id' => $admin->id,
                    'username' => $admin->username,
                    'created_at' => $admin->created_at,
                    'updated_at' => $admin->updated_at,
                ],
            ]);
        }

        return redirect('/dashboard');
    }

    public function dashboard(Request $request)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/inloggen')->with('error', 'U moet ingelogd zijn om toegang te krijgen tot het dashboard.');
        }

        $ComplaintC = new ComplaintController();
        $recentComplaints = $ComplaintC->index(5);

        $searchId = $request->get('search_id');
        $searchResult = null;

        if ($searchId) {
            $searchResult = Complaint::with('reporter', 'photo')
                ->find($searchId);
        }

        return view('dashboard', [
            'recentComplaints' => $recentComplaints,
            'searchResult' => $searchResult,
            'searchId' => $searchId,
        ]);
    }

    public function showComplaint(Request $request, $id)
    {
        if (!$request->session()->has('admin_id')) {
            return redirect('/inloggen')->with('error', 'U moet ingelogd zijn om toegang te krijgen tot deze pagina.');
        }

        $complaint = Complaint::with('reporter', 'photo')
            ->findOrFail($id);

        return view('complaint-detail', [
            'complaint' => $complaint,
        ]);
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_id');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/inloggen');
    }
}
