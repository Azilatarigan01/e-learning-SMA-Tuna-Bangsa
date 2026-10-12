@extends('layouts.app')

@section('container')
<!-- Header Card Ekskul Info -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid {{ !empty($getEkskul->icon) ? $getEkskul->icon : 'fa-award' }} fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            {{ $getEkskul->category }}
                        </span>
                        <h3 class="fw-bold mb-1 text-white">{{ $getEkskul->name }}</h3>
                        <div class="text-white-50 small">
                            <span class="me-3"><i class="fa-solid fa-chalkboard-user text-warning me-1"></i> Pembina: <strong>{{ !empty($getEkskul->teacher) ? $getEkskul->teacher->name : 'Belum Ada' }}</strong></span>
                            <span class="me-3"><i class="fa-regular fa-calendar-check text-warning me-1"></i> {{ $getEkskul->day_of_week }} ({{ $getEkskul->start_time }} - {{ $getEkskul->end_time }})</span>
                            <span><i class="fa-solid fa-location-dot text-warning me-1"></i> {{ $getEkskul->location }}</span>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end me-2">
                        <div class="small text-white-50">Kapasitas Terisi</div>
                        <div class="fs-5 fw-bold text-warning">{{ $getMembers->count() }} / {{ $getEkskul->quota }} Siswa</div>
                    </div>
                    <a href="{{ url('admin/extracurricular/list') }}" class="btn btn-outline-light px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Form Tambah Anggota Siswa -->
    <div class="col-lg-4">
        <div class="card shadow-sm border-0" style="border-radius: 14px;">
            <div class="card-header bg-primary text-white py-3 px-4">
                <h6 class="mb-0 fw-bold d-flex align-items-center gap-2">
                    <i class="fa-solid fa-user-plus text-warning"></i> Daftarkan Siswa ke Ekskul
                </h6>
            </div>
            <div class="card-body p-4">
                @if (session('success'))
                    <div class="alert alert-success d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.extracurricular.add_member', $getEkskul->id) }}">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilih Siswa <span class="text-danger">*</span></label>
                        <select class="form-select" name="student_id" required>
                            <option value="">-- Pilih Siswa --</option>
                            @foreach($availableStudents as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->email }})</option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hanya menampilkan siswa yang belum bergabung di ekskul ini.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Jabatan / Peran <span class="text-danger">*</span></label>
                        <select class="form-select" name="role" required>
                            <option value="Anggota" selected>Anggota</option>
                            <option value="Ketua">Ketua</option>
                            <option value="Wakil Ketua">Wakil Ketua</option>
                            <option value="Sekretaris">Sekretaris</option>
                            <option value="Bendahara">Bendahara</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="fa-solid fa-user-check me-1"></i> Daftarkan Siswa Sekarang
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Daftar Anggota Siswa -->
    <div class="col-lg-8">
        <div class="card shadow-sm border-0" style="border-radius: 14px;">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center justify-content-between border-bottom">
                <h6 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                    <i class="fa-solid fa-users text-primary"></i> Daftar Anggota Terdaftar ({{ $getMembers->count() }} Siswa)
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col" class="text-center">Jabatan / Peran</th>
                                <th scope="col" class="text-center">Tanggal Gabung</th>
                                <th scope="col" class="text-center" style="width: 100px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($getMembers as $member)
                            <tr>
                                <td class="text-center fw-bold text-muted">{{ $loop->iteration }}</td>
                                <td>
                                    @if(!empty($member->student))
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="lms-avatar" style="width: 36px; height: 36px; font-size: 0.85rem; background: #fee2e2; color: #991b1b;">
                                                {{ strtoupper(substr($member->student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark small">{{ $member->student->name }}</div>
                                                <small class="text-muted">{{ $member->student->email }}</small>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small">Siswa tidak ditemukan</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($member->role == 'Ketua')
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                            <i class="fa-solid fa-crown me-1"></i> Ketua
                                        </span>
                                    @elseif($member->role == 'Wakil Ketua')
                                        <span class="badge bg-info text-dark px-3 py-2 rounded-pill fw-semibold">
                                            Wakil Ketua
                                        </span>
                                    @elseif($member->role == 'Sekretaris' || $member->role == 'Bendahara')
                                        <span class="badge bg-primary px-3 py-2 rounded-pill">
                                            {{ $member->role }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                            Anggota
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">
                                    {{ date('d M Y', strtotime($member->created_at)) }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.extracurricular.delete_member', ['id' => $getEkskul->id, 'member_id' => $member->id]) }}" method="POST" onsubmit="return confirm('Keluarkan siswa ini dari ekskul?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2" title="Keluarkan Anggota">
                                            <i class="fa-solid fa-user-minus"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="fa-solid fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada anggota siswa yang terdaftar di ekskul ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
