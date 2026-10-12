@extends('layouts.app')

@section('container')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between py-3 px-4">
                <div class="d-flex align-items-center gap-2">
                    <i class="fa-solid fa-pen-to-square text-warning fs-5"></i>
                    <h5 class="mb-0 fw-bold">Edit Data Ekstrakurikuler</h5>
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
                <form method="POST" action="{{ url('admin/extracurricular/update', $getRecord->id) }}">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold">Nama Ekstrakurikuler <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required placeholder="Contoh: Robotik & AI Club..." value="{{ old('name', $getRecord->name) }}">
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold">Kategori Bidang <span class="text-danger">*</span></label>
                            <select class="form-select" name="category" required>
                                <option value="Kepemimpinan & Karakter" {{ $getRecord->category == 'Kepemimpinan & Karakter' ? 'selected' : '' }}>Kepemimpinan & Karakter</option>
                                <option value="Sains & Teknologi" {{ $getRecord->category == 'Sains & Teknologi' ? 'selected' : '' }}>Sains & Teknologi</option>
                                <option value="Olahraga Prestasi" {{ $getRecord->category == 'Olahraga Prestasi' ? 'selected' : '' }}>Olahraga Prestasi</option>
                                <option value="Seni & Budaya" {{ $getRecord->category == 'Seni & Budaya' ? 'selected' : '' }}>Seni & Budaya</option>
                                <option value="Bahasa & Diplomasi" {{ $getRecord->category == 'Bahasa & Diplomasi' ? 'selected' : '' }}>Bahasa & Diplomasi</option>
                                <option value="Kemanusiaan & Kesehatan" {{ $getRecord->category == 'Kemanusiaan & Kesehatan' ? 'selected' : '' }}>Kemanusiaan & Kesehatan</option>
                                <option value="Keagamaan" {{ $getRecord->category == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Guru Pembina Ekskul</label>
                            <select class="form-select" name="teacher_id">
                                <option value="">-- Pilih Guru Pembina (Opsional) --</option>
                                @foreach($getTeachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ $getRecord->teacher_id == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }} ({{ $teacher->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Ikon Ekskul</label>
                            <select class="form-select" name="icon">
                                <option value="fa-star" {{ $getRecord->icon == 'fa-star' ? 'selected' : '' }}>★ Bintang Umum (fa-star)</option>
                                <option value="fa-robot" {{ $getRecord->icon == 'fa-robot' ? 'selected' : '' }}>🤖 Robotik & Coding (fa-robot)</option>
                                <option value="fa-basketball" {{ $getRecord->icon == 'fa-basketball' ? 'selected' : '' }}>🏀 Bola Basket (fa-basketball)</option>
                                <option value="fa-futbol" {{ $getRecord->icon == 'fa-futbol' ? 'selected' : '' }}>⚽ Sepak Bola / Futsal (fa-futbol)</option>
                                <option value="fa-campground" {{ $getRecord->icon == 'fa-campground' ? 'selected' : '' }}>⛺ Pramuka (fa-campground)</option>
                                <option value="fa-flag" {{ $getRecord->icon == 'fa-flag' ? 'selected' : '' }}>🚩 Paskibra (fa-flag)</option>
                                <option value="fa-kit-medical" {{ $getRecord->icon == 'fa-kit-medical' ? 'selected' : '' }}>🩺 PMR / Kesehatan (fa-kit-medical)</option>
                                <option value="fa-masks-theater" {{ $getRecord->icon == 'fa-masks-theater' ? 'selected' : '' }}>🎭 Tari & Teater (fa-masks-theater)</option>
                                <option value="fa-comments" {{ $getRecord->icon == 'fa-comments' ? 'selected' : '' }}>💬 Debat & Bahasa (fa-comments)</option>
                                <option value="fa-music" {{ $getRecord->icon == 'fa-music' ? 'selected' : '' }}>🎵 Musik & Band (fa-music)</option>
                                <option value="fa-camera" {{ $getRecord->icon == 'fa-camera' ? 'selected' : '' }}>📸 Fotografi & Desain (fa-camera)</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Hari Latihan</label>
                            <select class="form-select" name="day_of_week">
                                <option value="Senin" {{ $getRecord->day_of_week == 'Senin' ? 'selected' : '' }}>Senin</option>
                                <option value="Selasa" {{ $getRecord->day_of_week == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                <option value="Rabu" {{ $getRecord->day_of_week == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                <option value="Kamis" {{ $getRecord->day_of_week == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                <option value="Jumat" {{ $getRecord->day_of_week == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                <option value="Sabtu" {{ $getRecord->day_of_week == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                <option value="Minggu" {{ $getRecord->day_of_week == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                <option value="Senin & Kamis" {{ $getRecord->day_of_week == 'Senin & Kamis' ? 'selected' : '' }}>Senin & Kamis</option>
                                <option value="Selasa & Jumat" {{ $getRecord->day_of_week == 'Selasa & Jumat' ? 'selected' : '' }}>Selasa & Jumat</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jam Mulai</label>
                            <input type="time" class="form-control" name="start_time" value="{{ old('start_time', $getRecord->start_time) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">Jam Selesai</label>
                            <input type="time" class="form-control" name="end_time" value="{{ old('end_time', $getRecord->end_time) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Lokasi / Tempat Latihan</label>
                            <input type="text" class="form-control" name="location" placeholder="Contoh: Lapangan Utama..." value="{{ old('location', $getRecord->location) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Kuota Siswa <span class="text-danger">*</span></label>
                            <input type="number" min="5" max="300" class="form-control" name="quota" required value="{{ old('quota', $getRecord->quota) }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-semibold">Status Keaktifan <span class="text-danger">*</span></label>
                            <select class="form-select" name="status" required>
                                <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Aktif</option>
                                <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Deskripsi / Visi Misi Ekskul</label>
                        <textarea class="form-control" name="description" rows="3">{{ old('description', $getRecord->description) }}</textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-2 pt-2 border-top">
                        <a href="{{ url('admin/extracurricular/list') }}" class="btn btn-secondary px-4">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa-solid fa-floppy-disk me-1"></i> Perbarui Ekskul
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
