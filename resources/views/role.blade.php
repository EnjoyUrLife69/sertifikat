@extends('layouts.dashboard')

@section('content')
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Table /</span> Role
            </h4>

            <!-- Bordered Table -->
            <div class="card">
                <div class="row" style="margin-top: 10px;">
                    <div class="col-10">
                        <h5 class="card-header">Data Role Tables</h5>
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
                                    <th><center>No</center></th>
                                    <th>Role</th>
                                    <th>Deskripsi</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $no=1; @endphp
                                @foreach ($role as $data)
                                    <tr>
                                        <td><center>{{ $no++ }}</center></td>
                                        <td><b>{{ $data->nama_roles }}</b></td>
                                        <td>{{ $data->deskripsi_roles }}</td>
                                        <td>
                                            {{-- SHOW DATA --}}
                                            <!-- Button yang nge-trigger modal -->
                                            <button type="button" class="btn btn-sm btn-warning"
                                                data-bs-target="#Show{{ $data->id }}" data-bs-toggle="modal">
                                                <i class='bx bx-show-alt' data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Show" data-bs-offset="0,4" data-bs-html="true"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="Show{{ $data->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="EditTitle">
                                                                Show
                                                                Data Role</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('role.update', $data->id) }}" method="post"
                                                            role="form" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="nameWithTitle" class="form-label">Nama
                                                                            Role</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-user'></i></span>
                                                                            <input
                                                                                style="font-weight: bold; padding-left: 15px;"
                                                                                type="text" id="nameWithTitle" required
                                                                                class="form-control" name="nama_roles"
                                                                                disabled value="{{ $data->nama_roles }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="nameWithTitle"
                                                                            class="form-label">Dekripsi</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bxs-edit-alt'></i></span>
                                                                            <textarea style="font-weight: bold; padding-left: 15px;" type="text-area" id="nameWithTitle" required
                                                                                class="form-control" disabled name="deskripsi_role">{{ $data->deskripsi_roles }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- EDIT DATA --}}
                                            <!-- Button yang nge-trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary"
                                                data-bs-target="#Edit{{ $data->id }}" data-bs-toggle="modal">
                                                <i class='bx bx-edit' data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Edit" data-bs-offset="0,4" data-bs-html="true"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="Edit{{ $data->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="EditTitle">
                                                                Edit
                                                                Data Role</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('role.update', $data->id) }}" method="post"
                                                            role="form" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="nameWithTitle" class="form-label">Nama
                                                                            Role</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bx-user'></i></span>
                                                                            <input
                                                                                style="font-weight: bold; padding-left: 15px;"
                                                                                type="text" id="nameWithTitle" required
                                                                                class="form-control" name="nama_roles"
                                                                                value="{{ $data->nama_roles }}" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col mb-3">
                                                                        <label for="nameWithTitle"
                                                                            class="form-label">Dekripsi</label>
                                                                        <div class="input-group input-group-merge">
                                                                            <span id="basic-icon-default-fullname2"
                                                                                class="input-group-text"><i
                                                                                    class='bx bxs-edit-alt'></i></span>
                                                                            <textarea style="font-weight: bold; padding-left: 15px;" type="text-area" id="nameWithTitle" required
                                                                                class="form-control" name="deskripsi_roles">{{ $data->deskripsi_roles }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-outline-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- DELETE DATA --}}
                                            <form id="deleteForm{{ $data->id }}" action="#" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    id="deleteButton{{ $data->id }}" data-bs-toggle="tooltip"
                                                    data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true"
                                                    title="<span>Delete</span>">
                                                    <i class='bx bx-trash'></i>
                                                </button>
                                            </form>
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
@endsection
