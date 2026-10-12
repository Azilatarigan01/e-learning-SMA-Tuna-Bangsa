@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-user-edit mr-1"></i> Pembaruan Data Guru
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Edit Data Guru & Tenaga Pendidik</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Perbarui data profil, kontak, status keaktifan, atau kata sandi guru.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/teacher/list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Guru
                        </a>
                    </div>
                </div>
            </div>
            @include('_message')
        </div>
    </div>

    <section class="content">
        <div class="container-fluid pb-5">
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger" style="border-radius: 10px;">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('teacher.update', $teacher->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nama Lengkap & Gelar <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $teacher->name) }}" required style="border-radius: 8px;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $teacher->email) }}" required style="border-radius: 8px;">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" required style="border-radius: 8px;">
                                    <option value="Laki-Laki" {{ old('gender', $teacher->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('gender', $teacher->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth', $teacher->date_of_birth) }}" required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nomor Kontak / WhatsApp</label>
                                <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number', $teacher->mobile_number) }}" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Tanggal Bergabung <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror" name="admission_date" value="{{ old('admission_date', $teacher->admission_date) }}" required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Status Pernikahan <span class="text-danger">*</span></label>
                                <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" required style="border-radius: 8px;">
                                    <option value="0" {{ old('marital_status', $teacher->marital_status) == 0 ? 'selected' : '' }}>Belum Menikah (Single)</option>
                                    <option value="1" {{ old('marital_status', $teacher->marital_status) == 1 ? 'selected' : '' }}>Menikah</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Status Keaktifan <span class="text-danger">*</span></label>
                                <select class="form-control @error('status') is-invalid @enderror" name="status" required style="border-radius: 8px;">
                                    <option value="0" {{ old('status', $teacher->status) == 0 ? 'selected' : '' }}>Aktif Mengajar</option>
                                    <option value="1" {{ old('status', $teacher->status) == 1 ? 'selected' : '' }}>Nonaktif / Cuti</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Alamat Domisili <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $teacher->address) }}" required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Foto Profil</label>
                                <input type="file" class="form-control-file p-2" name="profile_pic" style="border: 1px dashed #c59b27; border-radius: 8px; width: 100%; background: #faf8f5;">
                                @if($teacher->profile_pic)
                                    <div class="mt-2 d-flex align-items-center">
                                        <img src="{{ asset('uploads/profile_pics/' . $teacher->profile_pic) }}" alt="Profile" class="rounded-circle shadow-sm mr-2" style="width: 45px; height: 45px; object-fit: cover;">
                                        <small class="text-muted">Foto profil terpasang</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr class="my-4" style="border-top: 1px dashed #ebd8b0;" />
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Kata Sandi Baru (Opsional)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kosongkan jika tidak ingin mengubah password" style="border-radius: 8px;">
                                <small class="text-muted">Biarkan kosong bila tidak ingin mengganti kata sandi.</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi kata sandi baru" style="border-radius: 8px;">
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ url('admin/teacher/list') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                            <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                <i class="fas fa-save mr-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
