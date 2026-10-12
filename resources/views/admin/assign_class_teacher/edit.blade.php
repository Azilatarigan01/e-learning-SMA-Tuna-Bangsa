@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-chalkboard-teacher mr-1"></i> Perbarui Wali Kelas / Pengampu
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Edit Penugasan Guru ke Kelas</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Perbarui penugasan guru pengampu dan pembina kelas di SMA Tuna Bangsa.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/assign_class_teacher/list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
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
                            @if(session('error'))
                                <div class="alert alert-danger" style="border-radius: 10px;">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form id="editForm" method="POST" action="{{ route('assign_class_teacher.update', $record->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Kelas / Rombongan Belajar <span class="text-danger">*</span></label>
                                    <select class="form-control" name="class_id" id="class_id" required style="border-radius: 8px;">
                                        <option value="">Pilih Rombel</option>
                                        @foreach ($getClass as $class)
                                            <option value="{{ $class->id }}" {{ $record->class_id == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted mb-2 d-block">Pilih Guru Pengampu <span class="text-danger">*</span></label>
                                    <div class="p-3 rounded" style="background: #faf8f5; border: 1px solid #ebd8b0; max-height: 280px; overflow-y: auto;">
                                        <div class="row">
                                            @foreach ($getTeacherClass as $teacher)
                                                <div class="col-md-6 mb-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="teacher_{{ $teacher->id }}" class="custom-control-input" value="{{ $teacher->id }}" name="teacher_id" {{ $record->teacher_id == $teacher->id ? 'checked' : '' }} required>
                                                        <label class="custom-control-label font-weight-normal text-dark" for="teacher_{{ $teacher->id }}" style="cursor: pointer;">
                                                            {{ $teacher->name }} {{ $teacher->last_name }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Status Penugasan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status" style="border-radius: 8px;">
                                        <option value="0" {{ $record->status == 0 ? 'selected' : '' }}>Aktif Mengajar</option>
                                        <option value="1" {{ $record->status == 1 ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('admin/assign_class_teacher/list') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                                    <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                        <i class="fas fa-save mr-1"></i> Perbarui Penugasan
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
