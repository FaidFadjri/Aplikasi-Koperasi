@extends('templates/index')


@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-8 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Summary</h5>
                        <div class="row">
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-2">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="material-icons">
                                                add_business
                                            </span>
                                        </h5>
                                        <div class="card-text text-poppins">
                                            8 Usaha sedang berjalan
                                        </div>
                                    </div>
                                    <div class="border-0 bg-basic">
                                        <button
                                            class="btn-basic d-flex align-items-center w-100 justify-content-center">Detail
                                            <span class="material-icons">
                                                keyboard_arrow_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-2">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="material-icons">
                                                groups
                                            </span>
                                        </h5>
                                        <div class="card-text text-poppins">
                                            100 Anggota aktif koperasi
                                        </div>
                                    </div>
                                    <div class="bg-basic">
                                        <button
                                            class="btn-basic d-flex align-items-center w-100 justify-content-center">Detail
                                            <span class="material-icons">
                                                keyboard_arrow_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4 mb-2">
                                <div class="card border-0">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <span class="material-icons">
                                                currency_exchange
                                            </span>
                                        </h5>
                                        <div class="card-text text-poppins">
                                            5 Anggota pinjaman aktif
                                        </div>
                                    </div>
                                    <div class="bg-basic">
                                        <button
                                            class="btn-basic d-flex align-items-center w-100 justify-content-center">Detail
                                            <span class="material-icons">
                                                keyboard_arrow_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-4 mb-2">
                <div class="card border-0 shadow">
                    <div class="card-body d-flex align-items-center justify-content-center flex-column">
                        <h6 class="card-title title-profit">Profit <span class="bg-basic rounded-pill">Per January
                                2022</span></h6>
                        <h3 class="text-poppins title-saldo mt-1">Rp. 25.000.000</h3>
                        <div class="button-wrap d-flex gap-2 mt-2">
                            <a class="btn-cancel">Cek Pengeluaran</a>
                            <a class="btn-basic">Cek Pemasukan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script></script>
@endsection
