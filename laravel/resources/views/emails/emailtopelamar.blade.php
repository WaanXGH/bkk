<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $pelamar->status === 'diterima' ? 'Diterima' : 'Ditolak' }}</title>
</head>

<body>
    <p>Halo {{ $pelamar->nama_lengkap }},</p>

    @if($pelamar->status === 'diterima')
    <p>Selamat! Lamaran Anda untuk posisi <strong>{{ $pelamar->job->judul }}</strong> telah <strong>DITERIMA</strong>.</p>
    <p>Silakan cek dashboard Anda untuk informasi selanjutnya.</p>
    @else
    <p>Terima kasih atas minat Anda pada posisi <strong>{{ $pelamar->job->judul }}</strong>,</p>
    <p>Namun saat ini kami memutuskan untuk <strong>MENOLAK</strong> lamaran Anda. Jangan berkecil hati, semoga sukses pada kesempatan berikutnya.</p>
    @endif

    <p>Salam,<br>Tim HR</p>
</body>

</html>