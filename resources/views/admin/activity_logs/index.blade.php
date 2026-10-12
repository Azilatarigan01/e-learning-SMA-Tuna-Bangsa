@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-history"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-shield-alt mr-1"></i> Keamanan & Transparansi Data
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Jejak Audit & Riwayat Aktivitas Sistem
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Log pencatatan perubahan data nilai, presensi, jadwal, ujian, dan akun pengguna secara transparan sesuai standar PRD.
                        </p>
                    </div>
                </div>
            </div>

            @include('_message')
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <!-- Filter Bar -->
            <div class="card border-0 shadow-sm rounded-14 mb-4" style="border-radius: 14px; background: #fff;">
                <div class="card-body p-3">
                    <form method="GET" action="{{ route('admin.activity_logs') }}" class="form-row align-items-center">
                        <div class="col-md-5 mb-2 mb-md-0">
                            <label class="small text-muted font-weight-bold mb-1"><i class="fas fa-cubes mr-1"></i> Filter Modul</label>
                            <select name="module" class="form-control form-control-sm" style="border-radius: 8px; border: 1px solid #ddd;" onchange="this.form.submit()">
                                <option value="">-- Semua Modul --</option>
                                <option value="Nilai & Asesmen" {{ $selectedModule == 'Nilai & Asesmen' ? 'selected' : '' }}>Nilai & Asesmen</option>
                                <option value="Presensi" {{ $selectedModule == 'Presensi' ? 'selected' : '' }}>Presensi</option>
                                <option value="Jadwal KBM" {{ $selectedModule == 'Jadwal KBM' ? 'selected' : '' }}>Jadwal KBM</option>
                                <option value="CBT Exam" {{ $selectedModule == 'CBT Exam' ? 'selected' : '' }}>CBT Exam</option>
                                <option value="Pengumuman" {{ $selectedModule == 'Pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                                <option value="Akun & Autentikasi" {{ $selectedModule == 'Akun & Autentikasi' ? 'selected' : '' }}>Akun & Autentikasi</option>
                            </select>
                        </div>
                        <div class="col-md-5 mb-2 mb-md-0">
                            <label class="small text-muted font-weight-bold mb-1"><i class="fas fa-bolt mr-1"></i> Jenis Tindakan (Action)</label>
                            <select name="action" class="form-control form-control-sm" style="border-radius: 8px; border: 1px solid #ddd;" onchange="this.form.submit()">
                                <option value="">-- Semua Tindakan --</option>
                                <option value="Create" {{ $selectedAction == 'Create' ? 'selected' : '' }}>Create (Tambah Data)</option>
                                <option value="Update" {{ $selectedAction == 'Update' ? 'selected' : '' }}>Update (Perbarui Data)</option>
                                <option value="Delete" {{ $selectedAction == 'Delete' ? 'selected' : '' }}>Delete (Hapus Data)</option>
                                <option value="Publish" {{ $selectedAction == 'Publish' ? 'selected' : '' }}>Publish (Publikasi)</option>
                                <option value="Grading" {{ $selectedAction == 'Grading' ? 'selected' : '' }}>Grading (Penilaian)</option>
                            </select>
                        </div>
                        <div class="col-md-2 text-right pt-md-3">
                            <a href="{{ route('admin.activity_logs') }}" class="btn btn-sm btn-outline-secondary btn-block font-weight-bold" style="border-radius: 8px;">
                                <i class="fas fa-redo-alt mr-1"></i> Reset
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Audit Log Table -->
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff; overflow: hidden;">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-list-alt mr-2" style="color: #851624;"></i> Catatan Riwayat Audit Terbaru
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Menampilkan: {{ count($logs) }} Log Aktivitas
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 170px;">Waktu & Tanggal</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Pengguna (Aktor)</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Modul</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Tindakan</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Rincian Perubahan Data</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-right" style="width: 130px;">IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                <tr>
                                    <td class="px-4 py-3 small text-muted font-weight-bold">
                                        <i class="far fa-clock mr-1 text-danger"></i> {{ date('d M Y, H:i:s', strtotime($log->created_at)) }}
                                    </td>
                                    <td class="py-3">
                                        <div class="font-weight-bold text-dark">{{ $log->user->name ?? 'Sistem Otomatis' }}</div>
                                        <small class="text-muted">
                                            @if($log->user)
                                                @if($log->user->user_type == 1) Administrator
                                                @elseif($log->user->user_type == 2) Guru Pengajar
                                                @elseif($log->user->user_type == 3) Siswa
                                                @elseif($log->user->user_type == 4) Orang Tua
                                                @endif
                                            @endif
                                        </small>
                                    </td>
                                    <td class="py-3 text-center">
                                        <span class="badge badge-light border px-2 py-1 font-weight-bold text-dark" style="border-radius: 8px;">
                                            {{ $log->module }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center">
                                        @if($log->action == 'Create')
                                            <span class="badge badge-success px-2 py-1 font-weight-bold" style="border-radius: 8px;">CREATE</span>
                                        @elseif($log->action == 'Update' || $log->action == 'Grading')
                                            <span class="badge badge-warning text-dark px-2 py-1 font-weight-bold" style="background: #fdf0cd; border-radius: 8px;">UPDATE</span>
                                        @elseif($log->action == 'Delete')
                                            <span class="badge badge-danger px-2 py-1 font-weight-bold" style="border-radius: 8px;">DELETE</span>
                                        @elseif($log->action == 'Publish')
                                            <span class="badge badge-info px-2 py-1 font-weight-bold" style="border-radius: 8px;">PUBLISH</span>
                                        @else
                                            <span class="badge badge-secondary px-2 py-1 font-weight-bold" style="border-radius: 8px;">{{ strtoupper($log->action) }}</span>
                                        @endif
                                    </td>
                                    <td class="py-3" style="max-width: 380px;">
                                        <span class="text-dark" style="font-size: 0.9rem; line-height: 1.4;">
                                            {{ $log->description }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right text-muted small font-weight-bold">
                                        {{ $log->ip_address ?: '127.0.0.1' }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="fas fa-clipboard-check mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                                        <p class="mb-0">Belum ada riwayat aktivitas yang tercatat pada filter ini.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
