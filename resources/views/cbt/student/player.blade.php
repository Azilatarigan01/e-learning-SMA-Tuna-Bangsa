@extends('layouts.app')

@section('content')
<div class="content-wrapper" style="background: #f4f6f9; min-height: 100vh;">
    <!-- Sticky Exam Topbar -->
    <div class="sticky-top shadow-sm py-3 px-4" style="background: linear-gradient(135deg, #851624 0%, #4a060e 100%); color: #fff; z-index: 1020;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <span class="badge px-3 py-1 mb-1 font-weight-bold" style="background: rgba(197, 155, 39, 0.3); color: #ffd700; border: 1px solid rgba(255, 215, 0, 0.4); border-radius: 20px; font-size: 0.78rem;">
                    <i class="fas fa-desktop mr-1"></i> SIMULASI UJIAN CBT &bull; {{ $exam->subject->name ?? '' }}
                </span>
                <h5 class="font-weight-bold mb-0 text-white" style="letter-spacing: -0.3px;">
                    {{ $exam->title }}
                </h5>
            </div>

            <!-- Live Countdown Timer -->
            <div class="d-flex align-items-center">
                <div class="px-4 py-2 rounded-pill shadow-sm d-flex align-items-center" style="background: #ffffff; color: #851624; border: 2px solid #ffd700;">
                    <i class="fas fa-stopwatch mr-2 text-warning fs-5"></i>
                    <div>
                        <small class="d-block text-muted font-weight-bold text-uppercase" style="font-size: 0.65rem; line-height: 1;">SISA WAKTU</small>
                        <span id="countdownTimer" class="font-weight-bold" style="font-size: 1.25rem; font-family: monospace; letter-spacing: 1px;">
                            --:--:--
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Exam Content Area -->
    <section class="content pt-4 pb-5">
        <div class="container-fluid">
            <form id="cbtExamForm" method="POST" action="{{ route('cbt.student.submit', $exam->id) }}">
                @csrf
                <div class="row">
                    <!-- Left: Questions Container -->
                    <div class="col-lg-8">
                        @foreach($questions as $index => $q)
                        <div class="card border-0 shadow-sm rounded-14 mb-4 question-card" id="questionCard{{ $index }}" style="border-radius: 14px; background: #fff; {{ $index == 0 ? '' : 'display: none;' }}">
                            <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center border-bottom">
                                <span class="badge badge-danger px-3 py-1 font-weight-bold" style="background: #851624; border-radius: 12px; font-size: 0.85rem;">
                                    Nomor Soal {{ $index + 1 }} dari {{ count($questions) }}
                                </span>
                                <span class="badge badge-light border text-muted px-2 py-1">
                                    Bobot: {{ $q->marks }} Poin
                                </span>
                            </div>

                            <div class="card-body p-4">
                                <!-- Question Text -->
                                <div class="font-weight-bold text-dark mb-4" style="font-size: 1.05rem; line-height: 1.7; white-space: pre-line;">
                                    {{ $q->question_text }}
                                </div>

                                <!-- Choices Options -->
                                <div class="options-container">
                                    @foreach(['A' => $q->option_a, 'B' => $q->option_b, 'C' => $q->option_c, 'D' => $q->option_d, 'E' => $q->option_e] as $optKey => $optVal)
                                    @if(!empty($optVal))
                                    <label class="d-flex align-items-center p-3 mb-3 rounded-14 option-label" for="opt_{{ $q->id }}_{{ $optKey }}" style="border: 1.5px solid #e2e8f0; border-radius: 12px; cursor: pointer; transition: all 0.2s ease; background: #fff;">
                                        <input type="radio" name="answers[{{ $q->id }}]" value="{{ $optKey }}" id="opt_{{ $q->id }}_{{ $optKey }}" class="form-check-input mr-3 option-radio" data-question-index="{{ $index }}" style="width: 1.25rem; height: 1.25rem; accent-color: #851624; cursor: pointer;">
                                        <div class="d-flex align-items-center w-100">
                                            <span class="rounded-circle d-flex align-items-center justify-content-center mr-3 font-weight-bold" style="width: 32px; height: 32px; background: #fdf2f2; color: #851624; flex-shrink: 0; font-size: 0.9rem;">
                                                {{ $optKey }}
                                            </span>
                                            <span class="text-dark font-weight-medium" style="font-size: 0.95rem;">
                                                {{ $optVal }}
                                            </span>
                                        </div>
                                    </label>
                                    @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Footer Nav Controls -->
                            <div class="card-footer bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center border-top">
                                <button type="button" class="btn btn-outline-secondary font-weight-bold px-4 py-2" onclick="navigateQuestion({{ $index - 1 }})" {{ $index == 0 ? 'disabled' : '' }} style="border-radius: 10px;">
                                    <i class="fas fa-arrow-left mr-1"></i> Soal Sebelumnya
                                </button>

                                @if($index < count($questions) - 1)
                                <button type="button" class="btn text-white font-weight-bold px-4 py-2" onclick="navigateQuestion({{ $index + 1 }})" style="background: linear-gradient(135deg, #851624, #5a0c16); border-radius: 10px;">
                                    Soal Berikutnya <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                                @else
                                <button type="button" class="btn font-weight-bold px-4 py-2 shadow-sm text-dark" onclick="confirmSubmit()" style="background: linear-gradient(135deg, #ffd700, #c59b27); border-radius: 10px;">
                                    <i class="fas fa-check-circle mr-1"></i> Selesaikan Ujian
                                </button>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Right: Number Navigation Palette -->
                    <div class="col-lg-4">
                        <div class="card border-0 shadow-sm rounded-14 sticky-top" style="border-radius: 14px; background: #fff; top: 90px;">
                            <div class="card-header bg-white border-0 pt-4 px-4 pb-2">
                                <h6 class="font-weight-bold text-dark mb-0">
                                    <i class="fas fa-th mr-2" style="color: #851624;"></i> Lembar Navigasi Soal
                                </h6>
                                <small class="text-muted">Klik nomor untuk berpindah butir soal.</small>
                            </div>
                            <div class="card-body px-4 py-3">
                                <div class="row no-gutters mb-4" style="gap: 8px;">
                                    @foreach($questions as $idx => $q)
                                    <button type="button" class="btn nav-num-btn font-weight-bold {{ $idx == 0 ? 'border-danger active-num' : '' }}" id="navNumBtn{{ $idx }}" onclick="navigateQuestion({{ $idx }})" style="width: 44px; height: 44px; border-radius: 10px; background: #f8fafc; color: #64748b; border: 1.5px solid #cbd5e1; font-size: 0.95rem;">
                                        {{ $idx + 1 }}
                                    </button>
                                    @endforeach
                                </div>

                                <div class="pt-3 border-top">
                                    <div class="d-flex align-items-center mb-2 small text-muted">
                                        <span class="d-inline-block rounded mr-2" style="width: 14px; height: 14px; background: #28a745;"></span>
                                        <span>Sudah Terjawab</span>
                                    </div>
                                    <div class="d-flex align-items-center mb-3 small text-muted">
                                        <span class="d-inline-block rounded mr-2" style="width: 14px; height: 14px; background: #f8fafc; border: 1.5px solid #cbd5e1;"></span>
                                        <span>Belum Dijawab</span>
                                    </div>

                                    <button type="button" class="btn btn-block font-weight-bold py-2 shadow-sm text-dark" onclick="confirmSubmit()" style="background: linear-gradient(135deg, #ffd700, #c59b27); border-radius: 10px; border: none;">
                                        <i class="fas fa-flag-checkered mr-1"></i> Kumpulkan & Selesai
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Confirmation Modal -->
                <div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-0 shadow" style="border-radius: 14px;">
                            <div class="modal-header border-0 pb-0">
                                <h5 class="modal-title font-weight-bold text-dark" id="submitModalLabel">
                                    <i class="fas fa-question-circle text-warning mr-2"></i> Konfirmasi Pengumpulan Ujian
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body py-4">
                                <p class="text-secondary mb-2" id="answeredCountText">
                                    Memeriksa status jawaban Anda...
                                </p>
                                <p class="text-muted small mb-0">
                                    Setelah dikumpulkan, jawaban akan dinilai secara otomatis oleh sistem dan tidak dapat diubah lagi. Apakah Anda yakin ingin mengakhiri sesi ujian ini?
                                </p>
                            </div>
                            <div class="modal-footer border-0 pt-0">
                                <button type="button" class="btn btn-outline-secondary font-weight-bold px-4" data-dismiss="modal" style="border-radius: 8px;">Periksa Kembali</button>
                                <button type="submit" class="btn text-white font-weight-bold px-4 shadow-sm" style="background: linear-gradient(135deg, #851624, #4a060e); border-radius: 8px;">
                                    Ya, Kumpulkan Jawaban
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </section>
</div>

