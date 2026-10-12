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
                            TAHAP 8: BUAT PENGUMUMAN
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Publikasikan Pengumuman Sekolah</h3>
                        <p class="text-white-50 small mb-0">Kirimkan edaran informasi kepada guru, siswa, atau kelas tertentu di SMA Tuna Bangsa.</p>
                    </div>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.notice_board.list') }}" class="btn btn-outline-light px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mb-4" style="border-radius: 14px;">
    <div class="card-header bg-white py-3 px-4 border-bottom">
        <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
            <i class="fa-solid fa-pen-nib text-danger"></i> Formulir Publikasi Pengumuman
        </h6>
    </div>
    <div class="card-body p-4">
        <form method="POST" action="{{ route('admin.notice_board.insert') }}">
            @csrf

            <div class="row g-3 mb-3">
                <div class="col-md-8">
                    <label class="form-label fw-semibold small">Judul Pengumuman <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control shadow-sm" required placeholder="Contoh: Edaran Pelaksanaan Ujian Tengah Semester Ganjil 2026/2027">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Tanggal Terbit <span class="text-danger">*</span></label>
                    <input type="date" name="notice_date" class="form-control shadow-sm" required value="{{ date('Y-m-d') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Target Audiens <span class="text-danger">*</span></label>
                    <select name="message_to" class="form-select shadow-sm" required>
                        <option value="all">Semua Warga Sekolah (Guru & Siswa)</option>
                        <option value="teacher">Dewan Guru Saja</option>
                        <option value="student">Seluruh Siswa Saja</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Tingkat Prioritas <span class="text-danger">*</span></label>
                    <select name="priority" class="form-select shadow-sm" required>
                        <option value="normal">Normal (Informasi Umum)</option>
                        <option value="urgent">Penting / Urgent (Highlight Merah)</option>
                        <option value="info">Pemberitahuan Khusus</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Target Rombel Spesifik (Opsional)</label>
                    <select name="target_class_id" class="form-select shadow-sm">
                        <option value="">-- Semua Kelas (Tidak Terbatas) --</option>
                        @foreach($classes as $c)
                            <option value="{{ $c->id }}">{{ $c->name }} (40 Siswa)</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label fw-semibold small">Isi Pesan Pengumuman <span class="text-danger">*</span></label>
                    <textarea name="message" class="form-control shadow-sm" rows="6" required placeholder="Tuliskan isi edaran atau instruksi pengumuman secara rinci..."></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.notice_board.list') }}" class="btn btn-light border px-4">Batal</a>
                <button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #851624; border-color: #851624;">
                    <i class="fa-solid fa-paper-plane me-1"></i> Terbitkan Pengumuman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
