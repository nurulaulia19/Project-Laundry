

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
                                        <h3 class="panel-title">Edit Transaksi</h3>
                                    </div>
                                    <div class="col-xs-6 scroll-container">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <form action="{{ route('transaksi.filter', ['id_transaksi' => $dataTransaksi->id_transaksi]) }}" method="GET">
                                                    @csrf
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
                                                <form action="{{ route('jasa.searchEdit', ['id_transaksi' => $dataTransaksi->id_transaksi]) }}" method="GET" class="form-inline">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="searchInput">Cari jasa berdasarkan nama:</label>
                                                        <br>
                                                        <input type="text" class="form-control" id="searchInput" name="keyword" placeholder="Masukkan nama jasa...">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                    <input type="hidden" name="selectedKategori" value="{{ $selectedKategoriId }}">
                                                </form>

                                                {{-- <div class="col-sm-6">
                                                    <form action="{{ route('produk.search') }}" method="POST" class="form-inline">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="searchInput">Cari jasa berdasarkan nama:</label>
                                                            <br>
                                                            <input type="text" class="form-control" id="searchInput" name="keyword" placeholder="Masukkan nama jasa...">
                                                            <button type="submit" class="btn btn-primary">Cari</button>
                                                        </div>
                                                        <input type="hidden" name="selectedKategori" value="{{ $selectedKategoriId }}">
                                                    </form>
                                                </div>  --}}

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
                                            @include('transaksi.modalBayarEdit')
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
                                                            <th>Nama Produk</th>
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
                                                @php
                                                    $totalHargaDiskon = $totalSemuaHarga * $dataTransaksi->diskon_transaksi / 100;
                                                @endphp
                                                <div class="panel-footer text-right">
                                                    <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">KEMBALI</a>
                                                    <button type="button" data-toggle="modal" data-target="#modalEdit" class="btn btn-primary">SIMPAN</button>
                                                </div>
                                            </div>
                                            @include('transaksi.modalEdit')
                                        </div>
                                        
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
            <aside id="aside-container">
                <div id="aside">
                    <div class="nano">
                        <div class="nano-content">
                            
                            <!--Nav tabs-->
                            <!--================================-->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#demo-asd-tab-1" data-toggle="tab">
                                        <i class="demo-pli-speech-bubble-7 icon-lg"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-2" data-toggle="tab">
                                        <i class="demo-pli-information icon-lg icon-fw"></i> Report
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-3" data-toggle="tab">
                                        <i class="demo-pli-wrench icon-lg icon-fw"></i> Settings
                                    </a>
                                </li>
                            </ul>
                            <!--================================-->
                            <!--End nav tabs-->



                            <!-- Tabs Content -->
                            <!--================================-->
                            <div class="tab-content">

                                <!--First tab (Contact list)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="tab-pane fade in active" id="demo-asd-tab-1">
                                    <p class="pad-all text-main text-sm text-uppercase text-bold">
                                        <span class="pull-right badge badge-warning">3</span> Family
                                    </p>

                                    <!--Family-->
                                    <div class="list-group bg-trans">
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/2.png') }}" alt="Profile Picture">
												<i class="badge badge-success badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Stephen Tran</p>
							                    <small class="text-muteds">Availabe</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/7.png') }}" alt="Profile Picture">
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Brittany Meyer</p>
							                    <small class="text-muteds">I think so</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/1.png') }}" alt="Profile Picture">
												<i class="badge badge-info badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Jack George</p>
							                    <small class="text-muteds">Last Seen 2 hours ago</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/4.png') }}" alt="Profile Picture">
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Donald Brown</p>
							                    <small class="text-muteds">Lorem ipsum dolor sit amet.</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/8.png') }}" alt="Profile Picture">
												<i class="badge badge-warning badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Betty Murphy</p>
							                    <small class="text-muteds">Idle</small>
							                </div>
							            </a>
							            <a href="#" class="list-group-item">
							                <div class="media-left pos-rel">
							                    <img class="img-circle img-xs" src="{{ asset('assets/img/profile-photos/9.png') }}" alt="Profile Picture">
												<i class="badge badge-danger badge-stat badge-icon pull-left"></i>
							                </div>
							                <div class="media-body">
							                    <p class="mar-no text-main">Samantha Reid</p>
							                    <small class="text-muteds">Offline</small>
							                </div>
							            </a>
                                    </div>

                                    <hr>
                                    <p class="pad-all text-main text-sm text-uppercase text-bold">
                                        <span class="pull-right badge badge-success">Offline</span> Friends
                                    </p>

                                    <!--Works-->
                                    <div class="list-group bg-trans">
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-purple badge-icon badge-fw pull-left"></span> Joey K. Greyson
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-info badge-icon badge-fw pull-left"></span> Andrea Branden
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-success badge-icon badge-fw pull-left"></span> Johny Juan
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <span class="badge badge-danger badge-icon badge-fw pull-left"></span> Susan Sun
                                        </a>
                                    </div>


                                    <hr>
                                    <p class="pad-all text-main text-sm text-uppercase text-bold">News</p>

                                    <div class="pad-hor">
                                        <p>Lorem ipsum dolor sit amet, consectetuer
                                            <a data-title="45%" class="add-tooltip text-semibold text-main" href="#">adipiscing elit</a>, sed diam nonummy nibh. Lorem ipsum dolor sit amet.
                                        </p>
                                        <small><em>Last Update : Des 12, 2014</em></small>
                                    </div>


                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--End first tab (Contact list)-->


                                <!--Second tab (Custom layout)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="tab-pane fade" id="demo-asd-tab-2">

                                    <!--Monthly billing-->
                                    <div class="pad-all">
                                        <p class="pad-ver text-main text-sm text-uppercase text-bold">Billing &amp; reports</p>
                                        <p>Get <strong class="text-main">$5.00</strong> off your next bill by making sure your full payment reaches us before August 5, 2018.</p>
                                    </div>
                                    <hr class="new-section-xs">
                                    <div class="pad-all">
                                        <span class="pad-ver text-main text-sm text-uppercase text-bold">Amount Due On</span>
                                        <p class="text-sm">August 17, 2018</p>
                                        <p class="text-2x text-thin text-main">$83.09</p>
                                        <button class="btn btn-block btn-success mar-top">Pay Now</button>
                                    </div>


                                    <hr>

                                    <p class="pad-all text-main text-sm text-uppercase text-bold">Additional Actions</p>

                                    <!--Simple Menu-->
                                    <div class="list-group bg-trans">
                                        <a href="#" class="list-group-item"><i class="demo-pli-information icon-lg icon-fw"></i> Service Information</a>
                                        <a href="#" class="list-group-item"><i class="demo-pli-mine icon-lg icon-fw"></i> Usage Profile</a>
                                        <a href="#" class="list-group-item"><span class="label label-info pull-right">New</span><i class="demo-pli-credit-card-2 icon-lg icon-fw"></i> Payment Options</a>
                                        <a href="#" class="list-group-item"><i class="demo-pli-support icon-lg icon-fw"></i> Message Center</a>
                                    </div>


                                    <hr>

                                    <div class="text-center">
                                        <div><i class="demo-pli-old-telephone icon-3x"></i></div>
                                        Questions?
                                        <p class="text-lg text-semibold text-main"> (415) 234-53454 </p>
                                        <small><em>We are here 24/7</em></small>
                                    </div>
                                </div>
                                <!--End second tab (Custom layout)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


                                <!--Third tab (Settings)-->
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <div class="tab-pane fade" id="demo-asd-tab-3">
                                    <ul class="list-group bg-trans">
                                        <li class="pad-top list-header">
                                            <p class="text-main text-sm text-uppercase text-bold mar-no">Account Settings</p>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-1" type="checkbox" checked>
                                                <label for="demo-switch-1"></label>
                                            </div>
                                            <p class="mar-no text-main">Show my personal status</p>
                                            <small class="text-muted">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</small>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-2" type="checkbox" checked>
                                                <label for="demo-switch-2"></label>
                                            </div>
                                            <p class="mar-no text-main">Show offline contact</p>
                                            <small class="text-muted">Aenean commodo ligula eget dolor. Aenean massa.</small>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-3" type="checkbox">
                                                <label for="demo-switch-3"></label>
                                            </div>
                                            <p class="mar-no text-main">Invisible mode </p>
                                            <small class="text-muted">Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </small>
                                        </li>
                                    </ul>


                                    <hr>

                                    <ul class="list-group pad-btm bg-trans">
                                        <li class="list-header"><p class="text-main text-sm text-uppercase text-bold mar-no">Public Settings</p></li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-4" type="checkbox" checked>
                                                <label for="demo-switch-4"></label>
                                            </div>
                                            Online status
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-5" type="checkbox" checked>
                                                <label for="demo-switch-5"></label>
                                            </div>
                                            Show offline contact
                                        </li>
                                        <li class="list-group-item">
                                            <div class="pull-right">
                                                <input class="toggle-switch" id="demo-switch-6" type="checkbox" checked>
                                                <label for="demo-switch-6"></label>
                                            </div>
                                            Show my device icon
                                        </li>
                                    </ul>



                                    <hr>

                                    <p class="pad-hor text-main text-sm text-uppercase text-bold mar-no">Task Progress</p>
                                    <div class="pad-all">
                                        <p class="text-main">Upgrade Progress</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-success" style="width: 15%;"><span class="sr-only">15%</span></div>
                                        </div>
                                        <small>15% Completed</small>
                                    </div>
                                    <div class="pad-hor">
                                        <p class="text-main">Database</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-danger" style="width: 75%;"><span class="sr-only">75%</span></div>
                                        </div>
                                        <small>17/23 Database</small>
                                    </div>

                                </div>
                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                                <!--Third tab (Settings)-->

                            </div>
                        </div>
                    </div>
                </div>
            </aside>
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

        const totalSemuaHarga = {{ $totalSemuaHarga}};
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

<script>
    // Function to handle form validation and show the modal
    function validateForm(event) {
      event.preventDefault(); // Prevent the default form submission behavior
  
      // Add your form validation logic here if needed
      // ...
  
      // Show the modal
      const modalEdit = document.getElementById('modalEdit');
      modalEdit.style.display = 'block';
  
      // You might need additional logic here, depending on how your modal works (e.g., handling close button or backdrop click)
    }
  </script>
  
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



