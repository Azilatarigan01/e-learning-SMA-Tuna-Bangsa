@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-user-edit mr-1"></i> Pembaruan Profil Siswa
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Edit Data Peserta Didik</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Perbarui data identitas, kontak, NISN, atau kredensial akun peserta didik.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/student/list') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Siswa
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

                    <form method="POST" action="{{ route('student.update', $student->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $student->name) }}" required style="border-radius: 8px;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $student->email) }}" required style="border-radius: 8px;">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nomor Pendaftaran / Induk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('admission_number') is-invalid @enderror" name="admission_number" value="{{ old('admission_number', $student->admission_number) }}" required style="border-radius: 8px;">
                                @error('admission_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">NISN <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('roll_number') is-invalid @enderror" name="roll_number" value="{{ old('roll_number', $student->roll_number) }}" required style="border-radius: 8px;">
                                @error('roll_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender" required style="border-radius: 8px;">
                                    <option value="Laki-Laki" {{ old('gender', $student->gender) == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth', $student->date_of_birth) }}" required style="border-radius: 8px;">
                                @error('date_of_birth')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Agama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('religion') is-invalid @enderror" name="religion" value="{{ old('religion', $student->religion) }}" required style="border-radius: 8px;">
                                @error('religion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nomor Ponsel / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number', $student->mobile_number) }}" required style="border-radius: 8px;">
                                @error('mobile_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Tanggal Masuk Sekolah <span class="text-danger">*</span></label>
                                <input type="date" class="form-control @error('admission_date') is-invalid @enderror" name="admission_date" value="{{ old('admission_date', $student->admission_date) }}" required style="border-radius: 8px;">
                                @error('admission_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Foto Profil</label>
                                <input type="file" class="form-control-file p-2" name="profile_pic" style="border: 1px dashed #c59b27; border-radius: 8px; width: 100%; background: #faf8f5;">
                                @if($student->profile_pic)
                                    <div class="mt-2 d-flex align-items-center">
                                        <img src="{{ asset('uploads/profile_pics/' . $student->profile_pic) }}" alt="Profile" class="rounded-circle shadow-sm mr-2" style="width: 45px; height: 45px; object-fit: cover;">
                                        <small class="text-muted">Foto saat ini</small>
                                    </div>
                                @endif
                                @error('profile_pic')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <hr class="my-4" style="border-top: 1px dashed #ebd8b0;" />
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Kata Sandi Baru (Opsional)</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Kosongkan bila tidak ingin mengubah kata sandi" style="border-radius: 8px;">
                                <small class="text-muted">Kosongkan jika tetap menggunakan kata sandi lama.</small>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Ulangi kata sandi baru" style="border-radius: 8px;">
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ url('admin/student/list') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
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
