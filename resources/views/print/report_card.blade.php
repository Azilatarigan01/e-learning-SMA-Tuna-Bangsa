<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rapor Digital Siswa - {{ $student->name }} - SMA Tuna Bangsa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #111;
            background: #f4f6f9;
            margin: 0;
            padding: 20px 0;
        }
        .page-container {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            padding: 20mm 20mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            position: relative;
        }
        .header-kop {
            display: flex;
            align-items: center;
            border-bottom: 3px double #000;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .logo-box {
            width: 80px;
            height: 80px;
            background: #851624;
            color: #ffd700;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            margin-right: 20px;
            flex-shrink: 0;
        }
        .kop-text {
            text-align: center;
            flex-grow: 1;
        }
        .kop-text h4 {
            margin: 0;
            font-size: 13pt;
            letter-spacing: 0.5px;
            font-weight: normal;
        }
        .kop-text h2 {
            margin: 2px 0;
            font-size: 16pt;
            font-weight: bold;
            color: #851624;
        }
        .kop-text p {
            margin: 0;
            font-size: 9pt;
            color: #333;
        }
        .report-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .report-title h3 {
            margin: 0;
            font-size: 13pt;
            text-decoration: underline;
        }
        .report-title p {
            margin: 3px 0 0;
            font-size: 10pt;
        }
        .info-table {
            width: 100%;
            font-size: 10pt;
            margin-bottom: 15px;
        }
        .info-table td {
            padding: 3px 6px;
            vertical-align: top;
        }
        .grades-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9.5pt;
            margin-bottom: 20px;
        }
        .grades-table th, .grades-table td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: center;
        }
        .grades-table th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .grades-table td.text-left {
            text-align: left;
        }
        .summary-box {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 10pt;
        }
        .signatures {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            font-size: 10pt;
            text-align: center;
        }
        .sign-col {
            width: 30%;
        }
        .sign-space {
            height: 65px;
        }
        /* Floating Toolbar */
        .print-toolbar {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #851624;
            padding: 10px 18px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
            display: flex;
            gap: 12px;
            z-index: 9999;
        }
        .print-btn {
            background: #ffd700;
            color: #4a060e;
            border: none;
            padding: 8px 18px;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .back-btn {
            background: rgba(255,255,255,0.2);
            color: #fff;
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.9rem;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .page-container {
                box-shadow: none;
                margin: 0;
                padding: 10mm 15mm;
                width: 100%;
                min-height: auto;
            }
            .print-toolbar {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <!-- Print Toolbar -->
    <div class="print-toolbar">
        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak / Simpan PDF
        </button>
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <!-- Official Report Card Document -->
    <div class="page-container">
        <!-- KOP SURAT RESMI -->
        <div class="header-kop">
            <div class="logo-box">
                <i class="fas fa-school"></i>
            </div>
            <div class="kop-text">
                <h4>YAYASAN PENDIDIKAN TUNA BANGSA</h4>
                <h2>SMA SWASTA TUNA BANGSA</h2>
                <p>NPSN: 10203040 &bull; Akreditasi A (Unggul) &bull; SK Pendirian No. 421/08/Disdik</p>
                <p>Jl. Merdeka No. 128, Medan - Sumatera Utara | Telp: (061) 7894561 | Web: tunabangsa.sch.id</p>
            </div>
        </div>

        <!-- JUDUL LAPORAN -->
        <div class="report-title">
            <h3>LAPORAN HASIL CAPAIAN BELAJAR PESERTA DIDIK</h3>
            <p>Tahun Ajaran: <strong>2026/2027</strong> &bull; Semester: <strong>Ganjil</strong></p>
        </div>

        <!-- IDENTITAS SISWA -->
        <table class="info-table">
            <tr>
                <td style="width: 18%;"><strong>Nama Peserta Didik</strong></td>
                <td style="width: 2%;">:</td>
                <td style="width: 45%;"><strong>{{ strtoupper($student->name) }}</strong></td>
                <td style="width: 15%;"><strong>Kelas / Rombel</strong></td>
                <td style="width: 2%;">:</td>
                <td style="width: 18%;">{{ $student->classModel->name ?? '-' }}</td>
            </tr>
            <tr>
                <td><strong>NIS / NISN</strong></td>
                <td>:</td>
                <td>{{ $student->nis ?? '2026010' . str_pad($student->id, 3, '0', STR_PAD_LEFT) }}</td>
                <td><strong>Fase / Jenjang</strong></td>
                <td>:</td>
                <td>Fase E (SMA)</td>
            </tr>
            <tr>
                <td><strong>Wali Murid</strong></td>
                <td>:</td>
                <td>Bpk. Budi Santoso / Orang Tua</td>
                <td><strong>Wali Kelas</strong></td>
                <td>:</td>
                <td>Azillll, S.Pd.</td>
            </tr>
        </table>

        <!-- TABEL NILAI CAPAIAN -->
        <table class="grades-table">
            <thead>
                <tr>
                    <th rowspan="2" style="width: 35px;">No</th>
                    <th rowspan="2">Mata Pelajaran</th>
                    <th rowspan="2" style="width: 45px;">KKM</th>
                    <th colspan="3">Komponen Asesmen</th>
                    <th rowspan="2" style="width: 55px;">Nilai Akhir</th>
                    <th rowspan="2" style="width: 55px;">Predikat</th>
                    <th rowspan="2" style="width: 80px;">Keterangan</th>
                </tr>
                <tr>
                    <th style="width: 50px;">Tugas</th>
                    <th style="width: 50px;">UTS</th>
                    <th style="width: 50px;">UAS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($grades as $g)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left"><strong>{{ $g->subject->name ?? '-' }}</strong></td>
                    <td>75</td>
                    <td>{{ $g->assignment_score }}</td>
                    <td>{{ $g->midterm_score }}</td>
                    <td>{{ $g->final_score }}</td>
                    <td><strong>{{ $g->grade_total }}</strong></td>
                    <td><strong>{{ $g->letter_grade }}</strong></td>
                    <td>
                        @if($g->grade_total >= 75)
                            <span style="color: green; font-weight: bold;">TUNTAS</span>
                        @else
                            <span style="color: red; font-weight: bold;">REMEDIAL</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" style="padding: 20px;">Belum ada catatan nilai yang diterbitkan untuk semester ini.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- REKAPITULASI & STATUS -->
        <div class="summary-box">
            <div style="width: 60%; border: 1px solid #ddd; padding: 10px; border-radius: 6px;">
                <strong>Catatan Perkembangan Akademik & Karakter:</strong>
                <p style="margin: 5px 0 0; font-size: 9pt; font-style: italic; line-height: 1.4;">
                    Peserta didik menunjukkan motivasi belajar yang konsisten, aktif dalam kegiatan intrakurikuler dan kepribadian yang santun. Pertahankan prestasi dan kedisiplinan belajar.
                </p>
            </div>
            <div style="width: 35%; border: 1px solid #ddd; padding: 10px; border-radius: 6px; text-align: center;">
                <strong>Indeks Prestasi Rata-Rata (IPK):</strong>
                <h2 style="margin: 5px 0; color: #851624;">{{ $gpa['gpa'] ?? '0.00' }} / 4.00</h2>
                <small>Nilai Rata-Rata: <strong>{{ $gpa['average'] ?? '0.0' }}</strong></small>
            </div>
        </div>

        <!-- TANDA TANGAN RESMI -->
        <div class="signatures">
            <div class="sign-col">
                Mengetahui,<br>
                Orang Tua / Wali Murid
                <div class="sign-space"></div>
                ( .................................................. )
            </div>
            <div class="sign-col">
                Medan, 12 Oktober 2026<br>
                Wali Kelas
                <div class="sign-space"></div>
                <strong>Azillll, S.Pd.</strong><br>
                NIP. 19850714 201001 2 003
            </div>
            <div class="sign-col">
                Mengetahui,<br>
                Kepala SMA Tuna Bangsa
                <div class="sign-space"></div>
                <strong>Dr. H. Muhammad Ilyas, M.Pd.</strong><br>
                NIP. 19740312 199903 1 002
            </div>
        </div>
    </div>

</body>
</html>
