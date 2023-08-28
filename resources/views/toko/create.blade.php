

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
						<h3>Welcome back to the Dashboard.</h3>
						<p>This is your experience to manage the Resto Application.</p>
					</div>
                    </div>  
                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
					
					    <div class="row">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Tambah Data Toko</h3>
                                </div>
                        
                                <!--Horizontal Form-->
                                <!--===================================================-->
                               
                                <form method="POST" action="{{ route('toko.store') }}" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div class="panel-body">
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="nama_toko">Nama Toko</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Nama Toko" name="nama_toko" id="nama_toko" class="form-control">
                                                <span id="produkError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="logo">Logo</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="logo" id="logo" class="form-control">
                                                <span id="logoError" class="error-message"></span>
                                                    @if ($errors->has('logo'))
                                                        <span class="text-danger">{{ $errors->first('logo') }}</span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="no_hp">No HP</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="No HP" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="email">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Email" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="alamat">Alamat</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Alamat" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="panel-footer text-right">
                                        <a href="{{ route('toko.index') }}" class="btn btn-secondary">KEMBALI</a>
                                        <button type="submit" onclick="validateForm(event)" class="btn btn-primary">SIMPAN</button>
                                    </div>
                                </form>
                               
                                <!--===================================================-->
                                <!--End Horizontal Form-->
                        
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






