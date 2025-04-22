<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        if (auth()->check()) { // Pastikan user sudah login
            $user = auth()->user();

            // Cek apakah role user adalah admin
            if ($user->role === 'Admin') {
                return redirect()->route('admin.dashboard'); // Arahkan admin ke halaman dashboard
            }
        }

        $lokers = Loker::all();
        return view('Home', compact('lokers')); // Tampilkan halaman home untuk user biasa
    }
}
