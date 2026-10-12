@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-key mr-1"></i> Keamanan & Kredensial Akun
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Ganti Kata Sandi (Password)</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Perbarui kata sandi akun Anda secara berkala untuk menjaga keamanan sistem LMS SMA Tuna Bangsa.</p>
                    </div>
                </div>
            </div>
            @include('_message')
        </div>
    </div>

    <section class="content">
        <div class="container-fluid pb-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                        <div class="card-body p-4">
                            @if (session('success'))
                                <div class="alert alert-success" style="border-radius: 10px;">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger" style="border-radius: 10px;">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.change_password.post') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted">Kata Sandi Saat Ini <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="current_password" name="current_password" required placeholder="Masukkan kata sandi lama Anda" style="border-radius: 8px;">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted">Kata Sandi Baru <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="new_password" name="new_password" required placeholder="Minimal 6 karakter" style="border-radius: 8px;">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="font-weight-bold small text-muted">Konfirmasi Kata Sandi Baru <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required placeholder="Ulangi kata sandi baru" style="border-radius: 8px;">
                                </div>

                                <div class="p-3 mb-4 rounded d-flex align-items-center" style="background: #faf8f5; border: 1px solid #ebd8b0;">
                                    <i class="fas fa-shield-alt text-warning fa-2x mr-3"></i>
                                    <div>
                                        <div class="font-weight-bold text-dark" style="font-size: 0.9rem;">Peran Akun Aktif</div>
                                        <div class="text-muted small">
                                            @if ($user_type == 1)
                                                Administrator Sistem
                                            @elseif ($user_type == 2)
                                                Guru & Tenaga Pendidik
                                            @elseif ($user_type == 3)
                                                Peserta Didik (Siswa)
                                            @elseif ($user_type == 4)
                                                Orang Tua / Wali Murid
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn text-white font-weight-bold px-4 py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                        <i class="fas fa-sync-alt mr-1"></i> Perbarui Kata Sandi
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
