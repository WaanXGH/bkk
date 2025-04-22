<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use App\Models\apply_loker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            return route('login'); // Redirect ke halaman login
        }
    }

    // Menampilkan detail lowongan kerja beserta perhitungan jumlah pelamar.
    public function showLoker(Request $request, $id)
    {
        // Ambil data lowongan dengan relasi pelamars
        $lowongan = Loker::with('pelamars')->findOrFail($id);

        // Hitung jumlah pelamar yang sudah melamar ke lowongan ini
        $pelamar_count = apply_loker::where('id_lowongan', $lowongan->id)->count();

        // Tambahkan variabel status
        $status = 'Tersedia';

        if ($lowongan->tanggal_selesai < now()->toDateString()) {
            $status = 'Kadaluarsa';
        } elseif ($pelamar_count >= $lowongan->max_pelamar) {
            $status = 'Penuh';
        }

        $applied = null;

        if (Auth::check()) {
            $applied = apply_loker::where('id_lowongan', $lowongan->id)
                ->where('id_pelamar', Auth::id())
                ->first();
        }

        return view('home-lamaran', compact('lowongan', 'status', 'pelamar_count', 'applied'));
    }

    public function edit_lamaran($id)
    {
        $lamaran = apply_loker::with('loker')->findOrFail($id);

        // Cek apakah pelamar adalah user yang sedang login
        if ($lamaran->id_pelamar != Auth::id()) {
            abort(403);
        }

        // Kunci edit jika sudah lebih dari 2 hari sejak apply
        $locked = now()->diffInDays($lamaran->created_at) > 2;

        return view('editlamaran', compact('lamaran', 'locked'));
    }


    public function update_lamaran(Request $request, $id)
    {
        $lamaran = apply_loker::findOrFail($id);

        if ($lamaran->id_pelamar != Auth::id()) {
            abort(403);
        }

        if (now()->diffInDays($lamaran->created_at) > 2) {
            return redirect()->back()->with('error', 'Edit lamaran sudah tidak diperbolehkan.');
        }

        $lamaran->update($request->only([
            'nama_lengkap',
            'email',
            'tempat_lahir',
            'tanggal_lahir',
            'alamat',
            'NIK',
            'no_hp'
        ]));

        if ($request->hasFile('file_cv')) {
            $file = $request->file('file_cv');
            $filename = now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
            $path = 'aplicant-cv/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($file));
            $lamaran->file_cv = $path;
            $lamaran->save();
        }

        return redirect()->route('lamaran.edit', $id)->with('success', 'Data lamaran berhasil diperbarui.');
    }



    // Menampilkan seluruh pelamar untuk lowongan tertentu 
    public function pelamars($id)
    {
        return $this->hasMany(apply_loker::class, 'id_lowongan');
        // Misalnya kita punya view 'loker.pelamars' untuk menampilkan daftar pelamar
    }

    // Menangani lamaran ke lowongan kerja
    public function apply_loker(Request $request, $id)
    {

        try {
            $loker = Loker::findOrFail($id);
            $id_pelamar = Auth::id();

            if (!$request->hasFile('file_cv')) {
                return redirect()->back()->with('error', 'File CV tidak ditemukan.');
            }

            $file = $request->file('file_cv');
            $filename = now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();
            $path = 'aplicant-cv/' . $filename;
            Storage::disk('public')->put($path, file_get_contents($file));

            apply_loker::create([
                'id_lowongan'   => $loker->id,
                'id_pelamar'    => $id_pelamar,
                'nama_lengkap'  => $request->input('nama_lengkap'),
                'email'         => $request->input('email'),
                'tempat_lahir'  => $request->input('tempat_lahir'),
                'tanggal_lahir' => $request->input('tanggal_lahir'),
                'alamat'        => $request->input('alamat'),
                'NIK'           => $request->input('NIK'),
                'no_hp'         => $request->input('no_hp'),
                'file_cv'       => $path,
            ]);

            // Update user NIK jika belum diisi
            $user = User::find($id_pelamar);
            if ($user && !$user->NIK) {
                $user->NIK = $request->input('NIK');
                $user->email = $request->input('email');
                $user->nomor_telepon = $request->input('no_telp'); // mapping no_telp ke kolom nomor_telepon
                $user->save();
            }

            return redirect()->route('home')->with('success', 'Lamaran Anda telah berhasil dikirim!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengirim lamaran: ' . $e->getMessage());
        }
    }

    public function lamaranSaya()
    {
        $userId = Auth::id();
        $lamaran = apply_loker::where('id_pelamar', $userId)->latest()->first(); // atau ambil semua jika perlu

        return view('lamaran-saya', compact('lamaran'));
    }

    // Menghapus lamaran kerja (misalnya oleh admin atau pemilik lowongan)
    public function delete_loker($id)
    {
        $lamaran = apply_loker::findOrFail($id);
        $lamaran->delete();

        return redirect()->back()->with('success', 'Lamaran berhasil dihapus.');
    }

    // Method berikut tampaknya tidak diperlukan di controller, karena relasi belongsTo
    // sebaiknya didefinisikan di dalam model apply_loker (misalnya: public function user())
    // sehingga method ini bisa dihapus dari controller.
}
