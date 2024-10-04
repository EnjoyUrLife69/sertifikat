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
                            <h5 class="m-0 me-2">Statistik</h5>
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
                                <h3 class="mb-2" style="margin-left: -90px"> {{ $total_pelatihan }} </h3>
                                <span style="width: 150px">Total Jumlah <br> kelas Pelatihan</span>
                            </div>
                            <canvas id="myChart1" width="250" height="125" style="margin-left: -50px;"></canvas>
                        </div>
                        <ul class="p-0 m-0">
                            @foreach ($limitTraining as $data)
                                <li class="d-flex mb-3 pb-1">
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
                <div class="col-12 mb-2">
                    <div class="card" data-aos="zoom-in" data-aos-duration="500" data-aos-delay="500">
                        <div class="card-body" style="height: 275px">
                            <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                <div style="margin-top : 5%; margin-left : 2%"
                                    class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                    <div class="card-title">
                                        <h5 class="text-nowrap mb-2">Statistik <br> Pelatihan Bulanan</h5>
                                        <span class="badge bg-label-warning rounded-pill">Tahun 2024</span>
                                    </div>
                                </div>
                                <canvas id="myChart2" width="500" height="250" style="margin-top: -12px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4 mt-3 ">
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
                    <div class="col-4 mt-3">
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
                    <div class="col-4 mt-3">
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
            </div>
        </div>
    </div>


    <script>
        // Doughnut Chart - myChart1
        const ctx1 = document.getElementById('myChart1').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    borderWidth: 1,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'],
                }]
            },
            options: {
                responsive: false, // Disable responsiveness
                plugins: {
                    legend: {
                        display: true,
                    }
                }
            }
        });

        // Line Chart - myChart2
        const ctx2 = document.getElementById('myChart2').getContext('2d');

        const trainingData = @json($trainings); // Data jumlah pelatihan per bulan
        const trainingDetails = @json($trainingDetails); // Detail pelatihan per bulan (nama dan tanggal mulai)

        // Data labels bulan dan jumlah pelatihan
        const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        const dataCounts = new Array(12).fill(0);

        // Hitung jumlah pelatihan per bulan
        trainingData.forEach(training => {
            dataCounts[training.month - 1] = training.total;
        });

        new Chart(ctx2, {
            type: 'bar', // Gunakan tipe bar
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah Pelatihan',
                    data: dataCounts, // Data jumlah pelatihan
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false, // Ukuran chart tidak berubah
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true
                        },
                        ticks: {
                            stepSize: 1, // Tampilkan angka bulat
                            callback: function(value) {
                                return Math.floor(value); // Tampilkan angka bulat
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: true
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const monthIndex = context.dataIndex + 1; // Bulan (dimulai dari 1)
                                const details = trainingDetails[monthIndex] || [];

                                if (details.length === 0) {
                                    return 'Tidak ada pelatihan';
                                }

                                // Menyusun detail tooltip
                                const jumlahPelatihan = `Jumlah: ${details.length} pelatihan`;
                                return jumlahPelatihan; // Kembalikan jumlah pelatihan di baris pertama
                            },
                            afterLabel: function(context) {
                                const monthIndex = context.dataIndex + 1;
                                const details = trainingDetails[monthIndex] || [];

                                // Tampilkan nama pelatihan dan tanggal mulai sebagai list
                                return details.map(detail => {
                                    const tanggalMulai = new Date(detail.tanggal_mulai)
                                        .toLocaleDateString('id-ID', {
                                            day: 'numeric',
                                            month: 'long',
                                        });
                                    return `• ${detail.nama_training} (Mulai: ${tanggalMulai})`; // Menambahkan bullet point
                                }).join('\n'); // Gabungkan menjadi satu string dengan newline
                            }
                        },
                        displayColors: false // Menghilangkan warna kotak di sebelah tooltip
                    }

                }
            }
        });
    </script>
@endsection
