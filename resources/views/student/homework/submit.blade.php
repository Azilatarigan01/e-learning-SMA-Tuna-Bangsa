@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-upload mr-1"></i> Penyerahan Tugas Mandiri
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Kirimkan Lembar Jawaban & Berkas Tugas</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Unggah hasil kerja tugas Anda sebelum batas waktu tenggat berakhir.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('student/my_homework') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Tugas Saya
                        </a>
                    </div>
                </div>
            </div>
            @include('_message')
        </div>
    </div>

    <section class="content">
        <div class="container-fluid pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                        <div class="card-body p-4">
                            @if (session('error'))
                                <div class="alert alert-danger" style="border-radius: 10px;">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('student.my_homework.submit_homework.insert', ['id' => $getRecord->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Unggah Berkas Tugas / Lembar Jawaban <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control-file p-3" id="document" name="document_file" required style="border: 2px dashed #c59b27; border-radius: 10px; width: 100%; background: #faf8f5;">
                                    <small class="text-muted d-block mt-2">Dukungan format berkas: PDF, DOCX, ZIP, JPG, PNG (Maksimal 15MB).</small>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Ringkasan Jawaban / Catatan Siswa <span class="text-danger">*</span></label>
                                    <textarea id="description" name="description" class="form-control" placeholder="Tuliskan jawaban singkat, ringkasan pengerjaan, atau catatan yang ingin disampaikan kepada guru..." style="height: 220px; border-radius: 10px;" required></textarea>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('student/my_homework') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                                    <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                        <i class="fas fa-paper-plane mr-1"></i> Kirim Tugas Sekarang
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
