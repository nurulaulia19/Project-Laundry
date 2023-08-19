<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Edit Transaksi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('transaksi.updateTransaksi', ['id_transaksi' => $dataTransaksi->id_transaksi]) }}">
                    {{ csrf_field() }}
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Terima</label>
                                    <input type="date" placeholder="Tanggal Terima" name="tanggal_transaksi" id="tanggal_transaksi" class="form-control"  value="{{ $dataTransaksi->tanggal_transaksi }}">
                                    <span id="tanggal_transaksiError" class="error-message"></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="control-label">Tanggal Selesai</label>
                                    <input type="date" placeholder="Tanggal Selesai" name="tanggal_selesai" id="tanggal_selesai" class="form-control"  value="{{ $dataTransaksi->tanggal_selesai }}">
                                    <span id="tanggal_selesaiError" class="error-message"></span>
                                </div>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Nama Kasir</label>
                                <input type="text" name="user_name" value="{{ auth()->user()->user_name }}" class="form-control" readonly>
                            </div> 
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="proses" @if($dataTransaksi->status == 'proses') selected @endif>Proses</option>
                                    <option value="selesai" @if($dataTransaksi->status == 'selesai') selected @endif>Selesai</option>
                                </select>
                                <span id="statusError" class="error-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="id_customer">Customer</label>
                                <input type="text" id="customerSearch" class="form-control" placeholder="Cari customer..."  autocomplete="off">
                                <select name="id_customer" id="id_customer" class="form-control" multiple="multiple">
                                    @foreach ($dataCustomer as $item)
                                    <option value="{{ $item->id_customer }}" @if ($item->id_customer == $dataTransaksi->id_customer) selected @endif>{{ $item->nama_customer }}</option>
                                    @endforeach
                                </select>
                                <span id="customerError" class="error-message"></span>
                                <!-- Tambahkan elemen div untuk pesan pencarian tidak ditemukan -->
                                <div id="customerNotFound" class="not-found-message" style="display: none;">Pencarian tidak ditemukan.</div>
                            </div>
                        </div>
                        
                        <!-- Untuk kolom Cabang -->
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="id_cabang">Cabang</label>
                                <input type="text" id="cabangSearch" class="form-control" placeholder="Cari cabang..."  autocomplete="off">
                                <select name="id_cabang" id="id_cabang" class="form-control" multiple>
                                    @foreach ($dataCabang as $item)
                                        <option value="{{ $item->cabang->id_cabang }}" @if ($item->cabang->id_cabang == $dataTransaksi->id_cabang) selected @endif>{{ $item->cabang->nama_cabang }}</option>
                                    @endforeach
                                
                                    {{-- Display all branches when user has no accessible branches --}}
                                    @if ($dataCabang->isEmpty())
                                        @foreach ($allCabang as $branch)
                                            <option value="{{ $branch->id_cabang }}" @if ($branch->id_cabang == $dataTransaksi->id_cabang) selected @endif>{{ $branch->nama_cabang }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                
                                
                    
                                
                                {{-- <select name="id_cabang" id="id_cabang" class="form-control" multiple>
                                    @foreach ($dataCabang as $item)
                                        <option value="{{ $item->cabang->id_cabang }}" @if ($item->cabang->id_cabang == $dataTransaksi->id_cabang) selected @endif>{{ $item->cabang->nama_cabang }}</option>
                                    @endforeach
                                </select> --}}
                                <span id="cabangError" class="error-message"></span>
                                <!-- Tambahkan elemen div untuk pesan pencarian tidak ditemukan -->
                                <div id="cabangNotFound" class="not-found-message" style="display: none;">Pencarian tidak ditemukan.</div>
                            </div>
                        </div>
                        
                        

                        {{-- nitip --}}
                        {{-- <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="id_customer">Customer</label>
                                <input type="text" id="customerSearch" class="form-control" placeholder="Cari customer...">
                                <select name="id_customer" id="id_customer" class="form-control" multiple="multiple">
                                    @foreach ($dataCustomer as $item)
                                        <option value="{{ $item->id_customer }}" @if ($item->id_customer == $dataTransaksi->id_customer) selected @endif>{{ $item->nama_customer }}</option>
                                    @endforeach
                                </select>
                                <span id="customerError" class="error-message"></span>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="control-label" for="id_cabang">Cabang</label>
                                <input type="text" id="cabangSearch" class="form-control" placeholder="Cari cabang...">
                                <select name="id_cabang" id="id_cabang" class="form-control" multiple>
                                    @foreach ($dataCabang as $item)
                                        <option value="{{ $item->cabang->id_cabang }}">{{ $item->cabang->nama_cabang }}</option>
                                    @endforeach
                                </select>
                                <span id="cabangError" class="error-message"></span>
                            </div>
                        </div> --}}
                        
                        
                    </div>
                    <hr>
                    <div class="form-group d-flex mb-3">
                        <label class="col-sm-3 control-label" for="diskon_transaksi">Diskon</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Diskon" name="diskon_transaksi" id="diskon_transaksi" class="form-control" value="{{ $dataTransaksi->diskon_transaksi }}" onblur="setDefaultDiskon()">
                            <span id="diskon_transaksi_error" class="error-message"></span>
                        </div>
                    </div>
                    
                   
                    <div class="form-group d-flex mb-3">
                        <label class="col-sm-3 control-label" for="total_bayar">Total Harga</label>
                        <div class="col-sm-9">
                            
                            <input type="hidden" id="total_harga_setelah_diskon" value="{{ $totalHargaDiskon}}">
                            <input type="text" placeholder="Total Harga" name="total_harga" id="total_harga_input" class="form-control" value="{{ number_format($totalSemuaHarga - $totalHargaDiskon , 0, ',', '.') }}">
                        </div>
                    </div>
                    <div class="form-group d-flex mb-3">
                        <label class="col-sm-3 control-label" for="total_bayar">Total Bayar</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Total Bayar" name="total_bayar" id="total_bayar_input" class="form-control" value="{{ $dataTransaksi->total_bayar }}">
                            <span id="total_bayar_error" class="error-message"></span>
                        </div>
                    </div>
                    <div class="form-group d-flex mb-3">
                        <label class="col-sm-3 control-label" for="total_kembalian">Total Kembalian</label>
                        <div class="col-sm-9">
                            <input type="text" placeholder="Total Kembalian" name="total_kembalian" id="total_kembalian_input" class="form-control" value="{{ $dataTransaksi->total_kembalian }}">
                            <span id="total_kembalian_error" class="error-message"></span>
                        </div>
                    </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Bayar</button>
            </div>
        </form>
        </div>
    </div>
</div>

<script>
    // Mendapatkan elemen input tanggal
    var inputTanggal = document.getElementById('tanggal_transaksi');

    // Mendapatkan tanggal sekarang
    var today = new Date();
    var year = today.getFullYear();
    var month = String(today.getMonth() + 1).padStart(2, '0'); // Bulan dimulai dari 0, tambahkan 1 dan pad dengan 0 jika hanya satu digit
    var day = String(today.getDate()).padStart(2, '0');

    // Format tanggal sesuai dengan input tanggal (yyyy-mm-dd)
    var formattedDate = year + '-' + month + '-' + day;

    // Set nilai default input tanggal
    inputTanggal.value = formattedDate;
</script>


<script>
    function setDefaultDiskon() {
        var diskonInput = document.getElementById('diskon_transaksi');
        if (diskonInput.value.trim() === '') {
            diskonInput.value = '0';
        }
    }
</script>

{{-- <script>
    const setupSelectWithSearch = (inputId, selectId, options) => {
        const input = document.getElementById(inputId);
        const select = document.getElementById(selectId);
        const selectOptions = select.getElementsByTagName('option');
        
        input.addEventListener('click', function() {
            select.style.display = 'block';
            filterSelectOptions('');
        });

        input.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            filterSelectOptions(searchValue);
        });

        const filterSelectOptions = (searchValue) => {
            for (let i = 0; i < selectOptions.length; i++) {
                const optionText = selectOptions[i].textContent.toLowerCase();
                if (optionText.includes(searchValue)) {
                    selectOptions[i].style.display = 'block';
                } else {
                    selectOptions[i].style.display = 'none';
                }
            }
        }

        for (let i = 0; i < selectOptions.length; i++) {
            selectOptions[i].addEventListener('click', function() {
                input.value = this.textContent;
                select.style.display = 'none';
            });
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest(`#${inputId}`) && !event.target.closest(`#${selectId}`)) {
                select.style.display = 'none';
            }
        });
    };

    // Panggil fungsi setupSelectWithSearch untuk elemen pelanggan
    setupSelectWithSearch('customerSearch', 'id_customer', '{{ json_encode($dataCustomer) }}');

    // Panggil fungsi setupSelectWithSearch untuk elemen cabang
    setupSelectWithSearch('cabangSearch', 'id_cabang', '{{ json_encode($dataCabang) }}');
