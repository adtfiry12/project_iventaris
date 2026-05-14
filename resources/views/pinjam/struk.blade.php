<!DOCTYPE html>
<html>

<head>
    <title>Struk Peminjaman</title>
    <style>
        body {
            font-family: monospace;
            padding: 20px;
        }

        .center {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border-bottom: 1px dashed #000;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body onload="window.print()">
    <div style="width: 350px; margin: 0 auto; border: 1px dashed #000; padding: 15px;">
        <h3 class="center" style="margin-bottom: 5px;">BUKTI PEMINJAMAN</h3>
        <p class="center" style="margin-top: 0; font-size: 12px;">Sistem Inventaris Barang</p>
        <hr style="border: 1px dashed #000;">
        <p>
            Tgl Pinjam : {{ \Carbon\Carbon::parse($pinjam->tgl_pinjam)->format('d-m-Y') }} <br>
            Peminjam : {{ $pinjam->karyawan->nama }} <br>
            Admin : {{ $pinjam->pengguna->nama }}
        </p>
        <hr style="border: 1px dashed #000;">
        <table>
            <tr>
                <th>Barang</th>
                <th>Kondisi</th>
                <th>Qty</th>
            </tr>
            @foreach ($pinjam->detail_pinjam as $detail)
                <tr>
                    <td>{{ $detail->inventaris->nama ?? '-' }}</td>
                    <td>{{ $detail->kondisi }}</td>
                    <td>{{ $detail->jumlah }}</td>
                </tr>
            @endforeach
        </table>
        <br><br>
        <div style="text-align: right;">
            <p>Ttd Peminjam</p>
            <br><br>
            <p>( ................... )</p>
        </div>
    </div>
</body>

</html>
