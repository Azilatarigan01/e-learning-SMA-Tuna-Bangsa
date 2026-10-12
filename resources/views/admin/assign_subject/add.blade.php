@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-layer-group mr-1"></i> Alokasi Kurikulum
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Tambah Alokasi Mata Pelajaran ke Kelas</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Hubungkan rombongan belajar kelas dengan pilihan mata pelajaran aktif.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar
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
                            <form method="POST" action="{{ route('assign_subject.insert') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted">Pilih Rombel Kelas <span class="text-danger">*</span></label>
                                    <select class="form-control" name="class_id" required style="border-radius: 8px;">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($getClass as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-2">Pilih Mata Pelajaran <span class="text-danger">*</span></label>
                                    <div class="p-3 border rounded bg-light" style="max-height: 250px; overflow-y: auto; border-radius: 8px;">
                                        @foreach ($getSubject as $subject)
                                            <div class="custom-control custom-checkbox mb-2">
                                                <input type="checkbox" class="custom-control-input" id="sub_{{ $subject->id }}" value="{{ $subject->id }}" name="subject_id[]">
                                                <label class="custom-control-label font-weight-normal text-dark" for="sub_{{ $subject->id }}" style="cursor: pointer;">
                                                    {{ $subject->name }} <small class="text-muted">({{ $subject->type }})</small>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Status Keaktifan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" style="border-radius: 8px;">
                                        <option value="0">Aktif</option>
                                        <option value="1">Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('admin/assign_subject/list') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                                    <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                        <i class="fas fa-save mr-1"></i> Simpan Penugasan
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
