<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" href="assets/img/logo-bartech-no-text.png" type="image/png">
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }} " class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('backend.sidebar')

            <!-- Layout container -->
            <div class="layout-page">

                @include('backend.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sertifikat/</span> Show Data
                        </h4>

                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-xxl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Show Data Sertifikat table
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('sertifikat.update', $sertifikat->id) }}" method="post"
                                            role="form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Nama Peserta</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class='bx bx-user'></i></span>
                                                        <input type="text" class="form-control"
                                                            id="basic-icon-default-fullname"
                                                            placeholder="AI Development" aria-label="John Doe"
                                                            name="nama_penerima" disabled style="padding-left: 15px; font-weight: bold;"
                                                            aria-describedby="basic-icon-default-fullname2"
                                                            value="{{ $sertifikat->nama_penerima }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Nama Pelatihan</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i
                                                                class='bx bx-category'></i></span>
                                                        <select id="defaultSelect" class="form-select" style="font-weight: bold;"
                                                            name="id_training" disabled>
                                                            <option>Default select</option>
                                                            @foreach ($training as $data)
                                                                <option disabled value="{{ $data->id }}"
                                                                    {{ $data->id == $sertifikat->id_training ? 'selected' : '' }}>
                                                                    {{ $data->nama_training }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Email</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i class='bx bx-user'></i></span>
                                                        <input type="text" class="form-control" 
                                                            id="basic-icon-default-fullname"
                                                            placeholder="AI Development" aria-label="John Doe"
                                                            name="email" disabled style="padding-left: 15px; font-weight: bold;"
                                                            aria-describedby="basic-icon-default-fullname2"
                                                            value="{{ $sertifikat->email }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Status</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i
                                                                class='bx bx-category'></i></span>
                                                        <select class="form-control" id="status" name="status"
                                                            style="padding-left: 15px; font-weight: bold;"
                                                            aria-describedby="basic-icon-default-fullname2" disabled>
                                                            <option value="0"
                                                                {{ $sertifikat->status == 0 ? 'selected' : '' }}><b
                                                                    style="color: red">Terdaftar
                                                                    <b></option>
                                                            <option value="1"
                                                                {{ $sertifikat->status == 1 ? 'selected' : '' }}><b
                                                                    style="color: green">
                                                                    Selesai Pelatihan</b></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- SERTIFIKAT --}}
                                            <div class="row">
                                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                                    <a href="{{ route('sertifikat.index') }}"
                                                        class="btn btn-danger">Back</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if ($sertifikat->status == 1)
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card" style="height: 820px">
                                        <!-- Embed PDF preview in an iframe -->
                                        <iframe style="height: 200%; border-radius: 10px"
                                            src="{{ route('sertifikat.preview', $sertifikat->id) }}" width="100%"
                                            height="500px"></iframe>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-xxl">
                                    <div class="card" style="height: 100px">
                                        <!-- Embed PDF preview in an iframe -->
                                        <center><h3 style="margin-top : 35px;">Sertifikat belum tersedia karena peserta <b>belum</b> menyelesaikan pelatihan</h3></center>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- / Content -->


                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
