@extends('layouts.app')

@section('container')
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: white; border-radius: 16px;">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 56px; height: 56px; border-radius: 14px; background: rgba(197, 155, 39, 0.2); border: 1px solid rgba(197, 155, 39, 0.5); display: flex; align-items: center; justify-content: center;">
                        <i class="fa-solid fa-chalkboard-user fs-3 text-warning"></i>
                    </div>
                    <div>
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-1">
                            PEMBINAAN & PENGEMBANGAN SISWA
                        </span>
                        <h3 class="fw-bold mb-1 text-white">Ekstrakurikuler yang Saya Bina</h3>
                        <p class="text-white-50 small mb-0">Kelola dan pantau seluruh siswa asuhan dalam kegiatan ekstrakurikuler binaan Anda di SMA Tuna Bangsa.</p>
                    </div>
                </div>
                <div class="text-end">
                    <div class="badge bg-white bg-opacity-10 text-white px-3 py-2 rounded-pill fs-6">
                        <i class="fa-solid fa-trophy text-warning me-1"></i> {{ $myEkskuls->count() }} Ekskul Binaan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    @forelse($myEkskuls as $ekskul)
    <div class="col-12">
        <div class="card shadow-sm border-0" style="border-radius: 16px; overflow: hidden;">
            <div class="card-header bg-primary text-white py-3 px-4 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div class="d-flex align-items-center gap-3">
                    <div class="lms-avatar" style="width: 40px; height: 40px; font-size: 1.1rem; background: rgba(255,255,255,0.15); color: #c59b27;">
                        <i class="fa-solid {{ !empty($ekskul->icon) ? $ekskul->icon : 'fa-star' }}"></i>
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">{{ $ekskul->name }}</h5>
                        <small class="text-white-50">{{ $ekskul->category }} &bull; Kuota: {{ $ekskul->quota }} Siswa</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                        <i class="fa-solid fa-users me-1"></i> {{ $ekskul->members->count() }} Anggota Terdaftar
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="text-muted small fw-semibold">JADWAL LATIHAN</div>
                            <div class="fw-bold text-dark mt-1">
                                <i class="fa-regular fa-calendar-check text-primary me-1"></i>
                                {{ $ekskul->day_of_week }} ({{ $ekskul->start_time }} - {{ $ekskul->end_time }})
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="text-muted small fw-semibold">LOKASI / TEMPAT</div>
                            <div class="fw-bold text-dark mt-1">
                                <i class="fa-solid fa-location-dot text-danger me-1"></i>
                                {{ $ekskul->location }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded-3" style="background: #f8fafc; border: 1px solid #e2e8f0;">
                            <div class="text-muted small fw-semibold">STATUS EKSKUL</div>
                            <div class="fw-bold text-dark mt-1">
                                @if($ekskul->status == 0)
                                    <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Aktif Berjalan</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if(!empty($ekskul->description))
                    <div class="alert alert-light border small text-muted mb-4 py-2 px-3">
                        <i class="fa-solid fa-info-circle me-1 text-primary"></i> <strong>Tentang:</strong> {{ $ekskul->description }}
                    </div>
                @endif

                <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                    <i class="fa-solid fa-id-badge text-warning"></i> Daftar Anggota Siswa ({{ $ekskul->members->count() }})
                </h6>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center" style="width: 50px;">No</th>
                                <th scope="col">Nama Siswa</th>
                                <th scope="col" class="text-center">Jabatan / Peran</th>
                                <th scope="col" class="text-center">Tanggal Gabung</th>
                                <th scope="col">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ekskul->members as $member)
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
                                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold">
                                            <i class="fa-solid fa-crown me-1"></i> Ketua
                                        </span>
                                    @elseif($member->role == 'Wakil Ketua')
                                        <span class="badge bg-info text-dark px-3 py-1 rounded-pill fw-semibold">
                                            Wakil Ketua
                                        </span>
                                    @elseif($member->role == 'Sekretaris' || $member->role == 'Bendahara')
                                        <span class="badge bg-primary px-3 py-1 rounded-pill">
                                            {{ $member->role }}
                                        </span>
                                    @else
                                        <span class="badge bg-light text-dark border px-3 py-1 rounded-pill">
                                            Anggota
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center text-muted small">
                                    {{ date('d M Y', strtotime($member->created_at)) }}
                                </td>
                                <td class="small text-muted">
                                    {{ !empty($member->notes) ? $member->notes : '—' }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">
                                    Belum ada siswa yang bergabung di ekskul ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5" style="border-radius: 14px;">
            <div class="card-body">
                <i class="fa-solid fa-chalkboard-user fa-3x text-muted mb-3 d-block"></i>
                <h6 class="fw-bold text-dark mb-1">Anda Belum Ditugaskan Sebagai Pembina Ekstrakurikuler</h6>
                <p class="text-muted small mb-0">Admin sekolah akan mengatur penugasan pembina ekstrakurikuler melalui menu Manajemen Ekstrakurikuler.</p>
            </div>
        </div>
    </div>
    @endforelse
</div>
@endsection
