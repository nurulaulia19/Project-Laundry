

{{-- bener --}}

@extends('layoutsAdmin.main')
<link rel="stylesheet" href="{{ asset('assets-ui/style.css') }}">
  
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
                                        <h3 class="panel-title">Tambah Transaksi</h3>
                                    </div>

                                    
                                <div class="col-xs-6 scroll-container">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <form action="{{ route('transaksi.create') }}" method="GET">
                                                <div class="form-group">
                                                    <label for="filterKategori">Filter Kategori:</label>
                                                    <select class="form-control" id="filterKategori" name="selectedKategori" onchange="this.form.submit()">
                                                        <option value="">Semua Kategori</option>
                                                        @foreach ($dataKategori as $item)
                                                            <option value="{{ $item->id_kategori }}" {{ $item->id_kategori == $selectedKategoriId ? 'selected' : '' }}>
                                                                {{ $item->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </form>
                                        </div> 
                                        <div class="col-sm-6">
                                            <form action="{{ route('jasa.search') }}" method="POST" class="form-inline">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="searchInput">Cari jasa berdasarkan nama:</label>
                                                    <br>
                                                    <input type="text" class="form-control" id="searchInput" name="keyword" placeholder="Masukkan nama jasa...">
                                                    <button type="submit" class="btn btn-primary">Cari</button>
                                                </div>
                                                <input type="hidden" name="selectedKategori" value="{{ $selectedKategoriId }}">
                                            </form>
                                        </div>                                        
                                    </div>
                                    <div class="row" id="produkContainer">
                                        
                                        @foreach ($dataJasa as $index => $item)
                                          <div class="col-xs-2" style="margin: 20px; height: 250px;">
                                            <div class="card" >
                                               
                                                <a href="#" data-toggle="modal" data-target="#modal{{ $item->id_jasa }}">
                                                    <img src="{{ asset('storage/photos/'.basename($item->gambar)) }}" class="card-img-top" alt="..." style="height: 160px; width: 100px; cursor: pointer;">
                                                </a>
                                              {{-- <img src="{{ asset('storage/photos/'.basename($item->gambar_produk)) }}" class="card-img-top" alt="..." style="height: 160px; cursor: pointer;" data-target="modal{{ $item->id_produk }}"> --}}
                                              <div class="card-body" style="height: 92px; overflow: hidden;">
                                                <div class="product-info">
                                                    <p class="product-name">{{ $item->jenis_layanan }}</p>
                                                    <p class="product-price">{{ 'Rp ' . number_format($item->harga_perkg, 0, ',', '.') }}</p>
                                                    @if($item->diskon_jasa != 0)
                                                    <div class="discount-badge">
                                                        <p class="discount-text">Diskon {{ $item->diskon_jasa }}%</p>
                                                    </div>
                                                    @endif
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          @if (($index + 1) % 4 === 0)
                                            <div class="w-100"></div> <!-- Gunakan class 'w-100' untuk membuat baris baru -->
                                        @endif
                                        @include('transaksi.modal')
                                        @endforeach

                                      </div>
                                </div>
                                <div class="col-xs-6">
                                    <div>
                                        <div class="panel">
                                            <div class="panel-body">
                                                <table id="demo-dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%" style="font-size: 12px">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama Jasa</th>
                                                            <th class="min-tablet">QTY</th>
                                                            <th class="min-tablet">Diskon</th>
                                                            <th class="min-desktop">Harga</th>
                                                            <th class="min-desktop">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $totalHargaDiskon=0;
                                                        $totalSemuaHarga = 0; // Variabel untuk menyimpan total harga dari semua totalHargaSetelahDiskon
                                                        @endphp
                                                        @foreach ($dataTransaksiDetail as $item)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $item->jasa->jenis_layanan }} 
                                                                {{-- <div style="color:blue">
                                                                    @php
                                                                         $hargaAditional = 0; 
                                                                    @endphp
                                                                </div> --}}
                                                                
                                                            </td> 
                                                            
                                                            <td style="text-align: center;">
                                                                <form action="{{ route('transaksidetail.update', ['id' => $item->id_transaksi_detail]) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <input type="hidden" name="id_jasa" value="{{ $item->id_jasa }}">
                                                                    <input type="number" name="jumlah_jasa" value="{{ $item->jumlah_jasa }}" min="1" step="1" class="jumlah-produk" onchange="updateTotalPrice(this)">
                                                                    <button class="btn btn-sm btn-primary" type="submit">Ubah</button>
                                                                </form>
                                                            </td>                                                      
                                                            <td style="text-align: right;" class="diskon-jasa">
                                                                {{ $item->jasa->diskon_jasa }}%
                                                            </td>
                                                            {{-- <td style="text-align: right;">{{ number_format($item->produk->harga_produk, 0, ',', '.') }}</td> --}}
                                                            <td style="text-align: right;" class="harga-perkg">
                                                                {{ number_format($item->jasa->harga_perkg, 0, ',', '.') }}
                                                            </td>
                                                            <td style="text-align: right;" class="total-harga-setelah-diskon">
                                                                @php
                                                                $hargaJasa = $item->jasa->harga_perkg;
                                                                $diskonJasa = $item->jasa->diskon_jasa; // Diskon jasa dalam persen
                                                                $jumlahJasa = $item->jumlah_jasa;
                                                                $totalHargaSebelumDiskon = $hargaJasa * $jumlahJasa;
                                                            
                                                                // Hitung total harga additional
                                                                // $totalHargaAdditional = 0;
                                                                // if ($item->transaksiDetailAditional) {
                                                                //     foreach ($item->transaksiDetailAditional as $items) {
                                                                //         $hargaAditional = $items->dataAditional->harga_aditional;
                                                                //         $diskonAditional = $items->dataAditional->diskon_aditional; // Diskon aditional dalam persen
                                                                //         $totalHargaAdditional += $hargaAditional * $jumlahProduk * (1 - $diskonAditional / 100);
                                                                //     }
                                                                // }
                                                            
                                                                // Hitung besaran diskon dalam bentuk nominal untuk produk dan aditional jika ada diskon
                                                                $diskonNominalJasa = $totalHargaSebelumDiskon * $diskonJasa / 100;
                                                                // $diskonNominalAditional = $totalHargaAdditional * $diskonJasa / 100;
                                                            
                                                                // Hitung total harga setelah diskon, termasuk diskon untuk Jasa dan aditional
                                                                $totalHargaSetelahDiskon = $totalHargaSebelumDiskon - $diskonNominalJasa;
                                                                @endphp
                                                            
                                                                {{ number_format($totalHargaSetelahDiskon, 0, ',', '.') }}
                                                            </td>
                                                            <td>
                                                                <form method="POST" action="" id="delete-form-{{ $item->id_transaksi_detail }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    {{-- <a href="/admin/produk/destroy/{{ $item->id_produk }}" --}}
                                                                    <a href="/admin/transaksidetail/destroy/{{ $item->id_transaksi_detail  }}" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $item->id_transaksi_detail }})">Hapus</a>				
                                                                </form>	
        
                                                            </td>
                                                        </tr>
                                                        @php
                                                        // Akumulasi total harga ke variabel $totalSemuaHarga
                                                        $totalSemuaHarga += $totalHargaSetelahDiskon;
                                                        @endphp
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="6" style="text-align: right;">Total Harga</td>
                                                            <td style="text-align: right;" class="overall-total">
                                                              {{ number_format($totalSemuaHarga, 0, ',', '.') }}
                                                            </td>
                                                          </tr>
                                                    </tfoot>

                                                   
                                                </table>
                                                <div class="panel-footer text-right">
                                                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">KEMBALI</a>
                                                    <button type="button" data-toggle="modal" data-target="#modalBayar" class="btn btn-primary">SIMPAN</button>
                                                </div>
                                            </div>
                                            @include('transaksi.modalBayar')
                                        </div>
                                        {{-- <form method="POST" action="/transaksi/store" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="panel-body">
                                                <div class="form-group d-flex mb-3">
                                                    <label class="col-sm-3 control-label" for="diskon_transaksi">Diskon</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" placeholder="Diskon" name="diskon_transaksi" id="diskon_transaksi" class="form-control">
                                                        <span id="diskon_transaksi_error" class="error-message"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex mb-3">
                                                    <label class="col-sm-3 control-label" for="total_bayar">Total Harga</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" placeholder="Total Harga" name="total_harga" id="total_harga_input" class="form-control" value="{{ number_format($totalSemuaHarga, 0, ',', '.') }}">
                                                        <span id="total_harga_error" class="error-message"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex mb-3">
                                                    <label class="col-sm-3 control-label" for="total_bayar">Total Bayar</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" placeholder="Total Bayar" name="total_bayar" id="total_bayar_input" class="form-control">
                                                        <span id="total_bayar_error" class="error-message"></span>
                                                    </div>
                                                </div>
                                                <div class="form-group d-flex mb-3">
                                                    <label class="col-sm-3 control-label" for="total_kembalian">Total Kembalian</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" placeholder="Total Kembalian" name="total_kembalian" id="total_kembalian_input" class="form-control">
                                                        <span id="total_kembalian_error" class="error-message"></span>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="panel-footer text-right">
                                                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">KEMBALI</a>
                                                <button type="submit" onclick="validateForm(event)" class="btn btn-primary">SIMPAN</button>
                                            </div>
                                        </form> --}}
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
					
                    
                <!--===================================================-->
                <!--End page content-->

            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

			<!--ASIDE-->
            <!--===================================================-->
        
            <!--===================================================-->
            <!--END ASIDE-->
            
            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->

        </div>


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



