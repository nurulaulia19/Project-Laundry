<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table-bordered {
            border-collapse: collapse;
            width: 100%;
        }

        /* Style for table header cells */
        .table-bordered th {
            border: 1px solid black;
            padding: 8px;
        }

        /* Style for table data cells */
        .table-bordered td {
            border: 1px solid black;
            padding: 8px;
        }

        /* Additional styling for the PDF */
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 2cm;
        }

    </style>
</head>
<body>
    <div class="table-responsive mx-auto">
        <h3 class="mb-3" style="text-align: center">Laporan Jasa</h3>
        @php
        if (request('start_date') && request('end_date')) {
            $startDate = request('start_date');
            $endDate = request('end_date');
        }
        $status = request('status');
        $cabangId = request('cabang'); // Ambil nilai ID cabang dari request

        // Ambil data cabang berdasarkan ID cabang
        $cabangNama = '';
        
        if ($cabangId) {
            $cabangData = $dataCabang->firstWhere('id_cabang', $cabangId);
            if ($cabangData) {
                $cabangNama = $cabangData->nama_cabang;
            }
        }
    @endphp

    <h5 class="mb-3" style="text-align: center">
        @if(isset($startDate) && isset($endDate))
            Dalam rentang tanggal dari {{ $startDate }} hingga {{ $endDate }} dengan 
        @endif

        status
        @php
            $statusLaundry = isset($status) ? $status : 'semua';
            if (!in_array($statusLaundry, ['proses', 'selesai'])) {
                $statusLaundry = 'semua';
            }
        @endphp
        {{ $statusLaundry }}

        @if(isset($cabangNama)) {{-- Tampilkan nama cabang hanya jika ada nilai nama cabang --}}
            pada cabang {{ $cabangNama }}
        @endif
    </h5>


        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
					<th>Kategori</th>
                    <th>Jenis Layanan</th>
                    <th>Terjual</th>
                </tr>
            </thead>
            <tbody>
                @php
                $grandTotalJumlahJasa = 0; // Inisialisasi grand total jumlah produk
                @endphp
                @foreach ($dataJasa as $item)
                <tr>
                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
                    <td style="vertical-align: middle;">
                        @if ($item->kategori)
                            {{ $item->kategori->nama_kategori }}
                        @else
                            Kategori not assigned
                        @endif 
                    </td>
                    <td style="vertical-align: middle;">{{ $item->jenis_layanan }}</td>
                    @php
                    $totalJumlahJasa = 0; // Inisialisasi total jumlah jasa dalam loop ini
                    @endphp
                    @foreach ($item->transaksiDetail as $transaksiDetail)
                    @if ($transaksiDetail->transaksi && $transaksiDetail->transaksi->tanggal_transaksi)
                        @php
                            $tanggalTransaksi = $transaksiDetail->transaksi->tanggal_transaksi;
                            if ($tanggalTransaksi >= session('start_date') && $tanggalTransaksi <= session('end_date')) {
                                $totalJumlahJasa += $transaksiDetail->jumlah_jasa;
                                $grandTotalJumlahJasa += $transaksiDetail->jumlah_jasa;
                            }
                        @endphp
                    @endif
                @endforeach
                    <td style="vertical-align: middle;">{{ $totalJumlahJasa }}</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align: left;">Grand Total</td>
                    <td>{{ $grandTotalJumlahJasa }}</td>
                </tr>
                </tbody>
        </table>
    
    </div>
</body>
</html>

