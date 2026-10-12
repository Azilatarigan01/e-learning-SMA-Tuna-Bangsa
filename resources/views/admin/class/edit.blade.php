@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-edit mr-1"></i> Perbarui Rombel
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Edit Data Rombongan Belajar</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Perbarui nama dan status keaktifan kelas.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/class/list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
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
                            <form method="POST" action="">
                                {{ csrf_field() }}
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted">Nama Kelas / Rombel <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{ $getRecord->name }}" required style="border-radius: 8px;">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Status Keaktifan <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" style="border-radius: 8px;">
                                        <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Aktif (Sedang Berjalan)</option>
                                        <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Tidak Aktif</option>
                                    </select>
                                </div>
                                <div class="text-right">
                                    <a href="{{ url('admin/class/list') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                                    <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                        <i class="fas fa-save mr-1"></i> Perbarui Kelas
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
