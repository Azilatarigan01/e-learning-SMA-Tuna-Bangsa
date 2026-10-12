@extends('layouts.app')

@section('container')
<!-- Header Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-graduation-cap fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            RUANG BELAJAR DIGITAL
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Materi & Sumber Belajar Kelas Saya</h3>
                        <p class="text-white-50 small mb-0">Akses seluruh modul pelajaran, rangkuman materi, dan video pembelajaran yang diunggah oleh guru Anda.</p>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill fs-6">
                        <i class="fa-solid fa-book-open text-warning me-1"></i> {{ $getRecord->count() }} Modul Tersedia
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Mapel -->
@if(!empty($getSubject) && $getSubject->count() > 0)
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="border-radius: 14px;">
            <div class="card-body p-3 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="fw-semibold text-dark small">
                    <i class="fa-solid fa-filter text-primary me-1"></i> Filter Mata Pelajaran:
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ url('student/materials/list') }}" class="btn btn-sm {{ !Request::get('subject_id') ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                        Semua Mapel
                    </a>
                    @foreach($getSubject as $sub)
                        <a href="{{ url('student/materials/list') }}?subject_id={{ $sub->subject_id }}" class="btn btn-sm {{ Request::get('subject_id') == $sub->subject_id ? 'btn-primary' : 'btn-outline-secondary' }} rounded-pill px-3">
                            {{ $sub->subject_name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Materials Grid -->
<div class="row g-4">
    @forelse($getRecord as $record)
    <div class="col-lg-6">
        <div class="card h-100 border-0 shadow-sm" style="border-radius: 16px; overflow: hidden; border-left: 5px solid #851624 !important;">
            <div class="card-body p-4 d-flex flex-column justify-content-between">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <span class="badge bg-primary px-3 py-1 rounded-pill fw-semibold">
                            {{ $record->meeting_number }}
                        </span>
                        <span class="badge bg-light text-secondary border px-2 py-1 small">
                            {{ !empty($record->subjectModel) ? $record->subjectModel->name : 'Mata Pelajaran' }}
                        </span>
                    </div>

                    <h5 class="fw-bold text-dark mb-2">{{ $record->title }}</h5>
                    <p class="text-muted small mb-3" style="min-height: 40px;">
                        {{ \Illuminate\Support\Str::limit($record->description, 120) }}
                    </p>

                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        @if(!empty($record->document_file))
                            <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill small border border-danger-subtle">
                                <i class="fa-solid fa-file-pdf me-1"></i> Modul Dokumen
                            </span>
                        @endif
                        @if(!empty($record->video_url))
                            <span class="badge bg-danger bg-opacity-10 text-danger px-2 py-1 rounded-pill small border border-danger-subtle">
                                <i class="fa-brands fa-youtube me-1"></i> Video Pembelajaran
                            </span>
                        @endif
                        @if(empty($record->document_file) && empty($record->video_url))
                            <span class="badge bg-secondary bg-opacity-10 text-secondary px-2 py-1 rounded-pill small">
                                <i class="fa-solid fa-file-lines me-1"></i> Catatan Pelajaran
                            </span>
                        @endif
                    </div>
                </div>

                <div class="pt-3 border-top d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        <div style="width: 28px; height: 28px; border-radius: 50%; background: #e0f2fe; color: #0284c7; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold;">
                            {{ !empty($record->teacher) ? strtoupper(substr($record->teacher->name, 0, 1)) : 'G' }}
                        </div>
                        <small class="text-muted fw-semibold">{{ !empty($record->teacher) ? $record->teacher->name : 'Guru' }}</small>
                    </div>
                    <a href="{{ url('student/materials/detail', $record->id) }}" class="btn btn-sm btn-primary px-3 fw-semibold">
                        <i class="fa-solid fa-book-open-reader me-1"></i> Pelajari Materi
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
            <div class="card-body">
                <i class="fa-solid fa-folder-open fa-3x text-muted mb-3 d-block"></i>
                <h6 class="fw-bold text-dark mb-1">Belum Ada Materi Pembelajaran</h6>
                <p class="text-muted small mb-0">Guru pengampu mata pelajaran belum mengunggah materi untuk kelas Anda.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
