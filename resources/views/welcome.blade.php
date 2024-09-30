@extends('layouts.user')

@section('content')

    <!-- Carousel Start -->
    <div class="header-carousel owl-carousel">
        <div class="header-carousel-item">
            <div class="header-carousel-item-img-1">
                <img src="{{ asset('User/img/carousel-1.jpg') }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-start p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4 fadeInUp animate__animated" data-animation="fadeInUp"
                        data-delay="0.3s" style="animation-delay: 0.3s;">The most
                        prestigious Investments company in worldwide.</h1>
                    <p class="mb-5 fs-5 fadeInUp animate__animated" data-animation="fadeInUp" data-delay="0.5s"
                        style="animation-delay: 0.5s;">Lorem Ipsum is simply dummy text of the printing and
                        typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the
                        1500s,
                    </p>

                </div>
            </div>
        </div>
        <div class="header-carousel-item mx-auto">
            <div class="header-carousel-item-img-2">
                <img src="{{ asset('User/img/carousel-2.jpg') }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-center p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4">The most prestigious Investments company
                        in worldwide.</h1>
                    <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </p>
                    {{-- <a class="btn btn-primary rounded-pill py-3 px-5 mb-4 me-4" href="#">Apply Now</a>
                        <a class="btn btn-dark rounded-pill py-3 px-5 mb-4" href="#">Read More</a> --}}
                </div>
            </div>
        </div>
        <div class="header-carousel-item">
            <div class="header-carousel-item-img-3">
                <img src="{{ asset('User/img/carousel-3.jpg') }}" class="img-fluid w-100" alt="Image">
            </div>
            <div class="carousel-caption">
                <div class="carousel-caption-inner text-end p-3">
                    <h1 class="display-1 text-capitalize text-white mb-4">The most prestigious Investments company
                        in worldwide.</h1>
                    <p class="mb-5 fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                    </p>
                    {{-- <a class="btn btn-primary rounded-pill py-3 px-5 mb-4 me-4" href="#">Apply Now</a>
                        <a class="btn btn-dark rounded-pill py-3 px-5 mb-4" href="#">Read More</a> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Cek Sertifikat Start -->
    <div class="container-fluid sertifikat py-5 bg-light" id="sertifikat">
        <div class="container py-5 mt-5" style="margin-bottom: 5rem;">
            <div class="card py-5 shadow-lg border-0 rounded wow fadeInUp" data-wow-delay="0.1s"
                style="margin-bottom: 5rem;">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px">
                    <h4 class="text-primary">Sertifikat</h4>
                    <h1 class="display-4">Konfirmasi Sertifikat Kamu</h1>
                    <p class="fs-5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                </div>
                <div class="row g-4 justify-content-center ">
                    <div class="container justify-content-center"></div>
                    <div class="col-lg-8 wow fadeInUp text-center" data-wow-delay="0.1s">
                        <!-- Form untuk mengecek sertifikat -->
                        <form action="{{ route('checkCertificate') }}" method="POST">
                            @csrf
                            <label for="no_sertifikat" class="form-label text-center">
                                <h3>Masukan No. Sertifikat</h3>
                            </label>
                            <input type="text" class="form-control text-center nomor_sertifikat"
                                placeholder="NO. XXX/XX-XXX/XX/XXXX" id="no_sertifikat" name="nomor_sertifikat"
                                style="width:855px;">
                            <button class="btn btn-primary mt-4 w-100" type="submit">Cek</button>
                        </form>
                        <!-- Tempat untuk menampilkan hasil -->
                        <div id="result" class="mt-4">
                            @if (isset($message))
                                @if ($status == 'success')
                                    <div class="alert alert-success">{!! $message !!}</div>
                                @else
                                    <div class="alert alert-danger">{!! $message !!}</div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cek Sertifikat End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5 bg-light" id="service">
        <div class="container py-5">
            <div class="container-fluid service py-5 bg-light" id="service">
                <div class="container py-5">
                    <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 800px;">
                        <h4 class="text-primary">Our Services</h4>
                        <h1 class="display-4"> Offering the Best Consulting & Investa Services</h1>
                    </div>
                    <div class="row g-4 justify-content-center text-center">

                        @foreach ($limitTraining as $data)
                            <div class="col-md-6 col-lg-4 col-xl-3  wow fadeInUp" data-wow-delay="0.1s">
                                <a href="{{ url('pelatihan', $data->id) }}">

                                    <div class="service-item bg-light rounded">
                                        <div class="service-img ">

                                    <div class="service-item bg-light rounded d-flex flex-column h-100">
                                        <div class="service-img">

                                            <img src="{{ asset('images/training/' . $data->cover) }}"
                                                class="img-fluid w-100 rounded-top fixed-img" alt="">
                                        </div>
                                        <div class="service-content text-center p-4 flex-grow-1 d-flex flex-column">
                                            <div class="service-content-inner mb-auto">
                                                <a href="#" class="h4 mb-4 d-inline-flex text-start"><i
                                                        class="fas fa-donate fa-2x me-2"></i>{{ $data->nama_training }}</a>
                                                <p class="mb-4">
                                                    {{ $data->formatted_tanggal_training }}
                                                </p>
                                            </div>
                                            <a class="btn btn-light rounded-pill py-2 px-4 mt-auto" id="read_more"
                                                href="{{ url('pelatihan', $data->id) }}">Read More</a>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach

                        <div class="col-12">
                            <a class="btn btn-primary rounded-pill py-3 px-5 wow fadeInUp" data-wow-delay="0.1s"
                                href="{{ route('more') }}">Services More</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Services End -->

            <!-- About Start -->
            <div class="container-fluid about bg-light py-5" id="about">
                <div class="container py-5">
                    <div class="row g-5 align-items-center">
                        <div class="col-lg-6 col-xl-5 wow fadeInLeft" data-wow-delay="0.1s">
                            <div class="about-img">
                                <img src="{{ asset('User/img/about-3.png') }}"
                                    class="img-fluid w-100 rounded-top bg-white" alt="Image">
                                <img src="{{ asset('User/img/about-2.jpg') }}" class="img-fluid w-100 rounded-bottom"
                                    alt="Image">
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-7 wow fadeInRight" data-wow-delay="0.3s">
                            <h4 class="text-primary">About Us</h4>
                            <h1 class="display-5 mb-4">The most Profitable Investments company in worldwide.</h1>
                            <p class="text ps-4 mb-4">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dolores
                                atque nihil unde quisquam, deleniti illo a. Quam harum laboriosam, laudantium, deleniti
                                perferendis voluptates ex non laborum libero magni, minus illo!
                            </p>
                            <div class="row g-4 justify-content-between mb-5">
                                <div class="col-lg-6 col-xl-5">
                                    <p class="text-dark"><i class="fas fa-check-circle text-primary me-1"></i> Strategy &
                                        Consulting</p>
                                    <p class="text-dark mb-0"><i class="fas fa-check-circle text-primary me-1"></i>
                                        Business Process</p>
                                </div>
                                <div class="col-lg-6 col-xl-7">
                                    <p class="text-dark"><i class="fas fa-check-circle text-primary me-1"></i> Marketing
                                        Rules</p>
                                    <p class="text-dark mb-0"><i class="fas fa-check-circle text-primary me-1"></i>
                                        Partnerships</p>
                                </div>
                            </div>
                            <div class="row g-4 justify-content-between mb-5">
                                <div class="col-xl-5"><a href="#"
                                        class="btn btn-primary rounded-pill py-3 px-5">Discover
                                        More</a></div>
                                <div class="col-xl-7 mb-5">
                                    <div class="about-customer d-flex position-relative">
                                        <img src="{{ asset('User/img/customer-img-1.jpg') }}"
                                            class="img-fluid btn-xl-square position-absolute" style="left: 0; top: 0;"
                                            alt="Image">
                                        <img src="{{ asset('User/img/customer-img-2.jpg') }}"
                                            class="img-fluid btn-xl-square position-absolute" style="left: 45px; top: 0;"
                                            alt="Image">
                                        <img src="{{ asset('User/img/customer-img-3.jpg') }}"
                                            class="img-fluid btn-xl-square position-absolute" style="left: 90px; top: 0;"
                                            alt="Image">
                                        <img src="{{ asset('User/img/customer-img-1.jpg') }}"
                                            class="img-fluid btn-xl-square position-absolute" style="left: 135px; top: 0;"
                                            alt="Image">
                                        <div class="position-absolute text-dark" style="left: 220px; top: 10px;">
                                            <p class="mb-0">5m+ Trusted</p>
                                            <p class="mb-0">Global Customers</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-4 text-center align-items-center justify-content-center">
                                <div class="col-sm-4">
                                    <div class="bg-primary rounded p-4">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="counter-value fs-1 fw-bold text-dark"
                                                data-toggle="counter-up">32</span>
                                            <h4 class="text-dark fs-1 mb-0" style="font-weight: 600; font-size: 25px;">k+
                                            </h4>
                                        </div>
                                        <div class="w-100 d-flex align-items-center justify-content-center">
                                            <p class="text-white mb-0">Project Complete</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="bg-dark rounded p-4">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="counter-value fs-1 fw-bold text-white"
                                                data-toggle="counter-up">21</span>
                                            <h4 class="text-white fs-1 mb-0" style="font-weight: 600; font-size: 25px;">+
                                            </h4>
                                        </div>
                                        <div class="w-100 d-flex align-items-center justify-content-center">
                                            <p class="mb-0">Years Of Experience</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="bg-primary rounded p-4">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="counter-value fs-1 fw-bold text-dark"
                                                data-toggle="counter-up">97</span>
                                            <h4 class="text-dark fs-1 mb-0" style="font-weight: 600; font-size: 25px;">+
                                            </h4>
                                        </div>
                                        <div class="w-100 d-flex align-items-center justify-content-center">
                                            <p class="text-white mb-0">Team Members</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
