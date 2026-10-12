@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-user-graduate mr-1"></i> Manajemen Peserta Didik
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Tambah Siswa / Peserta Didik Baru</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Daftarkan peserta didik baru beserta penempatan kelas di SMA Tuna Bangsa.</p>
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

                    <form method="POST" action="{{ route('student.insert') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('name') }}" name="name" required placeholder="Contoh: Muhammad Rizky Pratama" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nomor Induk / Pendaftaran (No Induk) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="{{ old('admission_number') }}" name="admission_number" required placeholder="Contoh: 20261001" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">NISN (Nomor Induk Siswa Nasional)</label>
                                <input type="text" class="form-control" value="{{ old('roll_number') }}" name="roll_number" placeholder="Contoh: 0078129384" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Rombel / Kelas <span class="text-danger">*</span></label>
                                <select class="form-control" required name="class_id" style="border-radius: 8px;">
                                    <option value="">Pilih Rombongan Belajar</option>
                                    @foreach ($getClass as $value)
                                        <option value="{{ $value->id }}" {{ old('class_id') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control" required name="gender" style="border-radius: 8px;">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-Laki" {{ old('gender') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{ old('date_of_birth') }}" name="date_of_birth" required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Agama</label>
                                <input type="text" class="form-control" value="{{ old('religion') }}" name="religion" placeholder="Contoh: Islam, Kristen, dll" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Nomor Ponsel / WhatsApp</label>
                                <input type="text" class="form-control" value="{{ old('mobile_number') }}" name="mobile_number" placeholder="Contoh: 082198765432" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Tanggal Masuk Sekolah <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" value="{{ old('admission_date') }}" name="admission_date" required style="border-radius: 8px;">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold small text-muted">Status Keaktifan</label>
                                <select class="form-control" required name="status" style="border-radius: 8px;">
                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Aktif Belajar</option>
                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Nonaktif / Pindah</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold small text-muted">Foto Profil Siswa</label>
                                <input type="file" class="form-control-file p-2" name="profile_pic" accept="image/*" style="border: 1px dashed #c59b27; border-radius: 8px; width: 100%; background: #faf8f5;">
                            </div>
                        </div>
                        <hr class="my-4" style="border-top: 1px dashed #ebd8b0;" />
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold small text-muted">Alamat Email Siswa <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="{{ old('email') }}" name="email" required placeholder="siswa@tunabangsa.sch.id" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold small text-muted">Kata Sandi (Password) <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required placeholder="Minimal 6 karakter" style="border-radius: 8px;">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="font-weight-bold small text-muted">Konfirmasi Kata Sandi <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password_confirmation" required placeholder="Ulangi kata sandi" style="border-radius: 8px;">
                            </div>
                        </div>
                        <div class="text-right mt-3">
                            <a href="{{ url('admin/student/list') }}" class="btn btn-outline-secondary px-4 py-2 mr-2" style="border-radius: 8px;">Batal</a>
                            <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                <i class="fas fa-save mr-1"></i> Daftarkan Siswa
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