@section('script')

<script>
    // Function to calculate and update total harga based on diskon
    function updateTotalHarga() {
        const diskonInput = document.getElementById('diskon_transaksi');
        const totalHargaInput = document.getElementById('total_harga_input');
        const totalBayarInput = document.getElementById('total_bayar_input');
        const totalKembalianInput = document.getElementById('total_kembalian_input');

        const totalSemuaHarga = {{ $totalSemuaHarga }};
        const diskonValue = diskonInput.value.trim() === '' ? 0 : parseFloat(diskonInput.value);
        const totalBayarValue = parseFloat(totalBayarInput.value.trim());

        if (isNaN(diskonValue) || diskonValue < 0 || diskonValue > 100) {
            document.getElementById('diskon_transaksi_error').textContent = 'Diskon harus berada antara 0 dan 100.';
            totalHargaInput.value = '';
        } else {
            document.getElementById('diskon_transaksi_error').textContent = '';
            const totalHargaSetelahDiskon = totalSemuaHarga * (1 - diskonValue / 100);
            totalHargaInput.value = formatNumber(totalHargaSetelahDiskon);

            if (!isNaN(totalBayarValue) && totalBayarValue >= totalHargaSetelahDiskon) {
                const totalKembalian = totalBayarValue - totalHargaSetelahDiskon;
                totalKembalianInput.value = formatNumber(totalKembalian);
            } else {
                totalKembalianInput.value = '';
            }
        }
    }
    
    // Add event listeners to diskon_transaksi and total_bayar inputs for real-time updates
    const diskonInput = document.getElementById('diskon_transaksi');
    diskonInput.addEventListener('input', updateTotalHarga);

    const totalBayarInput = document.getElementById('total_bayar_input');
    totalBayarInput.addEventListener('input', updateTotalHarga);

    // Function to format number with thousand separators
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(number);
    }

    // Initial update when the page loads
    updateTotalHarga();