<!-- CBT Client Script -->
<script>
    let currentIndex = 0;
    const totalQuestions = {{ count($questions) }};
    let remainingSeconds = {{ $remainingSeconds }};

    // Countdown Timer logic
    function updateTimer() {
        if (remainingSeconds <= 0) {
            document.getElementById('countdownTimer').innerText = "00:00:00";
            alert("Waktu ujian telah berakhir! Sistem akan secara otomatis mengumpulkan lembar jawaban Anda.");
            document.getElementById('cbtExamForm').submit();
            return;
        }

        let hours = Math.floor(remainingSeconds / 3600);
        let minutes = Math.floor((remainingSeconds % 3600) / 60);
        let seconds = remainingSeconds % 60;

        let display = 
            (hours < 10 ? "0" + hours : hours) + ":" +
            (minutes < 10 ? "0" + minutes : minutes) + ":" +
            (seconds < 10 ? "0" + seconds : seconds);

        document.getElementById('countdownTimer').innerText = display;

        if (remainingSeconds < 300) {
            document.getElementById('countdownTimer').style.color = '#dc3545';
        }

        remainingSeconds--;
    }

    setInterval(updateTimer, 1000);
    updateTimer();

    // Navigate Questions
    function navigateQuestion(targetIndex) {
        if (targetIndex < 0 || targetIndex >= totalQuestions) return;

        // Hide current
        document.getElementById('questionCard' + currentIndex).style.display = 'none';
        let prevNavBtn = document.getElementById('navNumBtn' + currentIndex);
        prevNavBtn.classList.remove('active-num');

        // Show target
        currentIndex = targetIndex;
        document.getElementById('questionCard' + currentIndex).style.display = 'block';
        let targetNavBtn = document.getElementById('navNumBtn' + currentIndex);
        targetNavBtn.classList.add('active-num');
        window.scrollTo({ top: 80, behavior: 'smooth' });
    }

    // Radio change listener to mark question button as green (answered)
    document.querySelectorAll('.option-radio').forEach(function(radio) {
        radio.addEventListener('change', function() {
            let qIdx = this.getAttribute('data-question-index');
            let navBtn = document.getElementById('navNumBtn' + qIdx);
            navBtn.style.background = '#28a745';
            navBtn.style.color = '#ffffff';
            navBtn.style.borderColor = '#28a745';
        });
    });

    // Confirm Submit Modal
    function confirmSubmit() {
        let answered = document.querySelectorAll('.option-radio:checked').length;
        document.getElementById('answeredCountText').innerHTML = 
            'Anda telah menjawab <strong>' + answered + '</strong> dari <strong>' + totalQuestions + '</strong> butir soal yang tersedia.';
        
        // Trigger modal using jQuery/Bootstrap modal
        if (typeof $ !== 'undefined' && $('#submitModal').modal) {
            $('#submitModal').modal('show');
        } else {
            if (confirm('Anda telah menjawab ' + answered + ' dari ' + totalQuestions + ' soal. Yakin ingin mengumpulkan ujian sekarang?')) {
                document.getElementById('cbtExamForm').submit();
            }
        }
    }
</script>

<style>
    .option-label:hover {
        border-color: #851624 !important;
        background: #fdfbf7 !important;
    }
    .active-num {
        border: 2.5px solid #851624 !important;
        transform: scale(1.08);
        box-shadow: 0 2px 6px rgba(133, 22, 36, 0.25);
    }
</style>
@endsection
