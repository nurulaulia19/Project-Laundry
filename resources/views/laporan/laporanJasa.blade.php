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
					                    <h3 class="panel-title">Laporan Jasa</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            {{-- <div class="col-sm-6 table-toolbar-left">
													<a href="{{ route('produk.create') }}" class="btn btn-purple">
														<i class="demo-pli-add icon-fw"></i>Add
													</a>
													
					                            </div> --}}
                                                <form action="{{ route('laporan.laporanJasa') }}" method="get">
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
                                                                    <label for="cabang">Cabang:</label>
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
                                                                    
                                                                </div>
                                                        </div>
                                                        <div class="col-md-2 d-flex align-items-end">
                                                            <button type="submit" class="btn btn-primary" style="margin-right: 10px">Filter</button>
                                                            {{-- <a href="{{ route('exportjasa.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status')]) }}" class="btn btn-danger"  style="margin-right: 10px;">Export to PDF</a>
                                                            
                                                            <a href="{{ route('exportjasa.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status')]) }}" class="btn btn-success">Export to Excel</a> --}}
                                                            <a href="{{ route('exportjasa.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status'), 'cabang' => request('cabang')]) }}" class="btn btn-danger" style="margin-right: 10px;">
                                                                <i class="fas fa-file-pdf" style="font-size: 18px;"></i>
                                                            </a>
                                                            
                                                            <a href="{{ route('exportjasa.excel', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'status' => request('status'), 'cabang' => request('cabang')]) }}" class="btn btn-success">
                                                                <i class="fas fa-file-excel" style="font-size: 18px;"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </form>
                                                
					                           
					                        </div>
					                    </div>
					                    <div class="table-responsive">
                                            <table class="table table-striped">
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
                                                                $status = $transaksiDetail->transaksi->status;
                                                                $cabang = $transaksiDetail->transaksi->id_cabang;
                                                                $filteredStatus = session('status');
                                                                $filteredCabangId = session('cabang');
                                                            
                                                                if (
                                                                    $tanggalTransaksi >= session('start_date') && 
                                                                    $tanggalTransaksi <= session('end_date') && 
                                                                    (!$filteredStatus || $status == $filteredStatus) && 
                                                                    (!$filteredCabangId || $cabang == $filteredCabangId)
                                                                ) {
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
                                                <script>
                                                    function confirmDelete(menuId) {
                                                        if (confirm('Are you sure you want to delete this item?')) {
                                                            document.getElementById('delete-form-' + menuId).submit();
                                                        }
                                                    }
                                                </script>                                                
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-center">
                                                    {{ $dataJasa->appends(['status' => request('status'), 'start_date' => request('start_date'), 'end_date' => request('end_date')])->links('pagination::bootstrap-4') }}
                                                </ul>
                                            </nav>
                                        </div>
                                        

                                        {{-- {{ $dataProduk->links('pagination::bootstrap-4') }} --}}
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
