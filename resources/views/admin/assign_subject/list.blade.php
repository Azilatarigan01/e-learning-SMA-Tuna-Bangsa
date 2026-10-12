@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-link mr-1"></i> Alokasi Kurikulum
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Penugasan Mata Pelajaran ke Kelas
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Hubungkan mata pelajaran dengan rombongan belajar kelas binaan sesuai struktur kurikulum aktif.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/assign_subject/add') }}" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Penugasan Baru
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
                        <i class="fas fa-table mr-2" style="color: #851624;"></i> Data Alokasi Mapel Kelas
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($getRecord) }} Penugasan
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 70px;">No</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Rombel Kelas</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Mata Pelajaran</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Status</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Tanggal Dibuat</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-right" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $record)
                                <tr>
                                    <td class="px-4 py-3 font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2f2; color: #851624; border: 1px solid #fed7d7; border-radius: 10px; font-size: 0.85rem;">
                                            <i class="fas fa-school mr-1"></i> {{ $record->class_name }}
                                        </span>
                                    </td>
                                    <td class="py-3 font-weight-bold text-dark">
                                        {{ $record->subject_name }}
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
                                    <td class="py-3 text-center text-muted small">
                                        <i class="far fa-clock mr-1"></i> {{ date('d M Y, H:i', strtotime($record->created_at)) }}
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="d-inline-flex">
                                            <a href="{{ url('admin/assign_subject/edit/'.$record->id) }}" class="btn btn-sm btn-outline-primary mr-1" style="border-radius: 8px;">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="{{ url('admin/assign_subject/delete/'.$record->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus alokasi mapel ini?')" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <p class="mb-0">Belum ada data alokasi mata pelajaran ke kelas.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
