

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
                                    
                                
								<form action="{{ route('aksescabang.update', $dataAksesCabang->id_ac) }}" method="POST">
                            
                                {{-- <form method="POST" action="{{ route('menu.update') }}"> --}}
                                    {{ csrf_field() }}
									{{-- @csrf --}}
									@method('PUT')
                                    <div class="panel-body">
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="id_cabang">Nama Cabang</label>
                                            <div class="col-sm-9">
                                                <select name="id_cabang" id="id_cabang" class="form-control">
                                                    @foreach ($dataCabang as $item)
                                                        <option value="{{ $item->id_cabang }}" {{ $dataAksesCabang->id_cabang == $item->id_cabang ? 'selected' : ''}}>
                                                            {{ $item->nama_cabang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="CabangError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="user_id">Nama Kasir</label>
                                            <div class="col-sm-9">
                                                <select name="user_id" id="user_id" class="form-control">
                                                    @foreach ($dataUser as $item)
                                                        <option value="{{ $item->user_id }}" {{ $dataAksesCabang->user_id == $item->user_id ? 'selected' : ''}}>
                                                            {{ $item->user_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <span id="CabangError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <a href="{{ route('aksescabang.index') }}" class="btn btn-secondary">KEMBALI</a>
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






