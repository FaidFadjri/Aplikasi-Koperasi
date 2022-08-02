<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Login CSS --}}
    <link rel="stylesheet" href="/css/login/style.css">
</head>

<body>
    <section>
        <div class="container position-relative">
            {{-- Logo files --}}
            <img src="/assets/img/logo.jpg" alt="logo" class="logo">
            <div class="row">
                <div class="col-sm-12 col-md-6 left">
                    <div class="ilustrasi">
                        <img src="/assets/img/people-img.png" alt="illustration">
                    </div>
                </div>
                <div class="col-sm-12 col-md-6">
                    <div class="container">
                        <form class="form" action="/login/auth" method="POST" id="form-login">
                            <h1 class="form-title">Koperasi Mobile</h1>
                            <p class="form-subtitle mb-5">Developed by business development</p>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" name="email" autocomplete="off">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" name="password" id="floatingPassword"
                                    placeholder="Password" autocomplete="off">
                                <label for="floatingPassword">Password</label>
                            </div>
                            <button type="submit" class="btn-default">Sign in</button>
                            <hr />
                            <a class="btn-default-cancel">Register</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Login script --}}
    <script>
        $(document).ready(function() {
            $('#form-login').submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var actionUrl = form.attr('action');

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: form.serialize(),
                    dataType: "json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    beforeSend: function() {
                        showLoading("Silahkan tunggu", "sistem sedang verifikasi akun anda");
                    },
                    success: function(response, textStatus, xhr) {
                        Swal.close();
                        Swal.fire(
                            'Good job!',
                            `You logged in as ${response.role}`,
                            'success'
                        ).then(function() {
                            location.href = "/";
                        });
                    },
                    error: function(err) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: err.responseJSON
                        });
                    }
                });
            });


            const showLoading = (title, desc) => {
                Swal.fire({
                    title: title,
                    html: desc,
                    timerProgressBar: true,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
            }
        });
    </script>

</body>

</html>
