@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-bell"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-broadcast-tower mr-1"></i> Komunikasi Realtime
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Pusat Notifikasi & Pemberitahuan
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Semua pembaruan terkait tugas, jadwal, nilai rapor, ujian CBT, dan pengumuman resmi sekolah.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <form method="POST" action="{{ route('notifications.mark_all_read') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                                <i class="fas fa-check-double mr-1"></i> Tandai Semua Dibaca
                            </button>
                        </form>
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
                        <i class="fas fa-inbox mr-2" style="color: #851624;"></i> Kotak Masuk Pemberitahuan
                    </h5>
                    <span class="badge badge-light border text-muted px-3 py-2 font-weight-normal">
                        Total: {{ count($notifications) }} Pemberitahuan
                    </span>
                </div>
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse($notifications as $notif)
                        <a href="{{ route('notifications.read_redirect', $notif->id) }}" class="list-group-item list-group-item-action p-4 border-bottom d-flex align-items-start {{ $notif->is_read ? '' : 'bg-light' }}" style="transition: background 0.2s ease;">
                            <div class="rounded-circle d-flex align-items-center justify-content-center mr-3 font-weight-bold text-white shadow-xs" style="width: 44px; height: 44px; flex-shrink: 0; background: {{ $notif->type == 'exam' ? 'linear-gradient(135deg, #851624, #4a060e)' : ($notif->type == 'grade' ? '#28a745' : '#2b5876') }}; font-size: 1.1rem;">
                                @if($notif->type == 'exam')
                                    <i class="fas fa-laptop-code"></i>
                                @elseif($notif->type == 'grade')
                                    <i class="fas fa-graduation-cap"></i>
                                @elseif($notif->type == 'schedule')
                                    <i class="fas fa-calendar-alt"></i>
                                @elseif($notif->type == 'announcement')
                                    <i class="fas fa-bullhorn"></i>
                                @else
                                    <i class="fas fa-info-circle"></i>
                                @endif
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h6 class="font-weight-bold mb-0 {{ $notif->is_read ? 'text-dark' : 'text-danger' }}">
                                        {{ $notif->title }}
                                        @if(!$notif->is_read)
                                            <span class="badge badge-danger ml-2 px-2 py-0" style="font-size: 0.68rem; border-radius: 10px;">BARU</span>
                                        @endif
                                    </h6>
                                    <small class="text-muted"><i class="far fa-clock mr-1"></i> {{ $notif->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="text-secondary mb-1" style="font-size: 0.92rem; line-height: 1.5;">
                                    {{ $notif->message }}
                                </p>
                                @if($notif->url)
                                    <small class="font-weight-bold" style="color: #851624;">
                                        Buka Tautan <i class="fas fa-arrow-right ml-1 small"></i>
                                    </small>
                                @endif
                            </div>
                        </a>
                        @empty
                        <div class="text-center py-5 text-muted">
                            <i class="far fa-bell-slash mb-2" style="font-size: 3rem; opacity: 0.3;"></i>
                            <h6 class="font-weight-bold">Belum Ada Pemberitahuan</h6>
                            <p class="small text-muted mb-0">Semua notifikasi baru akan muncul di sini secara otomatis.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
