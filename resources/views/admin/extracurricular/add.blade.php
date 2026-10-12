@extends('layouts.app')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-plus-circle text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Tambah Ekstrakurikuler Baru</h5>
                </div>
                <a href="{{ url('admin/extracurricular/list') }}" class="btn btn-sm btn-outline-light px-3">
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
                <form method="POST" action="{{ url('admin/extracurricular/add') }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="Contoh: Robotik & AI Club, Futsal, Tari Tradisional..." value="{{ old('name') }}">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold">Kategori Bidang <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" required>
                                <option value="Kepemimpinan & Karakter">Kepemimpinan & Karakter</option>
                                <option value="Sains & Teknologi">Sains & Teknologi</option>
                                <option value="Olahraga Prestasi">Olahraga Prestasi</option>
                                <option value="Seni & Budaya">Seni & Budaya</option>
                                <option value="Bahasa & Diplomasi">Bahasa & Diplomasi</option>
                                <option value="Kemanusiaan & Kesehatan">Kemanusiaan & Kesehatan</option>
                                <option value="Keagamaan">Keagamaan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Guru Pembina Ekskul</label>
                            <select class="form-select" name="teacher_id">
                                <option value="">-- Pilih Guru Pembina (Opsional) --</option>
                                @foreach($getTeachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }} ({{ $teacher->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Ikon Ekskul</label>
                            <select class="form-select" name="icon">
                                <option value="fa-star">★ Bintang Umum (fa-star)</option>
                                <option value="fa-robot">🤖 Robotik & Coding (fa-robot)</option>
                                <option value="fa-basketball">🏀 Bola Basket (fa-basketball)</option>
                                <option value="fa-futbol">⚽ Sepak Bola / Futsal (fa-futbol)</option>
                                <option value="fa-campground">⛺ Pramuka (fa-campground)</option>
                                <option value="fa-flag">🚩 Paskibra (fa-flag)</option>
                                <option value="fa-kit-medical">🩺 PMR / Kesehatan (fa-kit-medical)</option>
                                <option value="fa-masks-theater">🎭 Tari & Teater (fa-masks-theater)</option>
                                <option value="fa-comments">💬 Debat & Bahasa (fa-comments)</option>
                                <option value="fa-music">🎵 Musik & Band (fa-music)</option>
                                <option value="fa-camera">📸 Fotografi & Desain (fa-camera)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Hari Latihan</label>
                            <select class="form-select" name="day_of_week">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu" selected>Sabtu</option>
                                <option value="Minggu">Minggu</option>
                                <option value="Senin & Kamis">Senin & Kamis</option>
                                <option value="Selasa & Jumat">Selasa & Jumat</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input type="time" class="form-control" name="start_time" value="{{ old('start_time', '15:30') }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input type="time" class="form-control" name="end_time" value="{{ old('end_time', '17:30') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Lokasi / Tempat Latihan</label>
                            <input type="text" class="form-control" name="location" placeholder="Contoh: Lapangan Utama, Lab Komputer 1, Aula Cut Nyak Dhien" value="{{ old('location') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Kuota Siswa <span class="text-danger">*</span></label>
                            <input type="number" min="5" max="300" class="form-control" name="quota" required value="{{ old('quota', 35) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Status Keaktifan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" required>
                                <option value="0" selected>Aktif</option>
                                <option value="1">Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi / Visi Misi Ekskul</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Tuliskan gambaran kegiatan ekstrakurikuler, pencapaian, dan tujuan pembelajaran...">{{ old('description') }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ url('admin/extracurricular/list') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-check me-1"></i> Simpan Ekskul
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
