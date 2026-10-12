@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #fdfbf7; min-height: 100vh;">
    <!-- Content Header -->
    <div class="content-header pb-2 pt-3">
        <div class="container-fluid">
            <!-- Modern Crimson Hero Header -->
            <div class="p-4 rounded-14 shadow-sm mb-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; position: relative; overflow: hidden; border-radius: 14px;">
                <div style="position: absolute; right: -20px; bottom: -20px; font-size: 8rem; opacity: 0.08; color: #fff;">
                    <i class="fas fa-comments"></i>
                </div>
                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-8">
                        <span class="badge px-3 py-1 mb-2" style="background: rgba(197, 155, 39, 0.25); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-weight: 600; font-size: 0.82rem;">
                            <i class="fas fa-question-circle mr-1"></i> Kolaborasi Pembelajaran & Q&A
                        </span>
                        <h1 class="h3 font-weight-bold mb-1" style="color: #ffffff; letter-spacing: -0.5px;">
                            Forum Diskusi & Tanya Jawab Mata Pelajaran
                        </h1>
                        <p class="mb-0 text-white-50" style="font-size: 0.95rem;">
                            Ruang interaktif bagi guru dan siswa SMA Tuna Bangsa untuk bertukar gagasan, mengulas materi, dan memecahkan soal secara kolaboratif.
                        </p>
                    </div>
                    <div class="col-md-4 text-md-right mt-3 mt-md-0">
                        <a href="#newDiscussionCard" class="btn px-4 py-2 font-weight-bold shadow-sm" style="background: linear-gradient(135deg, #ffd700, #c59b27); color: #4a060e; border-radius: 10px; border: none;">
                            <i class="fas fa-pen-nib mr-1"></i> Mulai Diskusi Baru
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
            <div class="row">
                <!-- Left Column: Filter & Feed -->
                <div class="col-lg-8">
                    <!-- Filter Bar -->
                    <div class="card border-0 shadow-sm rounded-14 mb-4" style="border-radius: 14px; background: #fff;">
                        <div class="card-body p-3">
                            <form method="GET" action="{{ url('discussion') }}" class="form-row align-items-center">
                                @if(Auth::user()->user_type != 3)
                                <div class="col-md-5 mb-2 mb-md-0">
                                    <label class="small text-muted font-weight-bold mb-1"><i class="fas fa-chalkboard mr-1"></i> Pilih Kelas</label>
                                    <select name="class_id" class="form-control form-control-sm" style="border-radius: 8px; border: 1px solid #ddd;" onchange="this.form.submit()">
                                        @foreach($classes as $c)
                                            <option value="{{ $c->id }}" {{ $classId == $c->id ? 'selected' : '' }}>
                                                {{ $c->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @endif

                                <div class="{{ Auth::user()->user_type == 3 ? 'col-md-8' : 'col-md-5' }} mb-2 mb-md-0">
                                    <label class="small text-muted font-weight-bold mb-1"><i class="fas fa-book mr-1"></i> Filter Mata Pelajaran</label>
                                    <select name="subject_id" class="form-control form-control-sm" style="border-radius: 8px; border: 1px solid #ddd;" onchange="this.form.submit()">
                                        <option value="">-- Semua Mata Pelajaran --</option>
                                        @foreach($subjects as $s)
                                            <option value="{{ $s->id }}" {{ $selectedSubjectId == $s->id ? 'selected' : '' }}>
                                                {{ $s->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="{{ Auth::user()->user_type == 3 ? 'col-md-4' : 'col-md-2' }} text-right pt-md-3">
                                    <a href="{{ url('discussion') }}{{ Auth::user()->user_type != 3 ? '?class_id='.$classId : '' }}" class="btn btn-sm btn-outline-secondary btn-block font-weight-bold" style="border-radius: 8px;">
                                        <i class="fas fa-redo-alt mr-1"></i> Reset
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Thread Discussion Feed -->
                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <h5 class="font-weight-bold mb-0 text-dark">
                            <i class="fas fa-stream mr-2" style="color: #851624;"></i> Daftar Utas Diskusi 
                            <span class="badge badge-light border ml-1 font-weight-normal text-muted">{{ count($discussions) }} Topik</span>
                        </h5>
                    </div>

                    @forelse($discussions as $disc)
                    <div class="card border-0 shadow-sm rounded-14 mb-4 position-relative" style="border-radius: 14px; background: #fff; overflow: hidden; border-left: 5px solid {{ $disc->is_pinned ? '#c59b27' : '#851624' }} !important;">
                        @if($disc->is_pinned)
                        <div class="py-1 px-3" style="background: rgba(197, 155, 39, 0.12); color: #8a6508; font-size: 0.78rem; font-weight: 700; border-bottom: 1px solid rgba(197, 155, 39, 0.2);">
                            <i class="fas fa-thumbtack mr-1 text-warning"></i> TOPIC DIPIN / DISEMATKAN OLEH GURU
                        </div>
                        @endif

                        <div class="card-body p-4">
                            <!-- Thread Meta -->
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="d-flex align-items-center">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold shadow-sm mr-3" style="width: 44px; height: 44px; background: {{ $disc->author->user_type == 2 ? 'linear-gradient(135deg, #851624, #4a060e)' : '#2b5876' }}; font-size: 1.1rem; flex-shrink: 0;">
                                        {{ strtoupper(substr($disc->author->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="d-flex align-items-center">
                                            <h6 class="font-weight-bold mb-0 text-dark mr-2">{{ $disc->author->name ?? 'Anonim' }}</h6>
                                            @if($disc->author && $disc->author->user_type == 2)
                                                <span class="badge badge-danger px-2 py-0" style="background: #851624; font-size: 0.72rem; border-radius: 10px;">Guru Pengajar</span>
                                            @elseif($disc->author && $disc->author->user_type == 3)
                                                <span class="badge badge-secondary px-2 py-0" style="font-size: 0.72rem; border-radius: 10px;">Siswa</span>
                                            @endif
                                        </div>
                                        <small class="text-muted">
                                            <i class="far fa-clock mr-1"></i> {{ date('d M Y, H:i', strtotime($disc->created_at)) }} &bull; {{ $disc->classModel->name ?? '' }}
                                        </small>
                                    </div>
                                </div>
                                <div>
                                    <span class="badge px-3 py-1 font-weight-bold" style="background: #fdf2f2; color: #851624; border: 1px solid #fed7d7; border-radius: 12px; font-size: 0.8rem;">
                                        <i class="fas fa-bookmark mr-1"></i> {{ $disc->subjectModel->name ?? 'Mata Pelajaran' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Thread Title & Body -->
                            <h5 class="font-weight-bold mb-2" style="color: #2c3e50; line-height: 1.4;">
                                {{ $disc->title }}
                            </h5>
                            <p class="text-secondary mb-3" style="font-size: 0.95rem; line-height: 1.6; white-space: pre-line;">
                                {{ $disc->content }}
                            </p>

                            <!-- Thread Action Footer -->
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                <div>
                                    <button class="btn btn-sm btn-light font-weight-bold text-dark px-3 py-1 rounded-pill" type="button" data-toggle="collapse" data-target="#replySection{{ $disc->id }}" aria-expanded="false" style="border: 1px solid #e2e8f0; font-size: 0.85rem;">
                                        <i class="far fa-comment-dots mr-1" style="color: #851624;"></i> {{ count($disc->replies) }} Tanggapan
                                    </button>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-link text-muted font-weight-bold p-0" type="button" data-toggle="collapse" data-target="#replySection{{ $disc->id }}">
                                        Tulis Balasan <i class="fas fa-chevron-down ml-1 small"></i>
                                    </button>
                                </div>
                            </div>

                            <!-- Replies Section (Collapsible) -->
                            <div class="collapse mt-3 {{ count($disc->replies) > 0 ? 'show' : '' }}" id="replySection{{ $disc->id }}">
                                <div class="p-3 rounded-14" style="background: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px;">
                                    
                                    @if(count($disc->replies) > 0)
                                        <div class="mb-3">
                                            @foreach($disc->replies as $reply)
                                                <div class="d-flex mb-3 pb-3 border-bottom position-relative">
                                                    <div class="rounded-circle d-flex align-items-center justify-content-center text-white font-weight-bold shadow-xs mr-2" style="width: 32px; height: 32px; background: {{ $reply->author && $reply->author->user_type == 2 ? '#851624' : '#64748b' }}; font-size: 0.85rem; flex-shrink: 0;">
                                                        {{ strtoupper(substr($reply->author->name ?? 'U', 0, 1)) }}
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <span class="font-weight-bold text-dark mr-2" style="font-size: 0.88rem;">{{ $reply->author->name ?? 'Anonim' }}</span>
                                                            @if($reply->author && $reply->author->user_type == 2)
                                                                <span class="badge badge-success px-2 py-0 mr-2" style="font-size: 0.68rem; background: #28a745;">Tanggapan Guru</span>
                                                            @endif
                                                            <small class="text-muted ml-auto" style="font-size: 0.75rem;">{{ date('d M, H:i', strtotime($reply->created_at)) }}</small>
                                                        </div>
                                                        <div class="text-secondary" style="font-size: 0.88rem; line-height: 1.5; white-space: pre-line;">
                                                            {{ $reply->reply_text }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <div class="text-center py-2 text-muted small mb-2">
                                            Belum ada balasan pada topik ini. Jadilah yang pertama memberikan solusi atau tanggapan!
                                        </div>
                                    @endif

                                    <!-- Quick Reply Form -->
                                    <form method="POST" action="{{ url('discussion/reply') }}">
                                        @csrf
                                        <input type="hidden" name="discussion_id" value="{{ $disc->id }}">
                                        <div class="form-group mb-2">
                                            <textarea name="reply_text" rows="2" class="form-control" placeholder="Tuliskan jawaban, pertanyaan lanjutan, atau tanggapan Anda..." required style="border-radius: 8px; font-size: 0.88rem; border: 1px solid #cbd5e1;"></textarea>
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="btn btn-sm text-white px-3 py-1 font-weight-bold" style="background: linear-gradient(135deg, #851624, #5a0c16); border-radius: 8px;">
                                                <i class="fas fa-paper-plane mr-1"></i> Kirim Balasan
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                    @empty
                    <div class="card border-0 shadow-sm rounded-14 text-center py-5" style="border-radius: 14px; background: #fff;">
                        <div class="card-body">
                            <div class="mb-3">
                                <i class="fas fa-comments text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                            </div>
                            <h5 class="font-weight-bold text-dark">Belum Ada Topik Diskusi</h5>
                            <p class="text-muted max-w-500 mx-auto" style="max-width: 450px;">
                                Belum ada diskusi atau tanya jawab yang dipublikasikan pada mata pelajaran ini. Silakan buat pertanyaan baru di panel sebelah kanan!
                            </p>
                        </div>
                    </div>
                    @endforelse

                </div>

                <!-- Right Column: Create Discussion Form & Rules -->
                <div class="col-lg-4">
                    <!-- Create Discussion Card -->
                    <div class="card border-0 shadow-sm rounded-14 mb-4" id="newDiscussionCard" style="border-radius: 14px; background: #fff; overflow: hidden; border-top: 4px solid #851624;">
                        <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                            <h5 class="font-weight-bold text-dark mb-0">
                                <i class="fas fa-pen-fancy mr-2" style="color: #851624;"></i> Buat Topik Diskusi
                            </h5>
                            <small class="text-muted">Ajukan pertanyaan atau buka topik belajar bersama rekan kelas.</small>
                        </div>
                        <div class="card-body px-4 py-3">
                            <form method="POST" action="{{ url('discussion/store') }}">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $classId }}">

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-1">Mata Pelajaran <span class="text-danger">*</span></label>
                                    <select name="subject_id" class="form-control" required style="border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem;">
                                        <option value="">-- Pilih Mata Pelajaran --</option>
                                        @foreach($subjects as $s)
                                            <option value="{{ $s->id }}" {{ $selectedSubjectId == $s->id ? 'selected' : '' }}>
                                                {{ $s->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-1">Judul Topik / Pertanyaan <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder="Cth: Penjelasan Reaksi Redoks Hal 45..." required style="border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem;">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="font-weight-bold small text-muted mb-1">Uraian / Deskripsi Pertanyaan <span class="text-danger">*</span></label>
                                    <textarea name="content" rows="4" class="form-control" placeholder="Jelaskan pertanyaan atau materi yang ingin Anda diskusikan..." required style="border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.9rem;"></textarea>
                                </div>

                                @if(Auth::user()->user_type == 2)
                                <div class="form-group form-check mb-3">
                                    <input type="checkbox" name="is_pinned" value="1" class="form-check-input" id="pinCheck">
                                    <label class="form-check-label small font-weight-bold text-dark" for="pinCheck">
                                        <i class="fas fa-thumbtack text-warning mr-1"></i> Sematkan Topik di Teratas (Pin Thread)
                                    </label>
                                </div>
                                @endif

                                <button type="submit" class="btn btn-block text-white font-weight-bold py-2 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 10px; border: none;">
                                    <i class="fas fa-paper-plane mr-1"></i> Publikasikan Topik
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Forum Guidelines Card -->
                    <div class="card border-0 shadow-sm rounded-14" style="border-radius: 14px; background: #fff;">
                        <div class="card-body p-4">
                            <h6 class="font-weight-bold text-dark mb-3">
                                <i class="fas fa-shield-alt text-warning mr-2"></i> Etika & Tata Tertib Forum
                            </h6>
                            <ul class="text-muted small pl-3 mb-0" style="line-height: 1.7;">
                                <li>Gunakan bahasa yang santun, sopan, dan akademis.</li>
                                <li>Fokuskan pertanyaan pada topik kompetensi mata pelajaran terkait.</li>
                                <li>Hargai setiap perbedaan pendapat dan jawaban teman sekelas.</li>
                                <li>Guru mata pelajaran bertindak sebagai moderator dan verifikator jawaban resmi.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
