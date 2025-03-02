@extends('layouts.master')

@section('title')
    Data Guru
@endsection

@section('content')
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        {{-- <div class="title">
                        <h4>Data Guru</h4>
                    </div> --}}
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Data Guru
                                </li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right">
                        {{-- <div class="dropdown">
                        <a class="btn btn-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                            January 2018
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Export List</a>
                            <a class="dropdown-item" href="#">Policies</a>
                            <a class="dropdown-item" href="#">View Assets</a>
                        </div>
                    </div> --}}
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#GuruModal">
                            <i class="icon-copy ion-plus-circled"></i>
                            Tambah Data
                        </button>


                    </div>
                </div>
                <div class="modal fade" id="GuruModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Form Data Guru</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- Fade-in effect -->
            {{-- <h5 class="h4 text-blue mb-10">Data Guru</h5> --}}
            {{-- <p class="mb-30">You can use by default <code>.da-overlay</code></p> --}}
            <div class="row clearfix">
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo1.jpg" alt="" />
                            <div class="da-overlay">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo2.jpg" alt="" />
                            <div class="da-overlay">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo3.jpg" alt="" />
                            <div class="da-overlay">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                    <div class="da-card">
                        <div class="da-card-photo">
                            <img src="vendors/images/photo4.jpg" alt="" />
                            <div class="da-overlay">
                                <div class="da-social">
                                    <ul class="clearfix">
                                        <li>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="da-card-content">
                            <h5 class="h5 mb-10">Don H. Rabon</h5>
                            <p class="mb-0">Lorem ipsum dolor sit amet</p>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
             
            </div>
            @include('layouts._includes._footersection')
        </div>
    </div>
@endsection
