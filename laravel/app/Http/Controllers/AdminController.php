<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Relasi;
use App\Models\Loker;
use App\Models\apply_loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\mail\WelcomeDeveloper;
use App\Mail\PelamarStatusChangedMail;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function index(Request $request)
    {
        //menghitung jumlah semua user
        $countUser = User::where('role', 'User')->count();
        $today = Carbon::now();

        $countRelation = Relasi::count();

        //menghitung jumlah semua loker
        $countloker = Loker::count();

        //menghitung data loker yang statusnya aktif

        $lowongans = Loker::withCount('pelamars')->get();
        $countTersedia = $lowongans->filter(function ($loker) use ($today) {
            return $loker->tanggal_mulai <= $today &&
                $loker->tanggal_selesai >= $today &&
                $loker->pelamars_count < $loker->max_pelamar;
        })->count();

        $users = User::all(); // Mengambil semua user

        $countDiterima = apply_loker::where('status', 'diterima')->count();
        $countDitolak = apply_loker::where('status', 'ditolak')->count();
        $countMenunggu = apply_loker::where('status', 'menunggu')->count();

        // mengambil nama pt beserta jumlah user yang melamar di perusahaan  tersebut
        $pelamarPerPerusahaan = DB::table('queue_applicant')
            ->join('lokers', 'queue_applicant.id_lowongan', '=', 'lokers.id')
            ->select('lokers.judul as perusahaan', DB::raw('COUNT(*) as total_pelamar'))
            ->groupBy('lokers.judul')
            ->orderBy('lokers.judul')
            ->pluck('total_pelamar', 'perusahaan');
        // Collection: ['Arutmin' => 12, 'Kopi' => 30, …]

        $NamaPerusahaan    = $pelamarPerPerusahaan->keys()->all();    // ['Arutmin','Kopi',…]
        $hitungtujuanUser = $pelamarPerPerusahaan->values()->all();  // [12,30,…]

        return view('admin', compact('countUser', 'countRelation', 'countloker', 'users', 'countTersedia', 'countDiterima', 'countDitolak', 'countMenunggu', 'NamaPerusahaan', 'hitungtujuanUser')); //buat ngirim ke blade

    }


    public function testEmail()
    {
        Mail::raw('Halo! Ini adalah email tes dari Laravel menggunakan Gmail SMTP.', function ($message) {
            $message->to('radityadp7224@gmail.com')
                ->subject('Tes Kirim Email dari Laravel');
        });

        return "Email berhasil dikirim!";
    }


    public function pengguna()
    {

        $users =  User::all();

        return view('pengguna-admin', compact('users',));
    }

    public function pengguna_edit(Request $request, $id)
    {
        $user = User::findOrFail($id); // Mengambil data user berdasarkan ID
        // return view('edit', compact('user')); // Mengirim data ke view edit


        // Validasi data
        $request->validate([
            'nama' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',

        ]);

        // Update nama perusahaan
        $user->nama = $request->nama;

        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Update email jika ada
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        // Update gambar jika ada file baru
        // if ($request->hasFile('gambar')) {
        //     // Hapus file lama jika ada
        //     if ($relasi->image_p) {
        //         Storage::delete('public/' . $relasi->gambar);
        //     }

        //     // Simpan file baru
        //     // $relasi->gambar = $request->file('gambar')->store('relasi', 'public');
        // }

        $user->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    public function Loker()
    {
        $lokers = Loker::all(); // Mengambil semua data loker
        return view('loker-admin', compact('lokers',));
        // Kirim data ke view
    }

    public function hapus_loker($id)
    {
        $loker = Loker::findOrFail($id);

        // Hapus file gambar jika ada
        if ($loker->gambar) {
            Storage::delete('public/' . $loker->gambar);
        }

        // Hapus data loker
        $loker->delete();

        return redirect()->back()->with('success', 'Loker berhasil dihapus!');
    }


    public function edit_loker(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // Jika ID sudah diambil dari URL, validasi di hidden field tidak wajib.
            // 'id' => 'required|exists:lokers,id',
            'judul'        => 'required|string|max:255',
            'detail'       => 'required|string',
            'detail_s'     => 'required|string',
            'max_pelamar'  => 'required|integer',
            'gaji_terendah' => 'required|integer',
            'gaji_tertinggi' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alamat'       => 'required|string',
            'jobdesk'      => 'required|string',
            'image_p'      => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
        ]);

        try {
            // Cari data loker berdasarkan ID dari route
            $loker = Loker::findOrFail($id);

            // Update data loker dengan input request
            $loker->judul          = $request->input('judul');
            $loker->detail         = $request->input('detail');
            $loker->detail_s       = $request->input('detail_s');
            $loker->max_pelamar    = $request->input('max_pelamar');
            $loker->gaji_terendah  = $request->input('gaji_terendah');
            $loker->gaji_tertinggi = $request->input('gaji_tertinggi');
            $loker->tanggal_mulai  = $request->input('tanggal_mulai');
            $loker->tanggal_selesai = $request->input('tanggal_selesai');
            $loker->alamat         = $request->input('alamat');
            $loker->jobdesk        = $request->input('jobdesk');

            // Jika ada file gambar baru yang diunggah, proses upload dan update kolom gambar
            if ($request->hasFile('image_p')) {
                if ($loker->gambar && Storage::exists('public/' . $loker->gambar)) {
                    Storage::delete('public/' . $loker->gambar);
                }
                $filePath = $request->file('image_p')->store('images/lokers', 'public');
                $loker->gambar = $filePath;
            }

            // Simpan data yang sudah diperbarui ke database
            $loker->save();

            return redirect()->back()->with('success', 'Data loker berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }


    // public function edit_loker(Request $request, $id)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'id' => 'required|exists:lokers,id',
    //         'judul' => 'required|string|max:255',
    //         'detail' => 'required|string',
    //         'detail_s' => 'required|string',
    //         'max_pelamar' => 'required|integer',
    //         'gaji_terendah' => 'required|integer',
    //         'gaji_tertinggi' => 'required|integer',
    //         'tanggal_mulai' => 'required|date',
    //         'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    //         'alamat' => 'required|string',
    //         'jobdesk' => 'required|string',
    //         'image_p' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048', // Opsional
    //     ]);

    //     try {
    //         // Cari data loker berdasarkan ID
    //         $loker = Loker::findOrFail($id);

    //         // Update data loker
    //         $loker->judul          = $request->input('judul');
    //         $loker->detail         = $request->input('detail');
    //         $loker->detail_s       = $request->input('detail_s');
    //         $loker->max_pelamar    = $request->input('max_pelamar');
    //         $loker->gaji_terendah  = $request->input('gaji_terendah');
    //         $loker->gaji_tertinggi = $request->input('gaji_tertinggi');
    //         $loker->tanggal_mulai  = $request->input('tanggal_mulai');
    //         $loker->tanggal_selesai = $request->input('tanggal_selesai');
    //         $loker->alamat         = $request->input('alamat');
    //         $loker->jobdesk        = $request->input('jobdesk');

    //         // Jika ada file gambar baru yang diunggah
    //         if ($request->hasFile('image_p')) {
    //             // Hapus gambar lama jika ada
    //             if ($loker->gambar && Storage::exists('public/' . $loker->gambar)) {
    //                 Storage::delete('public/' . $loker->gambar);
    //             }
    //             // Simpan gambar baru
    //             $filePath = $request->file('image_p')->store('images/lokers', 'public');
    //             $loker->gambar = $filePath;
    //         }

    //         // Simpan perubahan ke database
    //         $loker->save();

    //         return redirect()->back()->with('success', 'Data loker berhasil diperbarui.');
    //     } catch (\Exception $e) {
    //         // Redirect kembali dengan pesan error jika terjadi kesalahan
    //         return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    //     }
    // }

    public function Newton(Request $request)
    {

        // Validasi data
        // $request->validate([
        //     'judul' => 'required|string',
        //     'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        //     'detail' => 'required|string',
        //     'max_pelamar' => 'required|integer',
        //     'tanggal_mulai' => 'required|date',
        //     'tanggal_selesai' => 'required|date',
        // ]);

        // Mendapatkan file dari request
        $photo = $request->file('gambar');

        // Membuat nama file dengan format unik
        $filename = now()->format('Y-m-d_H-i-s') . $photo->getClientOriginalName();

        // Menentukan path penyimpanan di storage
        $path = 'loker-photos/' . $filename;

        // Menyimpan file ke direktori storage public
        Storage::disk('public')->put($path, file_get_contents($photo));

        // Menyimpan data ke database
        Loker::create([
            'judul' => $request->judul,
            'detail' => $request->input('detail'), // Simpan konten Quill.js
            'max_pelamar' => $request->max_pelamar,
            'tanggal_mulai' => $request->tanggal_mulai,
            'alamat' => $request->alamat,
            'tanggal_selesai' => $request->tanggal_selesai,
            'gaji_terendah' => $request->gaji_terendah,
            'gaji_tertinggi' => $request->gaji_tertinggi,
            'jobdesk' => $request->jobdesk,
            'detail_s' => $request->input('detail_s'), // Simpan konten Quill.js
            // 'masa_berlaku' => $request->masa_berlaku,
            'gambar' => $path, // Simpan path gambar
        ]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
    }


    public function relasi()
    {
        $relasi = Relasi::all(); // Ambil semua data dari tabel loker
        return view('relasi-admin', compact('relasi')); // Kirim data ke view

    }

    public function tambah_relasi(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_p' => 'required',
            'image_p' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        ]);

        // Mendapatkan file dari request
        $photo = $request->file('image_p');

        // Membuat nama file dengan format unik
        $filename = now()->format('Y-m-d_H-i-s') . $photo->getClientOriginalName();

        // Menentukan path penyimpanan di storage
        $path = 'relasi-photos/' . $filename;

        // Menyimpan file ke direktori storage public
        Storage::disk('public')->put($path, file_get_contents($photo));

        // Menyimpan data ke database
        $relasi = new Relasi(); // Pastikan modelnya bernama Relasi sesuai PSR standar
        $relasi->nama_p = $request->nama_p;
        $relasi->image_p = $path; // Menyimpan path file di kolom database

        $relasi->save(); // Menyimpan data ke database



        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');


        // $request->validate([
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

        // $login = [
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ];

        // #bakal return true or false logic   
        // if (Auth::attempt($login)) {
        //     return redirect()->route('home');
        // } else {
        //     return redirect()->route('login')->with('failed', 'E-mail atau password salah');
        // }

        // dd($data);
    }


    // buat edit di halaman pengguna
    public function relasi_edit(Request $request, $id)
    {
        $relasi = Relasi::findOrFail($id);

        // Validasi data
        $request->validate([
            'nama_p' => 'required|string|max:255',
            'image_p' => 'nullable|image|mimes:jpg,png,svg|max:2048',
        ]);

        // Update nama perusahaan
        $relasi->nama_p = $request->nama_p;

        // Update gambar jika ada file baru
        if ($request->hasFile('image_p')) {
            // Hapus file lama jika ada
            if ($relasi->image_p) {
                Storage::delete('public/' . $relasi->image_p);
            }

            // Simpan file baru
            $relasi->image_p = $request->file('image_p')->store('relasi', 'public');
        }

        $relasi->save();

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }


    public function relasi_destroy($id)
    {
        $relasi = Relasi::findOrFail($id);

        // Hapus file gambar jika ada
        if ($relasi->image_p) {
            Storage::delete('public/' . $relasi->image_p);
        }

        // Hapus data relasi
        $relasi->delete();

        return redirect()->back()->with('success', 'Relasi berhasil dihapus!');
    }

    //buat hapus akun paksa
    public function destroy($id)
    {
        $users = User::findOrFail($id); // Cari user berdasarkan ID
        $users->delete(); // Hapus user

        return redirect()->back()->with('success', 'User berhasil dihapus!');
    }



    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:Admin,User',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User berhasil dihapus.');
    }


    public function pelamars()
    {
        return $this->hasMany(apply_loker::class, 'id_lowongan');
    }


    public function new_loker(Request $request)
    {

        // Validasi data
        $request->validate([
            'judul' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
            'detail' => 'required|string',
            'detail_s' => 'required|string',
            'max_pelamar' => 'required|integer',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'alamat' => 'required|string',
        ]);

        // Mendapatkan file dari request
        $photo = $request->file('gambar');

        // Membuat nama file dengan format unik
        $filename = now()->format('Y-m-d_H-i-s') . $photo->getClientOriginalName();

        // Menentukan path penyimpanan di storage
        $path = 'loker-photos/' . $filename;

        // Menyimpan file ke direktori storage public
        Storage::disk('public')->put($path, file_get_contents($photo));

        // Menyimpan data ke database
        $loker = new Loker(); // Pastikan modelnya bernama Relasi sesuai PSR standar
        $loker->judul = $request->judul;
        $loker->gambar = $path; // Menyimpan path file di kolom database
        $loker->detail = $request->detail; // Menyimpan detail
        $loker->detail_s = $request->detail_s; // Menyimpan detail
        $loker->max_pelamar = $request->max_pelamar; // Menyimpan max_pelamar
        $loker->tanggal_mulai = $request->tanggal_mulai; // Menyimpan tanggal_mulai
        $loker->tanggal_selesai = $request->tanggal_selesai; // Menyimpan tanggal_selesai
        $loker->alamat = $request->alamat; // Menyimpan alamat

        // dump($loker);
        // $loker->status = $request->status; // Menyimpan status
        $loker->save(); // Menyimpan data ke database


        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Data berhasil disimpan!');
        // $request->validate([
        //     'nama' => 'required|string|max:255',
        //     'file' => 'required|file|mimes:jpg,png,svg,pdf|max:2048',
        //     'detail' => 'required|string',
        //     'max_pelamar' => 'required|integer',
        //     'gaji' => 'required|integer',
        //     'masaBerlaku' => 'required|date',
        // ]);

        // // Proses upload file
        // // if ($request->hasFile('file')) {
        // //     $path = $request->file('file')->store('uploads', 'public');
        // // }

        // $data['nama'] = $request->nama_lengkap;
        // $data['file'] = $request->email;
        // $data['detail'] = $this->encrypt_pass($request->password);

        // $userCreated = new Loker();
        // $userCreated->nama = $request->judul;
        // $userCreated->detail = $request->email;
        // $userCreated->password = $this->encrypt_pass($request->password);
        // $userCreated->role = 'user';
        // $userCreated->save();

        // // Simpan data ke database atau lakukan tindakan lain
        // // Contoh: $loker = new Loker();
        // // $loker->nama = $request->nama;
        // // $loker->file_path = $path;
        // // ...
        // // $loker->save();

        // return back()->with('success', 'Informasi loker berhasil ditambahkan!');


    }
    public function lihatPelamar($id)
    {
        // $lokerData = Loker::findOrFail($id); trap
        $jobData = Loker::findOrFail($id); // Mengambil semua pelamar untuk lowongan ini

        $pelamar = apply_loker::where('id_lowongan', $id)->get(); // Mengambil semua pelamar untuk lowongan ini
        //ngambil jumlah pelamar yang minn
        $jumlahPelamar = $pelamar->count(); // Mengambil jumlah pelamar yang ada

        return view('lihat-pelamar', compact('jobData', 'pelamar', 'jumlahPelamar')); // Mengirim data ke view
    }


    public function updateStatusPelamar(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diterima,ditolak'
        ]);

        $pelamar = apply_loker::findOrFail($id);
        $pelamar->status = $request->status;
        $pelamar->save();

        $emailTujuan = $pelamar->user->email;
        Mail::to($emailTujuan)
            ->send(new WelcomeDeveloper($pelamar));  // :contentReference[oaicite:0]{index=0}

        return back()->with('success', 'Status pelamar berhasil diperbarui.');
    }
    public function konfirmasiPelamar($id)
    {
        $pelamar = apply_loker::findOrFail($id);
        $pelamar->status = 'diterima';
        $pelamar->save();

        return back()->with('success', 'Pelamar berhasil dikonfirmasi.');
    }

    public function tolakPelamar($id)
    {
        $pelamar = apply_loker::findOrFail($id);
        $pelamar->status = 'ditolak';
        $pelamar->save();

        return back()->with('success', 'Pelamar berhasil ditolak.');
    }
}
