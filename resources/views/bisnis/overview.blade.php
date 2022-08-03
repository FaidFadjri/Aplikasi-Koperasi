@extends('templates.index')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="transaksi d-flex justify-content-end gap-2">
                    <button class="btn btn-secondary shadow text-poppins float-end d-flex gap-3" data-bs-toggle="modal"
                        data-bs-target="#modalKategori">
                        Kategori
                        <span class="material-icons">
                            local_mall
                        </span>
                    </button>
                    <button class="btn btn-success shadow text-poppins float-end d-flex gap-3" data-bs-toggle="modal"
                        data-bs-target="#modalTransaksi">
                        Transaksi
                        <span class="material-icons">
                            add_circle
                        </span>
                    </button>
                </div>


                <!-------- Modal Kategori ------>
                <div class="modal fade" id="modalKategori" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="/bisnis/add_kategori" id="formKategori">
                            @csrf
                            <div class="modal-content border-0">
                                <div class="modal-header border-0">
                                </div>
                                <div class="modal-body border-0 text-poppins">
                                    <input type="hidden" class="form-control" id="businessId" name="businessId"
                                        value="<?= $businessId ?>" readonly>

                                    <div class="mb-3">
                                        <label for="kategori" class="mb-2">Kategori</label>
                                        <input type="text" class="form-control" id="kategori" name="kategori">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategoriDesc" class="mb-2">Keterangan</label>
                                        <textarea class="form-control" placeholder="Ketikan Deskripsi" id="kategoriDesc" name="keterangan"
                                            style="min-height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-secondary">Simpan Kategori</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Modal Transaksi -->
                <div class="modal fade" id="modalTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <form method="POST" action="/bisnis/add_transaksi" id="formTransaksi">
                            @csrf
                            <input type="hidden" class="form-control" id="businessId" name="businessId"
                                value="<?= $businessId ?>" readonly>
                            <div class="modal-content border-0">
                                <div class="modal-header border-0">
                                    <div class="radio-transaksi">
                                        <input type="radio" id="radio1" name="jenis_transaksi" class="input-radio"
                                            value="pemasukan" checked>
                                        <label for="radio1" class="radio-label" id="label-radio1">Pemasukan</label>
                                        <input type="radio" id="radio2" name="jenis_transaksi" class="input-radio">
                                        <label for="radio2" class="radio-label" id="label-radio2"
                                            value="pengeluaran">Pengeluaran</label>
                                    </div>
                                </div>
                                <div class="modal-body border-0 text-poppins">
                                    <div class="mb-3">
                                        <label for="tanggal_transaksi" class="mb-2">Tanggal Transaksi</label>
                                        <input type="date" class="form-control" id="tanggal_transaksi"
                                            name="tanggal_transaksi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="kategori" class="mb-2">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control">
                                            @foreach ($kategori as $key)
                                                <option value="{{ $key['name'] }}">{{ $key['name'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="total" class="mb-2">Nominal</label>
                                        <input type="number" class="form-control" id="total" name="total">
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingTextarea" class="mb-2">Keterangan</label>
                                        <textarea class="form-control" placeholder="Ketikan Deskripsi" id="floatingTextarea" name="keterangan"
                                            style="min-height: 100px"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="button" class="btn btn-outline-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-secondary">Simpan Transaksi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            //---- Submit Kategori
            $('#formKategori').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        Swal.close();
                        Swal.fire(
                            'Berhasil!',
                            response,
                            'success'
                        ).then(function() {
                            location.reload();
                        })
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan pada sistem!'
                        })
                    }
                });
            });

            //---- Submit Transaksi
            $('#formTransaksi').submit(function(e) {
                e.preventDefault();

                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        Swal.showLoading();
                    },
                    success: function(response) {
                        Swal.close();
                        Swal.fire(
                            'Berhasil!',
                            response,
                            'success'
                        ).then(function() {
                            location.reload();
                        })
                    },
                    error: function() {
                        Swal.close();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan pada sistem!'
                        })
                    }
                });
            });
        });
    </script>
@endsection
