@extends('layouts.master')

@section('title')
    Home
@endsection

@section('content')
    @include('sweetalert::alert')
    {{-- @session('failed')
        <div class="alert alert-danger" role="alert">
            {{ session('failed') }}
        </div>
    @endsession
    @session('success')
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endsession --}}

    <div class="pd-Ltr-20">
        <div class="card-box pd-20 height-100-p mb-30">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <img src="{{ asset('vendors/images/banner-img.png') }}" alt="" />
                </div>
                <div class="col-md-8">
                    <h4 class="font-20 weight-500 mb-10 text-capitalize">
                        Selamat Datang
                        <div class="weight-600 font-30 text-blue">{{ Auth::user()->name }}</div>
                    </h4>
                    <p class="font-18 max-width-600">
                        Sistem Aplikasi Absensi Digital 2025
                    </p>
                </div>
            </div>
        </div>
        <div class="row">

            @if (\Carbon\Carbon::now()->format('d-m-Y') == date('d-m-Y', strtotime($jam_masuk)))
                {{-- sesudah presensi --}}
                <div class="col-md-6 mb-20">
                    <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="red">
                        <div class="d-flex justify-content-between pb-20 text-white">


                            <div class="icon h1 text-white">
                                SUDAH ABSEN MASUK
                            </div>


                        </div>
                        <div class="d-flex justify-content-between align-items-end">
                            <div class="text-white">
                                <div class="font-14">{{ date('d-m-Y', strtotime($jam_masuk)) }}
                                </div>
                                <div class="font-24 weight-500" id="clock">{{ date('H:i:s', strtotime($jam_masuk)) }}
                                </div>
                            </div>
                            <div class="max-width-150">
                                <img src="{{ asset($foto_masuk) }}" alt="" class="rounded-circle"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            </div>

                        </div>
                    </div>

                </div>
                {{-- akhir sesudah presensi --}}

                @if ($status != '0')
                    {{--  absen pulang --}}
                    <div class="col-md-6 mb-20">
                        <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                            <div class="d-flex justify-content-between pb-20 text-white">
                                <form action="{{ url('presensi/keluar') }}" id="absenKeluar" method="POST"
                                    enctype="multipart/form-data" style="display: none;">
                                    @csrf
                                    <input type="file" accept="image/*" capture="environment" name="foto_keluar"
                                        id="fotoKeluar" onchange="document.getElementById('absenKeluar').submit();">
                                    <input type="hidden" name="jam_masuk" value="{{ $jam_masuk }}">
                                </form>
                                <button type="button" class="btn btn-link" style="text-decoration: none"
                                    onclick="document.getElementById('fotoKeluar').click();">
                                    <div class="icon h1 text-white">
                                        <i class="icon-copy fa fa-camera" aria-hidden="true"></i> ABSEN PULANG
                                    </div>
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-end">
                                <div class="text-white">
                                    <div class="font-14">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                                    @if (is_null($foto_keluar))
                                        <div class="text-danger mb-2">Anda Belum Melakukan Absen Pulang</div>
                                    @else
                                        <div class="font-24 weight-500" id="clock">
                                            {{ date('H:i:s', strtotime($jam_keluar)) }}
                                    @endif
                                </div>
                            </div>
                            <div class="max-width-150">
                                <img src="{{ asset($foto_keluar) }}" alt="" class="rounded-circle"
                                    style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                            </div>

                        </div>
                    </div>
        </div>
        {{-- akhir absen pulang --}}
        @endif
    @else
        {{-- sebelum presensi --}}
        <div class="col-md-6 mb-20">
            <div class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                <div class="d-flex justify-content-between pb-20 text-white">
                    <form action="{{ url('presensi/masuk') }}" id="absenMasuk" method="POST" enctype="multipart/form-data"
                        style="display: none;">
                        @csrf
                        <input type="file" accept="image/*" capture="environment" name="foto_masuk" id="fotoMasuk"
                            onchange="document.getElementById('absenMasuk').submit();">
                    </form>
                    <button type="button" class="btn btn-link" style="text-decoration: none"
                        onclick="document.getElementById('fotoMasuk').click();">
                        <div class="icon h1 text-white">
                            <i class="icon-copy fa fa-camera" aria-hidden="true"></i> ABSEN DATANG
                        </div>
                    </button>
                </div>
                <div class="d-flex justify-content-between align-items-end">
                    <div class="text-white">
                        <div class="font-14">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                        <div class="font-24 weight-500" id="clock">00:00:00</div>
                    </div>
                </div>

            </div>
            {{-- akhir sebelum presensi --}}
            @endif

        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 pt-10 height-100-p">
                    <h2 class="mb-30 h4">Pendapatan Hari Ini</h2>
                    <div class="browser-visits">
                        <ul>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon">
                                    {{-- <img src="vendors/images/chrome.png" alt="" /> --}}
                                    <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                                </div>
                                <div class="browser-name">Bonus Hari ini</div>
                                <div class="visit">
                                    <span class="badge badge-pill badge-primary">Rp. 10.000</span>
                                </div>
                            </li>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon">
                                    {{-- <img src="vendors/images/firefox.png" alt="" /> --}}
                                    <i class="icon-copy fa fa-money" aria-hidden="true"></i>
                                </div>
                                <div class="browser-name">Transport Hari ini</div>
                                <div class="visit">
                                    <span class="badge badge-pill badge-secondary">Rp. 50.000</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 mb-30">
                <div class="card-box pd-30 pt-10 height-100-p">
                    <h2 class="mb-30 h4">Pendapatan Bulan Ini</h2>
                    <div class="browser-visits">
                        <ul>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon">
                                    {{-- <img src="vendors/images/chrome.png" alt="" /> --}}
                                    <span class="icon-copy ti-wallet"></span>
                                </div>
                                <div class="browser-name">Bonus Bulan ini</div>
                                <div class="visit">
                                    <span class="badge badge-pill badge-warning">Rp. 10.000</span>
                                </div>
                            </li>
                            <li class="d-flex flex-wrap align-items-center">
                                <div class="icon">
                                    {{-- <img src="vendors/images/firefox.png" alt="" /> --}}
                                    <span class="icon-copy ti-wallet"></span>
                                </div>
                                <div class="browser-name">Transport Bulan ini</div>
                                <div class="visit">
                                    <span class="badge badge-pill badge-success">Rp. 50.000</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts._includes._footersection')

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateClock() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                const seconds = String(now.getSeconds()).padStart(2, '0');

                document.getElementById('clock').textContent = $ {
                    hours
                }: $ {
                    minutes
                }: $ {
                    seconds
                };
            }

            // Panggil langsung dan setiap 1 detik
            updateClock();
            setInterval(updateClock, 1000);
        });
    </script>
@endsection

@section('content-2')
@endsection