</script> --}}

<script>
    const setupSelectWithSearch = (inputId, selectId, options) => {
        const input = document.getElementById(inputId);
        const select = document.getElementById(selectId);
        const selectOptions = select.getElementsByTagName('option');
        
        input.addEventListener('click', function() {
            select.style.display = 'block';
            filterSelectOptions('');
        });

        input.addEventListener('input', function() {
            const searchValue = this.value.toLowerCase();
            filterSelectOptions(searchValue);
        });

        const filterSelectOptions = (searchValue) => {
            for (let i = 0; i < selectOptions.length; i++) {
                const optionText = selectOptions[i].textContent.toLowerCase();
                if (optionText.includes(searchValue)) {
                    selectOptions[i].style.display = 'block';
                } else {
                    selectOptions[i].style.display = 'none';
                }
            }
        }

        for (let i = 0; i < selectOptions.length; i++) {
            selectOptions[i].addEventListener('click', function() {
                input.value = this.textContent;
                select.style.display = 'none';
            });
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest(`#${inputId}`) && !event.target.closest(`#${selectId}`)) {
                select.style.display = 'none';
            }
        });
    };

    // Panggil fungsi setupSelectWithSearch untuk elemen pelanggan
    setupSelectWithSearch('customerSearch', 'id_customer', '{{ json_encode($dataCustomer) }}');

    // Panggil fungsi setupSelectWithSearch untuk elemen cabang
    setupSelectWithSearch('cabangSearch', 'id_cabang', '{{ json_encode($dataCabang) }}');

    // Fungsi untuk menampilkan atau menyembunyikan pesan pencarian tidak ditemukan
    function showNotFoundMessage(inputElement, notFoundElement, selectOptions) {
    const searchValue = inputElement.value.trim().toLowerCase();
    let isMatchFound = false;

    for (let i = 0; i < selectOptions.length; i++) {
        const optionText = selectOptions[i].textContent.trim().toLowerCase();
        if (optionText.includes(searchValue)) {
            isMatchFound = true;
            break;
        }
    }

    if (isMatchFound || searchValue === '') {
        notFoundElement.style.display = 'none';
    } else {
        notFoundElement.style.display = 'block';
    }
}

    // Event listener untuk pencarian Customer
    const customerSearchInput = document.getElementById('customerSearch');
    const customerNotFound = document.getElementById('customerNotFound');
    const customerSelectOptions = document.querySelectorAll('#id_customer option'); // Ubah sesuai dengan selector yang sesuai
        
    customerSearchInput.addEventListener('input', function () {
        showNotFoundMessage(this, customerNotFound, customerSelectOptions);
    });

    // Event listener untuk pencarian Cabang
    const cabangSearchInput = document.getElementById('cabangSearch');
    const cabangNotFound = document.getElementById('cabangNotFound');
    const cabangSelectOptions = document.querySelectorAll('#id_cabang option'); // Ubah sesuai dengan selector yang sesuai
        
    cabangSearchInput.addEventListener('input', function () {
        showNotFoundMessage(this, cabangNotFound, cabangSelectOptions);
    });
