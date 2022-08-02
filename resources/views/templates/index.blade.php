<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Akastra Link</title>
    {{-- Bootstrap --}}
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <!-- Amchart -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>

    {{-- CSS --}}
    <link rel="stylesheet" href="/css/dashboard/style.css">
</head>

<body>
    <section>
        <nav class="navbar-area">
            <a href="" class="navbar-logo">
                Akastra Link
            </a>

            <ul class="navbar-item">
                <li class="navbar-link">Overview</li>
                <li class="navbar-link dropdown-nav" id="bisnis">
                    Bisnis <ion-icon name="chevron-down-outline"></ion-icon>

                    <ul class="navbar-dropdown d-none" id="bisnisDropdown">
                        <li class="navbar-dropdown-item">
                            <ion-icon name="git-network-outline"></ion-icon> Usaha
                        </li>
                        <li class="navbar-dropdown-item">
                            <ion-icon name="document-text-outline"></ion-icon>Report
                        </li>
                    </ul>
                </li>
                <li class="navbar-link">Tabungan</li>
                <li class="navbar-link">Simpan / Pinjam</li>
            </ul>

            <div class="profile-wrap">
                <button class="logout-button">Logout</button>
            </div>
        </nav>
        <div class="background-area"></div>

        @yield('content')
        <br><br><br><br>

        {{-- Bottom Navigation --}}
        <nav class="bottom-navigation">
            <ul class="bottom-navigation-wrapper">
                <li class="bottom-nav-item active">
                    <a href="#" class="bottom-nav-link">
                        <span class="material-icons">
                            home
                        </span>
                        Home
                    </a>
                </li>
                <li class="bottom-nav-item">
                    <a href="#" class="bottom-nav-link">
                        <span class="material-icons">
                            work
                        </span>
                        Business
                    </a>
                </li>
                <li class="bottom-nav-item">
                    <a href="#" class="bottom-nav-link">
                        <span class="material-icons">
                            account_balance
                        </span>
                        Tabungan
                    </a>
                </li>
                <li class="bottom-nav-item">
                    <a href="#" class="bottom-nav-link">
                        <span class="material-icons">
                            account_balance_wallet
                        </span>
                        Pinjaman
                    </a>
                </li>
            </ul>
        </nav>
        @yield('section')
    </section>



    {{-- Handle Navbar --}}
    <script>
        $(document).ready(function() {
            $('#bisnis').hover(function() {
                $('#bisnisDropdown').removeClass('d-none')
                $('#bisnisDropdown').removeClass('hide-dropdown')
                $('#bisnisDropdown').addClass('show-dropdown')
            }, function() {
                $('#bisnisDropdown').removeClass('show-dropdown')
                $('#bisnisDropdown').addClass('hide-dropdown')
                $('#bisnisDropdown').addClass('d-none')
            });
        });
    </script>
    @yield('script')
</body>

</html>
