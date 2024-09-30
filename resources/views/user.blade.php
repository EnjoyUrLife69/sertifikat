<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets/') }}" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>
    <meta name="description" content="" />
    <link rel="icon" href="{{asset('assets/img/logo-bartech-no-text.png')}}" type="image/png">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon"
        href="{{ asset('assets/img/favicon/favicon.ico"') }}' />

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
        crossorigin="anonymous">

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

    <!-- Datatables CSS -->
    <link
        href="https://cdn.datatables.net/v/bs5/dt-2.1.5/b-3.1.2/b-html5-3.1.2/r-3.0.3/sc-2.4.3/sb-1.8.0/datatables.min.css"
        rel="stylesheet">

    {{-- aos --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <style>
        .swal2-container {
            z-index: 9999 !important;
            /* Atur z-index tinggi agar SweetAlert menutupi semua elemen lain */
        }
    </style>

    <!-- SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Event handler untuk tombol delete
            $('button[id^="deleteButton"]').on('click', function(e) {
                e.preventDefault();

                // Mengambil ID form dari tombol yang diklik
                var formId = $(this).closest('form').attr('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form jika user mengonfirmasi penghapusan
                        $('#' + formId).submit();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }
                });
            });
        });
    </script>

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
                        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Table /</span> User
                        </h4>

                        <!-- Bordered Table -->
                        <div class="card">
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-10">
                                    <h5 class="card-header">Data User Tables</h5>
                                </div>
                                {{-- CREATE DATA --}}
                                {{-- <div class="col-2">
                                    <div class="mt-3">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter">
                                            <i class='bx bx-plus-circle'></i> Add Data
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalCenterTitle">Add Data
                                                            Sertifikat
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('sertifikat.store') }}" method="post"
                                                        role="form" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 col-form-label"
                                                                        for="basic-icon-default-fullname">Nama
                                                                        Peserta</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-category'></i></span>
                                                                            <input type="text" class="form-control"
                                                                                id="basic-icon-default-fullname"
                                                                                placeholder="Enter Name" required
                                                                                aria-label="John Doe"
                                                                                name="nama_penerima"
                                                                                aria-describedby="basic-icon-default-fullname2" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm-2 col-form-label"
                                                                        for="basic-icon-default-company">Nama
                                                                        Pelatihan</label>
                                                                    <div class="col-sm-10">
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-category'></i></span>
                                                                            <select id="defaultSelect"
                                                                                class="form-select" required
                                                                                name="id_training">
                                                                                <option value="">Pilih Pelatihan
                                                                                </option>
                                                                                @foreach ($training as $data)
                                                                                    <option
                                                                                        value="{{ $data->id }}">
                                                                                        {{ $data->nama_training }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <button type="submit"
                                                                class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped" id="myTable">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no=1; @endphp
                                            @foreach ($user as $data)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td><b>{{ $data->name }}</b></td>
                                                    <td>{{ $data->email }}</td>
                                                    <td>{{ $data->roles->nama_role }}
                                                    </td>
                                                    <td>
                                                        {{-- SHOW DATA --}}
                                                        <!-- Button yang nge-trigger modal -->
                                                        <button type="button" class="btn btn-sm btn-warning"
                                                            data-bs-target="#Show{{ $data->id }}"
                                                            data-bs-toggle="modal">
                                                            <i class='bx bx-show-alt' data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Show"
                                                                data-bs-offset="0,4" data-bs-html="true"></i>
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Show{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="EditTitle">
                                                                            Show
                                                                            Data User</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('user.show', $data->id) }}"
                                                                        method="post" role="form"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="nameWithTitle"
                                                                                        class="form-label">Nama
                                                                                        User</label>
                                                                                    <div
                                                                                        class="input-group input-group-merge">
                                                                                        <span
                                                                                            id="basic-icon-default-fullname2"
                                                                                            class="input-group-text"><i
                                                                                                class='bx bx-user'></i></span>
                                                                                        <input
                                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                                            type="text"
                                                                                            id="nameWithTitle" required
                                                                                            class="form-control"
                                                                                            name="name" disabled
                                                                                            value="{{ $data->name }}" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="nameWithTitle"
                                                                                        class="form-label">Roles</label>
                                                                                    <div
                                                                                        class="input-group input-group-merge">
                                                                                        <span
                                                                                            id="basic-icon-default-fullname2"
                                                                                            class="input-group-text"><i
                                                                                                class='bx bx-category'></i></span>
                                                                                        <select id="defaultSelect"
                                                                                            class="form-select" disabled
                                                                                            name="roles_id">
                                                                                            <option>Default
                                                                                                select
                                                                                            </option>
                                                                                            @foreach ($roles as $item)
                                                                                                <option
                                                                                                    value="{{ $item->id }}"
                                                                                                    {{ $item->id == $data->roles_id ? 'selected' : '' }}>
                                                                                                    {{ $item->nama_role }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="nameWithTitle"
                                                                                        class="form-label">Email</label>
                                                                                    <div
                                                                                        class="input-group input-group-merge">
                                                                                        <span
                                                                                            id="basic-icon-default-fullname2"
                                                                                            class="input-group-text"><i class='bx bxs-envelope'></i></span>
                                                                                        <input
                                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                                            type="text"
                                                                                            id="nameWithTitle" required
                                                                                            class="form-control" 
                                                                                            disabled name="email"
                                                                                            value="{{ $data->email }}" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-primary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- EDIT DATA --}}
                                                        <!-- Button yang nge-trigger modal -->
                                                        <button type="button" class="btn btn-sm btn-primary"
                                                            data-bs-target="#Edit{{ $data->id }}"
                                                            data-bs-toggle="modal">
                                                            <i class='bx bx-edit' data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Edit"
                                                                data-bs-offset="0,4" data-bs-html="true"></i>
                                                        </button>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="Edit{{ $data->id }}"
                                                            tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="EditTitle">
                                                                            Edit
                                                                            Data User</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <form
                                                                        action="{{ route('user.update', $data->id) }}"
                                                                        method="post" role="form"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="nameWithTitle"
                                                                                        class="form-label">Nama
                                                                                        User</label>
                                                                                    <div
                                                                                        class="input-group input-group-merge">
                                                                                        <span
                                                                                            id="basic-icon-default-fullname2"
                                                                                            class="input-group-text"><i
                                                                                                class='bx bx-user'></i></span>
                                                                                        <input
                                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                                            type="text"
                                                                                            id="nameWithTitle" required
                                                                                            class="form-control"
                                                                                            name="name"
                                                                                            value="{{ $data->name }}" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="nameWithTitle"
                                                                                        class="form-label">Roles</label>
                                                                                    <div
                                                                                        class="input-group input-group-merge">
                                                                                        <span
                                                                                            id="basic-icon-default-fullname2"
                                                                                            class="input-group-text"><i
                                                                                                class='bx bx-category'></i></span>
                                                                                        <select id="defaultSelect"
                                                                                            class="form-select"
                                                                                            name="roles_id">
                                                                                            <option>Default
                                                                                                select
                                                                                            </option>
                                                                                            @foreach ($roles as $item)
                                                                                                <option
                                                                                                    value="{{ $item->id }}"
                                                                                                    {{ $item->id == $data->roles_id ? 'selected' : '' }}>
                                                                                                    {{ $item->nama_role }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col mb-3">
                                                                                    <label for="nameWithTitle"
                                                                                        class="form-label">Email</label>
                                                                                    <div
                                                                                        class="input-group input-group-merge">
                                                                                        <span
                                                                                            id="basic-icon-default-fullname2"
                                                                                            class="input-group-text"><i class='bx bxs-envelope'></i></span>
                                                                                        <input
                                                                                            style="font-weight: bold; padding-left: 15px;"
                                                                                            type="text"
                                                                                            id="nameWithTitle" required
                                                                                            class="form-control"
                                                                                            disabled name="email"
                                                                                            value="{{ $data->email }}" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-outline-secondary"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                            <button type="submit"
                                                                                class="btn btn-primary">Save
                                                                                changes</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- DELETE DATA --}}
                                                        @if (auth()->user()->id != $data->id)
                                                            <form id="deleteForm{{ $data->id }}"
                                                                action="{{ route('user.destroy', $data->id) }}"
                                                                method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" class="btn btn-sm btn-danger"
                                                                    id="deleteButton{{ $data->id }}"
                                                                    data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                                    data-bs-placement="top" data-bs-html="true"
                                                                    title="<span>Delete</span>">
                                                                    <i class='bx bx-trash'></i>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr class="my-5" />
                    </div>
                    <div class="content-backdrop fade"></div>
                </div>
            </div>
        </div>


    </div>

    <!-- Datatables JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script
        src="https://cdn.datatables.net/v/bs5/dt-2.1.5/b-3.1.2/b-html5-3.1.2/r-3.0.3/sc-2.4.3/sb-1.8.0/datatables.min.js">
    </script>
    <script>
        let table = new DataTable('#myTable');
    </script>

    <!-- Tooltip JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(function(tooltipTriggerEl) {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>

    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    @include('sweetalert::alert')
    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    <!-- Toast SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
