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
            <div class="col-12 mb-3">
                <a href="/bisnis/sampah"
                    class="btn btn-secondary text-poppins float-end d-flex align-items-center gap-3 shadow">
                    Trash
                    <span class="material-icons">
                        delete
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
                            <a href="" class="btn btn-outline-secondary btn-delete"
                                data-id="{{ $row['businessId'] }}">Nonaktifkan Bisnis</a>
                            <a href="/bisnis/overview/{{ $row['businessId'] }}" class="btn btn-secondary">Cek Laporan</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-sm-12 col-md-6 col-lg-4 mb-3">
                <div class="card border border-secondary border-2 rounded fade-in">
                    <div class="card-body text-center p-4 d-flex justify-content-center flex-column align-items-center">
                        {{-- Error Animation --}}
                        <div class="d-flex align-items-center justify-content-center d-none" id="errorIndicator">
                            <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <lottie-player src="https://assets6.lottiefiles.com/packages/lf20_suhe7qtm.json"
                                background="transparent" speed="1" style="width: 300px; height: 300px;" autoplay loop>
                            </lottie-player>
                        </div>
                        {{-- End Error Animation --}}
                        <form action="/bisnis/add_bisnis" class="w-100 text-poppins" method="POST">
                            @csrf
                            <div class="hidden mb-3">
                                <input type="text" class="form-control" id="userId" name="userId" readonly required>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="bisnisName" name="bisnisName"
                                    placeholder="Nama Usaha" value="{{ old('bisnisName') }}" required>
                                <label for="bisnisName">Nama Usaha</label>
                            </div>
                            <div class="form-floating mb-2">
                                <textarea class="form-control" placeholder="Leave a comment here" id="bisnisDesc" name="bisnisDesc" required>{{ old('bisnisDesc') }}</textarea>
                                <label for="bisnisDesc">Deskripsi Usaha</label>
                            </div>
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" id="bisnisPIC" placeholder="Nama Usaha"
                                    name="bisnisPIC" required autocomplete="off" value="{{ old('bisnisPIC') }}">
                                <label for="bisnisPIC">Nama PIC</label>
                                <ul class="list-group text-start mt-2 mb-3" style="border-radius:0;" id="picList"></ul>
                            </div>
                            <button
                                class="btn btn-secondary shadow d-flex align-items-center gap-3 float-center mb-3 w-100 justify-content-center py-2"
                                type="submit" data-bs-toggle="collapse" data-bs-target="#collapseExample"
                                aria-expanded="false" aria-controls="collapseExample">
                                Tambah Usaha Baru
                                <span class="material-icons">
                                    add_circle
                                </span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('script')
    <script>
        //------------ DELETE
        $(document).ready(function() {
            $('.btn-delete').click(function(e) {
                e.preventDefault();

                var id = $(this).attr('data-id');

                Swal.fire({
                    title: 'Yakin Hapus Data ini?',
                    text: 'data akan dipindahkan ke tempat sampah',
                    showDenyButton: true,
                    denyButtonText: 'Batal',
                    confirmButtonText: 'Hapus',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/bisnis/delete_bisnis",
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
                                    'Data sudah di pindahkan te tong sampah',
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

        //------------ AUTOCOMPLETE PIC
        $(document).ready(function() {
            $('#bisnisPIC').keyup(function(e) {
                e.preventDefault();
                var keyword = $(this).val();

                if (keyword) {
                    $.ajax({
                        type: "POST",
                        url: "/bisnis/get_pic",
                        data: {
                            keyword: keyword
                        },
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.length > 0) {

                                //---- Jika data response tidak kosong
                                //-------- Mulai Buat Html DOM
                                let html = '';
                                response.forEach(element => {
                                    html +=
                                        `<li class="list-group-item pic-item py-3" user-id="${element.userId}">${element.username}</li>`;
                                });

                                $('#picList').html(html);



                                //----- Handle List Click Event
                                $('.pic-item').click(function(e) {
                                    e.preventDefault();

                                    //----- Ambil User id dan masukan ke field userId
                                    $("#userId").val($(this).attr('user-id'));

                                    //----- Masukan value ke field bisnis PIC
                                    $("#bisnisPIC").val($(this).html());

                                    //----- Sembunyikan List
                                    $('#picList').html('');
                                });

                            } else {
                                $('#picList').html('');
                            }
                        },
                        error: function(param) {
                            $('#errorIndicator').removeClass('d-none');
                        }
                    });
                } else {
                    $('#picList').html('');
                }
            });
        });
    </script>
@endsection
