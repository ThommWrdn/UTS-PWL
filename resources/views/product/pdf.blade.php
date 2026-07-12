<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Produk</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #1a1a2e;
        }

        /* ── HEADER ─────────────────────────────────────── */
        .header {
            background-color: #1e3a5f;
            color: #ffffff;
            padding: 14px 20px;
            margin-bottom: 18px;
        }
        .header h1 {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        .header-meta {
            font-size: 10px;
            color: #c0d8f0;
        }

        /* ── TABLE ───────────────────────────────────────── */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        thead tr {
            background-color: #d0e4f7;
            color: #1a2e4a;
        }

        thead th {
            padding: 9px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            border: 1px solid #9dbfdf;
        }

        tbody tr:nth-child(even) {
            background-color: #eaf1fb;
        }

        tbody tr:nth-child(odd) {
            background-color: #ffffff;
        }

        tbody td {
            padding: 8px 10px;
            border: 1px solid #c8d8ea;
            vertical-align: middle;
        }

        td.center { text-align: center; }
        td.right  { text-align: right; }

        /* badge-stock dihapus, stok tampil polos */

        /* ── FOOTER ──────────────────────────────────────── */
        .footer {
            margin-top: 20px;
            font-size: 10px;
            color: #6c757d;
            border-top: 1px solid #d0dce8;
            padding-top: 8px;
            display: table;
            width: 100%;
        }
        .footer-left  { display: table-cell; text-align: left; }
        .footer-right { display: table-cell; text-align: right; }

        .summary-box {
            margin-top: 14px;
            background-color: #eaf1fb;
            border: 1px solid #c8d8ea;
            padding: 8px 12px;
            font-size: 11px;
            width: 220px;
            float: right;
        }
        .summary-box table { font-size: 11px; }
        .summary-box td { border: none; padding: 3px 6px; }
    </style>
</head>
<body>

    {{-- Header --}}
    <div class="header">
        <h1>Laporan Data Produk</h1>
        <div class="header-meta">
            Tanggal Cetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM Y') }}
            &nbsp;|&nbsp;
            Dicetak oleh: SistemCRUD
        </div>
    </div>

    {{-- Tabel Produk --}}
    <table>
        <thead>
            <tr>
                <th style="width:5%">No</th>
                <th style="width:12%">Kode</th>
                <th style="width:38%">Nama Produk</th>
                <th style="width:25%">Harga</th>
                <th style="width:10%">Stok</th>
                <th style="width:10%">Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php $totalNilai = 0; @endphp
            @forelse($products as $index => $p)
            @php
                $nilai = ($p->price ?? 0) * ($p->stock ?? 0);
                $totalNilai += $nilai;
            @endphp
            <tr>
                <td class="center">{{ $index + 1 }}</td>
                <td class="center">P{{ str_pad($index + 1, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $p->name }}</td>
                <td class="right">Rp {{ number_format($p->price ?? 0, 0, ',', '.') }}</td>
                <td class="center">{{ $p->stock ?? 0 }}</td>
                <td class="center">{{ $p->satuan ?? 'pcs' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="center" style="padding: 14px; color: #888;">
                    Tidak ada data produk.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Summary --}}
    <div class="summary-box">
        <table width="100%">
            <tr>
                <td>Total Produk</td>
                <td style="text-align:right"><strong>{{ $products->count() }} item</strong></td>
            </tr>
            <tr>
                <td>Total Nilai Stok</td>
                <td style="text-align:right"><strong>Rp {{ number_format($totalNilai, 0, ',', '.') }}</strong></td>
            </tr>
        </table>
    </div>

    {{-- Footer --}}
    <div class="footer" style="clear:both;">
        <div class="footer-left">Dokumen ini digenerate otomatis oleh SistemCRUD</div>
        <div class="footer-right">{{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</div>
    </div>

</body>
</html>