</script>


{{-- awas yaa --}}
<script>

    // Function to format number with thousand separators
    function formatNumber(number) {
        return new Intl.NumberFormat('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(number);
    }

</script>


<script>
    // Function to handle form validation and show the modal
    function validateForm(event) {
      event.preventDefault(); // Prevent the default form submission behavior
  
      // Add your form validation logic here if needed
      // ...
  
      // Show the modal
      const modalBayar = document.getElementById('modalBayar');
      modalBayar.style.display = 'block';
  
      // You might need additional logic here, depending on how your modal works (e.g., handling close button or backdrop click)
    }
  </script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
    // Listen to changes in the filterKategori and searchInput
    $('#filterKategori, #searchInput').on('change input', function () {
        var selectedCategoryId = $('#filterKategori').val();
        var searchValue = $('#searchInput').val().toLowerCase();

        $('.produk-item').each(function () {
            var itemKategori = $(this).data('kategori');
            var itemText = $(this).text().toLowerCase();
            var isCategoryMatch = selectedCategoryId === '' || selectedCategoryId == itemKategori;
            var isSearchMatch = itemText.includes(searchValue);

            // Show the product if it matches the selected category and search input, hide otherwise
            $(this).toggle(isCategoryMatch && isSearchMatch);
        });
    });
</script> --}}



