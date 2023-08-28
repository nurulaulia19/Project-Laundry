

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
                                    <h3 class="panel-title">Edit Cabang</h3>
                                </div>
                        
                                <!--Horizontal Form-->
                                <!--===================================================-->
                                {{-- @foreach ( $dataMenu as $item)  --}}
                                    
                                
								<form action="{{ route('cabang.update', $dataCabang->id_cabang) }}" method="POST">
                            
                                {{-- <form method="POST" action="{{ route('menu.update') }}"> --}}
                                    {{ csrf_field() }}
									{{-- @csrf --}}
									@method('PUT')
                                    <div class="panel-body">
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="nama_cabang">Nama Cabang</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="nama_cabang" id="nama_cabang" class="form-control" value="{{ $dataCabang->nama_cabang }}">
                                                <span id="nama_cabangError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="alamat_cabang">Alamat Cabang</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="alamat_cabang" id="alamat_cabang" class="form-control" value="{{ $dataCabang->alamat_cabang }}">
                                                <span id="alamat_cabangError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="nama_cabang">No HP Cabang</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="noHp_cabang" id="noHp_cabang" class="form-control" value="{{ $dataCabang->noHp_cabang }}">
                                                <span id="noHp_cabangError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <a href="{{ route('cabang.index') }}" class="btn btn-secondary">KEMBALI</a>
                                            <button type="submit" class="btn btn-primary">SIMPAN</button>
                                            {{-- <button class="btn btn-success" type="submit">Edit</button> --}}
                                        </div>
                                        </div>
                                    </div>
                                    
                                </form>
                                <!--===================================================-->
                                <!--End Horizontal Form-->
                                {{-- @endforeach --}}
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

    <!--===================================================-->
    <!-- END OF CONTAINER -->
@endsection






