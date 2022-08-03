@extends('templates.index')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            @if (Session::has('error'))
                <div class="col-12">
                    <div class="alert alert-warning" role="alert">
                        {{ Session::get('error') }}
                    </div>
                </div>
            @endif
            <div class="col-12 mb-4">
                <a href="/bisnis" class="btn btn-secondary float-start d-flex align-items-center justify-content-center px-4">
                    <span class="material-icons">
                        chevron_left
                    </span>
                    Back
                </a>
                <a class="btn btn-secondary text-poppins float-end d-flex align-items-center gap-2 shadow restore-all">
                    Restore All
                    <span class="material-icons">
                        restore
                    </span>
                </a>
            </div>
            @foreach ($business as $row)
                <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                    <div class="card border border-white shadow fade-in">
                        <div class="card-body p-4">
                            <h5 class="card-title"><?= $row['nameOfBusiness'] ?></h5>
                            <p class="card-text">
                                <?= $row['descOfBusiness'] ?>
                            </p>
                            <a class="btn btn-outline-secondary btn-restore" data-id="{{ $row['businessId'] }}">Restore</a>
                            <a href="" class="btn btn-danger btn-delete" data-id="{{ $row['businessId'] }}">
                                Hapus Permanen
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection



@section('script')
    <script>
        //------------ RESTORE
        $(document).ready(function() {
            $('.btn-restore').click(function(e) {
                e.preventDefault();

                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Yakin mau restore data ini ?',
                    text: 'data akan di kembalikan lagi',
                    showDenyButton: true,
                    denyButtonText: 'Batal',
                    confirmButtonText: 'Restore',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/bisnis/restore_bisnis",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                Swal.showLoading();
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire(
                                    'Berhasil!',
                                    'Data berhasil di restore',
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
                                    text: 'Terjadi Kesalahan pada sistem',
                                })
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.close();
                    }
                })


            });
        });

        //----------- FORCE DELETE
        $(document).ready(function() {
            $('.btn-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Hapus permanen data ini ?',
                    text: 'data tidak akan bisa di kembalikan lagi',
                    showDenyButton: true,
                    denyButtonText: 'Batal',
                    confirmButtonText: 'Hapus Permanen',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/bisnis/force_delete",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                Swal.showLoading();
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire(
                                    'Berhasil!',
                                    'Data sudah dihapus permanen',
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
                                    text: 'Terjadi Kesalahan pada sistem',
                                })
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.close();
                    }
                })


            });
        });

        //---------- RESTORE ALL
        $(document).ready(function() {
            $('.restore-all').click(function(e) {
                e.preventDefault();

                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Restore semua sampah ?',
                    text: 'semua sampah akan di kembalikan',
                    showDenyButton: true,
                    denyButtonText: 'Batal',
                    confirmButtonText: 'Restore All',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/bisnis/restore_all",
                            data: {
                                id: id
                            },
                            dataType: "json",
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            beforeSend: function() {
                                Swal.showLoading();
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire(
                                    'Berhasil!',
                                    'Data berhasil direstore',
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
                                    text: 'Terjadi Kesalahan pada sistem',
                                })
                            }
                        });

                    } else if (result.isDenied) {
                        Swal.close();
                    }
                })


            });
        });
    </script>
@endsection
