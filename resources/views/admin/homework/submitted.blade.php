@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; border-radius: 14px;">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-file-signature mr-1"></i> Pengumpulan Tugas Siswa
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff;">Daftar Tugas yang Dikumpulkan</h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">Pantau berkas kiriman, jawaban tertulis, dan tanggal penyerahan tugas oleh siswa.</p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="{{ url('admin/homework/homework') }}" class="btn btn-outline-light px-4 py-2 font-weight-bold" style="border-radius: 10px;">
                            <i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Tugas
                        </a>
                    </div>
                </div>
            </div>
            @include('_message')
        </div>
    </div>

    <section class="content">
        <div class="container-fluid pb-5">
            <div class="card border-0 shadow-sm rounded-14 overflow-hidden" style="border-radius: 14px; background: #fff;">
                <div class="card-header bg-white py-3 px-4 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 font-weight-bold text-dark">
                        <i class="fas fa-users text-danger mr-2"></i> Siswa yang Telah Mengumpulkan
                    </h5>
                    <span class="badge badge-light px-3 py-2 border font-weight-bold" style="border-radius: 20px;">
                        Total Kiriman: {{ $getRecord->total() }}
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0" style="font-size: 0.95rem;">
                            <thead style="background: #faf8f5; border-bottom: 2px solid #ebd8b0; color: #4a060e;">
                                <tr>
                                    <th class="py-3 px-4 text-center" style="width: 60px;">No</th>
                                    <th class="py-3 px-4">Nama Siswa</th>
                                    <th class="py-3 px-4 text-center">Lampiran Dokumen</th>
                                    <th class="py-3 px-4">Catatan / Jawaban Siswa</th>
                                    <th class="py-3 px-4 text-center">Waktu Penyerahan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($getRecord as $value)
                                    <tr style="border-bottom: 1px solid #f3ece1;">
                                        <td class="text-center font-weight-bold py-3 text-muted">{{ $loop->iteration + ($getRecord->currentPage() - 1) * $getRecord->perPage() }}</td>
                                        <td class="py-3 px-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 font-weight-bold text-white shadow-sm" style="width: 38px; height: 38px; background: linear-gradient(135deg, #851624, #c59b27); font-size: 0.85rem;">
                                                    {{ strtoupper(substr($value->first_name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold text-dark d-block">{{ $value->first_name }} {{ $value->last_name }}</span>
                                                    <span class="text-muted small">Siswa SMA Tuna Bangsa</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center py-3">
                                            @if(!empty($value->getDocument()))
                                                <a href="{{ $value->getDocument() }}" class="btn btn-sm text-white font-weight-bold px-3 py-1 shadow-sm" style="background: linear-gradient(135deg, #851624, #a31d30); border-radius: 8px;" download>
                                                    <i class="fas fa-download mr-1"></i> Unduh File
                                                </a>
                                            @else
                                                <span class="text-muted small font-italic"><i class="fas fa-times-circle mr-1"></i> Tidak ada file</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-4 text-secondary" style="max-width: 340px;">
                                            <div class="p-2 rounded" style="background: #faf8f5; border: 1px solid #ebd8b0; font-size: 0.88rem;">
                                                {{ !empty($value->description) ? $value->description : 'Tidak ada catatan tambahan.' }}
                                            </div>
                                        </td>
                                        <td class="text-center py-3">
                                            <span class="badge px-3 py-2 font-weight-bold" style="background: #eef7ed; color: #1e7e34; border: 1px solid #c3e6cb; border-radius: 20px;">
                                                <i class="far fa-clock mr-1"></i> {{ date('d M Y, H:i', strtotime($value->created_at)) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <div class="py-4">
                                                <i class="fas fa-folder-open fa-3x text-muted mb-3 d-block" style="opacity: 0.4;"></i>
                                                <p class="font-weight-bold text-muted mb-0">Belum ada siswa yang mengumpulkan tugas ini.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer bg-white py-3 px-4 border-top d-flex justify-content-end">
                    {!! $getRecord->appends(request()->except('page'))->links() !!}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