</script>

{{-- pencarian kosong --}}
<script>
    // Fungsi untuk mereset pesan "Pencarian tidak ditemukan"
    function resetNotFoundMessages() {
        document.getElementById('customerNotFound').style.display = 'none';
        document.getElementById('cabangNotFound').style.display = 'none';
    }

    // Menambahkan event listener untuk mengatur ulang pesan saat pengguna mengklik di luar kolom pencarian
    document.addEventListener('click', function (event) {
        const clickedElement = event.target;
        const customerSearch = document.getElementById('customerSearch');
        const cabangSearch = document.getElementById('cabangSearch');

        // Cek apakah yang diklik adalah di luar kolom pencarian dan pesan tidak ditemukan ditampilkan
        if ((clickedElement !== customerSearch && clickedElement !== cabangSearch) &&
            (document.getElementById('customerNotFound').style.display === 'block' ||
             document.getElementById('cabangNotFound').style.display === 'block')) {
            // Kosongkan kolom pencarian hanya jika pesan tidak ditemukan ditampilkan
            if (document.getElementById('customerNotFound').style.display === 'block') {
                customerSearch.value = '';
            }
            if (document.getElementById('cabangNotFound').style.display === 'block') {
                cabangSearch.value = '';
            }
            resetNotFoundMessages();
        }
    });
</script>



