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
					                    <h3 class="panel-title">Daftar Jasa</h3>
					                </div>
					
					                <!--Data Table-->
					                <!--===================================================-->
					                <div class="panel-body">
					                    <div class="pad-btm form-inline">
					                        <div class="row">
					                            <div class="col-sm-6 table-toolbar-left">
													<a href="{{ route('produk.create') }}" class="btn btn-purple">
														<i class="demo-pli-add icon-fw"></i>Add
													</a>
													
					                            </div>
					                            {{-- <div class="col-sm-6 table-toolbar-right">
					                                <div class="form-group">
					                                    <input type="text" autocomplete="off" class="form-control" placeholder="Search" id="demo-input-search2">
					                                </div>
					                                <div class="btn-group">
					                                    <button class="btn btn-default"><i class="demo-pli-download-from-cloud icon-lg"></i></button>
					                                    <div class="btn-group dropdown">
					                                        <button class="btn btn-default btn-active-primary dropdown-toggle" data-toggle="dropdown">
					                                        <i class="demo-pli-dot-vertical icon-lg"></i>
					                                    </button>
					                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
					                                            <li><a href="#">Action</a></li>
					                                            <li><a href="#">Another action</a></li>
					                                            <li><a href="#">Something else here</a></li>
					                                            <li class="divider"></li>
					                                            <li><a href="#">Separated link</a></li>
					                                        </ul>
					                                    </div>
					                                </div>
					                            </div> --}}
					                        </div>
					                    </div>
					                    <div class="table-responsive">
					                        <table class="table table-striped">
					                            <thead>
					                                <tr>
					                                    <th>No</th>
					                                    <th>Kategori</th>
                                                        <th>Jenis Layanan</th>
                                                        <th>Harga per KG</th>
                                                        <th>Gambar</th>
                                                        <th>Diskon</th>
					                                </tr>
					                            </thead>
					                            <tbody>
													
													@foreach ($dataProduk as $item)
					                                <tr>
					                                    <td style="vertical-align: middle;">{{ $loop->iteration }}</td>
					                                    <td style="vertical-align: middle;">
                                                            @if ($item->kategori)
                                                                {{ $item->kategori->nama_kategori }}
                                                            @else
                                                                Kategori not assigned
                                                            @endif 
                                                            
                                                        </td>
                                                        <td style="vertical-align: middle;">{{ $item->nama_produk }}</td>
                                                        <td style="vertical-align: middle;">{{ number_format($item->harga_produk, 2, ',', '.') }}</td>
                                                        {{-- <td style="vertical-align: middle;">{{ $item->gambar_produk }}</td> --}}
                                                        <td style="vertical-align: middle;">
                                                            <div style="display: flex; justify-content: center; align-items: flex-center; flex-direction: column;">
                                                                @if($item->gambar_produk)
                                                                <img style="width: 50px; height: 50px; margin-bottom: 5px;" src="{{ asset('storage/photos/'.basename($item->gambar_produk)) }}" alt="Gambar Produk">
                                                            @else
                                                                No Photo
                                                            @endif
                                                            </div>
                                                            
                                                        </td> 
                                                        <td style="vertical-align: middle;">{{ $item->diskon_produk }} %</td>
														<td class="table-action" style="vertical-align: middle;">
                                                            <div style="display:flex; align-items:center">
                                                                <a style="margin-right: 10px;" href="{{ route( 'produk.edit', $item->id_produk) }}" class="btn btn-sm btn-warning">Edit</a>
															<form method="POST" action="" id="delete-form-{{ $item->id_produk }}">
																@csrf
                												@method('DELETE')
																<a href="/admin/produk/destroy/{{ $item->id_produk }}" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id_produk }})">Hapus</a>				
															</form>	
                                                            </div>													
														</td>
					                                </tr>
													@endforeach
													<script>
														function confirmDelete(menuId) {
															if (confirm('Are you sure you want to delete this item?')) {
																document.getElementById('delete-form-' + menuId).submit();
															}
														}
													</script>
									
					                            </tbody>
					                        </table>
					                    </div>

                                        {{ $dataProduk->links('pagination::bootstrap-4') }}
					                    <hr class="new-section-xs">
					                </div>
					                <!--===================================================-->
					                <!--End Data Table-->
					
					            </div>
                                @if(session('success'))
                                    <div class="alert alert-info">
                                        {{ session('success') }}
                                    </div>
                                @endif
					        </div>
					    </div>
					
					
					    
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
