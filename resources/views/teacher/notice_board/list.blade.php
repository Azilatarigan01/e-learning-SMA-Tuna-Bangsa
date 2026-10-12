@extends('layouts.app')

@section('container')
<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 58px; height: 58px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-bullhorn fs-2 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            TAHAP 8: PENGUMUMAN & INFORMASI
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Papan Pengumuman & Informasi Guru</h3>
                        <p class="text-white-50 small mb-0">Lihat pengumuman resmi sekolah dan terbitkan edaran langsung untuk kelas yang Anda ajar / bina.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-warning text-dark fw-bold px-3 shadow-sm" data-bs-toggle="modal" data-bs-target="#postNoticeModal">
                        <i class="fa-solid fa-plus me-1"></i> Buat Pengumuman Kelas
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm d-flex align-items-center gap-2 mb-4" role="alert" style="border-radius: 12px;">
    <i class="fa-solid fa-circle-check fs-5"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Announcement Feed -->
<div class="row g-4">
    @forelse($notices as $n)
        <div class="col-lg-6 col-12">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid {{ $n->priority == 'urgent' ? '#dc3545' : ($n->priority == 'info' ? '#0d6efd' : '#851624') }} !important;">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge {{ $n->priority == 'urgent' ? 'bg-danger' : ($n->priority == 'info' ? 'bg-primary' : 'bg-secondary') }} fw-bold px-2 py-1">
                                {{ strtoupper($n->priority) }}
                            </span>
                            <small class="text-muted">
                                <i class="fa-regular fa-calendar me-1"></i> {{ date('d M Y', strtotime($n->notice_date)) }}
                            </small>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">{{ $n->title }}</h5>
                        <p class="text-secondary small mb-3" style="line-height: 1.6; white-space: pre-line;">{{ $n->message }}</p>
                    </div>
                    <div class="pt-3 border-top d-flex justify-content-between align-items-center text-muted small">
                        <span>
                            <i class="fa-solid fa-user-tie me-1"></i> Oleh: <strong>{{ $n->author->name ?? 'Admin Sekolah' }}</strong>
                        </span>
                        @if($n->target_class_id)
                            <span class="badge bg-light text-dark border">
                                <i class="fa-solid fa-chalkboard me-1"></i> {{ $n->targetClass->name ?? 'Kelas' }}
                            </span>
                        @else
                            <span class="badge bg-light text-primary border">
                                <i class="fa-solid fa-globe me-1"></i> Seluruh Sekolah
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="card border-0 shadow-sm p-5 text-center" style="border-radius: 14px;">
                <i class="fa-solid fa-envelope-open-text fs-1 text-muted mb-3 d-block"></i>
                <h5 class="fw-bold text-dark">Belum ada pengumuman untuk Anda</h5>
                <p class="text-muted small">Informasi atau edaran resmi sekolah akan muncul di sini.</p>
            </div>
        </div>
    @endforelse
</div>

<!-- Modal Post Notice -->
<div class="modal fade" id="postNoticeModal" tabindex="-1" aria-labelledby="postNoticeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 16px;">
            <div class="modal-header border-bottom py-3 px-4">
                <h6 class="modal-title fw-bold text-dark" id="postNoticeModalLabel">
                    <i class="fa-solid fa-bullhorn text-danger me-2"></i> Buat Pengumuman untuk Siswa
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('teacher.notice_board.post') }}">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Judul Pengumuman <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" required placeholder="Contoh: Pengingat Tugas Proyek & Buku Catatan">
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Tanggal <span class="text-danger">*</span></label>
                            <input type="date" name="notice_date" class="form-control" required value="{{ date('Y-m-d') }}">
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Prioritas <span class="text-danger">*</span></label>
                            <select name="priority" class="form-select" required>
                                <option value="normal">Normal</option>
                                <option value="urgent">Penting / Mendesak</option>
                                <option value="info">Informasi</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Target Rombel / Kelas <span class="text-danger">*</span></label>
                        <select name="target_class_id" class="form-select" required>
                            @foreach($classes as $c)
                                <option value="{{ $c->id }}">{{ $c->name }} (40 Siswa)</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Isi Pesan <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="4" required placeholder="Tuliskan pesan instruksi untuk siswa..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top py-3 px-4">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold" style="background-color: #851624; border-color: #851624;">
                        <i class="fa-solid fa-paper-plane me-1"></i> Terbitkan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
