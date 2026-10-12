@extends('layouts.app')

@section('container')
<!-- Header Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-book-open-reader fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            KURIKULUM & SUMBER BELAJAR DIGITAL
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Bank Materi Pembelajaran SMA Tuna Bangsa</h3>
                        <p class="text-white-50 small mb-0">Monitoring seluruh modul ajar, materi presentasi, dan video pembelajaran digital yang diunggah oleh dewan guru.</p>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill fs-6">
                        <i class="fa-solid fa-layer-group text-warning me-1"></i> Total {{ $getRecord->count() }} Modul Materi
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-3">
                <form method="GET" action="{{ url('admin/materials/list') }}" class="row g-2 align-items-center">
                    <div class="col-md-5">
                        <select name="class_id" class="form-select">
                            <option value="">-- Semua Kelas / Rombel --</option>
                            @foreach($getClass as $c)
                                <option value="{{ $c->id }}" {{ Request::get('class_id') == $c->id ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="subject_id" class="form-select">
                            <option value="">-- Semua Mata Pelajaran --</option>
                            @foreach($getSubject as $s)
                                <option value="{{ $s->id }}" {{ Request::get('subject_id') == $s->id ? 'selected' : '' }}>
                                    {{ $s->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fa-solid fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ url('admin/materials/list') }}" class="btn btn-outline-secondary" title="Reset Filter">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Table Card -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-folder-open text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Daftar Modul & Materi Pembelajaran Terunggah</h5>
                </div>
                <span class="badge bg-warning text-dark fw-bold px-3 py-2 rounded-pill">
                    {{ $getRecord->count() }} Data
                </span>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Pertemuan / Bab</th>
                                <th scope="col">Judul Materi Pembelajaran</th>
                                <th scope="col">Kelas & Mapel</th>
                                <th scope="col">Guru Pengunggah</th>
                                <th scope="col" class="text-center">Lampiran</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center" style="width: 90px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getRecord as $record)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="badge bg-primary px-3 py-2 rounded-pill fw-semibold">
                                        {{ $record->meeting_number }}
                                    </span>
                                </td>
                                <td>
                                    <div class="fw-bold text-dark fs-6">{{ $record->title }}</div>
                                    <small class="text-muted d-block" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        {{ $record->description }}
                                    </small>
                                </td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ !empty($record->classModel) ? $record->classModel->name : 'Kelas -' }}</div>
                                    <small class="badge bg-light text-secondary border px-2 py-0">
                                        {{ !empty($record->subjectModel) ? $record->subjectModel->name : 'Mapel -' }}
                                    </small>
                                </td>
                                <td>
                                    @if(!empty($record->teacher))
                                        <div class="d-flex align-items-center gap-2">
                                            <div style="width: 30px; height: 30px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold;">
                                                {{ strtoupper(substr($record->teacher->name, 0, 1)) }}
                                            </div>
                                            <span class="small fw-semibold text-dark">{{ $record->teacher->name }}</span>
                                        </div>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        @if(!empty($record->document_file))
                                            <a href="{{ $record->getDocument() }}" target="_blank" class="badge bg-danger text-white px-2 py-1 text-decoration-none" title="Unduh Dokumen">
                                                <i class="fa-solid fa-file-pdf me-1"></i> File
                                            </a>
                                        @endif
                                        @if(!empty($record->video_url))
                                            <a href="{{ $record->video_url }}" target="_blank" class="badge bg-danger text-white px-2 py-1 text-decoration-none" style="background: #dc2626 !important;" title="Tonton Video Pembelajaran">
                                                <i class="fa-brands fa-youtube me-1"></i> Video
                                            </a>
                                        @endif
                                        @if(empty($record->document_file) && empty($record->video_url))
                                            <span class="text-muted small">Teks rangkuman</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    @if($record->is_published == 1)
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-circle-check me-1"></i> Diterbitkan
                                        </span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2 rounded-pill">
                                            <i class="fa-solid fa-file-lines me-1"></i> Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.materials.delete', $record->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-2" title="Hapus Materi">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada data materi pembelajaran yang diunggah.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
