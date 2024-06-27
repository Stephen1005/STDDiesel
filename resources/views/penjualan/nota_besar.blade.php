<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota PDF</title>

    <style>
        table td {
            /* font-family: Arial, Helvetica, sans-serif; */
            font-size: 14px;
        }
        table.data td,
        table.data th {
            border: 2px solid #ccc;
            padding: 5px;
        }
        table.data {
            border-collapse: collapse;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        table.data tbody{
            border-left: 2px solid #ccc;
            border-right: 2px solid #ccc;
        }
        table.data tbody td {
            border: none;
        }

    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td colspan="4">
                <h2 style="margin:0px; padding:0px;">{{$setting->nama_perusahaan}}</h2>
            </td>
        </tr>
        <tr>
            <td colspan="4">{{ $setting->alamat }}</td>
        </tr>
        <tr>
            <td colspan="6" style="text-align: center;"><h1>INVOICE</h1></td>
        </tr>
        <tr>
            <td>No Invoice</td>
            <td colspan="3">: {{ $penjualan->no_invoice ?? ''}}</td>
            <td>Tanggal</td>
            <td>: {{ tanggal_indonesia(date('Y-m-d')) }}</td>
        </tr>
        <tr>
            <td>Member</td>
            <td>: {{ $penjualan->member->nama ?? '' }}</td>
        </tr>
        <tr>
            <td>Alamat Member</td>
            <td>: {{ $penjualan->member->alamat ?? '' }}</td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: {{ $penjualan->member->telepon ?? '' }}</td>
        </tr>
    </table>
    <br>
    <table class="data" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Merk</th>
                <th>Type</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Diskon</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key+1 }}</td>
                    <td>{{ $item->produk->kode_produk }}</td>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td>{{ $item->produk->merk }}</td>
                    <td>{{ $item->produk->kategori->nama_kategori }}</td>
                    <td class="text-right">{{ format_uang($item->harga_jual) }}</td>
                    <td class="text-right">{{ format_uang($item->jumlah) }}</td>
                    <td class="text-right">{{ $item->diskon }}</td>
                    <td class="text-right">{{ format_uang($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" style="border-left: 0px; border-top:2px solid #ccc; border-right:0px;"></td>
                <td colspan="2" class="text-right" style="border-top:2px solid #ccc;border-left: 0px; border-bottom:0px;"><b>Total Harga</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->total_harga) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" style="visibility: hidden;border:none;">></td>
                <td colspan="2" class="text-right" style="border:none;"><b>Diskon</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->diskon) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" style="visibility: hidden;border:none;">></td>
                <td colspan="2" class="text-right" style="border:none;"><b>Total Bayar</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->bayar) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" style="visibility: hidden;border:none;">></td>
                <td colspan="2" class="text-right" style="border:none;"><b>Diterima</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->diterima) }}</b></td>
            </tr>
            <tr>
                <td colspan="6" style="visibility: hidden;border:none;">></td>
                <td colspan="2" class="text-right" style="border:none;"><b>Kembali</b></td>
                <td class="text-right"><b>{{ format_uang($penjualan->diterima - $penjualan->bayar) }}</b></td>
            </tr>
        </tfoot>
    </table>
    <br>
    <table width="100%">
        <tr>
            <td colspan="4" style="text-align: center;">Diterima Oleh,</td>
            <td colspan="2"></td>
            <td  colspan="3" style="text-align:center;">
                Hormat Kami
            </td>
        </tr>
        <br>
        <br>
        <tr>
            <td colspan="2" style="text-align: right; padding-right: 30px;">(</td>
<td colspan="4" style="text-align: left; padding-left: 30px;">)</td>
            <td colspan="3" style="text-align: center;">{{ auth()->user()->name }}</td></tr>

    </table>
</body>
</html>
