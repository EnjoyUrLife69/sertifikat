@extends('layouts.dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="0">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang, <b>{{ Auth::user()->name }}!</b>
                                </h5>
                                <p class="mb-4">
                                    Anda telah mengelola <span class="fw-bold">{{ $total_sertifikat }}
                                        sertifikat</span> minggu ini. Terus tingkatkan performa Anda dan cek
                                    statistik terbaru di dashboard.
                                </p>

                            </div>

                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Statistics -->
            <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                <div class="card h-100" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="300">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="card-title mb-0">
                            <h5 class="m-0 me-2">Statistics</h5>
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                <a class="dropdown-item" href="{{ route('training.index') }}">View More</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <h2 class="mb-2"> {{ $total_pelatihan }} </h2>
                                <span>Total Jumlah <br> kelas Pelatihan</span>
                            </div>
                        </div>
                        <ul class="p-0 m-0">
                            @foreach ($limitTraining as $data)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i
                                                class='bx bxs-category'></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $data->nama_training }}</h6>
                                        </div>
                                        {{-- <div class="user-progress">
                                                <small class="fw-semibold">90.5k</small>
                                            </div> --}}
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!--/ Order Statistics -->
            <div class="col">
                <div class="row">
                    <div class="col-4">
                        <div class="card" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="700">
                            <div class="card-body d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="fw-semibold d-block mb-1">Total Jumlah peserta Pelatihan</span><br>
                                    <h3 style="margin-left: 25px;" class="card-title mb-2">
                                        <b>{{ $total_sertifikat }}</b> &nbsp; <b style="font-size: 15px">Peserta</b>
                                    </h3><br>
                                    <small class="text-body fw-semibold"><i class='bx bxs-user'></i>&nbsp;
                                        Peserta</small>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('sertifikat.index') }}">View
                                            More</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="900">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total peserta <b style="color: blue">Terdaftar</b>
                                    Pelatihan</span><br>
                                <h3 style="margin-left: 25px;" class="card-title mb-2"><b>{{ $total_terdaftar }}</b>
                                    &nbsp; <b style="font-size: 15px">Peserta</b></h3><br>
                                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i>
                                    Sertifikat tidak tersedia</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="1100">
                            <div class="card-body">
                                <span class="fw-semibold d-block mb-1">Total peserta <b style="color: green">Selesai</b>
                                    Pelatihan</span><br>
                                <h3 style="margin-left: 25px;" class="card-title mb-2"><b>{{ $total_selesai }}</b>
                                    &nbsp; <b style="font-size: 15px">Peserta</b></h3><br>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>
                                    Sertifikat tersedia</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 mb-2 mt-4">
                    <div class="card" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="500">
                        <div class="card-body" style="height: 220px">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div style="margin-top : 5%; margin-left : 5%"
                                    class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Profile Report</h5>
                                        <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                    </div>
                                    <div class="mt-sm-auto">
                                        <small class="text-success text-nowrap fw-semibold"><i
                                                class="bx bx-chevron-up"></i> 68.2%</small>
                                        <h3 class="mb-0">$84,686k</h3>
                                    </div>
                                </div>
                                <div style="margin-top : 7%;" id="profileReportChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
