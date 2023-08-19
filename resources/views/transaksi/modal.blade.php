
@foreach ($dataJasa as $item)
  <!-- ... Kode lainnya ... -->
  <div class="modal" id="modal{{ $item->id_jasa }}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">{{ $item->jenis_layanan }}</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('transaksi.store') }}">
            <input type="hidden" name="id_jasa" value="{{ $item->id_jasa }}">
            {{ csrf_field() }}
            <div class="form-group d-flex">
                    <div class="col-sm-12">
                         <div class="radio-container" style="display: flex; flex-direction: column;">
                                {{-- @foreach ($item->aditionalProduk as $items)
                                <div class="row">

					                      <div class="col-xs-6">
                                    <input class="form-check-input" name="id_aditional[]" type="radio" value="{{ $items->id_aditional }}">
                                    <label class="form-check-label">{{ $items->nama_aditional }}</label>
                                </div>
					                      <div class="col-xs-6">
                                    <p>Harga: {{ $items->harga_aditional }}</p>
                                </div>
					                      </div>
                            @endforeach --}}
                            <div class="row form-group d-flex mb-6">
                              <div class="col-xs-6 text-center-container" style="display: flex;
                              align-items: center;">
                                <label class="col-sm-3 control-label" style="margin-right: 10px;" for="jumlah_produk">Jumlah</label>
                                <div class="col-xs-6 counter-container">
                                  <input type="number" class="form-control" name="jumlah_jasa" value="1" min="1">
                                </div>
                              </div>
                            </div>  
                        </div>
                    </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary save-changes-btn" productId="{{ $item->id_jasa }}">Save changes</button>
        </div>
      </form>
      
      </div>
    </div>
  </div>
  <!-- ... Kode lainnya ... -->
@endforeach
