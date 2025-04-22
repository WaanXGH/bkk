@extends('layouts.applicant')
{{-- Sesuaikan path: layouts/applicant --}}

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Bagian Header Info Lowongan -->
        <div class="row">
            <div class="col-md-2 text-center">
                {{-- Gambar Perusahaan diambil dari field 'gambar' misalnya --}}
                <img src="{{ asset('storage/' . $jobData->gambar) }}" alt="Logo Perusahaan" class="img-fluid mb-2" style="max-height: 80px;">
            </div>
            <div class="col-md-10">
                <h4 class="fw-bold">{{ $jobData->judul }}</h4>
                <span
                    class="badge 
                    @if($jobData->status == 'Tersedia') bg-success 
                    @elseif($jobData->status == 'Penuh') bg-danger 
                    @else bg-secondary @endif">
                    {{ $jobData->status }}
                </span>
                <p class="text-muted mt-2">
                    {{ $jobData->deskripsi_lamaran ?? 'Deskripsi tidak tersedia.' }}
                </p>
            </div>
        </div>
        <hr>

        <!-- Info Loker Singkat -->
        <div class="row mb-3">
            <div class="col-md-3 col-sm-6">
                <h6 class="text-muted">Tanggal Dimulai</h6>
                <p>{{ $jobData->tanggal_mulai }}</p>
            </div>
            <div class="col-md-3 col-sm-6">
                <h6 class="text-muted">Tanggal Berakhir</h6>
                <p>{{ $jobData->tanggal_selesai }}</p>
            </div>
            <div class="col-md-3 col-sm-6">
                <h6 class="text-muted">Total Pelamar</h6>
                <p>{{ $jumlahPelamar }}</p>
            </div>
            <div class="col-md-3 col-sm-6">
                <h6 class="text-muted">Max Pelamar</h6>
                <p>{{ $jobData->max_pelamar }}</p>
            </div>
        </div>

        <!-- Tabel Pelamar -->
        <h5 class="mb-3">Daftar Pelamar</h5>
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Tempat & Tanggal Lahir</th>
                        <th>Nomor Telepon</th>
                        <th>CV</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelamar as $index => $dataItem)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $dataItem->NIK }}</td>
                        <td>{{ $dataItem->nama_lengkap }}</td>
                        <td>{{ $dataItem->tempat_lahir }}, {{ $dataItem->tanggal_lahir }}</td>
                        <td>{{ $dataItem->no_hp }}</td>

                        <td>
                            @if ($dataItem->file_cv)
                            <!-- Tombol -->
                            <!-- Tombol untuk Membuka Modal -->
                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#cvModal{{ $dataItem->id }}">
                                Lihat CV
                            </button>

                            <!-- Modal Pop-Up -->
                            <div class="modal fade" id="cvModal{{ $dataItem->id }}" tabindex="-1" aria-labelledby="cvModalLabel{{ $dataItem->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="cvModalLabel{{ $dataItem->id }}"> CV - {{ $dataItem->nama_lengkap }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <iframe
                                                src="{{ asset('storage/' . $dataItem->file_cv) }}"
                                                frameborder="0"
                                                style="width: 100%; height: 100vh; border: none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <span class="text-muted">Tidak ada CV</span>
                            @endif
                        </td>

                        <td>
                            @if(empty($dataItem->status) || $dataItem->status == 'menunggu')
                            <!-- Konfirmasi -->
                            <form action="{{ route('admin.pelamar.updateStatus', $dataItem->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="diterima">
                                <button type="submit" class="btn btn-success btn-sm">Konfirmasi</button>
                            </form>

                            <!-- Tolak -->
                            <form action="{{ route('admin.pelamar.updateStatus', $dataItem->id) }}" method="POST" style="display: inline;">

                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                            </form>
                            @else
                            <span class="badge 
        @if($dataItem->status == 'diterima') bg-success 
        @elseif($dataItem->status == 'ditolak') bg-danger 
        @else bg-secondary 
        @endif">
                                {{ ucfirst($dataItem->status) }}
                            </span>
                            @endif
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data pelamar</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>