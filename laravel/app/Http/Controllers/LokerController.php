<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;

class LokerController extends Controller
{
    public function index()
    {
        $loker = Loker::all(); // Mengambil data dari tabel lokers secara terbaru
        return view('', compact('loker')); // Kirim data ke view dengan variabel 'lokers'
    }
}
