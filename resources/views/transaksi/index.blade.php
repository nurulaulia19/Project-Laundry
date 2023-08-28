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
					                    <h3 class="panel-title">Data Transaksi</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
													<a href="{{ route('transaksi.create') }}" class="btn btn-purple">
														<i class="demo-pli-add icon-fw"></i>Add
													</a>
					                            </div>
                                                <div class="col-sm-6">
                                                    <form action="{{ route('transaksi.index') }}" method="GET">
                                                        <div class="input-group">
                                                            <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama customer...">
                                                            <span class="input-group-btn">
                                                                <button class="btn btn-primary" type="submit">Cari</button>
                                                            </span>
                                                        </div>
                                                    </form>
                                                </div>
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
														<td style="vertical-align: middle; text-align: center;">{{ $item->customer->nama_customer }}</td>
                                                        <td style="vertical-align: middle; text-align: center;">{{ $item->cabang->nama_cabang }}</td>
                                                        <td style="vertical-align: middle;">{{ $item->status }}</td>
                                                        <td style="vertical-align: middle; text-align: center;">{{ $item->diskon_transaksi }} %</td>
														<td style="vertical-align: middle; text-align: center;">{{ number_format($item->total_harga, 2, ',', '.') }}</td>
                                                        <td style="vertical-align: middle; text-align: center;">{{ number_format($item->total_bayar, 2, ',', '.') }}</td>
                                                        <td style="vertical-align: middle; text-align: center;">{{ number_format($item->total_kembalian, 2, ',', '.') }}</td>
														<td class="table-action" style="vertical-align: middle;">
                                                            <div style="display:flex; align-items:center; justify-content:">
                                                                <a style="margin-right: 10px;" href="{{ route( 'transaksi.edit', $item->id_transaksi) }}" class="btn btn-sm btn-warning">Edit</a>
                                                                <a href="{{ route( 'transaksi.destroy', $item->id_transaksi) }}" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id_transaksi }})">Hapus</a>
															{{-- <form method="POST" action="" id="delete-form-{{ $item->id_transaksi }}" >
																@csrf
                												@method('DELETE')
																<a href="/admin/transaksi/destroy/{{ $item->id_transaksi }}" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id_transaksi }})">Hapus</a>				
															</form>	 --}}
                                                            <div class="resi-container">
                                                                <button onclick="printReceipt({{ $item->id_transaksi }})" style="margin-left: 10px; font-size:13px" class="btn btn-sm btn-success"><i class="demo-pli-printer"></i></button>
                                                               
                                                            </div> 
                                                            </div>													
														</td>
					                                </tr>
													@endforeach
													
									
					                            </tbody>
					                        </table>
                                        
                                            
					                    </div>
                                        {{ $dataTransaksi->links('pagination::bootstrap-4') }}
                                        

					                    <hr class="new-section-xs">
					                    
					                </div>
                                    
					                <!--===================================================-->
					                <!--End Data Table-->
					
					            </div>
					        </div>
					    </div>
                        @if(session('success'))
                        <div class="alert alert-info">
                            {{ session('success') }}
                        </div>
                        @endif
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

{{-- <script>
    $(document).ready(function() {
        // Inisialisasi DataTables dengan opsi paging
        const dataTable = $('#data-table').DataTable({
            // Atur paging, misalnya 10 baris per halaman
            pageLength: 10,
        });

        // Atur tampilan halaman saat tabel di-render
        dataTable.on('draw', function() {
            const pageInfo = dataTable.page.info();
            const btnPrevious = $('#btn-previous');
            const btnNext = $('#btn-next');

            // Aktifkan atau nonaktifkan tombol previous berdasarkan halaman saat ini
            if (pageInfo.page === 0) {
                btnPrevious.addClass('disabled');
            } else {
                btnPrevious.removeClass('disabled');
            }

            // Aktifkan atau nonaktifkan tombol next berdasarkan halaman saat ini
            if (pageInfo.page === pageInfo.pages - 1) {
                btnNext.addClass('disabled');
            } else {
                btnNext.removeClass('disabled');
            }
        });

        // Saat tombol previous diklik, navigasi ke halaman sebelumnya
        $('#btn-previous').on('click', function() {
            dataTable.page('previous').draw('page');
        });

        // Saat tombol next diklik, navigasi ke halaman berikutnya
        $('#btn-next').on('click', function() {
            dataTable.page('next').draw('page');
        });
    });
</script> --}}
