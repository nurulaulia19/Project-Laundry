<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>Laporan Transaksi</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
   
    <style>
        /* Add borders to the entire table */
        .table-bordered {
            border-collapse: collapse;
            width: 100%;
            
        }

        /* Style for table header cells */
        .table-bordered th {
            border: 1px solid black;
            padding: 8px;
            font-size: 12px; 
            
        }

        /* Style for table data cells */
        .table-bordered td {
        border: 1px solid black;
        padding: 8px;
        /* Tambahkan ukuran font yang lebih kecil */
        font-size: 12px; /* Sesuaikan dengan ukuran yang sesuai */
        white-space: nowrap;
    }

        @media print {
        .table-responsive {
            overflow: visible !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            font-weight: bold;
            font-size: 12px; 
        }

    }

    </style>
    
  </head>
  <body>
    <div class="table-responsive mx-auto">
        <h3 class="mb-3" style="text-align: center">Laporan Transaksi</h3>
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



        <table class="table table-bordered">
            <thead data-testid="table-header">
                <tr>
                    <th style="width: 5%;">No</th>
					<th>Tanggal Terima</th>
                    <th>Tanggal Selesai</th>
					<th>Nama Kasir</th>
                    <th>Nama Customer</th>
                    <th>Nama Cabang</th>
                    <th>Status</th>
                    <th>Diskon</th>
					<th>Total Harga</th>
					<th>Total Bayar</th>
                    <th>Total Kembalian</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataTransaksi as $item)
				    <tr style="font-size:13px;">
					    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
					    <td style="vertical-align: middle;">{{ $item->tanggal_transaksi }}</td>
                        <td style="vertical-align: middle;">{{ $item->tanggal_selesai }}</td>
					    {{-- <td style="vertical-align: middle;">{{ $item->user_password }}</td> --}}
					    <td style="vertical-align: middle;">{{ $item->user->user_name }}</td>                      
														<td style="vertical-align: middle; text-align: center;">{{ $item->customer->nama_customer }}</td>
                        <td style="vertical-align: middle; text-align: center;">{{ $item->cabang->nama_cabang }}</td>
                        <td style="vertical-align: middle;">{{ $item->status }}</td>
                        <td style="vertical-align: middle; text-align: center;">{{ $item->diskon_transaksi }} %</td>
														<td style="vertical-align: middle; text-align: center;">{{ number_format($item->total_harga, 2, ',', '.') }}</td>
                        <td style="vertical-align: middle; text-align: center;">{{ number_format($item->total_bayar, 2, ',', '.') }}</td>
                        <td style="vertical-align: middle; text-align: center;">{{ number_format($item->total_kembalian, 2, ',', '.') }}</td>
					</tr>
				@endforeach
                
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="9">Grand Total</td>
                    <td style="text-align: center;">
                        @if(app('request')->route()->getName() !== 'export.excel')
                            {{ number_format($totalBayar, 2, ',', '.') }}
                        @else
                            {!! $totalBayar !!}
                        @endif
                        {{-- {{ number_format($totalBayar, 0, ',', '.') }} --}}
                    </td>
                    <td style="text-align: center;">
                        @if(app('request')->route()->getName() !== 'export.excel')
                            {{ number_format($totalKembalian, 2, ',', '.') }}
                        @else
                            {!! $totalKembalian !!}
                        @endif
                    </td>
                </tr>
            </tfoot>
            
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>

