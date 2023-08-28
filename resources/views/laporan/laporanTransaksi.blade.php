{{-- bener --}}

@extends('layoutsAdmin.main')
@section('content')
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
		@if (session('activated'))
                        <div class="alert alert-success" role="alert">
                            {{ session('activated') }}
                        </div>
                    @endif
        <div class="boxed">
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">         
					<div class="pad-all text-center">
						<h3>Welcome back to the Dashboard</h3>
						<p>This is your experience to manage the Laundry Application</p>
					</div>
                </div>  
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
					    <div class="row">
					        <div class="col-xs-12">
					            <div class="panel">
					                <div class="panel-heading">
					                    <h3 class="panel-title">Laporan Transaksi</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
													{{-- <a href="{{ route('transaksi.create') }}" class="btn btn-purple">
														<i class="demo-pli-add icon-fw"></i>Add
													</a> --}}
													
					                            </div>
                                                    <form action="{{ route('laporan.laporanTransaksi') }}" method="get">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="start_date">Tanggal Awal: </label>
                                                                    <input type="date" class="form-control" name="start_date" id="start_date" value="{{ session('start_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="end_date">Tanggal Akhir: </label>
                                                                    <input type="date" class="form-control" name="end_date" id="end_date" value="{{ session('end_date') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label class="control-label">Status: </label>
                                                                    <select class="form-control" name="status" id="status">
                                                                        <option value=""{{ request('status') === '' ? ' selected' : '' }}>Semua</option>
                                                                        <option value="proses"{{ request('status') === 'proses' ? ' selected' : '' }}>Proses</option>
                                                                        <option value="selesai"{{ request('status') === 'selesai' ? ' selected' : '' }}>Selesai</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    
                                                                    <select class="form-control" name="cabang">
                                                                        <option value="">Semua</option>
                                                                        @foreach ($allCabang as $cabang)
                                                                            @if ($dataCabang->isEmpty() || $dataCabang->contains('cabang.id_cabang', $cabang->id_cabang))
                                                                                <option value="{{ $cabang->id_cabang }}"{{ request('cabang') == $cabang->id_cabang ? ' selected' : '' }}>
                                                                                    {{ $cabang->nama_cabang }}
                                                                                </option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                    
                                                                    {{-- <select class="form-control" name="cabang">
                                                                        <option value="">Semua</option>
                                                                        @foreach ($dataCabang as $cabang)
                                                                            <option value="{{ $cabang->cabang->id_cabang }}"{{ request('cabang') == $cabang->cabang->id_cabang ? ' selected' : '' }}>
                                                                                {{ $cabang->cabang->nama_cabang }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>  --}}
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="col-md-2 d-flex align-items-end">
                                                                <button type="submit" class="btn btn-primary" style="margin-right: 10px">Filter</button>
                                                                {{-- <a href="{{ route('export.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status')]) }}" class="btn btn-danger"  style="margin-right: 10px;">Export to PDF</a> --}}
                                                                <a href="{{ route('export.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status'), 'cabang' => request('cabang')]) }}" class="btn btn-danger" style="margin-right: 10px;">
                                                                    <i class="fas fa-file-pdf" style="font-size: 18px;"></i>
                                                                </a>
                                                                
                                                                
                                                                {{-- <a href="{{ route('export.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status')]) }}" class="btn btn-success">Export to Excel</a>    --}}
                                                                <a href="{{ route('export.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status'), 'cabang' => request('cabang')]) }}" class="btn btn-success">
                                                                    <i class="fas fa-file-excel" style="font-size: 18px;"></i>
                                                                </a>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                    </form>
					                        </div>
					                    </div>
					                    <div class="table-responsive">
                                            <table class="table table-striped">
					                            <thead data-testid="table-header">
					                                <tr>
					                                    <th>No</th>
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
														<td style="vertical-align: middle;">{{ $item->customer->nama_customer }}</td>
                                                        <td style="vertical-align: middle;">{{ $item->cabang->nama_cabang }}</td>
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
                                                        <td colspan="9" style="font-size: 13px;">Grand Total</td>
                                                        <td style="text-align: center; font-size: 13px;">
                                                            @if(app('request')->route()->getName() !== 'export.excel')
                                                                {{ number_format($totalBayar, 2, ',', '.') }}
                                                            @else
                                                                {!! $totalBayar !!}
                                                            @endif
                                                            {{-- {{ number_format($totalBayar, 0, ',', '.') }} --}}
                                                        </td>
                                                        <td style="text-align: center; font-size: 13px;">
                                                            @if(app('request')->route()->getName() !== 'export.excel')
                                                                {{ number_format($totalKembalian, 2, ',', '.') }}
                                                            @else
                                                                {!! $totalKembalian !!}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tfoot>
					                        </table>
                                            
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center">
                                                    {{ $dataTransaksi->appends(['status' => request('status'), 'start_date' => request('start_date'), 'end_date' => request('end_date')])->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
                                            
					                    </div>

                                        
                                        {{-- {{ $dataTransaksi->links('pagination::bootstrap-4') }} --}}
                                        {{-- {{ $dataTransaksi->appends(['start_date' => session('start_date'), 'end_date' => session('end_date'), 'ket_makanan' => session('status')])->links('pagination::bootstrap-4') }} --}}
                                        

					                    <hr class="new-section-xs">
					                    
					                </div>
					                <!--===================================================-->
					                <!--End Data Table-->
					
					            </div>
					        </div>
					    </div>
                        @if(session('error'))
							<div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
				        @endif
					
					    
                </div>
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->
        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
@endsection

<script>
    function confirmDelete(menuId) {
        if (confirm('Are you sure you want to delete this item?')) {
            document.getElementById('delete-form-' + menuId).submit();
        }
    }
</script>

<script>
    function printReceipt(id_transaksi) {
        var printWindow = window.open('{{ route('transaksi.resi', ['id_transaksi' => '__id_transaksi__']) }}'.replace('__id_transaksi__', id_transaksi), '_blank');
        printWindow.onload = function() {
            printWindow.print();
        };
    }
</script>




