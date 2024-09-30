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

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Training/</span> Edit Data
                        </h4>

                        <!-- Basic Layout & Basic with Icons -->
                        <div class="row">
                            <!-- Basic with Icons -->
                            <div class="col-xxl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Edit Data Training table
                                        </h5>
                                        <small class="text-muted float-end">Merged input group</small>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ route('training.update', $training->id) }}" method="post"
                                            role="form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Jenis Training</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i
                                                                class='bx bx-category'></i></span>
                                                        <input type="text" class="form-control"
                                                            id="basic-icon-default-fullname"
                                                            placeholder="AI Development" aria-label="John Doe"
                                                            name="nama_training"
                                                            aria-describedby="basic-icon-default-fullname2"
                                                            value="{{ $training->nama_training }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Tanggal Mulai</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2"
                                                            class="input-group-text"><i
                                                                class="bx bx-buildings"></i></span>
                                                        <input class="form-control" type="date" name="tanggal_mulai"
                                                            id="html5-date-input"
                                                            value="{{ $training->tanggal_mulai }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-company">Tanggal Selesai</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-company2"
                                                            class="input-group-text"><i
                                                                class="bx bx-buildings"></i></span>
                                                        <input class="form-control" name="tanggal_selesai"
                                                            type="date" id="html5-date-input"
                                                            value="{{ $training->tanggal_selesai }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 col-form-label"
                                                    for="basic-icon-default-fullname">Kode</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-fullname2"
                                                            class="input-group-text"><i
                                                                class='bx bx-category'></i></span>
                                                        <input type="text" class="form-control"
                                                            id="basic-icon-default-fullname"
                                                            placeholder="AI Development" aria-label="John Doe"
                                                            name="kode" value="{{ $training->kode }}"
                                                            aria-describedby="basic-icon-default-fullname2" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 form-label"
                                                    for="basic-icon-default-phone">Cover</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <span id="basic-icon-default-phone2"
                                                            class="input-group-text"><i
                                                                class='bx bx-image'></i></span>
                                                        <input class="form-control" type="file" id="formFile"
                                                            name="cover" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label class="col-sm-2 form-label"
                                                    for="basic-icon-default-message">Deskripsi</label>
                                                <div class="col-sm-10">
                                                    <div class="input-group input-group-merge">
                                                        <textarea id="basic-icon-default-message" class="form-control" name="konten"
                                                            aria-describedby="basic-icon-default-message2">{{ $training->konten }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-5" style="margin-left: 16.6%;">
                                                    <a href="{{ route('training.index') }}"
                                                        class="btn btn-danger">Cancel</a>
                                                </div>
                                                <div class="col-sm-5" style="margin-left: -31.5%;">
                                                    <button type="submit" class="btn btn-info">Send &nbsp;<i
                                                            class='bx bx-send'></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <!-- / CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#basic-icon-default-message'))
            .catch(error => {
                console.error(error);
            });
    </script>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
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
