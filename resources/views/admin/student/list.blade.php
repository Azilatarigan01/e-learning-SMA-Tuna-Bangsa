@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-users mr-1"></i> Database Kesiswaan
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Direktori Siswa SMA Tuna Bangsa
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Kelola data 480 siswa terdaftar pada 12 rombongan belajar kelas X, XI, dan XII (MIPA & IPS).
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/student/add') }}" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-user-plus mr-1"></i> Tambah Siswa Baru
                        </a>
                    </div>
                </div>
            </div>

            @include('_message')
        </div>
    </div>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid pb-5">
            <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff; overflow: hidden;">
                <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                    <h5 class="font-weight-bold text-dark mb-0">
                        <i class="fas fa-graduation-cap mr-2" style="color: #851624;"></i> Daftar Siswa Terdaftar
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($getRecords) }} Siswa Terdaftar
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 70px;">Foto</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Nama Lengkap Siswa</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Kelas Binaan</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">NIS / NISN</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Status</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-right" style="width: 220px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecords as $record)
                                <tr>
                                    <td class="px-4 py-3 text-center">
                                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold shadow-xs mx-auto" style="width: 42px; height: 42px; background: linear-gradient(135deg, #2b5876, #4e4376); font-size: 1.05rem;">
                                            {{ strtoupper(substr($record->name, 0, 1)) }}
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <div class="font-weight-bold text-dark" style="font-size: 0.95rem;">{{ $record->name }}</div>
                                        <small class="text-muted"><i class="far fa-envelope mr-1"></i> {{ $record->email }}</small>
                                    </td>
                                    <td class="py-3">
                                        <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2f2; color: #851624; border: 1px solid #fed7d7; border-radius: 10px; font-size: 0.85rem;">
                                            {{ $record->class_name ?? 'X MIPA 1' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center font-weight-bold text-dark">
                                        {{ $record->roll_number ?? '2026' . str_pad($record->id, 4, '0', STR_PAD_LEFT) }}
                                    </td>
                                    <td class="py-3 text-center">
                                        @if($record->status == 0)
                                            <span class="badge px-3 py-1 font-weight-bold" style="background: #eef7ed !important; color: #1e7e34 !important; border: 1px solid #c3e6cb !important; border-radius: 20px; font-size: 0.82rem; display: inline-flex; align-items: center;">
                                                <i class="fas fa-check-circle mr-1"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2f2 !important; color: #991b1b !important; border: 1px solid #fecaca !important; border-radius: 20px; font-size: 0.82rem; display: inline-flex; align-items: center;">
                                                <i class="fas fa-times-circle mr-1"></i> Non-Aktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="d-inline-flex">
                                            <a href="{{ route('report_card.print', $record->id) }}" target="_blank" class="btn btn-sm btn-outline-success mr-1" style="border-radius: 8px;" title="Cetak Rapor Siswa">
                                                <i class="fas fa-print"></i> Rapor
                                            </a>
                                            <a href="{{ url('admin/student/edit/'.$record->id) }}" class="btn btn-sm btn-outline-primary mr-1" style="border-radius: 8px;">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="{{ url('admin/student/delete/'.$record->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data siswa ini?')" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <p class="mb-0">Belum ada data siswa terdaftar.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 px-4 border-top d-flex flex-wrap align-items-center justify-content-between">
                    <div class="small text-muted font-weight-bold mb-2 mb-md-0">
                        Menampilkan {{ $getRecords->firstItem() ?? 0 }} - {{ $getRecords->lastItem() ?? 0 }} dari {{ $getRecords->total() }} siswa (10 per halaman)
                    </div>
                    <div>
                        {!! $getRecords->appends(request()->except('page'))->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
