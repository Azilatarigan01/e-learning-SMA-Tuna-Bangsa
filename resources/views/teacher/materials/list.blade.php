@extends('layouts.app')

@section('container')
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-book-bookmark text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Modul & Bahan Pembelajaran Digital Saya</h5>
                </div>
                <a href="{{ url('teacher/materials/add') }}" class="btn btn-sm btn-warning text-dark fw-bold px-3">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Materi Baru
                </a>
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

                <!-- Filter -->
                <form method="GET" action="{{ url('teacher/materials/list') }}" class="row g-2 align-items-center mb-4 p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
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
                        <a href="{{ url('teacher/materials/list') }}" class="btn btn-outline-secondary">
                            <i class="fa-solid fa-rotate-left"></i>
                        </a>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Pertemuan / Bab</th>
                                <th scope="col">Judul Materi</th>
                                <th scope="col">Kelas & Mapel</th>
                                <th scope="col" class="text-center">Lampiran</th>
                                <th scope="col" class="text-center">Status</th>
                                <th scope="col" class="text-center">Dibuat Pada</th>
                                <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
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
                                    <div class="fw-semibold text-dark">{{ !empty($record->classModel) ? $record->classModel->name : '-' }}</div>
                                    <small class="badge bg-light text-secondary border px-2 py-0">
                                        {{ !empty($record->subjectModel) ? $record->subjectModel->name : '-' }}
                                    </small>
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-1">
                                        @if(!empty($record->document_file))
                                            <a href="{{ $record->getDocument() }}" target="_blank" class="badge bg-danger text-white px-2 py-1 text-decoration-none">
                                                <i class="fa-solid fa-file-arrow-down me-1"></i> Modul
                                            </a>
                                        @endif
                                        @if(!empty($record->video_url))
                                            <a href="{{ $record->video_url }}" target="_blank" class="badge bg-danger text-white px-2 py-1 text-decoration-none" style="background: #dc2626 !important;">
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
                                <td class="text-center text-muted small">
                                    {{ date('d M Y', strtotime($record->created_at)) }}
                                </td>
                                <td class="text-center">
                                    <div class="d-inline-flex gap-2">
                                        <a href="{{ url('teacher/materials/edit', $record->id) }}" class="btn btn-sm btn-primary px-2" title="Edit Materi">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <form action="{{ route('teacher.materials.delete', $record->id) }}" method="POST" onsubmit="return confirm('Hapus materi ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger px-2" title="Hapus Materi">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Anda belum mengunggah materi pembelajaran. Silakan klik tombol <strong>Tambah Materi Baru</strong>.
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
