@extends('layouts.master')

@section('title')
    Home
@endsection

@section('content')
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
            <div class="col-md-6 mb-20">
                <div id="absen" class="card-box min-height-200px pd-20 mb-20" data-bgcolor="#455a64">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="icon-copy fa fa-camera" aria-hidden="true"></i>
                            ABSEN DATANG
                            
                            <input type="file" accept="image/*" capture="environment" id="cameraInput"
                                style="display:none;">

                            <!-- Preview Foto dan Tombol Ulangi -->
                            {{-- <div id="preview">
                                <h3>Hasil Foto:</h3>
                                <img id="previewImage" src="" alt="Preview Foto">
                                <br>
                                <button id="retryButton">Ulangi Foto</button>
                            </div> --}}

                            <script>
                                const absen = document.getElementById('absen');
                                const cameraInput = document.getElementById('cameraInput');
                                const preview = document.getElementById('preview');
                                const previewImage = document.getElementById('previewImage');
                                const retryButton = document.getElementById('retryButton');

                                // Klik gambar untuk buka kamera
                                absen.addEventListener('click', () => {
                                    cameraInput.click();
                                });

                                // Setelah ambil foto
                                cameraInput.addEventListener('change', (event) => {
                                    const file = event.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = (e) => {
                                            previewImage.src = e.target.result;
                                            preview.style.display = 'block';
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                });

                                // Klik tombol ulangi foto
                                // retryButton.addEventListener('click', () => {
                                //     cameraInput.value = ""; // Reset input agar bisa ambil ulang
                                //     preview.style.display = 'none';
                                //     cameraInput.click(); // Langsung buka kamera lagi
                                // });
                            </script>
                        </div>
                        {{-- <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-up-c"></i> jam</div>
                            <div class="font-12">Tanggal</div>
                        </div> --}}
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">{{ \Carbon\Carbon::now()->format('d-m-Y') }}
                            </div>
                            <div class="font-24 weight-500">{{ \Carbon\Carbon::now()->format('H:i:s') }}
                            </div>
                        </div>
                        <div class="max-width-150">
                            HASIL FOTO
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6 mb-20">
                <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
                    <div class="d-flex justify-content-between pb-20 text-white">
                        <div class="icon h1 text-white">
                            <i class="icon-copy fa fa-camera" aria-hidden="true"></i>
                            ABSEN PULANG
                        </div>
                        {{-- <div class="font-14 text-right">
                            <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                            <div class="font-12">Since last month</div>
                        </div> --}}
                    </div>
                    <div class="d-flex justify-content-between align-items-end">
                        <div class="text-white">
                            <div class="font-14">{{ \Carbon\Carbon::now()->format('d-m-Y') }}</div>
                            <div class="font-24 weight-500">{{ \Carbon\Carbon::now()->format('H:i:s') }}</div>
                        </div>
                        <div class="max-width-150">
                            HASIL FOTO
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row">

            <div class="col-xl-6 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0"></div>
                            <div class="weight-600 font-14">ABSEN DATANG</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 mb-30">
                <div class="card-box height-100-p widget-style1">
                    <div class="d-flex flex-wrap align-items-center">
                        <div class="progress-data">
                            <div id="chart2"></div>
                        </div>
                        <div class="widget-data">
                            <div class="h4 mb-0"></div>
                            <div class="weight-600 font-14">ABSEN PULANG</div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div> --}}
        {{-- <div class="row">
            <div class="col-xl-3 mb-30">
                <div class="card-box height-40-p pd-20">
                    <h2 class="h4 mb-20">Bonus Hari ini</h2>
                    <h5>Rp. 10.000</h5>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-40-p pd-20">
                    <h2 class="h4 mb-20">Bonus Hari ini</h2>
                    <h5>Rp. 10.000</h5>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-40-p pd-20">
                    <h2 class="h4 mb-20">Bonus Bulan ini</h2>
                    <h5>Rp. 10.000</h5>
                </div>
            </div>
            <div class="col-xl-3 mb-30">
                <div class="card-box height-40-p pd-20">
                    <h2 class="h4 mb-20">Transport Bulan ini</h2>
                    <h5>Rp. 10.000</h5>
                </div>
            </div>

        </div> --}}
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
@endsection

@section('content-2')
@endsection
