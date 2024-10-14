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
                @can('role-create')
                    <div class="col-2">
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.create') }}"><i
                                class="fa-solid fa-plus"></i> Create</a>
                    </div>
                @endcan
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped" id="myTable">
                        <thead>
                            <tr>
                                <th>
                                    <center>No</center>
                                </th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no=1; @endphp
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>
                                        <center>{{ $no++ }}</center>
                                    </td>
                                    <td><b>{{ $role->name }}</b></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="{{ route('roles.show', $role->id) }}"><i
                                                class="fa-solid fa-list"></i> Show</a>
                                        @can('role-edit')
                                            <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}"><i
                                                    class="fa-solid fa-pen-to-square"></i> Edit</a>
                                        @endcan

                                        @can('role-delete')
                                            <form method="POST" action="{{ route('roles.destroy', $role->id) }}"
                                                style="display:inline">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger btn-sm"><i
                                                        class="fa-solid fa-trash"></i> Delete</button>
                                            </form>
                                        @endcan
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
