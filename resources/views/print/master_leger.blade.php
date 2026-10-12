<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Buku Induk Leger Nilai - {{ $class->name }} - SMA Tuna Bangsa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @page {
            size: A4 landscape;
            margin: 10mm;
        }
        body {
            font-family: Arial, sans-serif;
            color: #111;
            background: #f4f6f9;
            margin: 0;
            padding: 20px 0;
        }
        .page-container {
            width: 297mm;
            min-height: 210mm;
            margin: 0 auto;
            background: #fff;
            padding: 12mm 15mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }
        .header-kop {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        .kop-text {
            text-align: center;
            flex-grow: 1;
        }
        .kop-text h4 {
            margin: 0;
            font-size: 11pt;
            font-weight: normal;
        }
        .kop-text h2 {
            margin: 2px 0;
            font-size: 14pt;
            color: #851624;
        }
        .kop-text p {
            margin: 0;
            font-size: 8.5pt;
        }
        .title-box {
            text-align: center;
            margin-bottom: 12px;
        }
        .title-box h3 {
            margin: 0;
            font-size: 12pt;
            text-transform: uppercase;
        }
        .meta-info {
            display: flex;
            justify-content: space-between;
            font-size: 9pt;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .leger-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
            margin-bottom: 15px;
        }
        .leger-table th, .leger-table td {
            border: 1px solid #333;
            padding: 4px 5px;
            text-align: center;
        }
        .leger-table th {
            background-color: #f2f2f2;
        }
        .leger-table td.text-left {
            text-align: left;
        }
        .signatures {
            width: 100%;
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            font-size: 9pt;
            text-align: center;
        }
        .sign-col {
            width: 35%;
        }
        .sign-space {
            height: 50px;
        }
        .print-toolbar {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #851624;
            padding: 8px 16px;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.25);
            display: flex;
            gap: 10px;
            z-index: 9999;
        }
        .print-btn {
            background: #ffd700;
            color: #4a060e;
            border: none;
            padding: 6px 16px;
            font-weight: bold;
            border-radius: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
        }
        .back-btn {
            background: rgba(255,255,255,0.2);
            color: #fff;
            border: none;
            padding: 6px 14px;
            border-radius: 20px;
            cursor: pointer;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
        }
        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .page-container {
                box-shadow: none;
                margin: 0;
                padding: 0;
                width: 100%;
            }
            .print-toolbar {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="print-toolbar">
        <button class="print-btn" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Leger (A4 Landscape)
        </button>
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="page-container">
        <!-- KOP -->
        <div class="header-kop">
            <div class="kop-text">
                <h4>DINAS PENDIDIKAN PROVINSI SUMATERA UTARA</h4>
                <h2>SMA SWASTA TUNA BANGSA MEDAN</h2>
                <p>Alamat: Jl. Merdeka No. 128, Medan &bull; Telepon: (061) 7894561 &bull; Website: tunabangsa.sch.id</p>
            </div>
        </div>

        <div class="title-box">
            <h3>BUKU LEGER NILAI AKHIR KOLEKTIF PESERTA DIDIK</h3>
        </div>

        <div class="meta-info">
            <span>Rombel Kelas: <u>{{ $class->name }}</u></span>
            <span>Tahun Ajaran: <u>2026/2027</u></span>
            <span>Semester: <u>Ganjil</u></span>
            <span>Wali Kelas: <u>Azillll, S.Pd.</u></span>
        </div>

        <!-- TABLE LEGER -->
        <table class="leger-table">
            <thead>
                <tr>
                    <th style="width: 25px;">No</th>
                    <th style="width: 140px;">Nama Siswa</th>
                    @foreach($subjects as $s)
                        <th style="min-width: 45px;">{{ Str::limit($s->name, 8) }}</th>
                    @endforeach
                    <th style="width: 45px; background: #e8f4fd;">Total</th>
                    <th style="width: 45px; background: #e8f4fd;">Rerata</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $stu)
                @php
                    $stuGrades = $gradesMatrix[$stu->id] ?? collect();
                    $tot = 0;
                    $cnt = 0;
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left"><strong>{{ $stu->name }}</strong></td>
                    @foreach($subjects as $s)
                        @php
                            $g = $stuGrades->get($s->id);
                            if ($g) {
                                $tot += $g->grade_total;
                                $cnt++;
                            }
                        @endphp
                        <td>{{ $g ? $g->grade_total : '-' }}</td>
                    @endforeach
                    <td style="background: #fbfdff; font-weight: bold;">{{ $tot }}</td>
                    <td style="background: #fbfdff; font-weight: bold; color: #851624;">
                        {{ $cnt > 0 ? round($tot / $cnt, 1) : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- TANDA TANGAN -->
        <div class="signatures">
            <div class="sign-col">
                Mengetahui,<br>
                Kepala SMA Tuna Bangsa
                <div class="sign-space"></div>
                <strong>Dr. H. Muhammad Ilyas, M.Pd.</strong><br>
                NIP. 19740312 199903 1 002
            </div>
            <div class="sign-col">
                Medan, 12 Oktober 2026<br>
                Wali Kelas {{ $class->name }}
                <div class="sign-space"></div>
                <strong>Azillll, S.Pd.</strong><br>
                NIP. 19850714 201001 2 003
            </div>
        </div>
    </div>

</body>
</html>
