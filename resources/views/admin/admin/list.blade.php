@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-user-shield mr-1"></i> Manajemen Hak Akses
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Daftar Administrator Sekolah
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Pengelolaan akun pengelola sistem E-Learning SMA Tuna Bangsa dengan hak akses penuh.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/admin/add') }}" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-plus-circle mr-1"></i> Tambah Admin Baru
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
                        <i class="fas fa-users-cog mr-2" style="color: #851624;"></i> Daftar Akun Administrator
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($getRecords) }} Admin
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" style="vertical-align: middle;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ede7df;">
                                <tr>
                                    <th class="px-4 py-3 text-muted text-uppercase small font-weight-bold" style="width: 70px;">No</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Nama Administrator</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold">Email Akun</th>
                                    <th class="py-3 text-muted text-uppercase small font-weight-bold text-center">Tanggal Dibuat</th>
                                    <th class="py-3 px-4 text-muted text-uppercase small font-weight-bold text-right" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecords as $record)
                                <tr>
                                    <td class="px-4 py-3 font-weight-bold text-muted">{{ $loop->iteration }}</td>
                                    <td class="py-3">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold mr-3" style="width: 40px; height: 40px; background: linear-gradient(135deg, #851624, #4a060e); font-size: 1rem; flex-shrink: 0;">
                                                {{ strtoupper(substr($record->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <span class="font-weight-bold text-dark d-block">{{ $record->name }}</span>
                                                <span class="badge badge-danger px-2 py-0" style="background: #851624; font-size: 0.72rem; border-radius: 8px;">Super Administrator</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-3">
                                        <span class="text-dark font-weight-medium">
                                            <i class="far fa-envelope mr-1 text-muted"></i> {{ $record->email }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center text-muted small">
                                        <i class="far fa-clock mr-1"></i> {{ date('d M Y', strtotime($record->created_at)) }}
                                    </td>
                                    <td class="py-3 px-4 text-right">
                                        <div class="d-inline-flex">
                                            <a href="{{ url('admin/admin/edit/'.$record->id) }}" class="btn btn-sm btn-outline-primary mr-1" style="border-radius: 8px;">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <a href="{{ url('admin/admin/delete/'.$record->id) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini?')" class="btn btn-sm btn-outline-danger" style="border-radius: 8px;">
                                                <i class="fas fa-trash-alt"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5 text-muted">
                                        <p class="mb-0">Belum ada akun administrator terdaftar.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 px-4 border-top d-flex flex-wrap align-items-center justify-content-between">
                    <div class="small text-muted font-weight-bold mb-2 mb-md-0">
                        Menampilkan {{ $getRecords->firstItem() ?? 0 }} - {{ $getRecords->lastItem() ?? 0 }} dari {{ $getRecords->total() }} administrator
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
