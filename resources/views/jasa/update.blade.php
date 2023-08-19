

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
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Edit Jasa</h3>
                                </div>
                        
                                <!--Horizontal Form-->
                                <!--===================================================-->
                                {{-- @foreach ( $dataMenu as $item)  --}}
                                    
                                
								<form action="{{ route('jasa.update', $dataJasa->id_jasa) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="panel-body">
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="id_kategori">Kategori</label>
                                            <div class="col-sm-9">
                                                <select name="id_kategori" id="id_kategori" class="form-control">
                                                    @foreach ($dataKategori as $item)
                                                    {{-- <option value="{{ $item->role_id }}" {{ $item->role_id == $dataUser->role_id ? 'selected' : '' }}> --}}
                                                    <option value="{{ $item->id_kategori }}" {{ $item->id_kategori == $dataJasa->id_kategori ? 'selected' : '' }}>
                                                        {{ $item->nama_kategori }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <span id="kategoriError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="jenis_layanan">Jenis Layanan</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Jenis Layanan" name="jenis_layanan" id="jenis_layanan" class="form-control" value="{{ $dataJasa->jenis_layanan }}">
                                                <span id="produkError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="harga_perkg">Harga per Kg</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="harga_perkg" id="harga_perkg" class="form-control @error('harga_perkg') is-invalid @enderror" value="{{ $dataJasa->harga_perkg }}">
                                                <span id="hargaError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="gambar">Gambar</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="gambar" id="gambar" class="form-control">
                                                <span id="gambarError" class="error-message"></span>
                                                @if ($dataJasa->gambar)
                                                    <a href="{{ asset($dataJasa->gambar) }}" target="_blank">
                                                        <img src="{{ asset('storage/photos/'.basename($dataJasa->gambar)) }}" width="100px" alt="">
                                                    </a>
                                                @endif
                                                @if ($errors->has('gambar'))
                                                        <span class="text-danger">{{ $errors->first('gambar') }}</span>
                                                @endif
                                            </div>                                                  
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="diskon_jasa">Diskon (%)</label>
                                            <div class="col-sm-9">
                                                <input type="number" name="diskon_jasa" id="diskon_jasa" class="form-control @error('diskon_jasa') is-invalid @enderror" value="{{ $dataJasa->diskon_jasa }}" min="0" step="1">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">KEMBALI</a>
                                            <button type="submit" onclick="validateForm(event)" class="btn btn-primary">SIMPAN</button>
                                        </div>
                                    </div>
                                </form>
                                <!--===================================================-->
                                <!--End Horizontal Form-->
                                {{-- @endforeach --}}
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






