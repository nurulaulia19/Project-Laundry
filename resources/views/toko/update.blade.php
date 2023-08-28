

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
                                    <h3 class="panel-title">Edit User</h3>
                                </div>
                        
                                <!--Horizontal Form-->
                                <!--===================================================-->
                                {{-- @foreach ( $dataMenu as $item)  --}}
                                    
                                
								<form action="{{ route('toko.update', $dataToko->id_toko) }}" method="POST" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    @method('PUT')
                                    <div class="panel-body">
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="nama_toko">Nama Toko</label>
                                            <div class="col-sm-9">
                                                <input type="text" placeholder="Nama Produk" name="nama_toko" id="nama_toko" class="form-control" value="{{ $dataToko->nama_toko }}">
                                                <span id="produkError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="logo">Logo</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="logo" id="logo" class="form-control">
                                                <span id="gambarError" class="error-message"></span>
                                                @if ($dataToko->logo)
                                                    <a href="{{ asset($dataToko->logo) }}" target="_blank">
                                                        <img src="{{ asset('storage/photos/'.basename($dataToko->logo)) }}" width="100px" alt="">
                                                    </a>
                                                @endif
                                                @if ($errors->has('logo'))
                                                        <span class="text-danger">{{ $errors->first('logo') }}</span>
                                                @endif
                                            </div>                                                  
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="no_hp">No HP</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="no_hp" id="no_hp" class="form-control @error('no_hp') is-invalid @enderror" value="{{ $dataToko->no_hp }}">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="email">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $dataToko->email }}">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex mb-3">
                                            <label class="col-sm-3 control-label" for="alamat">Alamat</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ $dataToko->alamat }}">
                                                <span id="diskonError" class="error-message"></span>
                                            </div>
                                        </div>
                                        <div class="panel-footer text-right">
                                            <a href="{{ route('toko.index') }}" class="btn btn-secondary">KEMBALI</a>
                                            <button type="submit" onclick="validateForm(event)" class="btn btn-primary">SIMPAN</button>
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
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
@endsection

{{-- @section('style')
<style>
    @if ($menu->menu_category=="master menu")
    #hidden_div {
    display: none ;
}
@else
#hidden_div {
    display: block ;
}
    @endif
    
</style>
@endsection

@section('script')
<script>
function showDiv(divId, element)
{
    document.getElementById(divId).style.display = element.value == 'sub menu' ? 'block' : 'none';
}
</script>

@endsection --}}

{{-- <?php
$userPhotoUrl = $dataUser->user_photo; 
?>

<script>
    var userPhotoUrl = "<?php echo $userPhotoUrl; ?>";
    if (userPhotoUrl) {
        var userPhotoInput = document.getElementById('user_photo');
        
        // Buat elemen option baru
        var option = document.createElement('option');
        option.value = userPhotoUrl;
        option.text = 'Existing Photo';
        option.selected = true; 

        while (userPhotoInput.firstChild) {
            userPhotoInput.firstChild.remove();
        }
        
        // Tambahkan opsi ke input file
        userPhotoInput.appendChild(option);
    }
</script> --}}




