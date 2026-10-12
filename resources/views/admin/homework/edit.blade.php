@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-edit mr-1"></i> Perbarui Tugas Siswa
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Edit Tugas / Pekerjaan Rumah</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Perbarui rincian instruksi, tenggat waktu pengumpulan, atau dokumen tugas.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/homework/homework') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Tugas
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
                <div class="col-lg-10">
                    <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                        <div class="card-body p-4">
                            @if (session('error'))
                                <div class="alert alert-danger" style="border-radius: 10px;">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.homework.update', $getRecord->id) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold small text-muted">Kelas / Rombel Sasaran <span class="text-danger">*</span></label>
                                            <select class="form-control" id="getClass" name="class_id" required style="border-radius: 8px;">
                                                <option value="">Pilih Kelas</option>
                                                @foreach ($getClass as $class)
                                                    <option {{ ($getRecord->class_id == $class->id) ? 'selected' : ''}} value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold small text-muted">Mata Pelajaran <span class="text-danger">*</span></label>
                                            <select class="form-control" id="getSubject" name="subject_id" required style="border-radius: 8px;">
                                                <option value="">Pilih Subject</option>
                                                @foreach ($getSubject as $subject)
                                                    <option {{ ($getRecord->subject_id == $subject->subject_id) ? 'selected' : ''}} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold small text-muted">Tanggal Diberikan <span class="text-danger">*</span></label>
                                            <input type="date" value="{{ $getRecord->homework_date }}" class="form-control" id="homework_date" name="homework_date" required style="border-radius: 8px;">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold small text-muted">Batas Pengumpulan (Deadline) <span class="text-danger">*</span></label>
                                            <input type="date" value="{{ $getRecord->submission_date }}" class="form-control" id="submission_date" name="submission_date" required style="border-radius: 8px;">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold small text-muted">Dokumen / Lampiran Tugas</label>
                                            <input type="file" class="form-control-file p-2 mb-2" id="document" name="document_file" style="border: 1px dashed #c59b27; border-radius: 8px; width: 100%; background: #faf8f5;">
                                            @if(!empty($getRecord->getDocument()))
                                                <div class="p-2 rounded bg-light border d-flex align-items-center justify-content-between">
                                                    <span class="small text-muted"><i class="fas fa-paperclip mr-1 text-primary"></i> Berkas terlampir saat ini</span>
                                                    <a href="{{ $getRecord->getDocument() }}" class="btn btn-sm btn-outline-danger font-weight-bold" download>
                                                        <i class="fas fa-download mr-1"></i> Unduh Berkas
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="font-weight-bold small text-muted">Deskripsi & Instruksi Pengerjaan <span class="text-danger">*</span></label>
                                            <textarea id="description" name="description" class="form-control" style="height: 320px; border-radius: 8px;" required>{{ $getRecord->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mt-3">
                                    <a href="{{ url('admin/homework/homework') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                                    <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        $('#getClass').change(function(){
            var class_id = $(this).val();
            if(!class_id) {
                $('#getSubject').html('<option value="">Pilih Rombel terlebih dahulu</option>');
                return;
            }
            $.ajax({
                type: "POST",
                url: "{{ route('admin.ajax_get_subject') }}",
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
        });
    });
</script>
@endsection