<script>
    function searchProducts() {
        // Ambil nilai kata kunci dari input pencarian
        var keyword = document.getElementById('searchInput').value.toLowerCase();
        
        // Ambil semua produk yang ditampilkan
        var produkContainer = document.getElementById('produkContainer');
        var produkItems = produkContainer.getElementsByClassName('produk-item');

        // Loop melalui setiap produk dan sembunyikan/munculkan sesuai dengan kata kunci
        for (var i = 0; i < produkItems.length; i++) {
            var namaProduk = produkItems[i].getAttribute('data-nama').toLowerCase();

            // Jika kata kunci ditemukan dalam nama produk, tampilkan; jika tidak, sembunyikan
            if (namaProduk.includes(keyword)) {
                produkItems[i].style.display = "block";
            } else {
                produkItems[i].style.display = "none";
            }
        }
    }
</script>


{{-- Edit --}}

<script>
    function searchProductsEdit() {
        // Ambil nilai kata kunci dari input pencarian
        var keyword = document.getElementById('searchInput').value.toLowerCase();
        
        // Ambil semua produk yang ditampilkan
        var produkContainer = document.getElementById('produkContainer');
        var produkItems = produkContainer.getElementsByClassName('produk-item');

        // Loop melalui setiap produk dan sembunyikan/munculkan sesuai dengan kata kunci
        for (var i = 0; i < produkItems.length; i++) {
            var namaProduk = produkItems[i].getAttribute('data-nama').toLowerCase();

            // Jika kata kunci ditemukan dalam nama produk, tampilkan; jika tidak, sembunyikan
            if (namaProduk.includes(keyword)) {
                produkItems[i].style.display = "block";
            } else {
                produkItems[i].style.display = "none";
            }
        }
    }
</script>


<script>
    function filterByCategory() {
        var selectedKategoriId = document.getElementById('filterKategori').value;
        var produkContainer = document.getElementById('produkContainer');
        var produkItems = produkContainer.getElementsByClassName('produk-item');

        for (var i = 0; i < produkItems.length; i++) {
            var produkKategoriId = produkItems[i].getAttribute('data-kategori');

            if (selectedKategoriId === '' || produkKategoriId === selectedKategoriId) {
                produkItems[i].style.display = "block";
            } else {
                produkItems[i].style.display = "none";
            }
        }
    }
</script>

<script>
    function submitForm() {
        const filterKategori = document.getElementById('filterKategori');
        const selectedKategoriId = filterKategori.value;
        const form = filterKategori.closest('form');

        // Remove any existing hidden input for filterKategori (if present)
        const existingInput = document.querySelector('input[name="filterKategori"]');
        if (existingInput) {
            existingInput.remove();
        }

        // Append the selected category ID as a hidden input to the form
        const hiddenInput = document.createElement('input');
        hiddenInput.type = 'hidden';
        hiddenInput.name = 'filterKategori';
        hiddenInput.value = selectedKategoriId;
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
    }
</script>

@endsection



