@extends('layouts.app')

@section('container')
@php
    $embedUrl = null;
    if(!empty($getRecord->video_url)) {
        if(preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/', $getRecord->video_url, $match)) {
            $embedUrl = "https://www.youtube.com/embed/" . $match[1];
        } else {
            $embedUrl = $getRecord->video_url;
        }
    }
@endphp

<!-- Header Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-book-open-reader fs-3 text-warning"></i>
                    </div>
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold">
                                {{ $getRecord->meeting_number }}
                            </span>
                            <span class="badge bg-white bg-opacity-20 text-white px-3 py-1 rounded-pill">
                                {{ !empty($getRecord->subjectModel) ? $getRecord->subjectModel->name : 'Mata Pelajaran' }}
                            </span>
                        </div>
                        <h3 class="fw-bold mb-1 text-white">{{ $getRecord->title }}</h3>
                        <div class="text-white-50 small">
                            <i class="fa-solid fa-chalkboard-user text-warning me-1"></i> Guru Pengajar: 
                            <strong>{{ !empty($getRecord->teacher) ? $getRecord->teacher->name : '-' }}</strong> &bull; 
                            <i class="fa-regular fa-clock text-warning ms-2 me-1"></i> 
                            Diterbitkan pada {{ date('d M Y, H:i', strtotime($getRecord->created_at)) }}
                        </div>
                    </div>
                </div>
                <div>
                    <a href="{{ url('student/materials/list') }}" class="btn btn-outline-light px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar Materi
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Main Content: Video & Study Notes -->
    <div class="col-lg-8">
        @if(!empty($embedUrl))
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; overflow: hidden;">
                <div class="card-header bg-dark text-white py-3 px-4 d-flex align-items-center gap-2">
                    <i class="fa-brands fa-youtube text-danger fs-5"></i>
                    <h6 class="mb-0 fw-bold">Video Penjelasan Materi</h6>
                </div>
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $embedUrl }}" title="Video Pembelajaran" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>
                    </div>
                </div>
            </div>
        @endif

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center gap-2">
                <i class="fa-solid fa-align-left text-primary fs-5"></i>
                <h6 class="mb-0 fw-bold text-dark">Rangkuman & Panduan Belajar</h6>
            </div>
            <div class="card-body p-4">
                @if(!empty($getRecord->description))
                    <div class="text-dark" style="font-size: 1rem; line-height: 1.8; white-space: pre-line;">
                        {{ $getRecord->description }}
                    </div>
                @else
                    <p class="text-muted italic mb-0">Tidak ada catatan teks tambahan untuk materi ini.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Sidebar: Lampiran Dokumen & Metadata -->
    <div class="col-lg-4">
        @if(!empty($getRecord->document_file))
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background: #fff8f8; border: 1px solid rgba(133, 22, 36, 0.2) !important;">
                <div class="card-body p-4 text-center">
                    <div style="width: 60px; height: 60px; border-radius: 16px; background: rgba(133, 22, 36, 0.1); color: #851624; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px;">
                        <i class="fa-solid fa-file-pdf fs-2"></i>
                    </div>
                    <h6 class="fw-bold text-dark mb-1">Modul Pembelajaran Tersedia</h6>
                    <p class="text-muted small mb-3 text-truncate">{{ $getRecord->document_file }}</p>
                    <a href="{{ $getRecord->getDocument() }}" target="_blank" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="fa-solid fa-download me-1"></i> Unduh File Modul
                    </a>
                </div>
            </div>
        @endif

        <div class="card border-0 shadow-sm" style="border-radius: 16px;">
            <div class="card-header bg-white py-3 px-4 border-bottom">
                <h6 class="mb-0 fw-bold text-dark">Informasi Materi</h6>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Kelas:</span>
                    <span class="fw-bold text-dark small">{{ !empty($getRecord->classModel) ? $getRecord->classModel->name : '-' }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Mata Pelajaran:</span>
                    <span class="fw-bold text-dark small">{{ !empty($getRecord->subjectModel) ? $getRecord->subjectModel->name : '-' }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-2 border-bottom">
                    <span class="text-muted small">Pertemuan:</span>
                    <span class="badge bg-primary">{{ $getRecord->meeting_number }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Guru:</span>
                    <span class="fw-bold text-dark small">{{ !empty($getRecord->teacher) ? $getRecord->teacher->name : '-' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
