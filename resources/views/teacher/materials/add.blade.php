@extends('layouts.app')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-cloud-arrow-up text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Unggah Materi & Bahan Ajar Baru</h5>
                </div>
                <a href="{{ url('teacher/materials/list') }}" class="btn btn-sm btn-outline-light px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>
            </div>
            <div class="card-body p-4">
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
                <form method="POST" action="{{ url('teacher/materials/add') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Target Kelas / Rombel <span class="text-danger">*</span></label>
                            <select class="form-select" id="getClass" name="class_id" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($getClass as $class)
                                    <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Mata Pelajaran <span class="text-danger">*</span></label>
                            <select class="form-select" id="getSubject" name="subject_id" required>
                                <option value="">-- Pilih Kelas Terlebih Dahulu --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Bab / Pertemuan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="meeting_number" required placeholder="Contoh: Pertemuan 1, Bab 3..." value="{{ old('meeting_number', 'Pertemuan 1') }}">
                        </div>
                        <div class="col-md-8 mb-3">
                            <label class="form-label fw-semibold">Judul Materi Pembelajaran <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" required placeholder="Contoh: Hukum Newton dan Penerapannya..." value="{{ old('title') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Lampirkan File Dokumen / Modul</label>
                            <input type="file" class="form-control" name="document_file" accept=".pdf,.doc,.docx,.ppt,.pptx,.zip,.rar">
                            <small class="text-muted">Format: PDF, PPTX, DOCX, ZIP (Maksimal 25 MB).</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Link Video Pembelajaran (YouTube/Eksternal)</label>
                            <input type="url" class="form-control" name="video_url" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url') }}">
                            <small class="text-muted">Opsional. Siswa dapat memutar video langsung dari LMS.</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Deskripsi & Rangkuman Materi Pembelajaran</label>
                        <textarea class="form-control" name="description" rows="5" placeholder="Tuliskan petunjuk belajar, ringkasan konsep penting, poin-poin yang perlu dipahami siswa...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status Publikasi <span class="text-danger">*</span></label>
                        <select class="form-select" name="is_published" required>
                            <option value="1" selected>Terbitkan Sekarang (Siswa Langsung Bisa Mengakses)</option>
                            <option value="0">Simpan Sebagai Draft (Belum Ditampilkan ke Siswa)</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ url('teacher/materials/list') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-cloud-arrow-up me-1"></i> Simpan & Unggah Materi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#getClass').change(function(){
            var class_id = $(this).val();
            if(class_id){
                $.ajax({
                    type: "POST",
                    url: "{{ route('teacher.materials.ajax_get_subject') }}",
                    data : {
                        "_token": "{{ csrf_token() }}",
                        class_id : class_id,
                    },
                    dataType :"json",
                    success:function(response){
                        $('#getSubject').empty();
                        $('#getSubject').append(response.success);
                    }
                });
            } else {
                $('#getSubject').html('<option value="">-- Pilih Kelas Terlebih Dahulu --</option>');
            }
        });
    });
</script>
@endsection
