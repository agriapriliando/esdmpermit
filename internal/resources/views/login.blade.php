<x-layouts.app>
    <div class="row my-2">
        <div class="col-md-6 col-12" style="margin: auto;">
            <div class="card align-middle" style="min-height: 50vh;">
                <div class="card-body px-5 pt-5 pb-4">
                    <img src="assets/logo_kotak.png" alt="navbar brand" class="navbar-brand float-end d-none" height="40" />
                    <h5 class="card-title">Login MinersDB</h5>
                    <h6 class="card-subtitle mb-4 text-body-secondary">Bidang Pertambangan DESDM Kalteng</h6>
                    <hr>
                    <div>
                        @session('status')
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endsession
                        <form action="{{ route('auth.login') }}" method="POST">
                            @csrf
                            @method('POST')
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" placeholder="Username" name="username">
                            </div>
                            <div>
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group mb-3" x-data="{ pass: false }">
                                    <input :type="pass ? 'password' : 'text'" class="form-control" placeholder="Password" id="password" name="password">
                                    <span class="input-group-text hover"><i x-on:click="pass = !pass" :class="pass ? 'ri-eye-off-line' : 'ri-eye-line'"></i></span>
                                </div>
                            </div>
                            <div class="form-check mb-3 pt-0">
                                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="remember">
                                <label class="form-check-label" for="flexCheckChecked">
                                    Ingat Saya
                                </label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn button-gradient-bg text-white">L o g i
                                    n</button>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-4">
                        <span class="fw-bold">MinersDB</span> Bidang Pertambangan DESDM Kalteng<br>Tahun 2025
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scriptsatas')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="{{ asset('') }}assets/css/libs.bundle.css" />

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('') }}assets/css/theme.bundle.css" />
        <style>
            .gradient-bg {
                background: linear-gradient(224deg, #007db7, #9600b7, #d71840);
                background-size: 600% 600%;

                -webkit-animation: animatebg 8s ease infinite;
                -moz-animation: animatebg 8s ease infinite;
                animation: animatebg 8s ease infinite;
            }

            @-webkit-keyframes animatebg {
                0% {
                    background-position: 0% 52%
                }

                50% {
                    background-position: 100% 49%
                }

                100% {
                    background-position: 0% 52%
                }
            }

            @-moz-keyframes animatebg {
                0% {
                    background-position: 0% 52%
                }

                50% {
                    background-position: 100% 49%
                }

                100% {
                    background-position: 0% 52%
                }
            }

            @keyframes animatebg {
                0% {
                    background-position: 0% 52%
                }

                50% {
                    background-position: 100% 49%
                }

                100% {
                    background-position: 0% 52%
                }
            }

            .button-gradient-bg {
                background: linear-gradient(224deg, #007db7, #9600b7, #d71840);
                background-size: 600% 600%;

                -webkit-animation: animatebg 3s ease infinite;
                -moz-animation: animatebg 3s ease infinite;
                animation: animatebg 3s ease infinite;
            }

            @-webkit-keyframes animatebg {
                0% {
                    background-position: 0% 52%
                }

                50% {
                    background-position: 100% 49%
                }

                100% {
                    background-position: 0% 52%
                }
            }

            @-moz-keyframes animatebg {
                0% {
                    background-position: 0% 52%
                }

                50% {
                    background-position: 100% 49%
                }

                100% {
                    background-position: 0% 52%
                }
            }

            @keyframes animatebg {
                0% {
                    background-position: 0% 52%
                }

                50% {
                    background-position: 100% 49%
                }

                100% {
                    background-position: 0% 52%
                }
            }

            .hover {
                cursor: pointer !important;
            }
        </style>
    @endpush

    @push('scriptsbawah')
        <!-- Theme JS -->
        <!-- Vendor JS -->
        <script src="{{ asset('') }}assets/js/vendor.bundle.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>

        <!-- Theme JS -->
        <script src="{{ asset('') }}assets/js/theme.bundle.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
</x-layouts.app>
