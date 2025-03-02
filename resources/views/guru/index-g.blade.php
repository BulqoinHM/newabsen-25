@extends('layouts.master')

@section('title')
Data Guru
@endsection

@section('content')
<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="row">
            @if(session('success'))
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert">
                <strong>{{session('success')}}</strong>
                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if(session('failed'))
            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <strong>{{session('failed')}}</strong>
                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif

            @if (count($errors) > 0)
            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert">
                <strong>Data Gagal Disimpan, Pengisian form tidak lengkap</strong>
                <button
                    type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @endif
        </div>
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
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Guru-modal">
                        <i class="icon-copy ion-plus-circled"></i>
                        Tambah Data
                    </button>


                </div>
            </div>
            <!-- Modal Tambah Guru -->
            <div
                class="modal fade bs-example-modal-lg"
                data-backdrop="static"
                id="Guru-modal"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">
                                Form Data Guru
                            </h4>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-hidden="true">
                                ×
                            </button>
                        </div>
                        <div class="modal-body">
                            @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible" role="alert">
                                <ul>
                                    <li><strong>Submit Data Gagal !</strong></li>
                                    @foreach ($errors->all() as $error)
                                    <li><strong>{{ $error }}</strong></li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <form action="{{url('guru/store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Kode Guru</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="kode_guru" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama Guru</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="text"
                                            name="nama_guru" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Jenis Kelamin</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12" name="jk">
                                            <option selected="">Pilih Jenis</option>
                                            @foreach($dropdown['JK'] as $jk)
                                            <option value="{{ $jk->nilai }}">{{ $jk->nilai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tanggal Lahir</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            placeholder="Select Date"
                                            type="date"
                                            name="tgllahir" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Jabatan</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12" name="jabatan">
                                            <option selected="">Pilih Jabatan</option>
                                            @foreach($dropdown['Jabatan'] as $jabatan)
                                            <option value="{{ $jabatan->nilai }}">{{ $jabatan->nilai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Upload foto</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="file" class="form-control" name="foto">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nomor Telp</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="tel"
                                            name="notelp" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Email</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="email"
                                            name="email" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Password</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input
                                            class="form-control"
                                            type="password"
                                            name="password" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Role</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="custom-select col-12" name="role">
                                            <option selected="">Pilih Role</option>
                                            @foreach($dropdown['Role'] as $role)
                                            <option value="{{ $role->nilai }}">{{ $role->nilai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-dismiss="modal">
                                Tutup
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Simpan
                            </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Modal Tambah Guru -->
        </div>
        <!-- Fade-in effect -->
        {{-- <h5 class="h4 text-blue mb-10">Data Guru</h5> --}}
        {{-- <p class="mb-30">You can use by default <code>.da-overlay</code></p> --}}
        <div class="row clearfix">
            @foreach($datas as $data)
            <div class="col-lg-3 col-md-6 col-sm-12 mb-30">
                <div class="da-card">
                    <div class="da-card-photo">
                        @if($data->foto == '')
                        <img src="{{asset('src/images/fotonull.png')}}" alt="" />
                        @else
                        <img src="{{asset($data->foto)}}" alt="" />
                        @endif
                        <div class="da-overlay">
                            <div class="da-social">
                                <ul class="clearfix">
                                    <li>
                                        <a href="#"><i class="icon-copy fa fa-calendar-check-o" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="icon-copy fa fa-edit" aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" data-toggle="modal" data-target="#Guru-modal{{$data->id}}"><i class="icon-copy fa fa-eye" aria-hidden="true"></i></a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="da-card-content">
                        <h5 class="h5 mb-10">{{$data->nama_guru}}</h5>
                        <p class="mb-0">{{$data->kode_guru}}</p>
                        <p class="mb-0">{{$data->jabatan}}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- Modal -->

        </div>
        @include('layouts._includes._footersection')
    </div>
</div>
@endsection